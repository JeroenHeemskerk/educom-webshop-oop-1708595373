<?php
require_once('basicDoc.php');
abstract class FormDoc Extends BasicDoc{
  protected abstract function formStart();
  protected abstract function formContent();
  protected abstract function formEnd();
  protected abstract function submitButton();
  protected abstract function checkFieldContent();
  protected abstract function postData();
  protected abstract function formInputCheck();


}
?>