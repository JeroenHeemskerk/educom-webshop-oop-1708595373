<?php
require_once('htmlDoc.php');
class BasicDoc extends HtmlDoc {
  protected $data;
  public function __construct($myData){
    $this->data = $myData;
  } 

  public function getData(){
    return $this->data;
  }

  protected function showHeadContent(){
    $this -> showTitle();
    $this -> showCssLinks();
  }

  protected function showTitle(){
  }

  private function showCssLinks(){
    echo'<link rel="stylesheet" href="../CSS/mystyle.css">';
  }

  private function showMenu(){
    $menu = $this->getData();
    echo '<ul class="menu">';
    foreach($menu['menu'] as $link => $label) { 
      $this->showMenuItem($link, $label); 
    } 
    echo '</ul>';
  }

  private function showMenuItem($page, $pageName){
    echo '<li><a href="index.php?page='.$page.'">'.$pageName.'</a></li>';
  }

  protected function showHeader(){
  }

  protected function showContent(){
  }

  private function showFooter(){
    echo '<footer> 
    &#169; - 2024 - Milan Lucas
    </footer> ';
  }

  protected function showBodyContent(){
    $this -> showHeader();
    $this -> showMenu();
    $this -> showContent();
    $this -> showFooter();
  }

}

?>