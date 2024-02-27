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
    $totalPrice = '0.00';
    if (isset($this->data['items']['basket'])) {    
      $cartContent = $this->data['items']['basket'];
      $totalPrice = $this ->data['items']['costs'];}

    $this -> startDivSection('cartItem');
    $top = array('', 'Product', 'Aantal', 'Prijs');
    $this -> showSpanTextMulti('cartText', $top);

    // And now for getting the cart content in here
    $this -> showProductContent('basket', array('width' => 64, 'height' => 64));
    $priceLine = array('', '', '', 'Totaal prijs <br> &euro;'.$totalPrice.'');
    $this -> showSpanTextMulti('cartText', $priceLine);

    $this -> showSpanTextMulti('cartText', array('', '', ''));

    $this -> showAddToButton('cart');
    $this -> endDivSection();
  }

}
?>