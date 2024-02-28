<?php
class Validators{
  public function validateInputs($page, $inputs, $errors){
    //different pages require different error handling
    
    if ($page == 'contact'){
      // if the contact form is correctly filled/validated it needs to redirect to the Thanks page
      $redirect = false;
      //If communication method is post, we also need to add a bunch of checks, we'll track the need for it with
      $postRequired = false;
      // First are the required inputs, these can't be empty
      // So one thing I am noticing is that I am calling on the same bit of code (checkFieldContent) in a lot of places
      // I think we can make that compacter
      $inputsToCheck = array('title' =>'', 'name'=>'', 'message'=>'', 'communication'=>'');

      //And now to check the fields required through communicaiton
      if ($inputs['communication'] == "email") {
        $inputsToCheck['email'] = '';
      } elseif ($inputs['communication'] == "phone") {
        $inputsToCheck['phonenumber'] = '';
      } elseif ($inputs['communication'] == "post"){
        $postRequired = true;
      }
      $postData = array($inputs['street'], $inputs['housenumber'], $inputs['postalcode'], $inputs['city']);
      //passing along post required in case it was already said to true
      $postRequired = $this->checkArrayNotEmpty($postData, $postRequired);

      if ($postRequired) {
        $inputsToCheck['street'] = '';
        $inputsToCheck['housenumber'] = '';
        $inputsToCheck['postalcode'] = '';
        $inputsToCheck['city'] = '';
      }
      foreach ($inputsToCheck as $key => $value) {
        $errors[$key] = $this->checkFieldContent($inputs[$key], $errors[$key]);
      }

      // if postalcode isn't empty, check postalcode
      if (empty($inputs['postalcode'] == false)){ 
        $errors['postalcode'] = $this->checkPostalCode($inputs['postalcode']);
      }
      //same for meail
      if (empty($inputs['email'] == false)){ 
        $errors['email'] = $this->checkEmail($inputs['email']);
      }

      // Lastly check if any errors are present
      $redirect = (count(array_unique($errors, SORT_REGULAR)) == 2);
      if($redirect){
        $errors['page'] = 'thanks';
      }
    }
    return $errors;
}

  private function checkArrayNotEmpty($data, $flag=false){
    foreach ($data as $key => $value) {
      if ($value != '') {
        $flag = true;
      }
    }
    return $flag;
  }

  
  private function checkFieldContent($data, $err=''){
    if (empty($data)) $err = $err."Dit veld moet ingevuld worden"; 
    return $err;
  }
  
  private function checkEmail($email, $err=''){
    if (filter_var($email, FILTER_VALIDATE_EMAIL)){
      $err = '';
    } else {
     $err = 'Dit is geen geldig email address';
    }
    return $err;
  }

  private function checkPostalCode($postalCode, $err=''){
    $postRegex = "/^[0-9]{4}\s[A-z]{2}$/";
    if (!preg_match($postRegex, $postalCode)) { 
      $err = "Dit is niet een nederlandse postcode";
    }
    return $err;
  }
  

}
?>