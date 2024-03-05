<?php
require_once('PageModel.php');
require_once('db_repository.php');

class ShopModel extends PageModel{
  public $products = array();
  public $product = array();
  public $cartLines = array();
  public $cartTotal = 0.00;

  public function __construct($pageModel){
    PARENT::__construct($pageModel);
  }

  public function getWebShopData(){
    try {
      $this->products = getItemsFromDB('id, name, price, image');
      }
      catch (exception $e) {$this-> genericErr = 'Kon database niet bereiken';
        $this->logErrors($e->getMessage());}
  }

  public function getTopFiveData(){
    try {
      $this->products = getTopItemsDB();
      }
      catch (exception $e) {$this-> genericErr = 'Kon database niet bereiken';
        $this->logErrors($e->getMessage());}
  }

  public function getDetailData(){
    $parts = explode('-', $this->page, 3);
    try {
      $this->products = getItemsFromDB('name, price, description, image, id', 'products', 'id='.$parts[2]);
      }
      catch (exception $e) {$this-> genericErr = 'Kon database niet bereiken';
        $this->logErrors($e->getMessage());}
  }

}
?>