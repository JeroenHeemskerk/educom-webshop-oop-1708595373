<?php
require_once('PageModel.php');
require_once('Validators.php');

class UserModel extends PageModel{
  public $meta = array();
  public $errors = array();
  private $userId = 0;
  public $valid = false;

  public function __construct($pageModel){
    PARENT::__construct($pageModel);
  }

  public function getInputs(){
    //initial if statements are to set up the meta $ error arrays
    if ($this->page == 'contact'){
      $this->meta =array('title' => '', 'name' => '', 'email' => '', 'phonenumber' => '', 'street' => '', 
      'housenumber' => '', 'postalcode' => '', 'city' => '', 'communication' => '', 'message' => '');
    }elseif ($this->page == 'login'){
      $this->meta = array('email' => '', 'password' => '');
    } elseif ($this->page == 'register'){
      $this->meta = array('name'=> '', 'email' => '', 'password' => '', 'repeat' => '');
    } else {
      $this->meta = array('password' => '', 'newPass' => '', 'newRepeatPass' => '');
    }
    //There's only info to fill them with if it is a post
    if ($this->isPost){
      foreach ($this->meta as $key => $value){
        $this->meta[$key] = $this->getPostVar("$key");
      }
    }
  }

  public function getErrors(){
    if ($this->page == 'contact'){
      $this->errors =array('title' => '*', 'name' => '*', 'email' => '', 'phonenumber' => '', 'street' => '', 
      'housenumber' => '', 'postalcode' => '', 'city' => '', 'communication' => '*', 'message' => '*');
    } elseif ($this->page == 'login'){
      $this->errors = array('email' => '*', 'password' => '*', 'valid' => false);
    } elseif ($this->page == 'register'){
      $this->errors = array('name'=>'*', 'email' => '*', 'password' => '*', 'repeat' => '*');
    }else {
      $this->errors = array('password' => '*', 'newPass' => '*', 'newRepeatPass' => '*', 'valid' => false);
    }
    // a more thorough check is only necessary if it is a POST request
    if ($this->isPost){
      $this->errors = Validators::validateInputs($this->page, $this->meta, $this->errors);
    }
  }

  public function validateLogin(){
    $this->getInputs();
    $this->getErrors();
    if (!$this->errors['valid']){
      return;
    } else {
      $this->authUser($this->meta['email']);
    }
  }

  private function authUser($email){
    require_once('db_Repository.php');
    $userInfo = findUserByEmailDB($email);
    //userInfo is only null if there was an error in the database
    // otherwise its an array
    if (!isset($userInfo)){
      return $userInfo;}
    //check if password overlaps with the password in $userInfo
    if ($this->passwordDecrypt($this->meta['password'], $userInfo['password'])){ 
      $this->meta['name'] = $userInfo['user'];
      $this->userId = $userInfo['id'];
      $this->valid = true;
    } else {
      $this->errors['email'] = 'Email of wachtwoord is incorrect';
    }
  }

  private function passwordDecrypt($password, $hash){
    return password_verify($password, $hash);
  }

  private function passwordEncrypt($password){
    return password_hash($password, PASSWORD_BCRYPT, ['cost' => 14]);
  }

  public function doLoginUser(){
    $this->sessionManager->doLoginUser($this->meta['name'], $this->meta['email'], $this->userId);
  }

  public function doLogoutUser(){
    $this->sessionManager->doLogoutUser();
  }

  public function doUpdatePassword(){
    // gotta authenticate user to check if the new password is correct
    $email = $this->sessionManager->getLoggedInUser()['email'];
    $this->authUser($email);
    if($this->valid){
      require_once('db_Repository.php');
      $password = self::passwordEncrypt( $this->meta['newPass']);
      updateUserPasswordDB($email, $password);
      $this->errors['password'] = 'wachtwoord geupdate';
    } else {
      $this->errors['password'] = 'wachtwoord incorrect';
    }
  }

  public function doRegisterUser(){
    require_once('db_Repository.php');
    $this->meta['email'];
    $this->meta['name'];
    $this->meta['password'];
    $check = findUserByEmailDB($this->meta['name']);
    if(!findUserByEmailDB($this->meta['name'])){
      self::saveUser();
      $this->setPage('home');
    } else {
      $this->error['email'] = 'Deze email is al geregisteerd';
    }
  }

  private function saveUser(){
    require_once('db_Repository.php');
    $password = self::passwordEncrypt($this->meta['password']);
    saveUserDB($this->meta['email'], $this->meta['name'], $password);
    
  }

}
?> 