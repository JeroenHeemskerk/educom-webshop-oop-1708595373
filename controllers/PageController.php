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
        if(isset($this->model->errors['page'])){
          $this->model->setPage('thank');
        }
        break;
      case 'login':
        $this->model = new UserModel($this->model);
        $this->model->validateLogin();
        if($this->model->valid){
          //otherwise a correct password stays afloat in the data
          $this->model->meta['password'] = '';
          $this->model->doLoginUser();
          $this->model->setPage('home');
        }
        break;
      case 'password':
        $this->model = new UserModel($this->model);
        $this->model->getInputs();
        $this->model->getErrors();
        break;
      case'logout':
        $this->mode->setPage('home');
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
      case 'login':
        require_once('views/loginDoc.php');
        $view = new LoginDoc($this->model);
        break;
      case 'password':
        require_once('views/passwordDoc.php');
        $view = new PasswordDoc($this->model);
        break;
    }
    $view->show();
  }


}


?>