<?php

require_once 'shop_model.php';

/**
 * Description of UserController
 *
 * @author Kevin de Vries
 */
class ShopController {
  private $model;

  public   function __construct($pageModel) {
    $this->model = new ShopModel($pageModel,$pageModel->crud);
  }

  public   function webshop() {
    $this->model->processWebshop();
    require 'webshop_doc.php';
    $view = new WebshopDoc($this->model);
    $view->show();
  }

  public   function topFive() {
    $this->model->processTopFive();
    require 'topfive_doc.php';
    $view = new TopFiveDoc($this->model);
    $view->show();
  }

  public   function product() {
    $this->model->processProduct();
    $this->model->pageType = 'webshop';
    if ($this->model->valid) {
      require 'product_ordered_doc.php';
      $view = new ProductOrderedDoc($this->model);
    }
    else {
      require 'product_doc.php';
      $view = new ProductDoc($this->model);
    }
    $view->show();
  }

  public   function productEdit() {
    $this->model->processProductEdit();
    $this->model->pageType = 'webshop';
    $this->model->submitText = 'Bewerken';
    if ($this->model->valid) {
      $this->model->processWebshop();
      require 'webshop_doc.php';
      $view = new WebshopDoc($this->model);
    }
    else {
      require 'product_edit_doc.php';
      $view = new ProductEditDoc($this->model);
    }
    $view->show();
  }


  public   function shoppingcart() {
    $this->model->processShoppingcart();
    $this->model->submitText = 'Bewerken';
    require 'shoppingcart_doc.php';
    $view = new ShoppingcartDoc($this->model);
    $view->show();
  }

  public   function order() {
    $this->model->processOrder();
    if ($this->model->valid) {
      require 'home_doc.php';
      $this->model->pageType = 'home';
      $view = new HomeDoc($this->model);
      $view->show();
    }
    else {
      $this->model->pageType = 'shoppingcart';
      $this->shoppingcart();
    }
  }
}
