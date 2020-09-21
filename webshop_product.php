<?php

require_once 'object_utils.php';

/**
 * Description of WebshopProduct
 *
 * @author Kevin de Vries
 */
class WebshopProduct {
  public $product_id;
  public $name;
  public $price;
  public $description;
  public $image_path;
  public $row_index;
  public $quantity;

  use ObjectUtils;

  public   function __construct($copy=NULL,$quantity=1) {
    if (is_array($copy)) {
      $this->fromArray($copy);
    }
    elseif (is_object($copy)) {
      $this->fromObject($copy);
    }
    $this->quantity = $quantity;
  }

  public   function subtotal() {
    return $this->quantity * $this->price / 100;
  }
}

?>