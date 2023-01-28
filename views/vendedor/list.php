<?php
require_once "controllers/vendedorController.php";
require_once "controllers/pedidosController.php";

$mensaje = "";
$clase = "alert alert-success";
$visibilidad = "hidden";
$inicio = microtime(true);
$controlador = new vendedorController();
$vendedores = $controlador->listar();

$controladorPe = new PedidosController();

if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "borrar") {
  $visibilidad = "visibility";
  $clase = "alert alert-success";
  //Mejorar y poner el nombre/usuario
  $mensaje = "El vendedor con Numero: {$_REQUEST['id']} Borrado correctamente";
  if (isset($_REQUEST["error"])) {
    $clase = "alert alert-danger ";
    $mensaje = "ERROR!!! No se ha podido borrar la pedido con Numero de vendedor: {$_REQUEST['id']}";
  }
}
?>
<div class="<?= $clase ?>" <?= $visibilidad ?> role="alert">
  <?= $mensaje ?>
</div>

<table class="table  table-hover">
  <thead class="table-dark">
    <tr>
      <th scope="col">Numero de vendedor</th>
      <th scope="col">Nombre vendedor</th>
      <th scope="col">Nombre comercial </th>

      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($vendedores as $vendedor) :
      $id = $vendedor["numvend"];
    ?>
      <tr>
        <td><?= $vendedor["numvend"] ?></td>
        <td><?= $vendedor["nomvend"] ?></td>
        <td><?= $vendedor["nombrecomer"] ?></td>
        <td>
          <?php
          $estado = "disabled";
          $modo = "btn-secondary";
          if (count($controladorPe->buscar("numvend", "igual", $id)) <= 0) {
            $estado = "";
            $modo = "btn-danger";
          }
          ?>
          <a class="btn <?= $estado . " " . $modo  ?>" href="index.php?accion=borrar&tabla=vendedor&id=<?= $id ?>" <?= $estado ?>><i class="fa fa-trash"></i> Borrar</a>
        </td>

        <td><a class="btn btn-success" href="index.php?accion=editar&tabla=vendedor&id=<?= $id ?>"><i class="fa fa-pencil"></i> Editar</a></td>
      </tr>
    <?php
    endforeach;
    $final = microtime(true);
    ?>
  </tbody>
</table>

<?php
$tiempo = $final - $inicio;
echo "Ha tardado {$tiempo} ms";

?>