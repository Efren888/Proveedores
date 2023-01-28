<?php
require_once('config/db.php');


class precioSumModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = db::conexion();
    }

    public function insert(array $preciosum): ?string //devuelvo entero o null
    {
        try {
            $sql = "INSERT INTO   VALUES ();";
            $sentencia = $this->conexion->prepare($sql);
            $arrayDatos = [
                // info
            ];
            $resultado = $sentencia->execute($arrayDatos);
            return ($resultado == true) ? $preciosum["numpreciosum"] : null;
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
            return null;
        }
    }

    public function read(int $id): ?stdClass
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM preciosum WHERE numpreciosum=:id");
        $arrayDatos = [":id" => $id];
        $resultado = $sentencia->execute($arrayDatos);
        // ojo devulve true si la consulta se ejecuta correctamente
        // eso no quiere decir que hayan resultados
        if (!$resultado) return null;
        //como sólo va a devolver un resultado uso fetch
        // DE Paso probamos el FETCH_OBJ
        $preciosum = $sentencia->fetch(PDO::FETCH_OBJ);
        //fetch duevelve el objeto stardar o false si no hay persona
        return ($preciosum == false) ? null : $preciosum;
    }

    public function readAll(): array
    {
        $sentencia = $this->conexion->query("SELECT pe.numvend AS numvend, numpreciosum,fecha,v.NOMVEND AS nomvend FROM preciosum pe , vendedor v WHERE pe.numvend=v.numvend");
        //usamos método query
        $preciosums = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $preciosums;
    }

    public function delete(int $id): bool
    {
        // en esta seccion no hay que verificar ya que se compone de fk y por ende se puede borrar este aprtado 
        $sql = "DELETE FROM preciosum WHERE numpreciosum =:id";
        try {
            $sentencia = $this->conexion->prepare($sql);
            //devuelve true si se borra correctamente
            //false si falla el borrado
            // Pero, si el id existe el borrado es correcto
            // Pero no borra
            $resultado = $sentencia->execute([":id" => $id]);
            // Si no ha borrado nada considero borrado error
            return ($sentencia->rowCount() <= 0) ? false : true;
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
            return false;
        }
    }

    public function edit(int $idAntiguo, array $preciosum): bool
    {

        try {
            $sql = "UPDATE preciosum SET numpreciosum = :numpe, numvend=:numve, fecha=:fecha";
            $sql .= " WHERE numpreciosum = :idantiguo;";
            $arrayDatos = [
                ":numpe" => $preciosum["numpreciosum"],
                ":numve" => $preciosum["numvend"],
                ":fecha" => $preciosum["fecha"],
                ":idantiguo" => $idAntiguo,
            ];
            $sentencia = $this->conexion->prepare($sql);
            return $sentencia->execute($arrayDatos);
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
            return false;
        }
    }
    public function search(string $campo, string $metodoBusqueda, string $dato): array
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM preciosum WHERE $campo LIKE :dato");
        switch ($metodoBusqueda) {
            case "empieza":
                $arrayDatos = [":dato" => "$dato%"];
                break;
            case "contiene":
                $arrayDatos = [":dato" => "%$dato%"];
                break;
            case "igual":
                $arrayDatos = [":dato" => "$dato"];
                break;
            case "acaba":
                $arrayDatos = [":dato" => "%$dato"];
                break;
            default:
                $arrayDatos = [":dato" => "%$dato%"];
                break;
        }

        $resultado = $sentencia->execute($arrayDatos);
        if (!$resultado) return [];
        $preciosums = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $preciosums;
    }
}
