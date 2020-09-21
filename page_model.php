<?php

require_once 'util.php';

/**
 * Description of PageModel
 *
 * @author Kevin de Vries
 */
class PageModel {
  public $page;
  public $pageType;
  protected $isPost;
  public $menu;
  public $errors = [];

  protected $sessionManager;
  protected $fileIOManager;

  public $crud;

  public    function __construct($copy,$sessionManager=NULL,$fileIOManager=NULL,$crud=NULL) {
    if ($copy) {
      $this->page = $copy->page;
      $this->pageType = $copy->pageType;
      $this->isPost = $copy->isPost;
      $this->menu = $copy->menu;
      $this->sessionManager = $copy->sessionManager;
      $this->fileIOManager = $copy->fileIOManager;
    }

    if ($sessionManager) {
      $this->sessionManager = $sessionManager;
    }

    if ($fileIOManager) {
      $this->fileIOManager = $fileIOManager;
    }

    if ($crud) {
      $this->crud = $crud;
    }
  }

  public    function getRequestedPage() {
    // $this->isPost = (filter_input(INPUT_SERVER,'REQUEST_METHOD') === 'POST');
    $this->isPost = ($_SERVER['REQUEST_METHOD'] === 'POST');
    if ($this->isPost) {
      $this->pageType = $this->page = Util::getPostVar('page','home');
    }
    else {
      $this->pageType = $this->page = Util::getUrlVar('page','home');
    }
  }

  public    function createMenu() {
    $this->menu = ['home' => 'Home', 'about' => 'About', 'contact' => 'Contact',
                   'webshop' => 'Webshop', 'topfive' => 'Top 5'];

    $this->menu['shoppingcart'] = '<i class="fas fa-shopping-cart d-none d-lg-inline"></i> '
                                . 'Shopping cart';

    if (!$this->sessionManager->isUserLoggedIn()) {
      $this->menu['login'] = 'Login';
      $this->menu['register'] = 'Register';
    }
    else {
      $this->menu['logout'] = 'Logout <span class = "d-none d-lg-inline">'
                            . $this->sessionManager->getLoggedInUserName() . '</span>';
    }
  }

  // FILE COMMUNICATION

  public    function logError($message) {
    date_default_timezone_set("Europe/Amsterdam");
    $date = date('Y/m/d H:i:s');
    $logEntry = $date . "\t" . $message;
    $this->fileIOManager->saveToLog($logEntry);
  }
}
 ?>