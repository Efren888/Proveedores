<?php
require_once "controllers/vendedorController.php";
//pagina invisible
if (!isset($_REQUEST["id"])) header('Location:index.php');
//recoger datos
$id = $_REQUEST["id"];

$controlador = new vendedorController();
$controlador->borrar($id);
