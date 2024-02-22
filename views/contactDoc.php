<?php
require_once('formDoc.php');
 class ContactDoc Extends FormDoc{
  protected function postData(){}

  protected function checkFieldContent(){}

  protected function formInputCheck(){}

  protected function showTitleContent(){
    echo 'Contact  page'; 
  }

  protected function showHeaderContent(){
    echo 'Contact'; 
  }

  protected function showContent(){
      $this->formStart();
      $this->formContent();
      $this->submitButton();
      $this->formEnd();
  }


  protected function formStart(){
    echo '<form class="contact" method="POST" action="index.php">
    <input type="hidden" name="page" value="contact" id="page"/>
    <fieldset class="persoon">';
  }

  protected function formContent(){

  }

  protected function submitButton(){
    echo'  <div>
    <input class="submit" type="submit" value="Submit">
    </div>';
  }

  protected function formEnd(){
    echo'</fieldset>
    </form> ';
  }

} 


?>