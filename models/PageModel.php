<?php
class PageModel{
  public $page;
  protected $isPost;
  public $menu;
  public $errors;
  public $genericErr;
  protected $sessionManager;

  public function __construct($copy){
    if (empty($copy)){
      require_once('sessionManager.php');
      $this->sessionManager = new SessionManager();
    } else {
      $this->page = $copy->page;
      $this->isPost = $copy->isPost;
      $this->menu = $copy->menu;
      $this->errors = $copy->errors;
      $this->genericErr = $copy->genericErr;
      $this->sessionManager = $copy->sessionManager;
    }
  }

  public function getRequestedPage(){
    $this->isPost = ($_SERVER['REQUEST_METHOD'] == 'POST');
    if ($this->isPost) {
      $this->page = $this->getPostVar('page', 'home');
    } else {
      $this->page = $this->getUrlVar('page', 'home');
    }
  }

  private function getArrayVal($array, $key, $default='') {
    return isset($array[$key]) ? $array[$key] : $default; 
   } 
 
  protected function getPostVar($key, $default='') {
   return $this->getArrayVal($_POST, $key, $default);  
  }

  protected function getUrlVar ($key, $default=''){
   return $this->getArrayVal($_GET, $key, $default);
  }

  public function setPage($newPage){ //public doesn't seem right for this function
    $this->page = $newPage;
  }

  public function createMenu(){
    //$myData['menu'] = array('home' => 'Home', 'about' => 'Over mij', 'contact' => 
    //'Contact', 'webshop' => 'WEBSHOP', 'top' => 'TOP 5')
    $this->menu['home'] = $this->createMenuItem('home', 'Home');
    $this->menu['about'] = $this->createMenuItem('about', 'Over mij');
    $this->menu['contact'] = $this->createMenuItem('contact', 'Contact');
    $this->menu['webshop'] = $this->createMenuItem('webshop', 'Webshop');
    $this->menu['top'] = $this->createMenuItem('top', 'Top 5');
    if ($this->sessionManager->isUserLoggedIn()){
      $this->menu['logout'] = $this->createMenuItem('logout', 'Uitloggen '.$this->sessionManager->getLoggedInUser()['name']);
      $this->menu['password'] = $this->createMenuItem('password', 'Wachtwoord veranderen');
    } else {
      $this->menu['login'] = $this->createMenuItem('login', 'Inloggen');
    }


  }

  private function createMenuItem($page, $pageName){
    return '<li><a href="index.php?page='.$page.'">'.$pageName.'</a></li>';
  }


}


?>