<?php

require_once 'testing_model.php';
require_once 'user.php';
require_once 'user_crud.php';

/**
 * Description of UserModel
 *
 * @author Kevin de Vries
 */
class UserModel extends TestingModel {
  public $user = NULL;
  public $user_id = '';
  public $isAdmin = false;
  public $name = '';
  public $email = '';
  public $message = '';
  public $password = '';
  public $confirmPassword = '';
  public $valid = false;

  private $userCrud;

  public function __construct($pageModel, $crud) {
    parent::__construct($pageModel);
    $this->userCrud = new UserCrud($crud);
  }

  public function initializeMetaData(...$requestValues) {
    foreach ($requestValues as $value) {
      switch ($value) {
        case 'name':
          $this->meta['name'] = ['formLabel' => 'Naam', 'type' => 'text'];
          break;
        case 'email':
          $this->meta['email'] = ['formLabel' => 'E-mail', 'type' => 'email'];
          break;
        case 'message':
          $this->meta['message'] = ['formLabel' => 'Bericht', 'type' => 'textarea'];
          break;
        case 'password':
          $this->meta['password'] = ['formLabel' => 'Wachtwoord', 'type' => 'password'];
          break;
        case 'confirmPassword':
          $this->meta['confirmPassword'] = ['formLabel' => 'Herhaal Wachtwoord', 'type' => 'password'];
          break;
      }
    }
  }

  public function validateContact() {
    $this->initializeMetaData('name','email','message');
    $this->meta['name']['validations'] = ['testIfEmpty','testNoLetters'];
    $this->meta['email']['validations'] = ['testIfEmpty','testEmailValidity'];
    $this->meta['message']['validations'] = ['testIfEmpty'];

    if($this->isPost) {
      $this->processInput('getPostVar');
      $this->valid = empty($this->errors);
    }
  }

  public function validateLogin() {
    $this->initializeMetaData('email','password');
    $this->meta['email']['validations'] = ['testIfEmpty','testEmailValidity'];
    $this->meta['password']['validations'] = ['testIfEmpty','testAuthentication'];

    if($this->isPost) {
      $this->processInput('getPostVar');
      $this->valid = empty($this->errors);
    }
  }

  public function processLogin() {
    $this->validateLogin();
    $this->submitText = 'Inloggen';
    if ($this->valid) {
      $this->loginUser();
      $this->pageType = $this->page = 'home';
      $this->createMenu();
    }
  }

  public function validateRegister() {
    $this->initializeMetaData('name','email','password','confirmPassword');
    $this->meta['name']['validations'] = ['testIfEmpty','testNoLetters'];
    $this->meta['email']['validations'] = ['testIfEmpty','testEmailValidity','testUserExists'];
    $this->meta['password']['validations'] = ['testIfEmpty'];
    $this->meta['confirmPassword']['validations'] = ['testIfEmpty','testIfEqualToPassword'];

    if($this->isPost) {
      $this->processInput('getPostVar');
      $this->valid = empty($this->errors);
    }
  }

  public function processRegister() {
    $this->validateRegister();

    if ($this->valid) {
      try {
        $this->storeUser();

        // Unset/Reset register data for login page
        unset($this->meta['name']);
        unset($this->meta['confirmPassword']);
        $this->password = '';
        $this->errors = [];
      }
      catch (Exception $e) {
        $this->logError($e->getMessage());
        $this->errors['main'] = 'User could not be registered, '
                              . 'please revise your input or try again later';
        $this->valid = false;
      }
    }
  }

  // SESSION COMMUNICATION

  public function loginUser() {
    $this->sessionManager->loginUser($this->user);
  }

  public function logoutUser() {
    $this->sessionManager->logoutUser();
  }

  // DATABASE COMMUNICATION

  public function storeUser() {
    $hashedPassword = password_hash($this->password,PASSWORD_DEFAULT);

    $userData = ['email' => $this->email, 'name' => $this->name, 'password' => $hashedPassword];
    $user = new User($userData);

    $this->userCrud->createUser($user);
  }

  // TEST FUNCTIONS

  protected function testNoLetters($key){
    if (!preg_match('/[a-zA-Z]+/', $this->$key)) {
      $this->errors[$key] = 'Een naam moet minstens 1 letter bevatten';
    }
  }

  protected function testEmailValidity($key){
    if (!filter_var($this->$key, FILTER_VALIDATE_EMAIL)) {
      $this->errors[$key] = 'Ongeldig email formaat';
    }
  }

  protected function testIfEqualToPassword($key) {
    if ($this->$key != $this->password) {
      $this->errors[$key] = 'De wachtwoorden zijn niet hetzelfde';
    }
  }

  protected function testAuthentication($key) {
    try {
      $user = $this->userCrud->readUserByEmail($this->email);
      $userExists = !empty($user);
      if ($userExists && password_verify($this->password,$user->password)) {
        $this->user = $user;
      }
      else {
        $this->errors[$key] = 'Email of wachtwoord is ongeldig';
      }
    }
    catch (Exception $e) {
      $this->logError($e->getMessage());
      $this->errors['main'] = 'A technical error has occurred, please try again later.';
    }
  }

  protected function testUserExists($key) {
    try {
      if ($this->userCrud->userExists($this->$key)) {
        $this->errors[$key] = 'Er is al een account aan deze email gebonden';
      }
    }
    catch (Exception $e) {
      $this->logError($e->getMessage());
      $this->errors['main'] = 'A technical error has occurred, please try again later.';
    }
  }
}

 ?>