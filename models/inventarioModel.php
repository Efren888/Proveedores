<?php
require_once('config/db.php');
//require_once('class/persona.php');

class InventarioModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = db::conexion();
    }
    //o Persona p1
    /*
    public function insert(array $inventario): ?string //devuelvo entero o null
    {
        try {
            $sql = "INSERT INTO inventario(numinventario, numvend, fecha)  VALUES (:numpe,:numvend,:fecha);";
            $sentencia = $this->conexion->prepare($sql);
            $arrayDatos = [
                ":numpe" => $inventario["numinventario"],
                ":numvend" => $inventario["numvend"],
                ":fecha" => $inventario["fecha"]
            ];
            $resultado = $sentencia->execute($arrayDatos);
            return ($resultado == true) ? $inventario["numinventario"] : null;
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
            return null;
        }
    }
*/
    public function read(int $id): ?stdClass
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM inventario WHERE numinventario=:id");
        $arrayDatos = [":id" => $id];
        $resultado = $sentencia->execute($arrayDatos);
        // ojo devulve true si la consulta se ejecuta correctamente
        // eso no quiere decir que hayan resultados
        if (!$resultado) return null;
        //como sólo va a devolver un resultado uso fetch
        // DE Paso probamos el FETCH_OBJ
        $inventario = $sentencia->fetch(PDO::FETCH_OBJ);
        //fetch duevelve el objeto stardar o false si no hay persona
        return ($inventario == false) ? null : $inventario;
    }
    /*
    public function readAll(): array
    {
        $sentencia = $this->conexion->query("SELECT pe.numvend AS numvend, numinventario,fecha,v.NOMVEND AS nomvend FROM inventario pe , vendedor v WHERE pe.numvend=v.numvend");
        //usamos método query
        $inventarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $inventarios;
    }
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM inventario WHERE numinventario =:id";
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

    public function edit(int $idAntiguo, array $inventario): bool
    {
        try {
            $sql = "UPDATE inventario SET numinventario = :numpe, numvend=:numve, fecha=:fecha";
            $sql .= " WHERE numinventario = :idantiguo;";
            $arrayDatos = [
                ":numpe" => $inventario["numinventario"],
                ":numve" => $inventario["numvend"],
                ":fecha" => $inventario["fecha"],
                ":idantiguo" => $idAntiguo,
            ];
            $sentencia = $this->conexion->prepare($sql);
            return $sentencia->execute($arrayDatos);
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
            return false;
        }
    }
*/
    public function search(string $campo, string $metodoBusqueda, string $dato): array
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM inventario WHERE $campo LIKE :dato");
        switch ($metodoBusqueda){
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
        $inventarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $inventarios;
    }
}
