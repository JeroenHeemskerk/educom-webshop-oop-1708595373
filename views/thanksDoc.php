<?php
require_once('formDoc.php');
 class ThanksDoc Extends BasicDoc{

  protected function showTitleContent(){
    echo 'Thanks page'; 
  }

  protected function showHeaderContent(){
    echo 'Bedankt'; 
  }

  protected function showContent(){
    // changing phone to telefoon for the display 
    if ($this->data->values['communication'] == 'phone'){
      $this->data->values['communication'] = 'telefoon';
    }
    echo '<p>Bedankt voor uw reactie:</p> 
    <div>Naam: '.$this->data->values['name'].'</div>
    <div>Email: '.$this->data->values['email'].'</div>
    <div>Telefoon: '.$this->data->values['phonenumber'].'</div>
    <div>Straat: '.$this->data->values['street'].'</div>
    <div>Huisnummer: '.$this->data->values['housenumber'].'</div>
    <div>Postcode: '.$this->data->values['postalcode'].'</div>
    <div>Woonplaats: '.$this->data->values['city'].'</div>
    <div>Communicatie voorkeur: '.$this->data->values['communication'].'</div>';
  }

} 
?>