<?php
include_once "../views/loginDoc.php";

$myData = array();
$myData['menu'] = array('home' => 'Home', 'about' => 'Over mij', 'contact' => 'Contact', 'webshop' => 'WEBSHOP', 'top' => 'TOP 5');


$myData['formInputs']['inputText'] = array('email' => '', 'password' => '', 'repeat' => '');
$myData['formInputs']['error'] = array('email' => '*', 'password' => '*', 'repeat' => '*');


$view = new LoginDoc($myData);

$view  -> show();

?>