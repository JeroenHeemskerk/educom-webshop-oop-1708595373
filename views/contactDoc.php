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
    require_once('models/Validators.php');
    $this -> showFormField('title') ;
    $this -> showFormField('name');
    $this -> showFormField('email');
    $this -> showFormField('phonenumber');
    $this -> showFormField('street');
    $this -> showFormField('housenumber');
    $this -> showFormField('postalcode');
    $this -> showFormField('city');
    $this -> showFormField('communication');
    $this -> showFormField('message');
  }
} 
?>