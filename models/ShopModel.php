<?php
require_once('PageModel.php');
require_once('db_repository.php');

class ShopModel extends PageModel{
  public $products = array();
  public $product = array();
  public $popular = array();
  public $cartLines = array();
  public $cartTotal = 0.00;

  public function __construct($pageModel){
    PARENT::__construct($pageModel);
  }

  public function handleCartActions(){
    $action = $this->getPostVar("action");
    switch($action){
      case "addToCart":
        try {
        $this->sessionManager->addItemToBasket($this->getPostVar("id"));
        }
        catch (exception $e) {$this->genericErr = 'Kon het item niet toevoegen, probeer later opnieuw';
          logErrors($e->getMessage());}
        break;
      case "placeOrder":
        try {
          $this->crud->createOrder($this->sessionManager->getLoggedInUser()['id'], $this->sessionManager->getBasket());
          $this->sessionManager->makeCart();
         }
          catch (exception $e) {$this->genericErr = 'Kon de order niet plaatsen probeer later opnieuw';
            logErrors($e->getMessage());}
        break;
    }
  }

  public function getWebShopData(){
    try {
      $this->products = $this->crud->readAllProducts();
      }
      catch (exception $e) {$this-> genericErr = 'Kon database niet bereiken';
        $this->logErrors($e->getMessage());}
  }

  public function getTopFiveData(){
    try {
      $this->products = $this->crud->readTop5Products();
      }
      catch (exception $e) {$this-> genericErr = 'Kon database niet bereiken';
        $this->logErrors($e->getMessage());}
    $this->products;
  }


  public function getDetailData(){
    $parts = explode('-', $this->page, 3);
    $id = array(1 => $parts[2]);
    try {
      $this->products = $this->crud->readProductsByIds($id);
      }
      catch (exception $e) {$this-> genericErr = 'Kon database niet bereiken';
        $this->logErrors($e->getMessage());}
  }

  public function getCartLines(){
    foreach ($this->sessionManager->getBasket() as $id => $amount){
      try{
        $query = array(1 => $id);
        $item = $this->crud->readProductsByIds($query);
        $this->cartLines[$id] = $item;
        $this->cartLines[$id]['count'] = $amount;
        $this->cartTotal += $amount * $this->cartLines[$id][0]->price;
        } catch (exception $e) {$this->genericErr = 'Database momenteel niet bereikbaar';
        logErrors($e->getMessage());}
    }
  }

}
?>