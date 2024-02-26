<?php
include_once "../views/top5Doc.php";
include_once "../db_Repository.php";



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


$myData = array();

$myData['items'] = handleTop();

$myData['page'] = 'top5';
$myData['menu'] = array('home' => 'Home', 'about' => 'Over mij', 'contact' => 'Contact', 'webshop' => 'WEBSHOP', 'top' => 'TOP 5');
        

$view = new Top5Doc($myData);

$view  -> show();

?>