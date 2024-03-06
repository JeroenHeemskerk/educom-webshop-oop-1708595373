<?php
include_once "../models/CRUD.php";
$crud = new Crud();
createUser($crud, 'testificate21313@gmail.com', 'john', 'theFirstOfMany');

function createUser($crud, $email, $user, $password){
  $sql = "INSERT INTO users (email, user, password)
  VALUES (:email, :user, :password)";
  $params = array('email' => $email, 'user'=>$user, 'password'=>$password);
  try {
    $crud->createRow($sql, $params);
  } catch (PDOException $e) {
    var_dump($e->getMessage());
  }
}


?>