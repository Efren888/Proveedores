<?php
require_once "controllers/pedidosController.php";
//recoger datos
if (!isset ($_REQUEST["numpedido"])) header('Location:index.php?accion=crear&tabla=pedido' );

$idAntiguo= ($_REQUEST["idAntiguo"])??"";//el id me servirá en editar
$arrayPedido=[
            "numpedido"=>$_REQUEST["numpedido"],
            "numvend"=>$_REQUEST["numvend"],
            "fecha"=>$_REQUEST["fecha"],
            ];
//pagina invisible
$controlador= new PedidosController();
if ($_REQUEST["evento"]=="crear"){
    $controlador->crear ($arrayPedido);
}

if ($_REQUEST["evento"]=="editar"){
    //devuelve true si edita false si falla
    $controlador->editar ($idAntiguo, $arrayPedido);
}
?>