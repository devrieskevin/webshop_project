<?php

require_once 'testing_model.php';
require_once 'webshop_product.php';
require_once 'shop_crud.php';

/**
 * Description of ShopModel
 *
 * @author Kevin de Vries
 */
class ShopModel extends TestingModel {
  public $loggedIn = false;
  public $isAdmin = false;
  public $ordered = false;
  public $products = [];
  public $product = NULL;
  public $product_id = '';
  public $row_index = '';
  public $name = '';
  public $price = '';
  public $description = '';
  public $image_path = '';
  public $quantity = [];
  public $priceTotal = 0;
  public $valid = false;

  private $shopCrud;

  public    function __construct($pageModel,$crud) {
    parent::__construct($pageModel);
    $this->shopCrud = new ShopCrud($crud);
  }

  public    function initializeMetaData(...$requestValues) {
    foreach ($requestValues as $value) {
      switch ($value) {
        case 'name':
          $this->meta['name'] = ['formLabel' => 'Naam', 'type' => 'text'];
          break;
        case 'price':
          $this->meta['price'] = ['formLabel' => 'Prijs', 'type' => 'price'];
          break;
        case 'quantity':
          $this->meta['quantity'] = ['formLabel' => 'Aantal', 'type' => 'number'];
          break;
        case 'description':
          $this->meta['description'] = ['formLabel' => 'Omschrijving', 'type' => 'textarea'];
          break;
        case 'image':
          $this->meta['image'] = ['formLabel' => 'Afbeelding', 'type' => 'file'];
          break;
        case 'product_id':
          $this->meta['product_id'] = ['type' => 'hidden'];
          break;
        case 'row_index':
          $this->meta['row_index'] = ['type' => 'hidden'];
          break;
        default:
          $this->meta[$value] = [];
      }
    }
  }

  // VALIDATION AND PROCESSING FUNCTIONS

  public    function processWebshop(){
    try {
      $this->products = $this->shopCrud->getAllProducts();
      $this->loggedIn = $this->sessionManager->isUserLoggedIn();
      $this->isAdmin = $this->sessionManager->isUserAdmin();
    }
    catch (Exception $e) {
      $this->logError($e->getMessage());
      $this->errors['main'] = 'A technical error has occurred while '
                            . 'retrieving the webshop products, please try again later';
    }
  }

  public    function processTopFive(){
    try {
      $this->products = $this->shopCrud->getTopFiveProducts();
    }
    catch (Exception $e) {
      $this->logError($e->getMessage());
      $this->errors['main'] = 'A technical error has occurred while '
                            . 'retrieving the webshop products, please try again later';
    }
  }

  public    function validateProduct() {
    $this->initializeMetaData('product_id');
    $this->meta['product_id']['validations'] = ['testProductExists','testImageExists'];
    if ($this->isPost) {
      $this->processInput('getPostVar');
      if ($this->sessionManager->isUserLoggedIn()) {
        $this->valid = empty($this->errors);
      }
    }
    else {
      $this->processInput('getUrlVar');
    }
  }

  public    function processProduct() {
    $this->validateProduct();

    $this->loggedIn = $this->sessionManager->isUserLoggedIn();
    $this->isAdmin = $this->sessionManager->isUserAdmin();
    if ($this->valid) {
      $this->sessionManager->addToShoppingcart($this->product_id);
    }
  }

  public    function validateProductEdit() {
    $this->initializeMetaData('product_id','row_index','name','price','description','image');
    $this->meta['product_id']['validations'] = ['testProductExists'];

    if ($this->isPost) {
      $this->meta['name']['validations'] = ['testIfEmpty'];
      $this->meta['price']['validations'] = ['testIfEmpty'];
      $this->meta['description']['validations'] = ['testIfEmpty'];
      $this->meta['image']['validations'] = ['testUploadSucceeded','testIfUploadImage','testImageSize'];

      $this->processInput('getPostVar');
    }
    else {
      $this->processInput('getUrlVar');
      if (!empty($this->product)) {
        $this->unpackProduct();
      }
    }

    // Remove errors when no product_id is given
    if (!empty($this->errors['main']) && empty($this->product_id)) {
      unset($this->errors['main']);
    }

    if ($this->isPost) {
      $this->valid = empty($this->errors);
    }
  }

  public    function processProductEdit() {
    $this->validateProductEdit();
    $this->isAdmin = $this->sessionManager->isUserAdmin();

    try {
      if ($this->valid) {
        $this->storeUploadedProductImage();
        $this->editProduct();
      }
    }
    catch (Exception $e) {
      $this->logError($e->getMessage());
      $this->errors['main'] = 'A technical error has occurred while '
                            . 'editing the product, please try again later';
      $this->valid = false;
    }
  }

  public    function validateShoppingcart() {
    $this->initializeMetaData('quantity');
    if ($this->isPost) {
      $this->meta['quantity']['validations'] = ['testQuantityValidity'];
      $this->processInput('getPostArray');
      $this->valid = empty($this->errors);
    }
  }

  public    function processShoppingcart() {
    $this->validateShoppingcart();
    $this->loggedIn = $this->sessionManager->isUserLoggedIn();

    if (!$this->loggedIn) {
      $this->valid = false;
    }

    if ($this->valid) {
      $this->sessionManager->updateProductQuantities($this->quantity);
    }

    try {
      $this->getShoppingcartProducts();
      $this->calculatePriceTotal();
    }
    catch (Exception $e) {
      $this->logError($e->getMessage());
      $this->errors['main'] = 'A technical error has occurred while '
                            . 'processing the order, please try again later';
    }
  }

  public    function processOrder() {
    try {
      $this->getShoppingcartProducts();

      if (!empty($this->products)) {
        $user_id = $this->sessionManager->getLoggedInUserId();
        $this->shopCrud->storeOrder($user_id,$this->products);
        $this->sessionManager->emptyShoppingcart();
        $this->valid = true;
      }
    }
    catch (Exception $e) {
      $this->logError($e->getMessage());
      $this->errors['main'] = 'A technical error has occurred while '
                            . 'processing the order, please try again later';
    }
  }

  // BUSINESS LOGIC FUNCTIONS

  public    function calculatePriceTotal() {
    $this->priceTotal = 0;
    foreach ($this->products as $product) {
      $this->priceTotal += $product->subtotal();
    }
  }

  public    function packProduct() {
    $this->product = new WebshopProduct();
    foreach (['product_id','name','description','image_path','row_index'] as $key) {
      $this->product->$key = $this->$key;
    }
    $this->product->price = $this->price * 100;
  }

  public    function unpackProduct() {
    foreach (['product_id','name','description','image_path','row_index'] as $key) {
      $this->$key = $this->product->$key;
    }
    $this->price = $this->product->price / 100;
  }

  // SESSION COMMUNICATION

  public    function getShoppingcartProducts() {
    $quantities = $this->sessionManager->getShoppingcartProducts();
    $this->products = $this->shopCrud->getMultipleProducts(...array_keys($quantities));
    foreach ($this->products as $product){
      $product->quantity = $quantities[$product->product_id];
    }
  }

  // FILE COMMUNICATION

  public    function storeUploadedProductImage() {
    if ($this->fileIOManager->uploadSucceeded('image')) {
      $this->image_path = $this->fileIOManager->saveUploadedProductImage();
    }
    else {
      $this->image_path = $this->product->image_path;
    }
  }

  // DATABASE COMMUNICATION

  public    function editProduct() {
    $user_id = $this->sessionManager->getLoggedInUserId();
    $this->packProduct();

    $editSuccess = $this->shopCrud->editProduct($user_id, $this->product);
    if(!$editSuccess) {
      $this->errors['main'] = 'Dit product is tijdens het bewerken veranderd door een andere admin. '
                            . 'De bijgewerkte informatie wordt getoond in het formulier.';
      $this->valid = false;
      $this->product = $this->shopCrud->getProduct($this->product_id);
      $this->unpackProduct();
    }
  }

  // TEST FUNCTIONS

  protected function testProductExists($key) {
    if(empty($this->$key)){
      $this->errors['main'] = 'Er is geen product ID gegeven';
      return;
    }

    try {
      $this->product = $this->shopCrud->getProduct($this->$key);
      if (empty($this->product)) {
        $this->errors['main'] = 'Dit product id is niet in gebruik';
      }
    }
    catch (Exception $e){
      $this->logError($e->getMessage());
      $this->errors['main'] = 'A technical error has occurred while '
                            . 'retrieving the product data, please try again later';
    }
  }

  protected function testQuantityValidity($key) {
    foreach ($this->$key as $quantity) {
      if ($quantity < 1) {
        $this->errors['main'] = 'Er is een ongeldig aantal ingevuld bij een '
                              . 'van de producten in de winkelwagen';

        break;
      }
    }
  }

  protected function testImageExists($key) {
    if (!file_exists($this->product->image_path)) {
      $this->errors['main'] = 'Path to image file could not be found.';
    }
  }

  protected function testUploadSucceeded($key) {
    if (empty($this->product_id) && !$this->fileIOManager->uploadSucceeded($key)) {
      $this->errors[$key] = 'Het uploaden van de afbeelding is niet gelukt';
    }
  }

  protected function testIfUploadImage($key) {
    $existingProductCheck = !empty($this->product_id) &&
                            $this->fileIOManager->uploadSucceeded($key);

    if (empty($this->product_id) || $existingProductCheck) {
      if (!$this->fileIOManager->isUploadImage($key)) {
        $this->errors[$key] = 'De geuploade file is geen afbeelding';
      }
    }
  }

  protected function testImageSize($key) {
    $existingProductCheck = !empty($this->product_id) &&
                            $this->fileIOManager->uploadSucceeded($key);

    if (empty($this->product_id) || $existingProductCheck ) {
      if ($this->fileIOManager->uploadedFileSize($key) > 2000000) {
        $this->errors[$key] = 'De geuploade afbeelding is te groot';
      }
    }
  }

}

 ?>