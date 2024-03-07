<?php

require_once('productDoc.php');
class DetailDoc Extends ProductDoc{
  protected function showTitleContent(){
    echo 'Product page';
  }

  protected function showHeaderContent(){

    echo $this->data->products[0]->name;
  }

  protected function showContent(){
    $item = $this->data->products[0];
    $this -> startDivSection('container');
    $this -> showProductImage($item, array('width' => 500, 'height' => 500));
    //$this -> showProductContent('detail', array('width' => 500, 'height' => 500));
    $this -> startDivSection('text');
    $this -> showSpanText('',  $item->name);
    $this -> showSpanText('',  $item->description);
    $this -> showSpanText('price', $item->price);
    $this -> showAddToButton('detail', $item);

    // add to cart button
    
    $this -> endDivSection();
    $this -> endDivSection();
    
    //$this -> showProductContent('cart', array('width' => 64, 'height' => 64));
  }

}
?>