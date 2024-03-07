<?php
require_once('userCrud.php');
require_once('shopCrud.php')
class CrudFactory{
  private $crud;

  public function __construct($crud){
    $this -> crud = $crud;
  }

  public function createCrud($name){
    switch ($name){
      case 'user':
          return new userCrud($this->crud);
        break;
      case 'shop':
        break;
    }
  }
}


?>