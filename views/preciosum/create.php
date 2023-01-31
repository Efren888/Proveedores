<?php
require_once "assets/php/funciones.php";
require_once "controllers/precioSumsController.php";
require_once "controllers/piezasController.php";
require_once "controllers/vendedorController.php";

$controladorPS = new precioSumsController();

$precioSumAll = $controladorPS->listar();

$controladorPiez = new PiezasController();

$alliezas = $controladorPiez->listar();

$controladorVend = new VendedorController();

$allVend = $controladorVend->listar();

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
<form action="index.php?accion=guardar&evento=crear&tabla=vendedor" method="POST">

    <div class="alert alert-danger <?= $visibilidad ?>"><?= $cadena ?></div>
    <form action="index.php?accion=guardar&evento=crear&tabla=piezas" method="POST">
        <div class="form-group">
            <label for="numpieza">Número de pieza </label>
            <select name="" id="" class="form-control">
                <?php
                foreach ($alliezas as $pieza) {
                ?>
                    <option value=<?= $pieza["numpieza"] ?>><?= $pieza["numpieza"] . " | -- | " . $pieza["nompieza"] ?>
                    </option>
                <?php
                }
                ?>
            </select>
            <small id="pieza" class="form-text text-muted">El número de la pieza esta en la isquierda del selector y a
                la derecha esta el nombre</small>
        </div>

        <div class="form-group">
            <!-- regex de solo carcteres -->
            <label for="numvend">Numero del vendedor </label>
            <select name="" id="" class="form-control">
                <?php
                foreach ($allVend as $allVend) {
                ?>
                    <option value=<?= $allVend["numvend"] ?>><?= $allVend["numvend"] . " | -- | " . $allVend["nomvend"] ?>
                    </option>
                <?php
                }
                ?>
            </select>
            <small id="numvend" class="form-text text-muted">El número de la pieza esta en la isquierda del selector y a
                la derecha esta el nombre</small>
        </div>

        <!-- PrecioUnidad, este campo se peude scar desde la tabla de peizas,sacamos el precios de pieza -->
        <div class="form-group">
            <!-- regex de solo carcteres -->
            <label for="PrecioUnidad">PrecioUnidad </label>
            <input type="numnber" required class="form-control" id="PrecioUnidad" name="PrecioUnidad" aria-describedby="PrecioUnidad" placeholder="Introduce el nombre del vendedor" value="<?= $_SESSION["datos"]["PrecioUnidad"] ?? "" ?>">
            <?= isset($errores["PrecioUnidad"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "PrecioUnidad") . '</div>' : ""; ?>
            <small id="PrecioUnidad" class="form-text text-muted">Precio unitario por porducto.</small>

        </div>

        <!-- diassum -->
        <div class="form-group">
            <!-- regex de solo carcteres -->
            <label for="diassum"> Dias de suministro </label>
            <input type="number" required class="form-control" min="1" pattern="^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,30}$" id="diassum" name="diassum" aria-describedby="diassum" placeholder="Introduce el nombre del vendedor" value="<?= $_SESSION["datos"]["diassum"] ?? "" ?>">
            <?= isset($errores["diassum"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "diassum") . '</div>' : ""; ?>
            <small id="diassum" class="form-text text-muted">El tiempo que tarda el producto en suministarse.</small>
        </div>
        <!-- descuetno -->
        <div class="form-group">
            <!-- regex de solo carcteres -->
            <label for="descuetno">descuetno </label>
            <input type="number" required class="form-control" min="1" max="75" pattern="^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,30}$" id="descuetno" name="descuetno" aria-describedby="descuetno" placeholder="Introduce el nombre del vendedor" value="<?= $_SESSION["datos"]["descuetno"] ?? "" ?>">
            <?= isset($errores["descuetno"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "descuetno") . '</div>' : ""; ?>
            <small id="descuento" class="form-text text-muted">Descuento sobro el preio unitario.</small>

        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a class="btn btn-danger" href="index.php">Cancelar</a>
    </form>

    <?php
    unset($_SESSION["errores"]);
    unset($_SESSION["datos"]);
    ?>