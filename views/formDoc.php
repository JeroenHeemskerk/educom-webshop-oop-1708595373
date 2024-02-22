<?php
require_once('basicDoc.php');
abstract class FormDoc Extends BasicDoc{
  protected abstract function formStart();
  protected abstract function formContent();

  protected function formEnd(){
    echo'</fieldset>
    </form> ';
  }

  protected function submitButton(){
    echo'  <div>
    <input class="submit" type="submit" value="Submit">
    </div>';
  }

}
?>