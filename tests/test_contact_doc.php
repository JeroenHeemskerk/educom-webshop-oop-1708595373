<?php
include_once "../views/contactDoc.php";

$myData = array();
$myData['menu'] = array('home' => 'Home', 'about' => 'Over mij', 'contact' => 'Contact', 'webshop' => 'WEBSHOP', 'top' => 'TOP 5');

$view = new ContactDoc($myData);

$view  -> show();

?>