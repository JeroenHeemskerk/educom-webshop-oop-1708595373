<?php
class UserCrud{
  private $crud;

  public function __construct(crud $crud){
    $this -> crud = $crud
  }

  private function createUser($email, $user, $password){
    $sql = "INSERT INTO users (email, user, password)
  VALUES (:email, :user, :password)";
  $params = array('email' => $email, 'user'=>$user, 'password'=>$password);
  try {
    $id = $this->crud->createRow($sql, $params);
  } catch (PDOException $e) {
    var_dump($e->getMessage());
  }
  }

  private function updateUserPassword($email, $password){
    $sql = 'UPDATE users 
    SET password=:password
    WHERE email=:email';
    $params = array('email' => $email, 'password' => $password);
    try {
      $this->crud->updateRow($sql, $params);
    } catch (PDOException $e) {
      var_dump($e->getMessage());
    }
  }

  private function readUserByEmail($email){
    $sql = 'SELECT * FROM users WHERE email=:email';
    $params = array('email' => $email);
    try {
      $data = $this->crud->readOneRow($sql, $params);
    } catch (PDOException $e) {
      var_dump($e->getMessage());
    }
    return $data;
  }

}

?>