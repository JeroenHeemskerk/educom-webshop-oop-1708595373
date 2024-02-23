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

  protected function showInputSectionStart($id, $label){
    echo '<div>
    <label for="'.$id.'"> '.$label.':</label>';
  }
  
  protected function showInputSectionEnd($error){
    echo '<span class="error">'.$error.' </span>
    </div>';
  }

  protected function showInputField($inputs, $errors){
    foreach ($inputs as $id => $content){
      $label = key($inputs[$id]);
      $value = $inputs[$id][$label];
      $this -> showInputSectionStart($id, $label);
      echo'<input type="text" '.$id.'="name" value="'.$value.'" id="'.$id.'">';
      $this -> showInputSectionEnd($errors[$id]);
    } 
  }

  protected function showSubmitButton(){
    echo'  <div>
    <input class="submit" type="submit" value="Submit">
    </div>';
  }

}
?>