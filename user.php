<?php

require_once 'object_utils.php';

/**
 * Description of User
 *
 * @author Kevin de Vries
 */
class User {
  public $user_id;
  public $email;
  public $name;
  public $password;
  public $is_admin;

  use ObjectUtils;

  public   function __construct($copy = NULL) {
    if (is_array($copy)) {
      $this->fromArray($copy);
    }
    elseif (is_object($copy)) {
      $this->fromObject($copy);
    }
  }

  public   function isAdmin() {
    return ($this->is_admin == '1');
  }
}

?>