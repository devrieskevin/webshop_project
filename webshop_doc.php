<?php

require_once 'basic_doc.php';

/**
 * Description of WebshopDoc
 *
 * @author Kevin de Vries
 */
class WebshopDoc extends BasicDoc {

  public    function __construct($model) {
    parent::__construct($model);
  }

  private   function webshopItemHeader($product){
    echo '<div class = "card-header">';
    $this->productImage($product);
    echo '</div>';
  }

  private   function webshopItemBody($product) {
    echo '<div class = "card-body">';
    $this->productName($product);
    $this->productPrice($product);
    if ($this->model->loggedIn){
      echo '<div>';
      $this->orderProductButton($product);
      echo '</div>';
    }
    echo '</div>';
  }

  private   function webshopItem($product) {
    echo '<div class = "col-12 col-sm-6 col-md-4 col-lg-3">';

    $reference = 'index.php?page=product&amp;product_id=' . $product->product_id;
    echo '<a class="btn text-decoration-none" href="'.$reference.'">';
    echo '<div class = "card">';
    $this->webshopItemHeader($product);
    $this->webshopItemBody($product);
    echo '</div>';
    echo '</a>';

    echo '</div>';
  }

  private   function addProductButton() {
    echo '<div class = "col-12 col-sm-6 col-md-4 col-lg-3 align-self-center text-center">';
    echo '<a class = "btn btn-primary" href = "index.php?page=productEdit">';
    echo '<i class = "fas fa-plus-circle"></i> Add product';
    echo '</a>';
    echo '</div>';
  }

  protected function productImage($product) {
    echo '<img class="img-thumbnail" src="' . $product->image_path . '">';
  }


  protected function productName($product) {
    echo '<div>' . $product->name . '</div>';
  }

  protected function productPrice($product) {
    $price_float = $product->price / 100;
    $priceFormatted = number_format($price_float,2,',','.');
    echo '<div>Prijs: &euro;' . $priceFormatted . '</div>';
  }

  protected function orderProductButton($product) {
    echo '<form class = "d-inline" method="post" action="index.php">';
    echo '<input type="hidden" name="page" value="product">';
    echo '<input type="hidden" name="product_id" value="' . $product->product_id . '">';
    echo '<button type="submit" class = "btn btn-primary">Bestellen</button>';
    echo '</form>';
  }


  // Override functions from BasicDoc
  protected function bodyHeaderContent() {
    echo 'Webshop';
  }

  protected function mainContent() {
    echo '<div class = "row align-items-end">';
    foreach ($this->model->products as $product) {
      $this->webshopItem($product);
    }
    if ($this->model->isAdmin) {
      $this->addProductButton();
    }
    echo '</div>';
  }
}

?>