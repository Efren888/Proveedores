<?php
require_once "controllers/piezasController.php";
//pagina invisible
if (!isset ($_REQUEST["id"])) header('Location:index.php' );
//recoger datos
$id=$_REQUEST["id"];

$controlador= new piezasController();
$controlador->borrar ($id);

