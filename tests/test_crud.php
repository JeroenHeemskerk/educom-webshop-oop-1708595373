<?php
include_once "../models/CRUD.php";
$crud = new Crud();
//createUser($crud, 'testificate2134224213@gmail.com', 'john', 'theFirstOfMany');
//readUserByEmail($crud, 'testificate@gmail.com');
readAllProducts($crud);
//updateUserPassword($crud, 'testificate@gmail.com', 'ThisIsAnUpdatedPassword');
//deleteUser($crud, 'testificate2134224213@gmail.com');

function createUser($crud, $email, $user, $password){
  $sql = "INSERT INTO users (email, user, password)
  VALUES (:email, :user, :password)";
  $params = array('email' => $email, 'user'=>$user, 'password'=>$password);
  try {
    $id = $crud->createRow($sql, $params);
  } catch (PDOException $e) {
    var_dump($e->getMessage());
  }
}

function readUserByEmail($crud, $email){
  $sql = 'SELECT * FROM users WHERE email=:email';
  $params = array('email' => $email);
  try {
    $data = $crud->readOneRow($sql, $params);
  } catch (PDOException $e) {
    var_dump($e->getMessage());
  }
}

// this is for the shop
function readAllProducts($crud, $params=array()){
  $sql ='SELECT id, image, price, name
    FROM products '; 
   try {
    $data = $crud->readMultipleRows($sql, $params);
  } catch (PDOException $e) {
    var_dump($e->getMessage());
  }
  var_dump($data);
}

function updateUserPassword($crud, $email, $password){
  $sql = 'UPDATE users 
  SET password=:password
  WHERE email=:email';
  $params = array('email' => $email, 'password' => $password);
  try {
    $crud->updateRow($sql, $params);
  } catch (PDOException $e) {
    var_dump($e->getMessage());
  }
}

function deleteUser($crud, $email){
  $sql = 'DELETE FROM users
  WHERE email = :email';
  $params = array('email' => $email);
  try {
    $crud->deleteRow($sql, $params);
  } catch (PDOException $e) {
    var_dump($e->getMessage());
  }
}



?>