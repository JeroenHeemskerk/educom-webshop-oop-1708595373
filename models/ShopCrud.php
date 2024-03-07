<?php
class ShopCrud{
  private $crud;

  public function __construct($crud){
    $this -> crud = $crud;
  }

  public function readAllProducts($params=array()){
    $sql ='SELECT id, image, price, name
      FROM products'; 
    try {
      $data = $this->crud->readMultipleRows($sql, $params);
    } catch (PDOException $e) {
      //var_dump($e->getMessage());
    }
    return ($data);
  }


  public function readProductsByIds($params){
    $sql ='SELECT *
      FROM products WHERE ';
    foreach ($params as $x) {
        $sql = $sql . 'id = ? OR ';
      }
    $sql = rtrim($sql, ' OR');
    try {
      $data = $this->crud->readMultipleRows($sql, $params);
    } catch (PDOException $e) {
      //var_dump($e->getMessage());
    }
    return ($data);
  }

  public function readTop5Products(){
    $params = array();
    $sql = 
    "SELECT orders_content.product_id, sum(orders_content.product_count) AS 'product_counts' 
    FROM orders LEFT JOIN orders_content on orders_content.order_id = orders.id
    WHERE date BETWEEN date_sub(now(),INTERVAL 1 WEEK) and now() 
    GROUP BY orders_content.product_id 
    ORDER BY product_counts DESC LIMIT 5";
    try {
      $data = $this->crud->readMultipleRows($sql, $params);
    } catch (PDOException $e) {
      //var_dump($e->getMessage());
    }
    return ($data);
  }

  public function createOrder($id, $basket){
    $orderId = self::createOrderInOrder($id);
    self::createOrderInOrderContent($orderId, $basket);
  }

  private function createOrderInOrder($id){
    $date = date('Y-m-d');
    $sql = 'INSERT INTO orders (user_id, date) VALUES (:id, :date)';
    $params = array('id' => $id, 'date' => $date);
    try {
      return $this->crud->createRow($sql, $params);
    } catch (PDOException $e) {
      // gotta change this to rethrowing the error message
      // left overs from testing
      var_dump($e->getMessage());
    }
  }

  private function createOrderInOrderContent($orderId, $basket){
    $params = array();
    $sql = 'INSERT INTO orders_content (order_id, product_id, product_count) 
    VALUES (:orderId, :productId, :productCount)';
    foreach ($basket as $key => $value){
      $params = array('orderId' => $orderId, 'productId' => $key, 'productCount' => $value);
      try {
      $this->crud->createRow($sql, $params);
      } catch (PDOException $e) {
        var_dump($e->getMessage());
      }
    }
  }
}