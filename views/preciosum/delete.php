<?php
require_once "controllers/precioSumsController.php";
//pagina invisible
if (!isset($_REQUEST["id"])) header('Location:index.php');

//recoger datos
$idvend = $_REQUEST["idvend"];
$idpieza = $_REQUEST["idpieza"];

$controlador = new PreciosumController();
$controlador->borrar($idvend, $idpieza);
