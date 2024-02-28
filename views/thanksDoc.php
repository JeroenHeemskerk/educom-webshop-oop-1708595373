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
    if ($this->data->meta['communication'] == 'phone'){
      $this->data->meta['communication'] = 'telefoon';
    }
    echo '<p>Bedankt voor uw reactie:</p> 
    <div>Naam: '.$this->data->meta['name'].'</div>
    <div>Email: '.$this->data->meta['email'].'</div>
    <div>Telefoon: '.$this->data->meta['phonenumber'].'</div>
    <div>Straat: '.$this->data->meta['street'].'</div>
    <div>Huisnummer: '.$this->data->meta['housenumber'].'</div>
    <div>Postcode: '.$this->data->meta['postalcode'].'</div>
    <div>Woonplaats: '.$this->data->meta['city'].'</div>
    <div>Communicatie voorkeur: '.$this->data->meta['communication'].'</div>';
  }

} 
?>