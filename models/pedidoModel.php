<?php
require_once('config/db.php');
//require_once('class/persona.php');

class PedidoModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = db::conexion();
    }
    //o Persona p1
    public function insert(array $pedido): ?string //devuelvo entero o null
    {
        try {
            $sql = "INSERT INTO pedido(numpedido, numvend, fecha)  VALUES (:numpe,:numvend,:fecha);";
            $sentencia = $this->conexion->prepare($sql);
            $arrayDatos = [
                ":numpe" => $pedido["numpedido"],
                ":numvend" => $pedido["numvend"],
                ":fecha" => $pedido["fecha"]
            ];
            $resultado = $sentencia->execute($arrayDatos);
            return ($resultado == true) ? $pedido["numpedido"] : null;
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
            return null;
        }
    }

    public function read(int $id): ?stdClass
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM pedido WHERE numpedido=:id");
        $arrayDatos = [":id" => $id];
        $resultado = $sentencia->execute($arrayDatos);
        // ojo devulve true si la consulta se ejecuta correctamente
        // eso no quiere decir que hayan resultados
        if (!$resultado) return null;
        //como sólo va a devolver un resultado uso fetch
        // DE Paso probamos el FETCH_OBJ
        $pedido = $sentencia->fetch(PDO::FETCH_OBJ);
        //fetch duevelve el objeto stardar o false si no hay persona
        return ($pedido == false) ? null : $pedido;
    }
    public function readAll(): array
    {
        $sentencia = $this->conexion->query("SELECT pe.numvend AS numvend, numpedido,fecha,v.NOMVEND AS nomvend FROM pedido pe , vendedor v WHERE pe.numvend=v.numvend");
        //usamos método query
        $pedidos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $pedidos;
    }
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM pedido WHERE numpedido =:id";
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

    public function edit(int $idAntiguo, array $pedido): bool
    {
        try {
            $sql = "UPDATE pedido SET numpedido = :numpe, numvend=:numve, fecha=:fecha";
            $sql .= " WHERE numpedido = :idantiguo;";
            $arrayDatos = [
                ":numpe" => $pedido["numpedido"],
                ":numve" => $pedido["numvend"],
                ":fecha" => $pedido["fecha"],
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
        $sentencia = $this->conexion->prepare("SELECT * FROM pedido WHERE $campo LIKE :dato");
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
        $pedidos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $pedidos;
    }
}
