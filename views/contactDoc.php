<?php
require_once('formDoc.php');
 class ContactDoc Extends FormDoc{

  protected function showTitleContent(){
    echo 'Contact page'; 
  }

  protected function showHeaderContent(){
    echo 'Contact'; 
  }

  protected function showContent(){
    $this->showFormStart();
    $this->showFormContent();
    $this->showSubmitButton();
    $this->showFormEnd();
  }

  protected function showFormContent(){ 
    $this -> showFormField('title', 'Title', 'select', array("mr" => "Dhr", 'mrs' => 'Mvr', 'other' => 'Anders')) ;
    $this -> showFormField('name', 'Naam', 'text');
    $this -> showFormField('email', 'Email', 'text');
    $this -> showFormField('phonenumber', 'Telefoon', 'text');
    $this -> showFormField('street', 'Straat', 'text');
    $this -> showFormField('housenumber', 'Huisnummer', 'text');
    $this -> showFormField('postalcode', 'Postcode', 'text');
    $this -> showFormField('city', 'Woonplaats', 'text');
    $this -> showFormField('communication', 'Hoe wilt u communiceren?', 'select', array('email'=> 'Email', 'phone'=>'Telefoon', 'post'=> 'Post'));
    $this -> showFormField('message', 'Waarom wilt u contact opnemen?', 'textarea', array('rows' => 4, 'cols' => 50));
  }

} 


?>