<?php
require_once('basicDoc.php');
abstract class ProductDoc Extends BasicDoc{
  protected  function showProductContent($type, $imagesize){
    /*
    type string
    imagesize array('width', 'height')
    */
    $page = $this->data['page']; 
    $items = $this->data['items'];
    $line = '';
    if($type == 'menu'){
      $line = $line . $this->showProductMenu($page, $items, $imagesize);
    } else if ($type == 'detail'){
      $item = $this->data['items'][0];
      $line = $line . $this->showProductImage($item, $imagesize);
    }
    echo $line;
  }

  //maybe move these up a class later
  protected function startDivSection($class=''){
    /* 
    class string
    */ 
    echo '<div class="'.$class.'">';
  }
  
  protected function endDivSection(){
    echo '</div>';
  }

  protected function showSpanText($class, $text, $item=''){
    /* 
    class string
    text string
    item array
    */
    if (!empty($item)){
      $text = $item[$text];
    }
    $this->startDivSection();
    echo '<span class = '.$class.'> '.$text.' </span>';
    $this-> endDivSection();
  }

  protected function showAddToCart($page, $item){
  /* 
  page string
  item array
  */
  $line = '';
    if (isset($_SESSION['userName'])){
      $line = '
      <form action="index.php?page="'.$page.'" method="POST">
      <input type="hidden" name="page" value="'.$page.'">
      <input type="hidden" name="action" value="addToCart">
      <input type="hidden" name="id" value="'.$item['id'].'">
      <button type="submit">Toevoegen aan bestelling</button>
      </form>';
    }
    return $line;
  }

  private function showProductImage($item, $imagesize){
    /*
    item array 
    imagesize array('width', 'height')
    */
      $line = '<img src="images\\'.$item['image'].'"  style="width:'.$imagesize['width'].'px;height:'.$imagesize['height'].'px;">';

      return $line;
  }

  private function showProductImageLink($item, $imagesize){
    /*
    item array 
    imagesize array('width', 'height')
    */
    $line =  '<a class=product_image  href="index.php?page=product-'.$item['name'].'-'.$item['id'].'">';
    $line = $line . $this->showProductImage($item, $imagesize);
    $line = $line .'</a>';
    return $line;
  }

  private function showProductName($item){
    // item array
    $line = '<h3 class=product_name>
        <a class=product_text href="index.php?page=product-'.$item['name'].'-'.$item['id'].'">
        <span>'.$item['name'].' </span>
        </a>
      </h3>';
    return $line;
  }


  private function showProductMenu($page, $items, $imagesize){
    /*
    page string
    item array 
    imagesize array('width', 'height')
    */
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
      $line = $line.$this->showProductImageLink($item, $imagesize); 
      $line = $line.$this->showProductName($item);

      if ($page == 'webshop'){
      $line = $line .'
        <div class=product_price>
        <span class=price>&euro;'.$item['price'].'  </span>
        </div>';
        $line = $line . $this-> showAddToCart($page, $item);
      }
      $line = $line .'</article>
      </li>';
    }
    $line = $line . '</ul>';
    return $line;

  }


}