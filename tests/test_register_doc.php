<?php
include_once "../views/registerDoc.php";

$myData = array();

$myData['page'] = 'register';
$myData['menu'] = array('home' => 'Home', 'about' => 'Over mij', 'contact' => 'Contact', 'webshop' => 'WEBSHOP', 'top' => 'TOP 5');
$myData['formInputs']['inputText'] = array('name'=> '', 'email' => '', 'password' => '', 'repeat' => '');
$myData['formInputs']['error'] = array('name'=>'*', 'email' => '*', 'password' => '*', 'repeat' => '*');

$view = new RegisterDoc($myData);

$view  -> show();

?>