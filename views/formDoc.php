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
    echo'</fieldset>';
    echo '</form> ';
  }

  private function showInputSectionStart($id, $label){
    return '<div>
    <label for="'.$id.'"> '.$label.':</label>';
  }
  
  private function showInputSectionEnd($error){
    return '<span class="error">'.$error.' </span>
    </div>';
  }

  protected function showFormField($id, $label, $type = 'text', $options=''){
    $content = $this->getData()['inputText'][$id];
    $error = $this->getData()['inputError'][$id];
    $line = $this->showInputSectionStart($id, $label);
    if ($type == 'text'){ 
      $line = $line . '<input type = '.$type.' name='.$id.' value= "'.$content.'" id="'.$id.'"' ;
      $line = $line . "/>";
    } elseif  ($type == 'select') {
      //$line = $line."Something";
      $line = $line . '<select id="'.$id.'" name="'.$id.'">
      <option value=""></option>';
      foreach ($options as $id =>  $display){
        $line = $line . '<option value="'.$id.'" '.($content == "'.$id.'"   ? "selected" : "").' >'.$display.'.</option> ';
      }
      $line = $line . '</select>';
    } else {
      $line = $line. '<textarea id="'.$id.'" name="'.$id.'" rows="'.$options['rows'].'" cols="'.$options['cols'].'" placeholder="'.$content.'" ></textarea>';
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