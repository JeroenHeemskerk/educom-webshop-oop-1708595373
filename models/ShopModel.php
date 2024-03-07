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
          placeOrderDB($this->sessionManager->getLoggedInUser()['email'], $this->sessionManager->getBasket());
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
      $this->popular = $this->crud->readTop5Products();
      }
      catch (exception $e) {$this-> genericErr = 'Kon database niet bereiken';
        $this->logErrors($e->getMessage());}
     // of the popular I can use the product id to fetch the required information
     $requestIds = array();
      
      foreach ($this->popular as $key => $value){
        $requestIds[$key + 1] = $value->product_id;
      }

      try {
        $this->products = $this->crud->readProductsByIds($requestIds);
        }
        catch (exception $e) {$this-> genericErr = 'Kon database niet bereiken';
          $this->logErrors($e->getMessage());}
    $this->products;
  }


  public function getDetailData(){
    $parts = explode('-', $this->page, 3);
    try {
      $this->products = getItemsFromDB('name, price, description, image, id', 'products', 'id='.$parts[2]);
      }
      catch (exception $e) {$this-> genericErr = 'Kon database niet bereiken';
        $this->logErrors($e->getMessage());}
  }

  public function getCartLines(){
    foreach ($this->sessionManager->getBasket() as $id => $amount){
      try{
        $item = getItemsFromDB('name, price, image, id', 'products', 'id='.$id);
        $this->cartLines[$id] = $item;
        $this->cartLines[$id]['count'] = $amount;
        $this->cartTotal += $amount * $this->cartLines[$id][0]['price'];
        } catch (exception $e) {$this->genericErr = 'Database momenteel niet bereikbaar';
        logErrors($e->getMessage());}
    }
  }

}
?>