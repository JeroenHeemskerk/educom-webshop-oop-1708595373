<?php
class SessionManager{

  public function isUserLoggedIn(){
    return (isset($_SESSION['user']));
  }

  public function getLoggedInUser(){
    $userData['user'] = $_SESSION['user'];
    $userData['email'] = $_SESSION['email'];
    return $userData;
  }


}

?>