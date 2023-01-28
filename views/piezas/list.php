<?php
require_once "controllers/piezasController.php";
require_once "controllers/lineaPedidosController.php";

$mensaje = "";
$clase = "alert alert-success";
$visibilidad = "hidden";

$controlador = new piezasController();
$piezas = $controlador->listar();

$controladorPe = new lineaPedidosController();

if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "borrar") {
  $visibilidad = "visibility";
  $clase = "alert alert-success";
  //Mejorar y poner el nombre/usuario
  $mensaje = "La pieza  con Numero de Pieza: {$_REQUEST['id']} Borrado correctamente";
  if (isset($_REQUEST["error"])) {
    $clase = "alert alert-danger ";
    $mensaje = "ERROR!!! No se ha podido borrar la pieza con Numero de Pieza: {$_REQUEST['id']}";
  }
}
?>
<div class="<?= $clase ?>" <?= $visibilidad ?> role="alert">
  <?= $mensaje ?>
</div>


<table class="table  table-hover">
  <thead class="table-dark">
    <tr>
      <th scope="col">Numero de Pieza</th>
      <th scope="col">Nombre de Pieza</th>
      <th scope="col">Precio </th>
      <th></th>
      <th></th>

    </tr>
  </thead>
  <tbody>
    <?php foreach ($piezas as $pieza) :
      $id = $pieza["numpieza"];
    ?>
      <tr>
        <td><?= $pieza["numpieza"] ?></td>
        <td><?= $pieza["nompieza"] ?></td>
        <td><?= $pieza["preciovent"] ?></td>
        <td>
          <?php
          $estado = "disabled";
          $modo = "btn-secondary";
          if (count($controladorPe->buscar("numpieza", "igual", $id)) <= 0) {
            $estado = "";
            $modo = "btn-danger";
          }
          ?>
          <a class="btn <?= $estado . " " . $modo  ?>" href="index.php?accion=borrar&tabla=piezas&id=<?= $id ?>" <?= $estado ?>><i class="fa fa-trash"></i> Borrar</a>
        </td>

        <td><a class="btn btn-success" href="index.php?accion=editar&tabla=piezas&id=<?= $id ?>"><i class="fa fa-pencil"></i> Editar</a></td>
      </tr>
    <?php
    endforeach;

    ?>
  </tbody>
</table>