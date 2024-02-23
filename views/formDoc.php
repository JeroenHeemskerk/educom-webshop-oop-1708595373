<?php
require_once('basicDoc.php');
abstract class FormDoc Extends BasicDoc{
  //protected abstract function formStart();
  protected abstract function showFormContent();

  protected function showFormStart(){
    $formValue = $this -> getData()['page'];
    echo '
    <form class="contact" method="POST" action="index.php">
    <input type="hidden" name="page" value="'.$formValue.'" id="page"/>
    <fieldset class="persoon">';
  }

  protected function showFormEnd(){
    echo'</fieldset>
    </form> ';
  }

  protected function showInputField(){
    $inputs = $this ->getData()['formInputs'];
    $errors = $inputs['error'];
    $inputs = $inputs['inputText'];
    foreach ($inputs as $id => $content){
      $label = key($inputs[$id]);
      $value = $inputs[$id][$label];
      echo'
      <div>
      <label for="'.$id.'"> '.$label.':</label> 
      <input type="text" '.$id.'="name" value="'.$value.'" id="'.$id.'">
      <span class="error">'.$errors[$id].' </span>
      </div>';
    } 

  }

  protected function showSubmitButton(){
    echo'  <div>
    <input class="submit" type="submit" value="Submit">
    </div>';
  }

}
?>