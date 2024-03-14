<?php
session_start();
require_once('controllers/PageController.php');
require_once("models/CRUD.php");
require_once("models/ModelFactory.php");
require_once("models/CrudFactory.php");

$crud = new Crud();
$crudFactory = new CrudFactory($crud);
$modelFactory = new ModelFactory($crudFactory);
$controller = new PageController($modelFactory);
$controller -> handleRequest();

?>