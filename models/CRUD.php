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
      if(!$stmt->execute()){
        throw new Exception( "Error inserting into database");
      }
      return $this->pdo->lastInsertId();
    } 
    finally {
      $this->pdo = null;
    }
  }

  public function readOneRow($sql, $params){
    self::connectToDB();
    $stmt = $this-> pdo -> prepare($sql);
    foreach ($params as $key => $content){;
      $stmt->bindValue($key, $content);
    }
    try {
      $stmt -> setFetchMode(PDO::FETCH_OBJ);;
      $stmt -> execute();
      $row = $stmt ->fetch();
      return $row;
      //throw new Exception( "Error reading from database");
    }   catch (PDOException $e) {
      throw  new Exception( "Error reading from database", $e); ;
    }
    finally {
      $this->pdo = null;
    }
  }

  public function readMultipleRows($sql, $params){
    //wip
    self::connectToDB();
    $stmt = $this-> pdo -> prepare($sql);
    //var_dump($sql);
    foreach ($params as $key => $content){;
      $stmt->bindValue($key, $content);
    }
    try {
      $stmt -> setFetchMode(PDO::FETCH_OBJ);;
      $stmt -> execute();
      $row = $stmt -> fetchAll();
      return $row;
      //throw new Exception( "Error reading from database");
    } catch (PDOException $e) {
      throw  new Exception($e); ;
    }
    finally {
      $this->pdo = null;
    }
  }

  public function updateRow($sql, $params){
    self::connectToDB();
    $stmt = $this-> pdo -> prepare($sql);
    foreach ($params as $key => $content){;
      $stmt->bindValue($key, $content);
    }
    try {
      $stmt->execute();
    } catch (PDOException $e) {
        throw  new Exception( "Error updating database", $e); ;
      }
    finally {
      $this->pdo = null;
    }
  }

  public function deleteRow($sql, $params){
    self::connectToDB();
    $stmt = $this-> pdo -> prepare($sql);
    foreach ($params as $key => $content){;
      $stmt->bindValue($key, $content);
    }
    try {
      $stmt->execute();
    } catch (PDOException $e) {
        throw  new Exception( "Error deleting row in database", $e); ;
      }
    finally {
      $this->pdo = null;
    }
  }
}
?>