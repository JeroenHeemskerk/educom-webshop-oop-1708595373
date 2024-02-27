<?php

require_once('productDoc.php');
class CartDoc Extends ProductDoc{
  protected function showTitleContent(){
    echo 'Cart page';
  }

  protected function showHeaderContent(){
    echo 'Winkelwagentje';
  }

  protected function showContent(){
    $cartContent = $this->data['items']['basket'];
    $totalPrice = $this ->data['items']['costs'];
    $this -> startDivSection('cartItem');
    $top = array('', 'Product', 'Aantal', 'Prijs');

    foreach ($top as $text){
      $this -> showSpanText('cartText', $text);
    }
    
    // And now for getting the cart content in here
    $this -> showProductContent('basket', array('width' => 64, 'height' => 64));
    $priceLine = array('', '', '', 'Totaal prijs <br> &euro;'.$totalPrice.'');

    foreach ($priceLine as $text){
      $this -> showSpanText('cartText', $text);
    }

    foreach (array('', '', '') as $text){
      $this -> showSpanText('cartText', $text);
    }

    $this -> showAddToButton('cart');
    $this -> endDivSection();
    
  }

}
?>