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
      $data = $crud->readMultipleRows($sql, $params);
    } catch (PDOException $e) {
      var_dump($e->getMessage());
    }
    var_dump($data);
  }


  public function readProductsByIds($params){
    $sql ='SELECT id, image, price, name
      FROM products WHERE ';
    foreach ($params as $x) {
        $sql = $sql . 'id = ? OR ';
      }
    $sql = rtrim($sql, ' OR');
    try {
      $data = $this->crud->readMultipleRows($sql, $params);
    } catch (PDOException $e) {
      var_dump($e->getMessage());
    }
  }
}