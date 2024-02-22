<?php
include_once "../views/aboutDoc.php";

$myData = array();
$myData['menu'] = array('home' => 'Home', 'about' => 'Over mij', 'contact' => 'Contact', 'webshop' => 'WEBSHOP', 'top' => 'TOP 5');
$view = new aboutDoc($myData);

$view  -> show();

?>