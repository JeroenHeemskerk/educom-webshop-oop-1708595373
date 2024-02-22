<?php
include_once "../views/registerDoc.php";

$myData = array();
$myData['menu'] = array('home' => 'Home', 'about' => 'Over mij', 'contact' => 'Contact', 'webshop' => 'WEBSHOP', 'top' => 'TOP 5');
$myData['formInputs'] = array('title' => '', 'titleErr' => '', 'name' => '', 'nameErr' => '', 'email' => '', 'emailErr' => '',
                               'phonenumber' => '', 'phonenumberErr' => '', 'street' => '', 'streetErr' => '', 'housenumber' => '', 'housenumberErr' => '',
                              'postalcode' => '', 'postalcodeErr' => '', 'city' => '', 'cityErr' => '', 'communication' => '', 'communicationErr' => '',
                              'message' => '', 'messageErr' => '', 'repeat' => '', 'repeatErr' => '');

$view = new RegisterDoc($myData);

$view  -> show();

?>