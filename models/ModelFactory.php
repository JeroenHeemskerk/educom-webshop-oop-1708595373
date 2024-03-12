<?php
  require_once('models/PageModel.php');
  require_once('models/UserModel.php');
  require_once('models/ShopModel.php');
class ModelFactory{
  private $crudFactory;
  private $name;
  private $model;

  public function __construct($crudFactory){
    $this->crudFactory = $crudFactory;
  }

  public function createModel($name, $model=NULL){
    switch ($name) {
      case 'page':
        $model = new PageModel($model);
        return $model;
        break;
      case 'user':
        $model = new UserModel($model);
        $model -> crud = $this->crudFactory->createCrud('user');
        return $model;
        break;
      case 'shop':
        $model = new ShopModel($model);
        $model -> crud = $this->crudFactory->createCrud('shop');
        return $model;
        break;
    }
  }

}

?>