<?php

function is_valid_dni(string $dni):bool
{
  $letter = substr($dni, -1);
  $numbers = substr($dni, 0, -1);
  $patron = "/^[[:digit:]]+$/";
  
  if (preg_match($patron, $numbers) && substr("TRWAGMYFPDXBNJZSQVHLCKE", $numbers%23, 1) == $letter && strlen($letter) == 1 && strlen ($numbers) == 8 ){
    return true;
  }
  return false;
}

function HayNulos (array $camposNoNulos, array $arrayDatos):array
{
    $nulos=[];
    foreach($camposNoNulos as $index=> $campo) {
        if (!isset ($arrayDatos[$campo]) || empty ($arrayDatos[$campo]) || $arrayDatos[$campo]==null){
            $nulos[]=$campo;
        }
    }
    return $nulos;
}


function ExisteAficion($aficiones, $aficion){

    foreach($aficiones as $index=>$valor){
        if($valor==$aficion) return true;
    }
    return false;
}

//existeValor ($usuarios,'nick',$nick);
function existeValor (array $array,string $campo,mixed $valor):bool
{
    foreach($array as $indice=>$fila){
        if ($fila[$campo]==$valor) {
            return true;
        }
    }
    return false;
}

function DibujarErrores($errores,$campo){
    $cadena="";
    
    if (isset($errores[$campo])){
        foreach ($errores[$campo] as $indice =>$msgError){
            $cadena.= "<br>{$msgError}" ;
        }
    }
    return $cadena;
}

function validarSoloLetras($cadena)
{
    if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/', $cadena)) {
        return true;
    }
    return false;
}

function validarTelefono(int $telefono): bool
{
    if (strlen($telefono) == 9 && preg_match('/^[0-9]*$/', $telefono)) {
        return true;
    }
    return false;

}

function validarDecimal(float $numero): bool
{
    $numeroFormateado = number_format($numero, 2);
    if ($numeroFormateado == $numero) {
        return true;
    }
    return false;
}



function validarEntero($number): bool
{ // me puede meter conotacion, hayq ue mirar la conotacion cientifica

    for ($i = 0; $i < strlen($number); $i++) {
        if ($number[$i] == "e" || $number[$i] == "E") {
            return false;
        }

    }
    if (!is_string($number)) {

        if (is_numeric($number)) {

            if (is_float($number)) {

                return false;
            }

            return true;
        }
        return false;
    }
    return false;
}