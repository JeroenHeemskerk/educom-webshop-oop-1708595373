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

    $this -> showFormDropDown();
    $this -> showInputField();
    $this -> showFormSelect();
    $this -> showFormLargeField();
  }

  protected function showFormDropDown(){
    $errors = $this->getData()['formInputs']['error'];
    $inputs = $this->getData()['formInputs']['inputOther'];
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

  protected function showFormSelect(){
    $errors = $this->getData()['formInputs']['error'];
    $inputs = $this->getData()['formInputs']['inputOther'];
    echo '
    <div>
    <label for="city">Hoe wilt u communiceren?</label> 
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

  protected function showFormLargeField(){
    $errors = $this->getData()['formInputs']['error'];
    $inputs = $this->getData()['formInputs']['inputOther'];
    echo '
    <div>
      <label for="message">Waarom wilt u contact opnemen?</label>
      <textarea id="message" name="message" rows="4" cols="50" placeholder="'.$inputs['message'].'" ></textarea>
      <span class="error">'.$errors['message'].'</span>
    </div>';
  }


} 


?>