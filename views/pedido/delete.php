<?php
require_once "controllers/pedidosController.php";
//pagina invisible
if (!isset ($_REQUEST["id"])) header('Location:index.php' );
//recoger datos
$id=$_REQUEST["id"];

$controlador= new pedidosController();
$controlador->borrar ($id);

