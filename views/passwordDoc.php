<?php
require_once('formDoc.php');
class PasswordDoc Extends FormDoc{
 protected function showTitleContent(){
   echo 'Password page'; 
 }

 protected function showHeaderContent(){
   echo 'Nieuw wachtwoord'; 
 }

 protected function showContent(){
    $this->showFormStart();
    $this->showFormContent();
    $this->showSubmitButton();
    $this->showFormEnd();
 }


  protected function showFormContent(){
    $this -> showFormField('oldPass', 'Wachtwoord', 'text');
    $this -> showFormField('newPass', 'Nieuw wachtwoord', 'text');
    $this -> showFormField('newRepeatPass', 'Herhaal nieuw wachtwoord', 'text');
  }

}
?>