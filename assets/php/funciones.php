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