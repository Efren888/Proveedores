<?php
require_once "controllers/vendedorController.php";
//recoger datos
if (!isset($_REQUEST["numvend"])) {
    header('Location:index.php?accion=crear&tabla=vendedor');
    exit;
}

$idOriginal = ($_REQUEST["idOriginal"]) ?? ""; //el id me servirá en editar

$arrayVendedor = [

    "idOriginal" => $idOriginal,
    "numvend" => $_REQUEST["numvend"],
    "nomvend" => $_REQUEST["nomvend"],
    "nombrecomer" => $_REQUEST["nombrecomer"],
    "telefono" => $_REQUEST["telefono"],
    "calle" => $_REQUEST["calle"],
    "ciudad" => $_REQUEST["ciudad"],
    "provincia" => $_REQUEST["provincia"],
    "cod_postal" => $_REQUEST["cod_postal"],
    
];

$controlador = new VendedorController();

if ($_REQUEST["evento"] == "crear") {

    $controlador->crear($arrayVendedor);

} elseif ($_REQUEST["evento"] == "editar") {

    $controlador->editar($idOriginal, $arrayVendedor);
}