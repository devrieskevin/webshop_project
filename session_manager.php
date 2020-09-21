<?php

require_once 'user.php';
require_once 'isession_manager.php';

/**
 * Description of SessionManager
 *
 * @author Kevin de Vries
 */
class SessionManager implements ISessionManager {
  public function __construct() {
    if (!isset($_SESSION)) {
      session_start();
    }
  }

  public function loginUser($user) {
    session_unset();
    unset($user->password);
    $_SESSION['user'] = $user;
    $_SESSION['shoppingcart'] = [];
  }

  public function logoutUser() {
    session_unset();
    session_destroy();
  }

  public function isUserLoggedIn() {
    return isset($_SESSION['user']);
  }

  public function getLoggedInUser() {
    return Util::getArrayVal($_SESSION, 'user', NULL);
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
    return Util::getArrayVal($_SESSION, 'shoppingcart',[]);
  }

  public function addToShoppingcart($product_id) {
    if (empty(Util::getArrayVal($_SESSION['shoppingcart'],$product_id))) {
      $_SESSION['shoppingcart'][$product_id] = 1;
    }
  }

  public function updateProductQuantities($quantities) {
    foreach ($quantities as $product_id => $quantity) {
      $_SESSION['shoppingcart'][$product_id] = $quantity;
    }
  }

  public function emptyShoppingcart() {
    $_SESSION['shoppingcart'] = [];
  }
}

?>