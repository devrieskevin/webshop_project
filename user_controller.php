<?php

require_once 'user_model.php';

/**
 * Description of UserController
 *
 * @author Kevin de Vries
 */
class UserController {
  private $model;

  public   function __construct($pageModel) {
    $this->model = new UserModel($pageModel,$pageModel->crud);
  }

  public   function contact() {
    $this->model->validateContact();
    $this->model->submitText = 'Verstuur';
    if ($this->model->valid) {
      require 'contact_reaction_doc.php';
      $view = new ContactReactionDoc($this->model);
    }
    else {
      require 'contact_doc.php';
      $view = new ContactDoc($this->model);
    }
    $view->show();
  }

  public   function login() {
    $this->model->processLogin();
    if ($this->model->valid) {
      require 'home_doc.php';
      $view = new HomeDoc($this->model);
    }
    else {
      require 'login_doc.php';
      $view = new LoginDoc($this->model);
    }
    $view->show();
  }

  public   function logout() {
    $this->model->logoutUser();
    $this->model->pageType = $this->model->page = 'home';
    $this->model->createMenu();
    require 'home_doc.php';
    $view = new HomeDoc($this->model);
    $view->show();
  }

  public   function register() {
    $this->model->processRegister();
    $this->model->submitText = 'Registreren';
    if ($this->model->valid) {
      require 'login_doc.php';
      $this->model->pageType = $this->model->page = 'login';
      $view = new LoginDoc($this->model);
    }
    else {
      require 'register_doc.php';
      $view = new RegisterDoc($this->model);
    }
    $view->show();
  }
}
