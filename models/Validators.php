<?php
  define("TITLES", array("mr" => "Dhr", 'mrs' => 'Mvr', 'other' => 'Anders'));
  define("COMMUNICATIONS", array('email'=> 'Email', 'phone'=>'Telefoon', 'post'=> 'Post'));
class Validators{
  public static function validateInputs($page, $meta, $inputs, $errors){
    $errors['valid'] = false;
    $ogErrors = $errors;
    $groups = array();
    foreach($meta as $key => $metaData){
      $errors[$key] = self::validateField($key, $inputs, $metaData, $errors);
      if (array_key_exists('group', $metaData )){
        $groups[$metaData['group']][$key] = $inputs[$key];
      }
    }
    if(!empty($groups)){
      foreach($groups as $group => $keys){
        $flag = false;
        foreach($keys as $key => $value){
          if (!empty($value)){
            $flag = true;
          }
        }
        // if the flag ends up on true you gotta loop through everything, otherwise you'll miss something
        var_dump($group);
        if ($flag){
          foreach($keys as $key => $value){
            $errors[$key] = self::checkFieldContent($key, $inputs, $errors);
          }
        }

      }
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
    $groupCheck = array();
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
              if (empty($inputs[$key] == false)){ 
                  $error[$key] = self::checkEmail($key, $inputs, $error);
              }
                break;
        }
    }
    if(empty($error[$key])){
      $error[$key] = '';
    }
    return $error[$key];
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
    // so for the contact condition
    if ($parts[0] == 'contact'){
      if ($parts[1] == $data['communication'])
      $err[$key] = self::checkFieldContent($key, $data, $err);
    }
    // the second condition is group
    // how'd this work? I think by checking if anything else in the group is filled
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
      if (!filter_var($data[$key], FILTER_VALIDATE_EMAIL)){
        $err[$key] = $err[$key]. 'Dit is geen geldig email address';
      } 
    return $err[$key];
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