<?php
require_once "user_model.php";
require_once 'test_crud.php';

use PHPUnit\Framework\TestCase;

class UserModelTest extends TestCase {


  /** Test if a UserModel is created when called without a PageModel */
  public function testConstructEmpty() {
    // prepare
    $crud = new TestCrud();

    // test
    $result = new UserModel(null, $crud);

    // validate
    $this->assertNotEmpty($result); // <-- When the $result variable happens to be empty the test has 'failed'
  }

  /** Test if a created UserModel copies properties from PageModel */
  public function testConstructPropertiesFromPageModel() {
    // prepare
    $pageModel = new PageModel(null);
    $pageModel->page = 'test';

    $crud = new TestCrud();

    // test
    $result = new UserModel($pageModel, $crud);

    // validate
    $this->assertNotEmpty($result);
    $this->assertEquals('test', $result->page); // <-- When the page property is 'test' here, and the function ends normally the test is 'passed'
  }

  // ..... other functions
}

?>