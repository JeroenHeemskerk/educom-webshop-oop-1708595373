<?php
//load in required external functions
require_once('views/homeDoc.php');
require_once('views/aboutDoc.php');
require_once('views/contactDoc.php');
require_once('views/webshopDoc.php');
require_once('views/cartDoc.php');
require_once('views/top5Doc.php');
require_once('views/registerDoc.php');
require_once('views/loginDoc.php');
require_once('views/passwordDoc.php');
require('session_Manager.php');
require('home.php');
require('about.php');
require('contact.php');
require('register.php');
require('login.php');
require('password.php');
require('webshop.php');
require('detail.php');
require('cart.php');
require('top5.php');
require('validate.php');
require('user_Service.php');
require('db_Repository.php');

$page = getRequestedPage(); 
$page = processRequest($page);

showResponsePage($page); 

function getRequestedPage() {
  $requestedType = $_SERVER['REQUEST_METHOD']; 
  if ($requestedType == "POST") {
    $requestedPage = getPostVar('page', 'home');
  } else {
    $requestedPage = getGetVar('page','home');
  }
return $requestedPage;
}
  
function getArrayVal($array, $key, $default='') {
   return isset($array[$key]) ? $array[$key] : $default; 
} 

function getPostVar($key, $default='') {
  return getArrayVal($_POST, $key, $default);  
}

function getGetVar($key, $default=''){
  return getArrayVal($_GET, $key, $default);
}

function processRequest($page){
  //The process depends on which page is submitted
  $data = array('page' => $page);
  switch($page){
    case 'contact':
      // okay time to set this up fresh
      $data['inputText'] = postDataContact();
      // next we have to check if there are any error messages
      $data['inputError']  = formCheckContact($data['inputText']);
      break;
    case 'register':
      $data['inputText'] = postDataRegister();
      $data['inputError'] = formCheckRegister($data['inputText']);
      break;
    case 'login':
      $data['inputText'] = postDataLogin();
      $data['inputError'] = formCheckLogin($data['inputText']);
      $data['page'] = $data['inputError']['page'];
      break;
    case 'password':
      $data['inputText'] = postDataPassword();
      $data['inputError'] = postDataPassword($data['inputText']);
      break;
    case 'logout':
      doLogout();
      $data['page'] = 'home';
      break;
    case 'webshop':
      try {
      $data['items'] = getItemsFromDB('id, name, price, image');
      } catch (exception $e) {$items['error'] = 'Kon database niet bereiken';
      logErrors($e->getMessage());}
      break;
    case strstr($data['page'], 'product'):
      $details = prepareDetail($data['page']);
      $data = array_merge($details, $data);
      $data['page'] = 'product';
      break;
    case 'cart':
      $basket = handleActions();
      var_dump($basket);
      $data = array_merge($basket, $data);
      break;
    case 'top':
      $data['items'] = handleTop();
      break;
  }
  // no matter the page, some data is always necessary: the menu
  $data = menuItems($data);
  return $data;
}

function handleTop(){
  $data = array();
  $items = array();
  try {
    $data = getTopItemsDB();
    }
    catch (exception $e) {$items['error'] = 'Kon database niet bereiken';
      logErrors($e->getMessage());}
  // okay great that gives us the ids
  $sql = "ID = ";
  foreach ($data as $id => $content) {
    if($data[$id]['product_id']){
      $sql = $sql.$data[$id]['product_id'].' OR ';
    }
  }

  $sql = rtrim($sql, "OR ");
  try {
   $items = getItemsFromDB('id, image, name', 'products', $sql);
  }
  catch (exception $e) {$items['error'] = 'Fout by database';
    logErrors($e->getMessage());}

  return $items;
}


function handleActions(){
  $action = getPostVar("action");
  switch($action) {
    case "addToCart":
      $id = getPostVar("id");
      try {
      addItemToBasket($id);
      }
      catch (exception $e) {$basket['error'] = 'Kon het item niet toevoegen, probeer later opnieuw';
        logErrors($e->getMessage());}
      break;
    case "placeOrder";
     try {
      placeOrderDB();
     }
      catch (exception $e) {$basket['error'] = 'Kon de order niet plaatsen probeer later opnieuw';
        logErrors($e->getMessage());}
    break;
  }
  // so one thing we'll need regardless of action is the basket content, the image, price, and name of this content
  $basket = getSessionBasket();
  $basketContents = array('costs' => 0); 
  foreach ($basket as $id => $content){
   try{
    $item = getItemsFromDB('name, price, image, id', 'products', 'id='.$id);
    $basketContents[$id] = $item;
    $basketContents[$id]['count'] = $basket[$id];
    $basketContents['costs'] += $content * $basketContents[$id][0]['price'];
    } catch (exception $e) {$basket['error'] = 'Database momenteel niet bereikbaar';
    logErrors($e->getMessage());}
  }
  return $basketContents;
}

function removeNonBodyArray($data){
  unset($data['page']);
  unset($data['menu']);
  return $data;
}

function menuItems($data){
  $data['menu'] = array('home' => 'Home', 'about' => 'Over mij', 'contact' => 'Contact', 'webshop' => 'WEBSHOP', 'top' => 'TOP 5');
  if (isUserLoggedIn()) {
    $data['menu']['cart'] = "Winkelwagen";
    $data['menu']['password'] = "Wachtwoord";
    $data['menu']['logout'] = "Uitloggen " . getSessionUser(); 
  } else {
    $data['menu']['register'] = "Registreren";
    $data['menu']['login'] = 'Inloggen';
  }
  return $data;
}

function logErrors($msg){
  echo "LOG TO SERVER:".$msg;
}

function showResponsePage($data) {
  switch($data['page']){
    case 'home':
      $view = new HomeDoc($data);
      break;
    case 'about':
      $view = new AboutDoc($data);
      break;
    case 'contact':
      $view = new ContactDoc($data);
      break;
    case 'webshop':
      $view = new WebshopDoc($data);
      break;
    case 'top':
      $view = new Top5Doc($data);
      break;
    case 'cart':
      $view = new CartDoc($data);
      break;
    case 'register':
      $view = new RegisterDoc($data);
      break;
    case 'login':
      $view = new LoginDoc($data);
      break;
    case 'password':
      $view = new PasswordDoc($data);
      break;
  }
  $view  -> show();
  /*
  showDocumentStart(); 
  showHeadSection($page); 
  showBodySection($page); 
  showDocumentEnd(); */
}     

function showDocumentStart() { 
  echo '<!doctype html> 
  <html>'; 
} 

function showHeadSection($page){
  // only the title differs between these head sections so, you can load/close the head and reference the css here
  echo '</head>';
  switch($page['page']){
    case 'home':
        showHeadHome();
        break;
    case 'about':
        showHeadAbout();
        break;
    case 'contact': 
        showHeadContact();
        break;
    case 'thanks': 
        showHeadContact();
        break;
    case 'register':
        showHeadRegister();
        break;
    case 'login': 
        showHeadLogin();
        break;    
    case 'password':
        showHeadPassword();
        break;
      case 'webshop':
        showHeadWebshop();
        break;
      case 'product':
        showHeadDetail($page['nameAndId']);
        break;
      case 'cart':
        showHeadCart();
        break;
      case 'top':
        showHeadTop();
        break;
   }
   
   echo '<link rel="stylesheet" href="CSS/mystyle.css">
    </head>';
}

function showBodySection($page) { 
  echo '<body class="algemeen">' . PHP_EOL; 
  showHeader($page);
  showMenu($page); 
  showContent($page); 
  showFooter(); 
  echo '</body>' . PHP_EOL; 
} 

function showDocumentEnd(){
  echo '</html>'; 
}

function showHeader($page){
  switch($page['page']){
    case 'home':
        showHeaderHome();
        break;
    case 'about':
        showHeaderAbout();
        break;
    case 'contact':
        showHeaderContact();
        break;   
    case 'thanks':
        showHeaderContact();
        break; 
    case 'register':
        showHeaderRegister();
        break;  
    case 'login':
        showHeaderLogin();
        break;      
    case 'password':
        showHeaderPassword();
        break;
      case 'webshop':
        showHeaderWebshop();
        break;
        case 'product':
        showHeaderDetail($page['name']);
        break;
      case 'cart':
        showHeaderCart();
        break;  
      case 'top':
        showHeaderTop();
        break;       
   }
}

function showMenu($page){
  echo '<ul class="menu">';
  foreach($page['menu'] as $link => $label) { 
    showMenuItem($link, $label); 
  } 
  echo '</ul>';
}

function showMenuItem($page, $pageName){
  echo '<li><a href="index.php?page='.$page.'">'.$pageName.'</a></li>';
}

function showContent($page){
  switch($page['page']){
    case 'home':
        showContentHome();
        break;
    case 'about':
        showContentAbout();
        break;
    case 'contact':
        showContentContact($page);
        break;    
    case 'thanks':
        showContentThanks($page);
        break; 
    case 'register':
        showContentRegister($page);
        break;           
    case 'login':
        showContentLogin($page);
        break;          
    case 'password':
        showContentPassword($page);
        break;
      case 'webshop':
        showContentWebshop($page);
        break;
        case 'product':
        showContentDetail($page);
        break;
      case 'cart':
        showContentCart($page);
        break;         
      case 'top':
        showContentTop($page);
        break;   
   }
}

function showFooter(){
  echo '<footer> 
  &#169; - 2024 - Milan Lucas
  </footer> ';
}

?>