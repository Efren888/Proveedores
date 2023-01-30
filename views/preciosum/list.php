<?php
require_once "controllers/piezasController.php";
require_once "controllers/vendedorController.php";
require_once "controllers/precioSumsController.php";

$mensaje = "";
$clase = "alert alert-success";
$visibilidad = "hidden";

$controlador = new precioSumsController();
$precioSum = $controlador->listar();
echo "<pre>";
// var_dump($precioSum);
echo "</pre>";

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
      <th scope="col">Numero de Vendedor</th>
      <th scope="col">Precio Unidad</th>
      <th scope="col">Dia Sum</th>
      <th scope="col">Descuento</th>
      <th></th>
      <th></th>

    </tr>
  </thead>
  <tbody>
    <?php foreach ($precioSum as $precioSums):
      //Aquñi abria que asigna unas varuiables de idpieza e idvend para tener los dos id.
      $idpieza = $precioSums["numpieza"];
      $idvend = $precioSums["numvend"];
      ?>
      <tr>
        <td>
          <?= $precioSums["numpieza"] ?>
        </td>
        <td>
          <?= $precioSums["numvend"] ?>
        </td>
        <td>
          <?= $precioSums["preciounit"] ?>
        </td>
        <td>
          <?= $precioSums["diassum"] ?>
        </td>
        <td>
          <?= $precioSums["descuento"] ?>
        </td>
        <td>
          <?php
          $estado = "disabled";
          $modo = "btn-secondary";
          if (count($controlador->buscar("numpieza", "igual", $idpieza)) <= 0) {
            $estado = "";
            $modo = "btn-danger";
          }
          ?>
          <a class="btn <?= $estado . " " . $modo ?>"
            href="index.php?accion=borrar&tabla=preciosum&id=<?= $idpieza ?>&idvend=<?= $idvend ?>" <?= $estado ?>><i
              class="fa fa-trash"></i> Borrar</a>
        </td>

        <td><a class="btn btn-success"
            href="index.php?accion=editar&tabla=preciosum&idpieza=<?= $idpieza ?>&idvend=<?= $idvend ?>"><i
              class="fa fa-pencil"></i> Editar</a></td>
      </tr>
      <?php
    endforeach;

    ?>
  </tbody>
</table>
<?php


?>