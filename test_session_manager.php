<?php

require_once 'util.php';
require_once 'isession_manager.php';

/**
 * Description of TestSessionManager
 *
 * @author Kevin de Vries
 */
class TestSessionManager implements ISessionManager {

  public $session = []; // Session array mocking the superglobal $_SESSION

  public function loginUser($user) {
    unset($user->password);
    $this->session['user'] = $user;
    $this->session['shoppingcart'] = [];
  }

  public function logoutUser() {
    $this->session = [];
  }

  public function isUserLoggedIn() {
    return isset($this->session['user']);
  }

  public function getLoggedInUser() {
    return Util::getArrayVal($this->session, 'user', NULL);
  }

  public function isUserAdmin() {
    $user = $this->getLoggedInUser();
    if (!$user) {
      return false;
    }
    return $user->isAdmin();
  }

  public function getLoggedInUserName() {
    $user = $this->getLoggedInUser();
    return $user->name;
  }

  public function getLoggedInUserId() {
    $user = $this->getLoggedInUser();
    return $user->user_id;
  }

  public function getShoppingcartProducts() {
    return Util::getArrayVal($this->session, 'shoppingcart',[]);
  }

  public function addToShoppingcart($product_id) {
    if (empty(Util::getArrayVal($this->session['shoppingcart'],$product_id))) {
      $this->session['shoppingcart'][$product_id] = 1;
    }
  }

  public function updateProductQuantities($quantities) {
    foreach ($quantities as $product_id => $quantity) {
      $this->session['shoppingcart'][$product_id] = $quantity;
    }
  }

  public function emptyShoppingcart() {
    $this->session['shoppingcart'] = [];
  }
}
