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

  public function doLoginUser($user, $email, $id){
    $_SESSION['user'] = $user;
    $_SESSION['email'] = $email;
    $_SESSION['id'] = $id;
  }

  public function doLogoutUser(){
      session_unset();
  }

}

?>