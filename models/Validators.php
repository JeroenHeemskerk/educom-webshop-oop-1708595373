<?php
class Validators{
  public static function validateInputs($page, $inputs, $errors){
    $ogErrors = $errors;
    //different pages require different error handling
    if ($page == 'contact'){
      // if the contact form is correctly filled/validated it needs to redirect to the Thanks page
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
      $postRequired = self::checkArrayNotEmpty($postData, $postRequired);

      if ($postRequired) {
        $inputsToCheck['street'] = '';
        $inputsToCheck['housenumber'] = '';
        $inputsToCheck['postalcode'] = '';
        $inputsToCheck['city'] = '';
      }
      foreach ($inputsToCheck as $key => $value) {
        $errors[$key] = self::checkFieldContent($inputs[$key], $errors[$key]);
      }

      // if postalcode isn't empty, check postalcode
      $errors['postalcode'] = self::checkPostalCode($inputs['postalcode']);
      //same for mail
      $errors['email'] = self::checkEmail($inputs['email']);

      // Lastly check if any errors are present, which is slightly complicated by the fact we got * to display as part of errors
      if($errors == $ogErrors){
        $errors['page'] = 'thanks';
      } 
    } elseif ($page == 'login'){
      $errors['valid'] = false;
      $errors['email'] = self::checkFieldContent($inputs['email'], $errors['email']);
      $errors['email'] = self::checkEmail($inputs['email'], $errors['email']);
      $errors['password'] = self::checkFieldContent($inputs['password'], $errors['password']);
      if($errors == $ogErrors){
        $errors['valid'] = true;
      }
      //

    }

    return $errors;
  }

  private static function checkArrayNotEmpty($data, $flag=false){
    foreach ($data as $key => $value) {
      if ($value != '') {
        $flag = true;
      }
    }
    return $flag;
  }

  
  private static function checkFieldContent($data, $err=''){
    if (empty($data)) $err = $err."Dit veld moet ingevuld worden"; 
    return $err;
  }
  
  private static function checkEmail($email, $err=''){
    if (empty($email == false)){ 
      if (filter_var($email, FILTER_VALIDATE_EMAIL)){
        $err = $err . '';
      } else {
      $err = $err. 'Dit is geen geldig email address';
      }
    }
    return $err;
  }

  private static function checkPostalCode($postalCode, $err=''){
    $postRegex = "/^[0-9]{4}\s[A-z]{2}$/";
    if (empty($postalCode== false)){
      if (!preg_match($postRegex, $postalCode)) { 
        $err = "Dit is niet een nederlandse postcode";
      }
    }
    return $err;
  }
  

}
?>