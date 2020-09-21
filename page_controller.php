<?php

require_once 'page_model.php';

/**
 * Description of PageController
 *
 * @author Kevin de Vries
 */
class PageController {
  private $model;

  public   function __construct($pageModel) {
    $this->model = $pageModel;
  }

  public   function handleRequest() {
    $this->model->getRequestedPage();
    $this->model->createMenu();

    switch ($this->model->page) {
      case 'home':
        require 'home_doc.php';
        $view = new HomeDoc($this->model);
        $view->show();
        break;
      case 'about':
        require 'about_doc.php';
        $view = new AboutDoc($this->model);
        $view->show();
        break;
      case 'contact':
        require 'user_controller.php';
        $controller = new UserController($this->model);
        $controller->contact();
        break;
      case 'login':
        require 'user_controller.php';
        $controller = new UserController($this->model);
        $controller->login();
        break;
      case 'logout':
        require 'user_controller.php';
        $controller = new UserController($this->model);
        $controller->logout();
        break;
      case 'register':
        require 'user_controller.php';
        $controller = new UserController($this->model);
        $controller->register();
        break;
      case 'webshop':
        require 'shop_controller.php';
        $controller = new ShopController($this->model);
        $controller->webshop();
        break;
      case 'topfive':
        require 'shop_controller.php';
        $controller = new ShopController($this->model);
        $controller->topFive();
        break;
      case 'product':
        require 'shop_controller.php';
        $controller = new ShopController($this->model);
        $controller->product();
        break;
      case 'productEdit':
        require 'shop_controller.php';
        $controller = new ShopController($this->model);
        $controller->productEdit();
        break;
      case 'shoppingcart':
        require 'shop_controller.php';
        $controller = new ShopController($this->model);
        $controller->shoppingcart();
        break;
      case 'order':
        require 'shop_controller.php';
        $controller = new ShopController($this->model);
        $controller->order();
        break;
      default:
        require 'basic_doc.php';
        $view = new BasicDoc($this->model);
        $view->show();
        break;
    }
  }

}

?>