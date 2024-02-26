
<?php
function postDataRegister(){
  $formInputs['name'] = getPostVar('name');
  $formInputs['email'] = getPostVar('email');
  $formInputs['password'] = getPostVar('password');;
  $formInputs['repeat'] = getPostVar('repeat');
  return $formInputs;
}

function formCheckRegister($formInputs ){
   // array order is  name, email, password, repeat password
  $errors = array('name' => '', 'email' => '', 'password' => '', 'repeat' => '');
  $emailExist = false;
  $passwordMatch = checkPasswordMatch($formInputs['password'],$formInputs['repeat']);

  // checking if the email is valid
  $errors['email'] = checkEmail($formInputs['email']);
  // checking if the passwords match
  if (empty($passwordMatch)){
    $errors['password'] = $errors['repeat'] = "Wachtworden matchen niet";} 
    

  $errors['name'] = checkFieldContent($formInputs['name']);
  $errors['email'] = checkFieldContent($formInputs['email']);
  $errors['password'] = checkFieldContent($formInputs['password']);
  $errors['repeat'] = checkFieldContent($formInputs['repeat']);

  /*for ($x = 0; $x <= 3; $x++){
    $errors[$x] = checkFieldContent($formInputs[$x]);
  } */
  
  try {
  $emailExist = doesEmailExist($formInputs['email']);
  } catch (Exception $e) {
    $errrors['name'] = 'Er is een probleem met de server, probeer later nog eens';
    logors('Connection failed'.$e);
  }
  if ($emailExist) {
    $errors[1] = "Deze mail is al in gebruik";
    }
  // next up is determening whether to go back to the register page or to file away the data and go to login
  // so for this email can't already be registered, and passwords have to match
  if ($passwordMatch && !$emailExist){
    $errors['page'] = 'login';
    try {
    saveUser($formInputs['email'], $formInputs['name'], $formInputs['password']);
    }
    catch (Exception $e) { 
      $errors['name'] = 'Er is een probleem met de server, probeer later nog eens';
      logors('Connection failed'.$e);
    }

  } else {
      $errors['page'] = 'register';
  }
  return $errors;
}

function showHeadRegister(){
  echo '<title>Register form</title>';
}

function showHeaderRegister(){
  echo '<header  class=title><h1>Registratie</h1></header>';
}

function showContentRegister($formInputs){
  echo '
  <form class="contact" method="POST" action="index.php">
  <input type="hidden" name="page" value="register" id="page"/>
  <fieldset class="persoon">
  <div> 
    <label for="name"> Naam:</label> 
    <input type="text" name="name" value="'.$formInputs['name'].'" id="name">
    <span class="error">* '.$formInputs['name'].'</span>
  </div>
  <div> 
    <label for="email"> Email:</label> 
    <input type="text" name="email" value="'.$formInputs['email'].'" id="email">
    <span class="error">* '.$formInputs['email'].'</span>
  </div>
  <div> 
    <label for="password"> Wachtword:</label> 
    <input type="text" name="password" value="'.$formInputs['password'].'" id="password">
    <span class="error">* '.$formInputs['password'].'</span>
  </div>
  <div> 
    <label for="repeat"> Herhaal het wachtword:</label> 
    <input type="text" name="repeat" value="'.$formInputs['repeat'].'" id="repeat">
    <span class="error">* '.$formInputs['repeat'].'</span>
  </div>
  <div>
    <input class = "submit" type="submit" value="Submit">
  </div>
    </fieldset>
  </form>';
}

?>

