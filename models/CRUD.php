<?php
  class Crud {

    private $pdo;

    private function connectToDB(){
      $servername = "localhost";
      $username = "milan_lucas_web_shop";
      $password = "cNLN0whG56mamGYq";
      $dbName = 'milan_web_shop_users';
      try {
        $this-> pdo = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
        $this-> pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         if (!$this->pdo) {
        throw new Exception("Cannot connect to database");
      }
      }
    // refuses to function without finally
    finally {
    }
  }
  

    public function createRow($sql, $params){
      self::connectToDB();
      $stmt = $this-> pdo -> prepare($sql);
      foreach ($params as $key => $content){;
        $stmt->bindValue($key, $content);
      }
      try {
        $stmt->execute();
        throw new Exception("Error inserting into database");
      } 
      finally {
        $this->pdo = null;
      }
    }
  }
?>