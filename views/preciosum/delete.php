<?php

require_once "controllers/precioSumsController.php";


if (!isset($_REQUEST["idvend"]) && !isset($_REQUEST["idpieza"]))
    header('Location:index.php');

$idvend = $_REQUEST["idvend"];
$idpieza = $_REQUEST["idpieza"];

$controlador = new PrecioSumsController();

$controlador->borrar($idpieza, $idvend);