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
    $this -> startDivSection('cartItem');
    $this -> showSPanText('cartText', '');
    $this -> showSpanText('cartText', 'Product');
    $this -> showSpanText('cartText', 'Aantal');
    $this -> showSpanText('cartText', 'Prijs');
    // And now for getting the cart content in here

    $this -> endDivSection();
  }

}
?>