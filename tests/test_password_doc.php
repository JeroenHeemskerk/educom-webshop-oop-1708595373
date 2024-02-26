<?php
include_once "../views/passwordDoc.php";

$myData = array();
$myData['page'] = 'password';
$myData['menu'] = array('home' => 'Home', 'about' => 'Over mij', 'contact' => 'Contact', 'webshop' => 'WEBSHOP', 'top' => 'TOP 5');
$myData['formInputs']['inputText'] = array('oldPass'=> '', 'newPass' => '', 'newRepeatPass' => '');
$myData['formInputs']['error'] = array('oldPass'=> '*', 'newPass' => '*',  'newRepeatPass' => '*');
$view = new passwordDoc($myData);

$view  -> show();

?>