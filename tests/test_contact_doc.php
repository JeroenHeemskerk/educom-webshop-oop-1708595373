<?php
include_once "../views/contactDoc.php";

$myData = array();
$myData['page'] = 'contact';
$myData['menu'] = array('home' => 'Home', 'about' => 'Over mij', 'contact' => 'Contact', 'webshop' => 'WEBSHOP', 'top' => 'TOP 5');
                             
$myData['formInputs']['inputText'] = array('title' => '' , 'name' => '', 'email' => '', 'phonenumber' => '',
                                            'street' => '', 'housenumber' => '',
                                          'postalcode' => '', 'city' => '', 'communication' => '', 'message' => '');
$myData['formInputs']['error'] = array('title' => '*', 'name' => '*', 'email' => '', 'phonenumber' => '', 'street' => '', 
                                      'housenumber' => '', 'postalcode' => '', 'city' => '', 'communication' => '*', 'message' => '*');

$view = new ContactDoc($myData);

$view  -> show();

?>