<?php
require_once "controllers/pedidosController.php";

$mensaje = "";
$clase = "alert alert-success";
$visibilidad = "hidden";

$controlador = new pedidosController();
$pedidos = $controlador->listar();

if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "borrar") {
  $visibilidad = "visibility";
  $clase = "alert alert-success";
  //Mejorar y poner el nombre/usuario
  $mensaje = "La pedido  con Numero de Pedido: {$_REQUEST['id']} Borrado correctamente";
  if (isset($_REQUEST["error"])) {
    $clase = "alert alert-danger ";
    $mensaje = "ERROR!!! No se ha podido borrar la pedido con Numero de Pedido: {$_REQUEST['id']}";
  }
}
?>
<div class="<?= $clase ?>" <?= $visibilidad ?> role="alert">
  <?= $mensaje ?>
</div>

<table class="table  table-hover">
  <thead class="table-dark">
    <tr>
      <th scope="col">Numero de Pedido</th>
      <th scope="col">Numero de Vendedor</th>
      <th scope="col">Nombre de Vendedor</th>
      <th scope="col">Fecha </th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pedidos as $pedido) :
      $id = $pedido["numpedido"];
    ?>
      <tr>
        <td><?= $pedido["numpedido"] ?></td>
        <td><?= $pedido["numvend"] ?></td>
        <td><?= $pedido["nomvend"] ?></td>
        <td><?= $pedido["fecha"] ?></td>
        <td><a class="btn btn-danger" href="index.php?accion=borrar&tabla=pedido&id=<?= $id ?>"><i class="fa fa-trash"></i> Borrar</a></td>
        <!-- <td><a class="btn btn-success" href="index.php?accion=editar&tabla=pedido&id=<?= $id ?>"><i class="fa fa-pencil"></i> Editar</a></td>-->
      </tr>
    <?php
    endforeach;

    ?>
  </tbody>
</table>