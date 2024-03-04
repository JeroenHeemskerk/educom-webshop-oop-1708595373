<?php
require_once('basicDoc.php');
abstract class FormDoc Extends BasicDoc{
  //protected abstract function formStart();
  protected abstract function showFormContent();

  protected function showFormStart(){
    echo '
    <form class="contact" method="POST" action="index.php">
    <input type="hidden" name="page" value="'.$this -> data -> page.'" id="page"/>
    <fieldset class="persoon">';
  }

  protected function showFormEnd(){
    echo'</fieldset>';
    echo '</form> ';
  }

  private function showInputSectionStart($id, $label){
    /* 
    id string
    label string 
    */ 
    return '<div>
    <label for="'.$id.'"> '.$label.':</label>';
  }
  
  private function showInputSectionEnd($error){
    /*
    error string
    */
    
    return '<span class="error">'.$error.' </span>
    </div>';
  }

  protected function showFormField($id){
    $content = $this->data->meta[$id];
    $value = $this->data->values[$id];
    $error = $this->data->errors[$id];

    $line = $this->showInputSectionStart($id, $content['label']);
    if ($content['type'] == 'text'){ 
      $line = $line . '<input type = '.$content['type'].' name='.$id.' value= "'.$value.'" id="'.$id.'"' ;
      $line = $line . "/>";
    } elseif  ($content['type'] == 'select') {
      //$line = $line."Something";
      $line = $line . '<select id="'.$id.'" name="'.$id.'">
      <option value=""></option>';
      foreach ($content['options'] as $id =>  $display){
        $selected = $value == $id ? 'selected' : '';
        $line = $line . '<option value="'.$id.'" '. $selected.' >'.$display.'.</option> ';
      }
      $line = $line . '</select>';
    } else {

      $line = $line. '<textarea id="'.$id.'" name="'.$id.'" rows="'.$content['options']['rows'].'" cols="'.$content['options']['cols'].'" placeholder="'.$value.'" ></textarea>';
    }

    $line = $line . $this->showInputSectionEnd($error);
    echo $line;
  }


  protected function showSubmitButton(){
    echo'  <div>
    <input class="submit" type="submit" value="Submit">
    </div>';
  }

}
?>