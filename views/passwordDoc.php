<?php
require_once('formDoc.php');
class PasswordDoc Extends FormDoc{
 protected function showTitleContent(){
   echo 'Password page'; 
 }

 protected function showHeaderContent(){
   echo 'Password'; 
 }

 protected function showContent(){
    $this->showFormStart('password');
    $this->showFormContent();
    $this->showSubmitButton();
    $this->showFormEnd();
 }


  protected function showFormContent(){
    $formInputs = $this->getData()['formInputs'];
    echo '
    <div> 
    <label for="oldPass">Oude wachtwoord:</label> 
    <input type="text" name="oldPass" value="" id="oldPass">
    <span class="error">* '.$formInputs['oldPass'].'</span>
  </div>
    <div> 
    <label for="newPass"> Nieuw wachtwoord:</label> 
    <input type="text" name="newPass" value="" id="newPass">
    <span class="error">* '.$formInputs['newPass'].'</span>
  </div>
    <div> 
    <label for="repeatNewPass"> Herhaal nieuw wachtwoord:</label> 
    <input type="text" name="repeatNewPass" value="" id="repeatNewPass">
    <span class="error">* '.$formInputs['repeatNewPass'].'</span>
  </div>';
  }

}
?>