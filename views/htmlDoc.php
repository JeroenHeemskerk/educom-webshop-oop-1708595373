<?php
class HtmlDoc {
  private function showHTMLstart(){ 
    echo '<!doctype html> 
     <html>';
  }

  private function showHeadStart(){
    echo '<head>';
  }

  protected function showHeadContent(){
  }

  private function showHeadEnd(){
    echo '</head>';
  }
  
  private function showBodyStart(){
    echo '<body class="algemeen">' . PHP_EOL; 
  }

  protected function showBodyContent(){
  }

  private function showBodyEnd(){
    echo '</body>' . PHP_EOL; 
  }
  private function showHTMLEnd(){
    echo '</html>';
  }

  public function show(){
    $this-> showHTMLstart();
    $this-> showHeadStart();
    $this -> showHeadContent();
    $this -> showHeadEnd();
    $this -> showBodyStart();
    $this -> showBodyContent();
    $this -> showBodyEnd();
    $this -> showHTMLEnd();

  }


}