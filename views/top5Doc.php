<?php

require_once('productDoc.php');
class Top5Doc Extends ProductDoc{
  protected function showTitleContent(){
    echo 'Top 5 page';
  }

  protected function showHeaderContent(){
    echo 'De 5 populairste producten';
  }

  protected function showContent(){
    $this -> showProductContent('menu', array('width' => 128, 'height' => 128));
  }

}
?>