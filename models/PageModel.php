<?php
class PageModel{
  require_once('models/sessionManager.php');
  public $page;
  protected $isPost = false;
  public $menu;
  public $errors = array();
  public $genericErr = '';
  protected $sessionManager;

  public function __construct($copy){
    if (empty($copy)){
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
    $data = isset($array[$key]) ? $array[$key] : $default;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data; 
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
    $this->menu['home'] = 'Home';
    $this->menu['about'] = 'Over mij';
    $this->menu['contact'] =  'Contact';
    $this->menu['webshop'] = 'Webshop';
    $this->menu['top'] = 'Top 5';
    if ($this->sessionManager->isUserLoggedIn()){
      $this->menu['password'] = 'Wachtwoord veranderen';
      $this->menu['logout'] = 'Uitloggen '.$this->sessionManager->getLoggedInUser()['user'];
    } else {
      $this->menu['login'] = 'Inloggen';
      $this->menu['register'] = 'Aanmelden';
    }
  }

  private function createMenuItem($page, $pageName){
    return '<li><a href="index.php?page='.$page.'">'.$pageName.'</a></li>';
  }

}


?>