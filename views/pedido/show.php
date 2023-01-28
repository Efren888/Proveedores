<?php
require_once "controllers/pedidosController.php";
if (!isset($_REQUEST['id'])){
    header ("location:index.php");
}
$id=$_REQUEST['id'];
$controlador= new pedidosController();
$pedido= $controlador->ver ($id);
?>

<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">pedido: ID: <?=$pedido->numpedido?> NUMVEND: <?=$pedido->numvend?></h5>
    <p class="card-text">
        Vendedor: <?=$pedido->numvend?>
        Fecha: <?=$pedido->fecha ?>
    </p>
    <a href="index.php" class="btn btn-primary">Volver a Inicio</a>
  </div>
</div>