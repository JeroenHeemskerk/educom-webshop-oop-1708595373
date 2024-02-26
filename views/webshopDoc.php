<?php

require_once('productDoc.php');
class WebshopDoc Extends ProductDoc{
  protected function showTitleContent(){
    echo 'Shop page';
  }

  protected function showHeaderContent(){
    echo 'Winkel';
  }

  protected function showContent(){
    $this -> showProductContent('menu', array('width' => 128, 'height' => 128));
  }

}
?>