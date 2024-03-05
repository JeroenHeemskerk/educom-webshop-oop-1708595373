<?php
class SessionManager{

  public function isUserLoggedIn(){
    return (isset($_SESSION['user']));
  }

  public function getLoggedInUser(){
    $userData['user'] = $_SESSION['user'];
    $userData['email'] = $_SESSION['email'];
    $userData['id'] = $_SESSION['id'];
    return $userData;
  }

  function makeCart(){
    $_SESSION['basket'] = array();
  }

  public function doLoginUser($user, $email, $id){
    $_SESSION['user'] = $user;
    $_SESSION['email'] = $email;
    $_SESSION['id'] = $id;
    self::makeCart();
  }

  public function doLogoutUser(){
      session_unset();
  }

  function addItemToBasket($id){
    if (array_key_exists($id, $_SESSION['basket'])) {
      $_SESSION['basket'][$id] += 1;
    } else { 
      $_SESSION['basket'][$id] = 1;
    }
  }

  function getBasket(){
    return $_SESSION['basket'];
  }
}
?>