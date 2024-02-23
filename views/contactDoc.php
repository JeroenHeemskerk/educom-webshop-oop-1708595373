<?php
require_once('formDoc.php');
 class ContactDoc Extends FormDoc{

  protected function showTitleContent(){
    echo 'Contact page'; 
  }

  protected function showHeaderContent(){
    echo 'Contact'; 
  }

  protected function showContent(){
    $this->showFormStart();
    $this->showFormContent();
    $this->showSubmitButton();
    $this->showFormEnd();
  }

  protected function showFormContent(){ 
    $inputForm = $this ->getData()['formInputs'];
    $errors = $inputForm['error'];
    $inputField = $inputForm['inputText'];
    $inputOther = $inputForm['inputOther'];
    $this -> showFormDropDown($inputOther, $errors);
    $this -> showInputField($inputField, $errors);
    $this -> showFormSelect($inputOther, $errors);
    $this -> showFormLargeField($inputOther, $errors);
  }

  protected function showFormDropDown($inputs, $errors){
    $errors = $this->getData()['formInputs']['error'];
    echo '  <div>
    <label for="title">Title:</label> 
    <select id="title" name="title">
      <option value=""></option>
      <option value="sir" '.($inputs['title'] == "sir"   ? "selected" : "").' >Dhr.</option> 
      <option value="madam" '.($inputs['title'] == "madam"   ? "selected" : "").' >Mvr.</option>
      <option value="other" '.($inputs['title'] == "other"   ? "selected" : "").'>Anders</option>
    </select> 
      <span class="error">'.$errors['title'].'</span>
    </div>'; 
  }

  protected function showFormSelect($inputs, $errors){
    $this -> showInputSectionStart('city', 'Hoe wilt u communiceren?');
    echo '
    </div>
    <fieldset class = "communication">
       <legend class = "communication"><span class="error">'.$errors['communication'].'</span></legend> 
        <div>
        <input type="radio" name="communication" value="email" '.($inputs['communication'] == "email"   ? "checked" : "").' >  
        <label for="email">Email</label> 
        </div>
        <div>
        <input type="radio" name="communication" value="phone"  '.($inputs['communication'] == "phone"   ? "checked" : "").' >
        <label for="phone">Telefoon</label> 
        </div>
        <div>
        <input type="radio" name="communication" value="post"  '.($inputs['communication'] == "post"   ? "checked" : "").' > 
        <label for="post">Post</label>
        </div>
       </legend>
      </fieldset>';
  }

  protected function showFormLargeField($inputs, $errors){
    $this -> showInputSectionStart("message", "Waarom wilt u contact opnemen?");
    echo '
      <textarea id="message" name="message" rows="4" cols="50" placeholder="'.$inputs['message'].'" ></textarea>';
    $this -> showInputSectionEnd($errors['message']);
  }


} 


?>