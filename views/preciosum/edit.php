<?php
require_once "assets/php/funciones.php";
require_once "controllers/vendedorController.php";
require_once "controllers/precioSumsController.php";
require_once "controllers/piezasController.php";

if (!isset($_REQUEST["idpieza"]) && !isset($_REQUEST["idvend"]))
    header('location:index.php?accion=listar&tabla=preciosum');
$idvend = $_REQUEST["idvend"];
$idpieza = $_REQUEST["idpieza"];


$controladorPS = new PrecioSumsController();

$precSum = $controladorPS->ver($idpieza, $idpieza);

$controladorVend = new VendedorController();

$controladorPiez = new PiezasController();



$visibilidad = "hidden";
$mensaje = "";
$clase = "alert alert-success";
$mostrarForm = true;
if ($precSum == null) {
    $visibilidad = "visibility";
    $mensaje = "El precioSum con id: {$idvend} e id: {$idpieza} no existe. Por favor vuelva a la pagina anterior";
    $clase = "alert alert-danger";
    $mostrarForm = false;
}

if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "guardar") {
    $visibilidad = "visibility";
    $mensaje = "El precioSum con id: {$idvend} de precSum e id: {$idpieza} Modificado con éxito";
    if (isset($_REQUEST["error"])) {
        $mensaje = "No se ha podido modificar el precioSum con id: {$idvend} de precSum e id: {$idpieza}";
        $clase = "alert alert-danger";
        $errores = ($_SESSION["errores"]) ?? [];
        $datos = ($_SESSION["datos"]) ?? [];
        //datos  mostar

    }

}
?>
<div class="<?= $clase ?>" <?= $visibilidad ?>> <?= $mensaje ?> </div>
<?php

if ($mostrarForm) {
    ?>

    <form action="index.php?accion=guardar&evento=editar&tabla=preciosum" method="POST">

        <div class="form-group">
            <label for="numpieza">Número de pieza </label>
            <input type="text" disabled class="form-control" id="numpieza" name="numpieza"
                value="<?= $precSum->numpieza ?>" aria-describedby="numpieza" placeholder="Introduce precSum">
            <?= isset($errores["numpieza"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "numpieza") . '</div>' : ""; ?>
        </div>

        <div class="form-group">
            <label for="numvend">Número de pieza </label>
            <input type="text" disabled class="form-control" id="numvend" name="numvend" value="<?= $precSum->numvend ?>"
                aria-describedby="numvend">
            <?= isset($errores["numvend"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "numvend") . '</div>' : ""; ?>
        </div>
        <div class="form-group">
            <label for="numvend">Número de pieza </label>
            <input type="text" disabled class="form-control" id="numvend" name="numvend" value="<?= $precSum->numvend ?>"
                aria-describedby="numvend">
            <?= isset($errores["numvend"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "numvend") . '</div>' : ""; ?>
        </div>

        <div class="form-group">
            <label for="preciounit">Número de pieza </label>
            <input type="text" disabled class="form-control" id="preciounit" name="preciounit" value="<?= $precSum->preciounit ?>"
                aria-describedby="preciounit">
            <?= isset($errores["preciounit"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "preciounit") . '</div>' : ""; ?>
        </div>

        <div class="form-group">
            <label for="diassum">Número de pieza </label>
            <input type="text" disabled class="form-control" id="diassum" name="diassum" value="<?= $precSum->diassum ?>"
                aria-describedby="diassum">
            <?= isset($errores["diassum"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "diassum") . '</div>' : ""; ?>
        </div>
        <div class="form-group">
            <label for="descuento">descuento</label>
            <input type="text" disabled class="form-control" id="descuento" name="descuento" value="<?= $precSum->descuento ?>"
                aria-describedby="descuento">
            <?= isset($errores["descuento"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "descuento") . '</div>' : ""; ?>
        </div>

        <!-- 
        Posible modificación
                diassum
                descuento
         -->




    </form>

    <?php
}
?>