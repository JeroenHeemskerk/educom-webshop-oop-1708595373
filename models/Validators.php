<?php
  define("TITLES", array("mr" => "Dhr", 'mrs' => 'Mvr', 'other' => 'Anders'));
  define("COMMUNICATIONS", array('email'=> 'Email', 'phone'=>'Telefoon', 'post'=> 'Post'));
class Validators{
  public static function validateInputs($page, $meta, $inputs, $errors){
    $errors['valid'] = false;
    $ogErrors = $errors;
    foreach($meta as $key => $metaData){
      $errors[$key] = self::validateField($key, $inputs, $metaData, $errors);
    }
      //$errors[$key] = self::validateField($key, $inputs, $metaData, $errors);
      //if (isset($errors[$key])) {
        // Stop on first error for this field
       // break;
     // }
    if($errors == $ogErrors){
      $errors['valid'] = true;
    }
    return $errors;
  }

  private static function validateField($key, $inputs, $metadata, $error){
    //var_dump($error[$key]);
    foreach($metadata['validations'] as $validation) {
        $parts = explode(':', $validation, 2); 
        switch($parts[0]) {
            case 'notEmpty':
                $error[$key] = self::checkFieldContent($key, $inputs, $error);
                break;
            case 'notEmptyIf':
                $error[$key] = self::conditionalCheckFieldContent($key, $inputs, $error, $parts[1]);
                break;
            case "validEmail":
                $error[$key] = self::checkEmail($key, $inputs, $error);
                break;
        }
    }
    if(empty($error[$key])){
      $error[$key] = '';
    }
    return $error[$key];
  }

  private static function validateInputsRegister($inputs, $errors){
    //$errors['email'] = self::checkFieldContent($inputs['email'], $errors['email']);
    $errors['name'] = self::checkFieldContent($inputs['name'], $errors['name']);
    $errors['email'] = self::checkEmail($inputs['email'], $errors['email']);
    $errors['password'] = self::checkFieldContent($inputs['password'], $errors['password']);
    $errors['repeat'] = self::checkFieldContent($inputs['repeat'], $errors['repeat']);
    $errors['password'] = self::checkPasswordMatch($inputs['password'], $inputs['repeat'], $errors['password']);
    // first check fields

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

  private static function conditionalCheckFieldContent($key, $data, $err, $condition){
    $parts = explode(':', $condition, 2); 
    // so if its contact, you do a field content check on a few fields, I think this is also the only conditional currently in the system
    switch ($parts[1]){
      case 'email':
        $err[$key] = self::checkFieldContent($key, $data, $err);
    }
    return $err[$key];
  }
  
  private static function checkFieldContent($key, $data, $err){
    //var_dump($err[$key]);
    if (empty($data[$key])) {
     $err[$key] = $err[$key]."Dit veld moet ingevuld worden"; 
    }

    return $err[$key];
  }
  
  private static function checkEmail($key, $data, $err){
    if (empty($data[$key] == false)){ 
      if (!filter_var($data[$key], FILTER_VALIDATE_EMAIL)){
        $err[$key] = $err[$key]. 'Dit is geen geldig email address';
      } 
    return $err[$key];
    }
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
  
  private static function checkPasswordMatch($password, $repeat, $err = ''){
    if ($password != $repeat) {
      $err = $err. 'Wachtworden zijn niet hetzelfde';
    }
    return $err;
  }
}
?>