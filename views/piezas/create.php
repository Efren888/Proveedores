<?php
require_once "assets/php/funciones.php";
$cadenaErrores = "";
$cadena = "";
$errores = [];
$datos = [];
$visibilidad = "invisible";
if (isset($_REQUEST["error"])) {
  $errores = ($_SESSION["errores"]) ?? [];
  $datos = ($_SESSION["datos"]) ?? [];
  $cadena = "Atención Se han producido Errores";
  $visibilidad = "visible";
}
?>
<div class="alert alert-danger <?= $visibilidad ?>"><?= $cadena ?></div>
<form action="index.php?accion=guardar&evento=crear&tabla=piezas" method="POST">
  <div class="form-group">
    <label for="pieza">pieza </label>
    <input type="text" required class="form-control" id="numpieza" name="numpieza" aria-describedby="numpieza" placeholder="Introduce pieza" value="<?= $_SESSION["datos"]["numpieza"] ?? "" ?>">
    <small id="pieza" class="form-text text-muted">Compartir tu pieza lo hace menos seguro.</small>
    <?= isset($errores["numpieza"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "numpieza") . '</div>' : ""; ?>
  </div>
  <div class="form-group">
    <label for="nompieza">Nombre </label>
    <input type="text" class="form-control" id="nompieza" name="nompieza" placeholder="Introduce el Nombre de la pieza" value="<?= $_SESSION["datos"]["nompieza"] ?? "" ?>">
    <?= isset($errores["nompieza"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "nompieza") . '</div>' : ""; ?>
  </div>
  <div class="form-group">
    <label for="preciovent">Precio de Venta </label>
    <input type="number" min="0" step="any" pattern="^[0-9]+[.,]?([0-9]{0,2})$" class="form-control" id="preciovent" name="preciovent" placeholder="Introduce el Precio" value="<?= $_SESSION["datos"]["preciovent"] ?? "" ?>">
    <?= isset($errores["preciovent"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "preciovent") . '</div>' : ""; ?>
  </div>
  <button type="submit" class="btn btn-primary">Guardar</button>
  <a class="btn btn-danger" href="index.php">Cancelar</a>
</form>

<?php
unset($_SESSION["errores"]);
unset($_SESSION["datos"]);
?>