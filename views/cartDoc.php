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
   /* echo '<div class=cartItem> 
    <div class=cartText> </div> 
    <div class=cartText> <span> product Name </span></div>
    <div class=cartText> <span> Aantal </span> </div>
    <div class=cartText> <span> Prijs per stuk</span> </div>
    </div>'; */

    $this -> startDivSection('cartItem');
    $this -> showSPanText('cartText', '');
    $this -> showSpanText('cartText', 'Product');
    $this -> showSpanText('cartText', 'Aantal')
    $this -> showSpanText('cartText', 'Prijs');
    $this -> endDivSection();

    // if there's actual content
    //$this -> showProductContent('cart', array('width' => 64, 'height' => 64));
  }

}
?>