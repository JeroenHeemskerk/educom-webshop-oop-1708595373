<?php
require_once('formDoc.php');
class LoginDoc Extends FormDoc{
  protected function showTitleContent(){
    echo 'Login page'; 
  }

  protected function showHeaderContent(){
    echo 'Login'; 
  }

 protected function showContent(){
    $this->showFormStart();
    $this->showFormContent();
    $this->showSubmitButton();
    $this->showFormEnd();
  }

  protected function showFormContent(){
    $this -> showFormField('email', 'Email', 'text');
    $this -> showFormField('password', 'Wachtwoord', 'text');
  }

}

?>