<?php
require_once "assets/php/funciones.php";
require_once "controllers/vendedorController.php";
require_once "controllers/precioSumsController.php";
require_once "controllers/pedidosController.php";

//recoger datos
if (!isset($_REQUEST["id"]))
    header('location:index.php?accion=listar&tabla=vendedor');

//trycatch?????

$id = $_REQUEST["id"];

$controlVendedor = new VendedorController();
$vendedor = $controlVendedor->ver($id);


// controlador de preciosum
$controlPrecioSum = new precioSumsController();


//controlador de pedido
$controlPedido = new PedidosController();


$visibilidad = "hidden";
$mensaje = "";
$clase = "alert alert-success";
$mostrarForm = true;
if ($vendedor == null) {
    $visibilidad = "visibility";
    $mensaje = "La vendedor con id: {$id} no existe. Por favor vuelva a la pagina anterior";
    $clase = "alert alert-danger";
    $mostrarForm = false;
}

if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "guardar") {
    $visibilidad = "visibility";
    $mensaje = "vendedor con numero de vendedor {$id} Modificado con éxito";
    if (isset($_REQUEST["error"])) {
        $mensaje = "No se ha podido modificar el numero de vendedor {$id}";
        $clase = "alert alert-danger";
        $errores = ($_SESSION["errores"]) ?? [];
        $datos = ($_SESSION["datos"]) ?? [];
        //actualizo los campos
        $id = $datos["id"];
        $vendedor->nomvend = $datos["nomvend"];
        $vendedor->nombrecomer = $datos["nombrecomer"];
        $vendedor->telefono = $datos["telefono"];
        $vendedor->calle = $datos["calle"];
        $vendedor->ciudad = $datos["ciudad"];
        $vendedor->provincia = $datos["provincia"];
        $vendedor->cod_postal = $datos["cod_postal"];
    }
    // var_dump($_SESSION["datos"]);
}
?>
<div class="<?= $clase ?>" <?= $visibilidad ?>> <?= $mensaje ?> </div>
<?php
if ($mostrarForm) {
    ?>
    <form action="index.php?accion=guardar&evento=editar&tabla=vendedor" method="POST">
        <input type="hidden" id="idOriginal" name="idOriginal " value="<?= $id ?>">
        <div class="form-group">
            <label for="vendedor">ID vendedor </label>
            <?php

            $habilitado = (count($controlVendedor->buscar("numvend", "igual", $vendedor->numvend)) > 0 &&
                count($controlPedido->buscar("numvend", "igual", $vendedor->numvend)) > 0 &&
                count($controlPrecioSum->buscar("numvend", "igual", $vendedor->numvend)) > 0)
                ? "disabled" : "";


            ?>
            <input type="text" <?= $habilitado ?> class="form-control" id="numvend" name="numvend"
                value="<?= $vendedor->numvend ?>" aria-describedby="numvend" placeholder="Introduce vendedor">
            <small id="vendedor" class="form-text text-muted">Compartir tu vendedor lo hace menos seguro.</small>
            <?= isset($errores["numvend"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "numvend") . '</div>' : ""; ?>
        </div>
        <div class="form-group">
            <label for="nomvend">Nombre </label>
            <input type="text" class="form-control" id="nomvend" name="nomvend" value="<?= $vendedor->nomvend ?>"
                placeholder="Introduce el Nombre de la vendedor">
        </div>
        <div class="form-group">
            <label for="nombrecomer">Nombre de la comercial</label>
            <input type="text" class="form-control" id="nombrecomer" name="nombrecomer"
                value="<?= $vendedor->nombrecomer ?>" placeholder="Introduce el nombre de empresa">
        </div>
        <div class="form-group">
            <label for="telefono">Numero de telefono</label>
            <input type="text" class="form-control" id="telfono" name="telefono" value="<?= $vendedor->telefono ?>"
                placeholder="Introduce el numeor de telefono">
        </div>

        <div class="form-group">
            <label for="calle">Direccion</label>
            <input type="text" class="form-control" id="calle" name="calle" value="<?= $vendedor->calle ?>"
                placeholder="Introduce la direccion">
        </div>

        <div class="form-group">
            <label for="ciudad">Ciudad</label>
            <input type="text" class="form-control" id="ciudad" name="ciudad" value="<?= $vendedor->ciudad ?>"
                placeholder="Introduce la ciudad ">
        </div>

        <div class="form-group">
            <label for="provincia">Nombre de la provincia</label>
            <input type="text" class="form-control" id="provincia" name="provincia" value="<?= $vendedor->nombrecomer ?>"
                placeholder="Introduce el nombre de la provincia">
        </div>
        <div class="form-group">
            <label for="cod_postal">Codigo postal</label>
            <input type="text" class="form-control" id="cod_postal" name="cod_postal" value="<?= $vendedor->cod_postal ?>"
                placeholder="Introduce el codigo postal">
        </div>


        <button type="submit" class="btn btn-primary">Guardar</button>
        <a class="btn btn-danger" href="index.php?accion=listar&tabla=vendedor">Cancelar</a>

    </form>
    <?php
} else {
    ?>
    <a href="index.php" class="btn btn-primary">Volver a Inicio</a>
    <?php
}
unset($_SESSION["errores"]);
unset($_SESSION["datos"]);
?>