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
    }
    //There's only info to fill them with if it is a post
    if ($this->isPost){
      foreach ($this->meta as $query){
        $this->meta[$query] = $this->getPostVar("$query");
      }
    }
  }

  public function getErrors(){

    if ($this->page == 'contact'){
      $this->errors =array('title' => '*', 'name' => '*', 'email' => '', 'phonenumber' => '', 'street' => '', 
      'housenumber' => '', 'postalcode' => '', 'city' => '', 'communication' => '*', 'message' => '*');
    }

    // a more thorough check is only necessary if it is a POST request
    if ($this->isPost){
      $validators = new Validators();
      $this->errors = $validators->validateInputs($this->page, $this->meta, $this->errors);
    }
  }

}
?> 