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
     $this->formStart('login');
     $this->formContent();
     $this->submitButton();
     $this->formEnd();
 }

 }
  protected function formContent(){
    $formInputs = $this->getData()['formInputs'];
    echo '
    <div> 
    <label for="name"> Email:</label> 
    <input type="text" name="email" value="'.$formInputs['email'].'" id="email">
    <span class="error">* '.$formInputs['emailErr'].'</span>
    </div>
    <div> 
    <label for="password"> Wachtword:</label> 
    <input type="text" name="password" value="'.$formInputs['password'].'" id="password">
    <span class="error">* '.$formInputs['passwordErr'].'</span>
    </div>';
  }

}
?>