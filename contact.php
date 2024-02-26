
<?php
function showHeadContact(){
  echo '<title>Contact form</title>';
}

function showHeaderContact(){
  echo '<header  class=title><h1>Contact</h1></header>';
}

function showContentContact($formInputs){
  // order of arrays is title, name, email, phonenumber, street, housenumber, postalcode, city, message, communication (repeating once after communication)
  $title = $formInputs['title'];
  $communication = $formInputs['communication'];

  echo '<form class="contact" method="POST" action="index.php">
  <input type="hidden" name="page" value="contact" id="page"/>
  <fieldset class="persoon">
  <div>
  <label for="title">title:</label> 
  <select id="title" name="title">
    <option value=""></option>
    <option value="sir" '.($title == "sir"   ? "selected" : "").' >Dhr.</option> 
    <option value="madam" '.($title == "madam"   ? "selected" : "").' >Mvr.</option>
    <option value="other" '.($title == "other"   ? "selected" : "").'>Anders</option>
  </select> 
    <span class="error">* '.$formInputs['title'].'</span>
  </div>
  <div>
    <label for="name"> Naam:</label> 
    <input type="text" name="name" value="'.$formInputs['name'].'" id="name">
    <span class="error">* '.$formInputs['name'].'</span>
  </div>
  <div>
    <label for="email">E-mail:</label> 
      <input type="text" name="email" value="'.$formInputs['email'].'" id="email">
    <span class="error"> '.$formInputs['email'].'</span>
  </div>
  <div>
    <label for="phonenumber">Telefoon nummer:</label> 
    <input type="text" name="phonenumber" value="'.$formInputs['phonenumber'].'" id="phonenumber">
    <span class="error"> '.$formInputs['phonenumber'].'</span>
  </div>
  <div>
    <label for="street">Straat:</label> 
    <input type="text" name="street" value="'.$formInputs['street'].'" id="street">
    <span class="error"> '.$formInputs['street'].'</span>
  </div>
  <div>
    <label for="housenumber">Huisnummer:</label> 
    <input type="text" name="housenumber" value="' .$formInputs['housenumber'].'" id="housenumber">
    <span class="error"> '.$formInputs['housenumber'].'</span>
  </div>
  <div>
    <label for="postalcode">Postcode:</label> 
    <input type="text" name="postalcode" value="'.$formInputs['postalcode'].'" id="postalcode">
    <span class="error"> '.$formInputs['postalcode'].'</span>
  </div>
  <div>
    <label for="city">Woonplaats:</label> 
    <input type="text" name="city" value="' .$formInputs['city'].'" id="city">
    <span class="error">'.$formInputs['city'].'</span>
  </div>

    <!-- Voorkeur communication -->
  <div>
  <label for="city">Hoe wilt u communiceren?</label> 
  </div>
  <fieldset class = "communication">
     <!-- Need some help here: the legend brings a nice shape to things, but due to how the title in it works it isnt a perfect square -->
     <legend class = "communication"><span class="error">*'.$formInputs['communcation'].'</span></legend> 
      <div>
      <input type="radio" name="communication" value="email" '.($communication == "email"   ? "checked" : "").' >  
      <label for="email">Email</label> 
      </div>
      <div>
      <input type="radio" name="communication" value="phone"  '.($communication == "phone"   ? "checked" : "").' >
      <label for="phone">Telefoon</label> 
      </div>
      <div>
      <input type="radio" name="communication" value="post"  
      '.($communication == "post"   ? "checked" : "").' > 
     
      <label for="post">Post</label>
      </div>
       
     </legend>
    </fieldset>

    <!-- reden van contact -->
  <div>
    <label for="message">Waarom wilt u contact opnemen?</label>
    <textarea id="message" name="message" rows="4" cols="50" placeholder="'.$formInputs['message'].'" ></textarea>
    <span class="error">* '.$formInputs['message'].'</span>
  </div>
  <div>
    <input class="submit" type="submit" value="Submit">
  </div>
    </fieldset>
  </form> 
  ';
}

function postDataContact(){
  $formInputs['title'] = getPostVar("title");
  $formInputs['name'] = getPostVar("name");
  $formInputs['email'] = getPostVar("email");
  $formInputs['phonenumber'] = getPostVar("phonenumber");
  $formInputs['street'] = getPostVar("street");
  $formInputs['housenumber'] = getPostVar("housenumber");
  $formInputs['postalcode'] = getPostVar("postalcode");
  $formInputs['city'] = getPostVar("city");
  $formInputs['communication'] = getPostVar("communication");
  $formInputs['message'] = getPostVar("message");
  return $formInputs;
}

function formCheckContact($formInputs) {
  // Order of arrays should be: title, name, email, phonenumber, street, housenumber, postalcode, city, communication, message
  $errors = array('title' => '', 'name' => '', 'email' => '', 'phonenumber' => '', 'street' => '', 
                  'housenumber' => '', 'postalcode' => '', 'city' => '', 'communication' => '', 'message' => '');
  $valid = false;
  $postRequired = false;
	//Ordered the same way the form is in
  // so this is the title
  $errors['title'] = checkFieldContent($formInputs['title'], $errors['title']);
  // the name
  $errors['name'] = checkFieldContent($formInputs['name'], $errors['name']);
  // the message
  $errors['message'] = checkFieldContent($formInputs['message'], $errors['message']);
  // the communication method
  $errors['communcation'] = checkFieldContent($formInputs['communication'], $errors['communication']);
  
  if ($formInputs['communcation'] == "email") {
    $errors['email'] = checkFieldContent($formInputs['email'], $errors['email']);
  } elseif ($formInputs['communcation'] == "phone") {
    $errors['phonenumber'] = checkFieldContent($formInputs['phonenumber'], $errors['phonenumber']);
  } elseif ($formInputs['communication'] == "post"){
    $postRequired = true;
  }
  
  $postData = array($formInputs['street'], $formInputs['housenumber'], $formInputs['postalcode'], $formInputs['city']);
  foreach ($postData as $x) {
    if ($x != '') {
      $postRequired = true;
    }
  }
    
  if ($postRequired) {
    //Validating postal code
    $errors['postalcode'] = checkPostalCode($formInputs['postalcode']);
    //in order street, housenumber, postalcode, city
    $errors['street'] = checkFieldContent($formInputs['street']);
    $errors['housenumber'] = checkFieldContent($formInputs['housenumber']);
    $errors['postalcode'] = checkFieldContent($formInputs['postalcode']);
    $errors['city'] = checkFIeldContent($formInputs['city']);

  }
  // have to check if the email is actually an email if its filled
  if (empty($formInputs['email'] == false)){ 
    $errors['email'] = checkEmail($formInputs['email']);
  }
  
  //Validity check, first check if everything is the same, if it is, check if $errors[1] is empty because it means there's no errors
  // actually might not be necessary to check name, because under no circumstances are all fields required
  $valid = (count(array_unique($errors, SORT_REGULAR)) == 1);
  if ($valid == 'true' && $errors['namerepeat'] == ''){
    // the thanks is the page to redirect to, the error messages are unneeded since the input is valid
    return array('page' =>'thanks');
  } 
  // otherwise it should circle back with data to fill the og page, which means including the page name to link back to
  $errors['page'] = 'contact';
  return $errors;
}



function showContentThanks($formInputs){
  // changing phone to telefoon for the display 
  if ($formInputs['communication'] == 'phone'){
    $formInputs['communication'] = 'telefoon';
  }
 
  echo '<p>Bedankt voor uw reactie:</p> 
  <div>Naam: '.$formInputs['name'].'</div>
  <div>Email: '.$formInputs['email'].'</div>
  <div>Telefoon: '.$formInputs['phonenumber'].'</div>
  <div>Straat: '.$formInputs['street'].'</div>
  <div>Huisnummer: '.$formInputs['housenumber'].'</div>
  <div>Postcode: '.$formInputs['postalcode'].'</div>
  <div>Woonplaats: '.$formInputs['city'].'</div>
  <div>Communicatie voorkeur: '.$formInputs['communication'].'</div>';
}

?>
