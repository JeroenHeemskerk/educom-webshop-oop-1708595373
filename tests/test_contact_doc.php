<?php
include_once "../views/contactDoc.php";

$myData = array();
$myData['page'] = 'contact';
$myData['menu'] = array('home' => 'Home', 'about' => 'Over mij', 'contact' => 'Contact', 'webshop' => 'WEBSHOP', 'top' => 'TOP 5');
                              // 'id' => array('label' => 'current Input') current input is obtained from PostRequests later in processRequest()
$myData['formInputs']['inputText'] = array( 'name' => array('Naam' => ''), 'email' => array('Email' => ''), 'phonenumber' => array('Telefoon' => ''),
                                            'street' => array('Straat' => ''), 'housenumber' => array('Huisnummer' => ''),
                                          'postalcode' => array('Postcode' => ''), 'city' => array('Woonplaats' => ''));
$myData['formInputs']['error'] = array('title' => '*', 'name' => '*', 'email' => '', 'phonenumber' => '', 'street' => '', 
                                      'housenumber' => '', 'postalcode' => '', 'city' => '', 'communication' => '*', 'message' => '*');
$myData['formInputs']['inputOther'] = array('title' => '', 'communication' => '', 'message' => '');

$view = new ContactDoc($myData);

$view  -> show();

?>