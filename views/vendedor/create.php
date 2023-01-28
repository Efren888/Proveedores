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
<form action="index.php?accion=guardar&evento=crear&tabla=vendedor" method="POST">


    <div class="form-group">
        <!-- regex de solo carcteres -->
        <label for="numvend">numero de vendedor </label>
        <input type="number" required class="form-control" id="numvend" name="numvend" aria-describedby="numvend" placeholder="Introduce el numero del vendedor" value="<?= $_SESSION["datos"]["numvend"] ?? "" ?>">
        <?= isset($errores["numvend"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "numvend") . '</div>' : ""; ?>
    </div>


    <div class="form-group">
        <!-- regex de solo carcteres -->
        <label for="nomvend">Nombre del vendedor </label>
        <input type="text" required class="form-control" pattern="^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,30}$" id="nomvend" name="nomvend" aria-describedby="nomvend" placeholder="Introduce el nombre del vendedor" value="<?= $_SESSION["datos"]["nomvend"] ?? "" ?>">
        <!-- <small id="nomvend" class="form-text text-muted">Compartir tu pieza lo hace menos seguro.</small> -->
        <?= isset($errores["nomvend"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "nomvend") . '</div>' : ""; ?>
    </div>




    <div class="form-group">
        <label for="nombrecomer">Nombre de la comercial</label>
        <input type="text" class="form-control" id="nombrecomer" pattern="^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,30}$" name="nombrecomer" placeholder="Introduce el Nombre de la comercial" value="<?= $_SESSION["datos"]["nombrecomer"] ?? "" ?>">
        <?= isset($errores["nombrecomer"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "nombrecomer") . '</div>' : ""; ?>
    </div>


    <div class="form-group">
        <!-- regex solo numeros  9 digitos -->
        <label for="telefono">Numero de telefono </label>
        <input type="number" required class="form-control" pattern="/^[76]{1}[0-9]{8}$/" id="telefono" name="telefono" placeholder="Introduce el numero de telefono" value="<?= $_SESSION["datos"]["telefono"] ?? "" ?>">
        <?= isset($errores["telefono"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "telefono") . '</div>' : ""; ?>
    </div>



    <div class="form-group">
        <!-- regex solo numeros  9 digitos -->
        <label for="domicilio">Domicilio </label>
        <input type="text" required class="form-control" pattern="^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,30}$" id="domicilio" name="domicilio" placeholder="Introduce el domicilio" value="<?= $_SESSION["datos"]["domicilio"] ?? "" ?>">
        <?= isset($errores["domicilio"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "domicilio") . '</div>' : ""; ?>
    </div>


    <div class="form-group">
        <!-- regex solo numeros  9 digitos -->
        <label for="ciudad">Ciudad </label>
        <input type="text" required class="form-control" pattern="^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,30}$" id="ciudad" name="ciudad" placeholder="Introduce la ciudad donde resides" value="<?= $_SESSION["datos"]["ciudad"] ?? "" ?>">
        <?= isset($errores["ciudad"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "ciudad") . '</div>' : ""; ?>
    </div>

    <div class="form-group">
        <!-- regex solo numeros  9 digitos -->
        <label for="provincia">Provincia </label>
        <input type="text" class="form-control" pattern="^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,30}$" id="provincia" name="provincia" placeholder="Introduce la provincia d donde vives" value="<?= $_SESSION["datos"]["provincia"] ?? "" ?>">
        <?= isset($errores["provincia"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "provincia") . '</div>' : ""; ?>
    </div>
    <div class="form-group">
        <!-- regex solo numeros  9 digitos -->
        <label for="cod_post">Codigo postal </label>
        <input type="number" class="form-control" id="cod_post" name="cod_post" placeholder="Introduce el codigo postal" value="<?= $_SESSION["datos"]["cod_post"] ?? "" ?>">
        <?= isset($errores["cod_post"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "cod_post") . '</div>' : ""; ?>
    </div>




    <button type="submit" class="btn btn-primary">Guardar</button>
    <a class="btn btn-danger" href="index.php">Cancelar</a>


</form>

<?php
unset($_SESSION["errores"]);
unset($_SESSION["datos"]);
?>