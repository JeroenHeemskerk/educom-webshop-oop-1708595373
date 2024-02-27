<?php
require_once('models/PageModel.php');

class PageController{
  private $model;

  public function __construct() {
    $this->model = new PageModel(NULL);
  }

  public function handleRequest(){
    $this->getRequest();
    $this->processRequest();
    $this->showResponse();
  }

  private function getRequest(){
    $this->model->getRequestedPage();
  }

  private function processRequest(){
    switch($this->model->page){
      case 'login':
        $this->model->setPage('home');
    }
  }

  private function showResponse(){
    $this->model->createMenu();
    switch($this->model->page){
      case 'home':
        require_once('views/homeDoc.php');
        $view = new HomeDoc($this->model);
        break;
      case 'about':
        require_once('views/aboutDoc.php');
        $view = new AboutDoc($this->model);
        break;
    }
    $view->show();
  }


}


?>