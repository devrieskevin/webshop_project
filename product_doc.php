<?php

require_once 'webshop_doc.php';

/**
 * Description of ProductDoc
 *
 * @author Kevin de Vries
 */
class ProductDoc extends WebshopDoc {

  public    function __construct($model) {
    parent::__construct($model);
  }

  private   function productDescription($product) {
    echo '<div> Omschrijving: </div>';
    echo '<div>' . $product->description . '</div>';
  }

  // Override functions from WebshopDoc
  protected function productImage($product) {
    echo '<img class="img-thumbnail w-50" src="' . $product->image_path . '">';
  }

  protected function mainContent() {
    if (empty($this->model->errors)) {
      echo '<div>';

      $this->productImage($this->model->product);
      $this->productName($this->model->product);
      $this->productPrice($this->model->product);
      $this->productDescription($this->model->product);

      echo '<div>';
      if ($this->model->loggedIn) {
        $this->orderProductButton($this->model->product);
      }
      if ($this->model->isAdmin) {
        echo '<a class = "btn" href = "index.php?page=productEdit&amp;product_id='
           . $this->model->product->product_id . '"><i class = "fas fa-edit"></i></a>';
      }
      echo '</div>';

      echo '</div>';
    }
  }
}

?>