<?php

require_once 'page_model.php';


/**
 * Description of TestingModel
 *
 * @author Kevin de Vries
 */
abstract class TestingModel extends PageModel {
  public $meta = [];

  public    function __construct($pageModel) {
    parent::__construct($pageModel);
  }

  abstract public function initializeMetaData(...$requestValues);

  protected function processInput($getMethod) {
    foreach (array_keys($this->meta) as $key) {
      $this->$key = Util::$getMethod($key);
      if ($getMethod !== 'getPostArray') {
        $this->$key = trim($this->$key);
      }

      // Test input
      $this->testInput($key);

      // Sanitize input for html
      if ($getMethod !== 'getPostArray') {
        $this->$key = htmlspecialchars($this->$key);
      }
    }
  }

  protected function testInput($key) {
    foreach (Util::getArrayVal($this->meta[$key],'validations',[]) as $test) {
      if (empty($this->errors[$key])) {
        $this->$test($key);
      }
      else {
        break;
      }
    }
  }

  // TEST FUNCTIONS
  protected function testIfEmpty($key) {
    if (empty($this->$key)) {
      $this->errors[$key] = 'Dit veld moet ingevuld zijn';
    }
  }
}

?>