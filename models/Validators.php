<?php
class Validators{
  public function validateInputs($page, $inputs, $errors){
    //different pages require different error handling
    if ($page == 'contact'){

    }

    return $errors;
  }

  /*
  private function checkFieldContent($data, $err=''){
    if (empty($data)) $err = "Dit veld moet ingevuld worden"; 
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
  */

}
?>