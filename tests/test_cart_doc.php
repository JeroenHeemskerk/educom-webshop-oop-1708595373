<?php
include_once "../views/cartDoc.php";
include_once "../db_Repository.php";

$myData = array();

$myData['items'] = getItemsFromDB('id, name, price, image');



$myData['page'] = 'webshop';
$myData['menu'] = array('home' => 'Home', 'about' => 'Over mij', 'contact' => 'Contact', 'webshop' => 'WEBSHOP', 'top' => 'TOP 5');
        

$view = new CartDoc($myData);

$view  -> show();

?>