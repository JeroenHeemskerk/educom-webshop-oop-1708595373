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
      $errors['title'] = $this->checkFieldContent($inputs['title'], $errors['title']);
      $errors['name'] = $this->checkFieldContent($inputs['name'], $errors['name']);
      $errors['message'] = $this->checkFieldContent($inputs['message'], $errors['message']);
      $errors['communication'] = $this->checkFieldContent($inputs['communication'], $errors['communication']);

      //And now to check the fields required through communicaiton
      if ($inputs['communication'] == "email") {
        $errors['email'] = $this->checkFieldContent($inputs['email']);
      } elseif ($inputs['communication'] == "phone") {
        $errors['phonenumber'] = $this->checkFieldContent($inputs['phonenumber']);
      } elseif ($inputs['communication'] == "post"){
        $postRequired = true;
      }

      $postData = array($inputs['street'], $inputs['housenumber'], $inputs['postalcode'], $inputs['city']);
      //passing along post required in case it was already said to true
      $postRequired = $this->checkArrayNotEmpty($postData, $postRequired);

      if ($postRequired) {
        //Validating postal code
        $errors['postalcode'] = $this->checkPostalCode($inputs['postalcode']);
        //in order street, housenumber, postalcode, city
        $errors['street'] = $this->checkFieldContent($inputs['street']);
        $errors['housenumber'] = $this->checkFieldContent($inputs['housenumber']);
        $errors['postalcode'] = $this->checkFieldContent($inputs['postalcode']);
        $errors['city'] = $this->checkFieldContent($inputs['city']);
      }

      if (empty($formInputs['email'] == false)){ 
        $errors['email'] = checkEmail($formInputs['email']);
      }


    }
    return $errors;
}

  private function checkArrayNotEmpty($data, $flag=false){
    foreach ($data as $key => $value) {
      if ($value != '') {
        $flag = true;
      }
    return $flag;
    }
  }

  
  private function checkFieldContent($data, $err=''){
    if (empty($data)) $err = $err."Dit veld moet ingevuld worden"; 
    return $err;
  }
  /*
  private function checkEmail($email, $err=''){
    if (filter_var($email, FILTER_VALIDATE_EMAIL)){
      $err = '';
    } else {
     $err = 'Dit is geen geldig email address';
    }
    return $err;
  }*/

  private function checkPostalCode($postalCode, $err=''){
    $postRegex = "/^[0-9]{4}\s[A-z]{2}$/";
    if (!preg_match($postRegex, $postalCode)) { 
      $err = "Dit is niet een nederlandse postcode";
    }
    return $err;
  }
  

}
?>