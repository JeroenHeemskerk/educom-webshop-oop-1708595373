<?php
require_once('basicDoc.php');
abstract class ProductDoc Extends BasicDoc{
  protected  function showProductContent($type, $imagesize){
    $page = $this->data['page']; 
    $items = $this->data['items'];
    $line = '';
    if($type == 'menu'){
      $line = $line . $this->showProductMenu($page, $items, $imagesize);
    }
    echo $line;
  }

  private function showProductImage($item, $imagesize){
      $line =  '<a class=product_image  href="index.php?page=product-'.$item['name'].'-'.$item['id'].'"> 
      <img src="..\\images\\'.$item['image'].'"  style="width:'.$imagesize['width'].'px;height:'.$imagesize['height'].';"> 
      </a>';
      return $line;
  }

  private function showProductName($item){
    $line = '<h3 class=product_name>
        <a class=product_text href="index.php?page=product-'.$item['name'].'-'.$item['id'].'">
        <span>'.$item['name'].' </span>
        </a>
      </h3>';
    return $line;
  }

  private function showProductMenu($page, $items, $imagesize){
    $line = '';
    if(isset($this->data['dbError'])){
      $line = 'Database kan momenteel niet bereikt worden';
    }
    $line = '<ul class=items>';
    foreach ($items as $item) {
      $line = $line .'
      <li class=product_webshop>
      <br>
      <article>'; 
      $line = $line. $this->showProductImage($item, $imagesize); 
      $line = $line.$this->showProductName($item);

      if ($page == 'webshop'){
      $line = $line .'
        <div class=product_price>
        <span class=price>&euro;'.$item['price'].'  </span>
        </div>';
      }

      // show button for adding to shopping cart
      //addToCartButton('webshop', $x['id']);

      $line = $line .'</article>
      </li>';
    }
    $line = $line . '</ul>';
    return $line;

  }


}