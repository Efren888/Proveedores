<?php
require_once "assets/php/funciones.php";
require_once "controllers/piezasController.php";
//require_once "controllers/inventariosController.php";
require_once "controllers/lineaPedidosController.php";
require_once "controllers/precioSumsController.php";

//recoger datos
if (!isset($_REQUEST["id"])) header('location:index.php?accion=listar&tabla=piezas');
$id = $_REQUEST["id"];
$controlador = new piezasController();
$pieza = $controlador->ver($id);

//$controladorInv = new inventariosController();
//$piezaInv = $controladorInv->ver($id);

$controladorLinea = new lineaPedidosController();
//$piezaLinea = $controladorLinea->ver($id);

$controladorPreSum = new precioSumsController();
//$piezaPreSum = $controladorPreSum->ver($id);


$visibilidad = "hidden";
$mensaje = "";
$clase = "alert alert-success";
$mostrarForm = true;
if ($pieza == null) {
  $visibilidad = "visbility";
  $mensaje = "La pieza con id: {$id} no existe. Por favor vuelva a la pagina anterior";
  $clase = "alert alert-danger";
  $mostrarForm = false;
}

if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "guardar") {
  $visibilidad = "vibility";
  $mensaje = "Pieza con numero de Pieza {$id} Modificado con éxito";
  if (isset($_REQUEST["error"])) {
    $mensaje = "No se ha podido modificar el numero de Pieza {$id}";
    $clase = "alert alert-danger";
    $errores = ($_SESSION["errores"]) ?? [];
    $datos = ($_SESSION["datos"]) ?? [];
    //actualizo los campos
    $pieza->numpieza = $datos["numpieza"];
    $pieza->nompieza = $datos["nompieza"];
    $pieza->preciovent = $datos["preciovent"];
  }
}
?>
<div class="<?= $clase ?>" <?= $visibilidad ?>> <?= $mensaje ?> </div>
<?php
if ($mostrarForm) {
?>
  <form action="index.php?accion=guardar&evento=editar&tabla=piezas" method="POST">
    <input type="hidden" id="idOriginal" name="idOriginal" value="<?= $id ?>">
    <div class="form-group">
      <label for="pieza">pieza </label>
      <?php
      $habilitado = (
        //count($controladorInv->buscar("numpieza", "igual", $pieza->numpieza)) > 0 &&
        count($controladorLinea->buscar("numpieza", "igual", $pieza->numpieza)) > 0 &&
        count($controladorPreSum->buscar("numpieza", "igual", $pieza->numpieza)) > 0 &&
        count($controlador->buscar("numpieza", "igual", $pieza->numpieza)) > 0) ? "disabled" : "";
      ?>

      <input type="text" <?= $habilitado ?> required class="form-control" id="numpieza" name="numpieza" value="<?= $pieza->numpieza ?>" aria-describedby="numpieza" placeholder="Introduce pieza">
      <small id="pieza" class="form-text text-muted">Compartir tu pieza lo hace menos seguro.</small>
      <?= isset($errores["numpieza"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "numpieza") . '</div>' : ""; ?>

    </div>
    <div class="form-group">
      <label for="nompieza">Nombre </label>
      <input type="text" class="form-control" id="nompieza" name="nompieza" value="<?= $pieza->nompieza ?>" placeholder="Introduce el Nombre de la pieza">
    </div>
    <div class="form-group">
      <label for="preciovent">Precio de Venta </label>
      <input type="text" class="form-control" id="preciovent" name="preciovent" value="<?= $pieza->preciovent ?>" placeholder="Introduce el Precio">
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
    <a class="btn btn-danger" href="index.php?accion=listar&tabla=piezas">Cancelar</a>
  </form>
<?php
} else {
?>
  <a href="index.php" class="btn btn-primary">Volver a Inicio</a>
<?php
}
