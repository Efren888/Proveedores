<?php

require_once "controllers/precioSumsController.php";

//recoger datos
if (!isset ($_REQUEST["numvend"])&& $_REQUEST["numpieza"]) 
header('Location:index.php?accion=crear&tabla=preciosum' );

 $idvend = $_REQUEST["numvend"];

 $idpieza = $_REQUEST["numpieza"];


$arrayPrecioSum=[
    "numpieza"=>$idpieza  ,
    "numvend"=>$idvend  ,
    "preciounit"=>$_REQUEST["preciounit"],
    "diassum"=>$_REQUEST["diassum"]  ,
    "descuento"=>$_REQUEST["descuento"]  ,

            ];
            var_dump($arrayPrecioSum);
//pagina invisible
 $controladorPs= new  PrecioSumsController();
if ($_REQUEST["evento"]=="crear"){
    $controladorPs->crear($arrayPrecioSum);
}

if ($_REQUEST["evento"]=="editar"){
    //devuelve true si edita false si falla
    $controladorPs->editar($arrayPrecioSum);
}
