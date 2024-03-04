<?php
require_once('formDoc.php');
class RegisterDoc Extends FormDoc{
 protected function showTitleContent(){
   echo 'Register page'; 
 }

 protected function showHeaderContent(){
   echo 'Register'; 
 }

 protected function showContent(){
     $this->showFormStart();
     $this->showFormContent();
     $this->showSubmitButton();
     $this->showFormEnd();
 }

  protected function showFormContent(){
    $this -> showFormField('user', 'Gebruikersnaam', 'text');
    $this -> showFormField('email', 'Email', 'text');
    $this -> showFormField('password', 'Wachtwoord', 'text');
    $this -> showFormField('repeat', 'Herhaal wachtwoord', 'text');
  }

}
?>