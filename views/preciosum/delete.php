<?php
require_once "controllers/precioSumsController.php";

//pagina invisible
if (!isset($_REQUEST["idvend"]) && !isset($_REQUEST["idpieza"]))
    header('Location:index.php');

//recoger datos
$idvend = $_REQUEST["idvend"];
$idpieza = $_REQUEST["idpieza"];

$controlador = new PreciosumController();
$controlador->borrar($idpieza, $idvend);
