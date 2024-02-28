<?php
require_once('models/PageModel.php');
require_once('models/UserModel.php');

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
      case 'contact':
        $this->model = new UserModel($this->model);
        $this->model->getInputs();
        $this->model->getErrors();
        if(isset($this->model->errors)){
          $this->model->page = 'thank';
        }
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
      case 'contact':
        require_once('views/contactDoc.php');
        $view = new ContactDoc($this->model);
        break;
      case 'thank':
        require_once('views/thanksDoc.php');
        $view = new ThanksDoc($this->model);
        break;
    }
    $view->show();
  }


}


?>