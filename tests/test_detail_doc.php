<?php
include_once "../views/detailDoc.php";
include_once "../db_Repository.php";



$myData = array();

$myData['items'] = getItemsFromDB('name, price, description, image', 'products', 'id="1"');

$myData['page'] = 'webshop';
$myData['menu'] = array('home' => 'Home', 'about' => 'Over mij', 'contact' => 'Contact', 'webshop' => 'WEBSHOP', 'top' => 'TOP 5');
        

$view = new detailDoc($myData);

$view  -> show();

?>