<?php
require_once "controllers/precioSumsController.php";

//recoger datos
if (!isset ($_REQUEST["idvend"])&& $_REQUEST["idpieza"]) 
header('Location:index.php?accion=crear&tabla=preciosum' );



$idvend = $_REQUEST["idvend"];

$idpieza = $_REQUEST["idpieza"];


$arrayPrecioSum=[

    "numpieza"=>$_REQUEST["numpieza"]  ,
    "numvend"=>$_REQUEST["numvend"]  ,
    "preciounit"=>$_REQUEST["preciounit"],
    "diassum"=>$_REQUEST["diassum"]  ,
    "descuento"=>$_REQUEST["descuento"]  ,

            ];
//pagina invisible
$controlador= new  PrecioSumsController();
// if ($_REQUEST["evento"]=="crear"){
//     $controlador->crear ($arrayPrecioSum);
// }

if ($_REQUEST["evento"]=="editar"){
    //devuelve true si edita false si falla
    $controlador->editar ($arrayPrecioSum);
}
