<?php

/**
 * Description of UserCrud
 *
 * @author Kevin de Vries
 */
class UserCrud {
  private $crud;

  public function __construct(ICrud $crud) {
    $this->crud = $crud;
  }

  // CRUD FUNCTIONS

  public function createUser(User $user) {
    $sql = 'INSERT INTO users (email,name,password) '
         . 'VALUES (:email,:name,:password)';

    $params = $user->get_properties(['email','name','password']);

    return $this->crud->createRow($sql,$params);
  }

  public function readUserByEmail($email) {
    $sql = 'SELECT user_id, name, password, is_admin FROM users '
         . 'WHERE email = :email';

    $params = ['email' => $email];

    return $this->crud->readOneRow($sql,$params, 'User');
  }

  public function updateUser($user_id, User $user) {
    $sql = 'UPDATE users '
         . 'SET '
         . 'email = :email, name = :name, '
         . 'password = :password, is_admin = :is_admin '
         . 'WHERE user_id = :user_id';

    $params = $user->get_properties('email','name','password','is_admin');
    $params['user_id'] = $user_id;

    return $this->crud->updateRow($sql, $params);
  }

  public function deleteUser($user_id) {
    $sql = 'DELETE FROM users WHERE user_id = :user_id';
    $params = ['user_id' => $user_id];

    return $this->crud->deleteRows($sql, $params);
  }

  // BUSINESS LOGIC FUNCTIONS

  public function userExists($email) {
    $user = $this->readUserByEmail($email);
    return !empty($user);
  }

}

?>
