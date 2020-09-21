<?php

require_once 'basic_doc.php';

/**
 * Description of AboutDoc
 *
 * @author Kevin de Vries
 */
class TopFiveDoc extends BasicDoc {

  public    function __construct($model) {
    parent::__construct($model);
  }

  private   function topFiveItem($product) {
    echo '<li>';
    echo '<a href="index.php?page=product&product_id=' . $product->product_id . '">';
    echo $product->name;
    echo '</a>';
    echo ', aantal besteld: ' . $product->full_quantity;
    echo '</li>';
  }

  // Override functions from BasicDoc
  protected function bodyHeaderContent() {
    echo 'Top 5';
  }

  protected function mainContent() {
    echo 'Product ranking:';
    echo '<ol>';
    foreach ($this->model->products as $product) {
      $this->topFiveItem($product);
    }
    echo '</ol>';
  }
}

?>