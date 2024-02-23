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

  protected function showInputSectionStart($id, $label){
    return '<div>
    <label for="'.$id.'"> '.$label.':</label>';
  }
  
  protected function showInputSectionEnd($error){
    return '<span class="error">'.$error.' </span>
    </div>';
  }

  protected function showFormField($id, $label, $type = 'text', $options=''){
    $content = $this->getData()['formInputs']['inputText'][$id];
    $error = $this->getData()['formInputs']['error'][$id];
    $line = $this->showInputSectionStart($id, $label);
    if ($type != 'select') {
      //$line = $line."Something";
      $line = $line . '<input type = '.$type.' name='.$id.' value= "'.$content.'" id="'.$id.'"' ;
      if ($type == 'text'){ 
        $line = $line . "/>";
        $line = $line . $this->showInputSectionEnd($error);
        }
      if ($type ==  'radio'){
        // $line is gonna be needed multiple times
        
      }


    } else {
      $line = $line . '<select id="'.$id.'" name="'.$id.'">
      <option value=""></option>';
      foreach ($options as $id =>  $display){
        $line = $line . '<option value="'.$id.'" '.($content == "'.$id.'"   ? "selected" : "").' >'.$display.'.</option> ';

      }
      $line = $line . '</select>';
    }
    echo $line;
    }


  protected function showSubmitButton(){
    echo'  <div>
    <input class="submit" type="submit" value="Submit">
    </div>';
  }

}
?>