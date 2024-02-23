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
    //$this -> showFormDropDown($inputOther, $errors);
    //$myData['formInputs']['inputText'] = array('title' => '' , 'name' => '', 'email' => '', 'phonenumber' => '',
    //                                        'street' => '', 'housenumber' => '',
     //                                     'postalcode' => '', 'city' => '', 'communication' => '', 'message' => '');

    $this -> showFormField('title', 'Title', 'select', array("mr" => "Dhr", 'mrs' => 'Mvr', 'other' => 'Anders')) ;
    $this -> showFormField('name', 'Naam', 'text');
    $this -> showFormField('email', 'Email', 'text');
    $this -> showFormField('phonenumber', 'Telefoon', 'text');
    $this -> showFormField('street', 'Straat', 'text');
    $this -> showFormField('housenumber', 'Huisnummer', 'text');
    $this -> showFormField('postalcode', 'Postcode', 'text');
    $this -> showFormField('city', 'Woonplaats', 'text');
    $this -> showFormField('communicatie', 'Hoe wilt u communiceren?', 'radio', array('email'=> 'Email', 'phone'=>'Telefoon', 'post'=> 'Post'));

    //$this -> showFormField($inputField, $errors, 'text');
    //$this -> showFormSelect($inputOther, $errors);
    //$this -> showFormLargeField($inputOther, $errors);
  }

  protected function showFormSelect($inputs, $errors){
    $this -> showFormSelectStart($errors);
    $this -> showFormSelectButton($inputs, 'Email', 'email', 'communication');
    $this -> showFormSelectButton($inputs, "Telefoon", "phone", "communication");
    $this -> showFormSelectButton($inputs, "Post", "post", "communication");
    $this -> showFormSelectEnd();
  }

  protected function showFormSelectStart($errors){
    $this -> showInputSectionStart('communicatie', 'Hoe wilt u communiceren?');
    echo '
    </div>
    <fieldset class = "communication">
       <legend class = "communication"><span class="error">'.$errors['communication'].'</span></legend>';
  }

  protected function showFormSelectButton($inputs, $label, $id, $name){
    $this -> showInputSectionStart($id, $label);
    echo'
    <input type="radio" name="'.$name.'" value="'.$id.'" '.($inputs['communication'] == "'.$id.'"    ? "checked" : "").' > 
    </div>';
  }

  protected function showFormSelectEnd(){
    echo'
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