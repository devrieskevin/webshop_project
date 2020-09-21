<?php

require_once 'basic_doc.php';

/**
 * Description of HomeDoc
 *
 * @author Kevin de Vries
 */
class HomeDoc extends BasicDoc {

  public    function __construct($model) {
    parent::__construct($model);
  }

  // Override functions from BasicDoc
  protected function bodyHeaderContent() {
    echo 'Home';
  }

  protected function mainContent() {
    echo '<p>
          Welkom op de website van Kevin de Vries! <br>
          Op deze website kan je over mij lezen en een bericht naar mij sturen.
          </p>';
  }
}

?>