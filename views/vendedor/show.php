<?php
require_once "controllers/vendedorController.php";
if (!isset($_REQUEST['id'])) {
  header("location:index.php");
}
$id = $_REQUEST['id'];
$controlador = new VendedorController();
$vendedor = $controlador->ver($id);

  //  Vendedor: ID: <?= /*$vendedor->numvend*/ ?> 
<!-- ?> -->

<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">
 
    Vendedor : <?= $vendedor->nomvend ?></h5>
    <br>
    <hr>
    <p class="card-text">
      ID : <?= $vendedor->numvend ?>
      <br>
      Nombre : <?= $vendedor->nomvend ?>
      <br>
      Comercial : <?=$vendedor->nombrecomer?>
      <br>
      Telefono: <?=$vendedor->telefono?>
    </p>
    <a href="index.php" class="btn btn-primary">Volver a Inicio</a>
  </div>
</div>