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
      $this->authUser();
    }
  }

  private function authUser(){
    require_once('db_Repository.php');
    $userInfo = findUserByEmailDB($this->meta['email']);
    //userInfo is only null if there was an error in the database
    // otherwise its an array
    if (!isset($userInfo)){
      return $userInfo;}
    //check if password overlaps with the password in $userInfo
    if ($this->passwordDecrypt($this->meta['password'], $userInfo['password'])){ 
      $this->meta['name'] = $userInfo['user'];
      $this->userId = $userInfo['id'];
      $this->valid = true;
    }
  }

  private function passwordDecrypt($password, $hash){
    return password_verify($password, $hash);
  }

  public function doLoginUser(){
    $this->sessionManager->doLoginUser($this->meta['name'], $this->meta['email'], $this->userId);
  }

}
?> 