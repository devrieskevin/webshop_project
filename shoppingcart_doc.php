<?php

require_once 'form_doc.php';

/**
 * Description of ShoppingcartDoc
 *
 * @author Kevin de Vries
 */
class ShoppingcartDoc extends FormDoc{
  public    function __construct($model) {
    parent::__construct($model);
  }

  private   function productImage($key) {
    $product = $this->model->products[$key];
    echo '<img class="img-thumbnail" src="' . $product->image_path . '">';
  }

  private   function productName($key) {
    $product = $this->model->products[$key];
    echo $product->name;
  }

  private   function productPrice($key) {
    $product = $this->model->products[$key];
    $price_float = $product->price / 100;
    echo 'Prijs: &euro;' . number_format($price_float,2,',','.');
  }

  private   function productSubtotal($key) {
    $product = $this->model->products[$key];
    echo 'Subtotaal: &euro;' . number_format($product->subtotal(),2,',','.');
  }

  private function showPriceTotal() {
    echo '<p>';
    echo 'Totaal: &euro;' . number_format($this->model->priceTotal,2,',','.');
    echo '</p>';
  }

  private   function emptyShoppingcart() {
    echo '<p> Er staan geen producten in de winkelwagen </p>';
  }

  private   function orderButton() {
    echo '<div>';
    echo '<a class = "btn btn-primary" href = "index.php?page=order">';
    echo 'Afrekenen';
    echo '</a>';
    echo '</div>';
  }

  // Override function from BasicDoc
  protected function bodyHeaderContent() {
    echo 'Shopping cart';
  }

  // Override function from FormDoc
  protected function beginFormField() {
    echo '<div class="form-group row align-items-center">';
  }

  protected function formFieldLabel($key) {
    $product = $this->model->products[$key];
    $quantityLabel = 'quantity[' . $product->product_id . ']';
    echo '<label class = "col-form-label" for = "' . $quantityLabel . '">';
    echo Util::getArrayVal($this->model->meta['quantity'],'formLabel') . ':';
    echo '</label>';
  }

  protected function formFieldInput($key) {
    $product = $this->model->products[$key];
    $quantityLabel = 'quantity[' . $product->product_id . ']';
    echo '<input type = "number" min = "1" value = "' . $product->quantity . '" '
       . 'id = "' . $quantityLabel . '" name = "' . $quantityLabel . '">';
  }

  protected function formFieldContent($key) {
    echo '<div class = "col-md">';
    $this->productImage($key);
    echo '</div>';

    echo '<div class = "col-md">';
    $this->productName($key);
    echo '</div>';

    echo '<div class = "col-md">';
    $this->productPrice($key);
    echo '</div>';

    echo '<div class = "col-md">';
    $this->formFieldLabel($key);
    $this->formFieldInput($key);
    echo '</div>';

    echo '<div class = "col-md">';
    echo $this->productSubtotal($key);
    echo '</div>';
  }

  protected function formContent() {
    foreach (array_keys($this->model->products) as $key) {
      $this->formField($key);
    }
  }

  protected function mainContent() {
    if (!empty($this->model->products)) {
      $this->form();
      $this->showPriceTotal();
      $this->orderButton();
    }
    else {
      $this->emptyShoppingcart();
    }
  }
}

?>