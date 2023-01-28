<?php
require_once "controllers/vendedorController.php";
//recoger datos
if (!isset($_REQUEST["numvend"]))
    header('Location:index.php?accion=crear&tabla=vendedor');

$numvend = ($_REQUEST["numvend"]) ?? ""; //el id me servirá en editar
$arrayVendedor = [
    "numvend" => $_REQUEST["numvend"],
    "nomvend" => $_REQUEST["nomvend"],
    "nombrecomer" => $_REQUEST["nombrecomer"],
    "telefono" => $_REQUEST["telefono"],
    "domicilio" => $_REQUEST["domicilio"],
    "ciudad" => $_REQUEST["ciudad"],
    "provincia" => $_REQUEST["provincia"],
    "cod_post" => $_REQUEST["cod_post"],
];
//pagina invisible
$controlador = new vendedorController();
if ($_REQUEST["evento"] == "crear") {
    $controlador->crear($arrayVendedor);
}

if ($_REQUEST["evento"] == "editar") {
    //devuelve true si edita false si falla
    $controlador->editar($numvend, $arrayVendedor);
}