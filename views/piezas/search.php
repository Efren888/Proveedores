<?php
require_once "controllers/piezasController.php";
require_once "controllers/lineaPedidosController.php";

$mensaje = "";
$clase = "alert alert-success";
$visibilidad = "hidden";
$mostrarDatos = false;
$controlador = new piezasController();
$texto = "";
$controladorPe = new lineaPedidosController();


if (isset($_REQUEST["evento"])) {
  $mostrarDatos = true;
  switch ($_REQUEST["evento"]) {
    case "todos":
      $piezas = $controlador->listar();
      $mostrarDatos = true;
      break;
    case "filtrar":
      $campo = ($_REQUEST["campo"]) ?? "";
      $metodoBusqueda = ($_REQUEST["metedoBusqueda"]) ?? "";
      $dato = ($_REQUEST["busqueda"]) ?? "";
      $piezas = $controlador->buscar($campo, $metodoBusqueda, $dato);
      break;
    case "borrar":
      $visibilidad = "visibility";
      $mostrarDatos = true;
      $clase = "alert alert-success";
      //Mejorar y poner el nombre/usuario
      $mensaje = "La pieza con id: {$_REQUEST['id']} Borrado correctamente";
      if (isset($_REQUEST["error"])) {
        $clase = "alert alert-danger ";
        $mensaje = "ERROR!!! No se ha podido borrar la pieza con Numero de Pieza: {$_REQUEST['id']}";
      }
      break;
  }
}

?>
<div class="<?= $clase ?>" <?= $visibilidad ?> role="alert">
  <?= $mensaje ?>
</div>

<form action="index.php?accion=buscar&tabla=piezas&evento=filtrar" method="POST">
  <div class="form-group">
    <label for="busqueda">Buscar Piezas</label>
    <input type="text" required class="form-control" id="busqueda" name="busqueda" value="<?= $texto ?>" placeholder="Buscar por Numero de Pieza">
  </div>

  <select id="campo" name="campo">
    <option selected value="NUMpieza">Numero Pieza</option>
    <option value="NOMpieza" >Nombre pieza</option>
    <option value="PRECIOVENT">Precio venta</option>
  </select>

  <select id="metodoBusqueda" name="metodoBusqueda">
    <option selected value="empieza">Empieza</option>
    <option value="contiene">Contiene</option>
    <option value="igual">Igual</option>
    <option value="acaba">Acaba</option>
  </select>

  </br>
  <button type="submit" class="btn btn-success" name="Filtrar">Buscar</button>
</form>
<!-- Este formulario es para ver todos los datos    -->
<form action="index.php?accion=buscar&tabla=piezas&evento=todos" method="POST">
  <button type="submit" class="btn btn-info" name="Todos">Ver todos</button>
</form>

<?php
if ($mostrarDatos) {
?>
  <table class="table table-light table-hover">
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
          <a class="btn <?= $estado . " " . $modo  ?>" href="index.php?accion=borrar&tabla=pieza&id=<?= $id ?>" <?= $estado ?>><i class="fa fa-trash"></i> Borrar</a>
        </td>
          <td><a class="btn btn-success" href="index.php?accion=editar&tabla=piezas&id=<?= $id ?>"><i class="fa fa-pencil"></i> Editar</a></td>
        </tr>
      <?php
      endforeach;

      ?>
    </tbody>
  </table>

<?php
}
?>