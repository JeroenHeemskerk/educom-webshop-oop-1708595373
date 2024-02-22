<?php
require_once('basicDoc.php');
class HomeDoc extends BasicDoc{
  protected function showTitleContent(){
    echo 'Home page'; 
  }

  protected function showHeaderContent(){
    echo 'Home'; 
  }

  protected function showContent(){
    echo '<p>Welcome op mijn website beste lezer. Ik ben Milan Lucas, als je meer over me wil weten kan je de about pagina bekijken.
    <br> Wil je contact met me opnemen kan je het formulier op deze pagina invullen.';
  }

}


?>