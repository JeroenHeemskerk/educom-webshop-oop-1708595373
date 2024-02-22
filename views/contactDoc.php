<?php
require_once('formDoc.php');
 class ContactDoc Extends FormDoc{
  protected function showTitleContent(){
    echo 'Contact  page'; 
  }

  protected function showHeaderContent(){
    echo 'Contact'; 
  }

  protected function showContent(){
    $this->showFormStart('contact');
    $this->showFormContent();
    $this->showSubmitButton();
    $this->showFormEnd();
  }

  protected function showFormContent(){
    $formInputs = $this->getData()['formInputs'];
    echo '  <div>
    <label for="title">title:</label> 
    <select id="title" name="title">
      <option value=""></option>
      <option value="sir" '.($formInputs['title'] == "sir"   ? "selected" : "").' >Dhr.</option> 
      <option value="madam" '.($formInputs['title'] == "madam"   ? "selected" : "").' >Mvr.</option>
      <option value="other" '.($formInputs['title'] == "other"   ? "selected" : "").'>Anders</option>
    </select> 
      <span class="error">* '.$formInputs['titleErr'].'</span>
    </div>
    <div>
      <label for="name"> Naam:</label> 
      <input type="text" name="name" value="'.$formInputs['name'].'" id="name">
      <span class="error">* '.$formInputs['nameErr'].'</span>
    </div>
    <div>
      <label for="email">E-mail:</label> 
        <input type="text" name="email" value="'.$formInputs['email'].'" id="email">
      <span class="error"> '.$formInputs['emailErr'].'</span>
    </div>
    <div>
      <label for="phonenumber">Telefoon nummer:</label> 
      <input type="text" name="phonenumber" value="'.$formInputs['phonenumber'].'" id="phonenumber">
      <span class="error"> '.$formInputs['phonenumberErr'].'</span>
    </div>
    <div>
      <label for="street">Straat:</label> 
      <input type="text" name="street" value="'.$formInputs['street'].'" id="street">
      <span class="error"> '.$formInputs['streetErr'].'</span>
    </div>
    <div>
      <label for="housenumber">Huisnummer:</label> 
      <input type="text" name="housenumber" value="' .$formInputs['housenumber'].'" id="housenumber">
      <span class="error"> '.$formInputs['housenumberErr'].'</span>
    </div>
    <div>
      <label for="postalcode">Postcode:</label> 
      <input type="text" name="postalcode" value="'.$formInputs['postalcode'].'" id="postalcode">
      <span class="error"> '.$formInputs['postalcodeErr'].'</span>
    </div>
    <div>
      <label for="city">Woonplaats:</label> 
      <input type="text" name="city" value="' .$formInputs['city'].'" id="city">
      <span class="error">'.$formInputs['cityErr'].'</span>
    </div>
  
      <!-- Voorkeur communication -->
    <div>
    <label for="city">Hoe wilt u communiceren?</label> 
    </div>
    <fieldset class = "communication">
       <legend class = "communication"><span class="error">*'.$formInputs['communicationErr'].'</span></legend> 
        <div>
        <input type="radio" name="communication" value="email" '.($formInputs['communication'] == "email"   ? "checked" : "").' >  
        <label for="email">Email</label> 
        </div>
        <div>
        <input type="radio" name="communication" value="phone"  '.($formInputs['communication'] == "phone"   ? "checked" : "").' >
        <label for="phone">Telefoon</label> 
        </div>
        <div>
        <input type="radio" name="communication" value="post"  '.($formInputs['communication'] == "post"   ? "checked" : "").' > 
       
        <label for="post">Post</label>
        </div>
         
       </legend>
      </fieldset>
  
      <!-- reden van contact -->
    <div>
      <label for="message">Waarom wilt u contact opnemen?</label>
      <textarea id="message" name="message" rows="4" cols="50" placeholder="'.$formInputs['message'].'" ></textarea>
      <span class="error">* '.$formInputs['messageErr'].'</span>
    </div>';
  }


} 


?>