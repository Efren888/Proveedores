<?php
require_once "controllers/piezasController.php";
//recoger datos
if (!isset ($_REQUEST["id"])) header('location:index.php?accion=listar&tabla=piezas');
$id=$_REQUEST["id"];
$controlador= new piezasController();
$pieza= $controlador->ver ($id);

$visibilidad="hidden";
$mensaje="";
$clase= "alert alert-success";
$mostrarForm=true;
if($pieza==null) {
  $visibilidad="visbility";
  $mensaje="La pieza con id: {$id} no existe. Por favor vuelva a la pagina anterior";
  $clase= "alert alert-danger";
  $mostrarForm=false;
 } 

if (isset ($_REQUEST["evento"]) && $_REQUEST["evento"]=="guardar"){
    $visibilidad="vibility";
    $mensaje="Pieza con numero de Pieza {$id} Modificado con éxito";
    if (isset($_REQUEST["error"])){
        $mensaje="No se ha podido modificar el numero de Pieza {$id}";
        $clase="alert alert-danger";
    }
}
?>
<div class="<?=$clase?>" <?=$visibilidad?>> <?=$mensaje?> </div>
<?php 
if ($mostrarForm) {
?>
<form action="index.php?accion=guardar&evento=editar&tabla=piezas" method="POST">
<input type="hidden"   id="idAntiguo" name="idAntiguo" value="<?=$pieza->numpieza?>">
  <div class="form-group">
    <label for="pieza">pieza </label>
    <input type="text" required class="form-control" id="numpieza" name="numpieza" value="<?=$pieza->numpieza?>" aria-describedby="numpieza" placeholder="Introduce pieza">
    <small id="pieza" class="form-text text-muted">Compartir tu pieza lo hace menos seguro.</small>
  </div>
  <div class="form-group">
  <label for="nompieza">Nombre </label>
    <input type="text" class="form-control" id="nompieza" name="nompieza" value="<?=$pieza->nompieza?>" placeholder="Introduce el Nombre de la pieza">
  </div>
  <div class="form-group">
  <label for="preciovent">Precio de Venta </label>
    <input type="text" class="form-control" id="preciovent" name="preciovent" value="<?=$pieza->preciovent?>" placeholder="Introduce el Precio">
  </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
  <a class="btn btn-danger" href="index.php?accion=listar&tabla=piezas">Cancelar</a>
</form>
<?php
} 
else{
  ?>
      <a href="index.php" class="btn btn-primary">Volver a Inicio</a>
  <?php
}
