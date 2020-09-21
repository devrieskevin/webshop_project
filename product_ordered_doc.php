<?php

require_once 'basic_doc.php';

/**
 * Description of ProductOrderedDoc
 *
 * @author Kevin de Vries
 */
class ProductOrderedDoc extends BasicDoc {

  public    function __construct($model) {
    parent::__construct($model);
  }

  // Override functions from BasicDoc
  protected function bodyHeaderContent() {
    echo 'Webshop';
  }

  protected function mainContent() {
    echo '<p>';
    echo 'Het product is toegevoegd aan je winkelwagen. <br>';
    echo '<a href="index.php?page=webshop">Verder winkelen</a>';
    echo ' of ';
    echo '<a href="index.php?page=shoppingcart">verder naar bestellen</a>.';
    echo '</p>';
  }
}

?>