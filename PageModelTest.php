<?php
require_once "page_model.php";

use PHPUnit\Framework\TestCase;

class PageModelTest extends TestCase {


  /** Test if a PageModel is created when called with 'null' */
  public function testConstructEmpty() {
    // prepare
       /* nothing to prepare here */

    // test
    $result = new PageModel(null);

    // validate
    $this->assertNotEmpty($result); // <-- When the $result variable happens to be empty the test has 'failed'
  }

  /** Test if a PageModel is created when called with 'null' */
  public function testConstructNotEmpty() {
    // prepare
    $copy = new PageModel(null);
    $copy->page = 'test';

    // test
    $result = new PageModel($copy);

    // validate
    $this->assertNotEmpty($result);
    $this->assertEquals('test', $result->page); // <-- When the page property is 'test' here, and the function ends normally the test is 'passed'
  }

  /** Test if the 'page' is read from the URL */
  public function testGetRequestedPageOnGetWithPage() {
    // prepare
    $_SERVER['REQUEST_METHOD'] = 'GET';
    $_GET['page'] = 'abcd';
    $sut = new PageModel(null); // SUT = Software Under Test

    // test
    $sut->getRequestedPage();

    // validate
    $this->assertEquals('abcd', $sut->page);
  }

  /** Test if the 'page' is missing from the URL */
  public function testGetRequestedPageOnGetWithoutPage() {
    // prepare
    $_SERVER['REQUEST_METHOD'] = 'GET';
    unset($_GET['page']);

    $sut = new PageModel(null);

    // test
    $sut->getRequestedPage();

    // validate
    $this->assertEquals('home', $sut->page); // Expect the default page 'home'
  }

  /** Test if the 'page' is read from the URL */
  public function testGetRequestedPageOnPostWithPage() {
    // prepare
    $_SERVER['REQUEST_METHOD'] = 'POST';
    $_POST['page'] = 'efgh';
    $sut = new PageModel(null);

    // test
    $sut->getRequestedPage();

    // validate
    $this->assertEquals('efgh', $sut->page);
  }

  // ..... other functions
}

?>