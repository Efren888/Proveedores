<?php
require_once "controllers/piezasController.php";
if (!isset($_REQUEST['id'])){
    header ("location:index.php");
}
$id=$_REQUEST['id'];
$controlador= new piezasController();
$pieza= $controlador->ver ($id);
?>

<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">pieza: ID: <?=$pieza->numpieza?> NOMBRE: <?=$pieza->nompieza?></h5>
    <p class="card-text">
        Nombre: <?=$pieza->nompieza?>
        Precio: <?=$pieza->preciovent ?>
    </p>
    <a href="index.php" class="btn btn-primary">Volver a Inicio</a>
  </div>
</div>