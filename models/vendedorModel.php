<?php
require_once('config/db.php');
//require_once('class/persona.php');

class vendedorModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = db::conexion();
    }
    // //o Persona p1
    // public function insert(array $pedido): ?string //devuelvo entero o null
    // {
    //     try {
    //         $sql = "INSERT INTO pedido(numpedido, numvend, fecha)  VALUES (:numpe,:numvend,:fecha);";
    //         $sentencia = $this->conexion->prepare($sql);
    //         $arrayDatos = [
    //             ":numpe" => $pedido["numpedido"],
    //             ":numvend" => $pedido["numvend"],
    //             ":fecha" => $pedido["fecha"]
    //         ];
    //         $resultado = $sentencia->execute($arrayDatos);
    //         return ($resultado == true) ? $pedido["numpedido"] : null;
    //     } catch (Exception $e) {
    //         echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
    //         return null;
    //     }
    // }

    // public function read(int $id): ?stdClass
    // {
    //     $sentencia = $this->conexion->prepare("SELECT * FROM pedido WHERE numpedido=:id");
    //     $arrayDatos = [":id" => $id];
    //     $resultado = $sentencia->execute($arrayDatos);
    //     // ojo devulve true si la consulta se ejecuta correctamente
    //     // eso no quiere decir que hayan resultados
    //     if (!$resultado) return null;
    //     //como sólo va a devolver un resultado uso fetch
    //     // DE Paso probamos el FETCH_OBJ
    //     $pedido = $sentencia->fetch(PDO::FETCH_OBJ);
    //     //fetch duevelve el objeto stardar o false si no hay persona
    //     return ($pedido == false) ? null : $pedido;
    // }
    public function readAll(): array
    {
        $sentencia = $this->conexion->query("SELECT * from vendedor");
        //usamos método query
        $v = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $v;
    }
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM vendedor WHERE numvend =:id";
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

    // public function edit(int $idAntiguo, array $pedido): bool
    // {
    //     try {
    //         $sql = "UPDATE pedido SET numpedido = :numpe, numvend=:numve, fecha=:fecha";
    //         $sql .= " WHERE numpedido = :idantiguo;";
    //         $arrayDatos = [
    //             ":numpe" => $pedido["numpedido"],
    //             ":numve" => $pedido["numvend"],
    //             ":fecha" => $pedido["fecha"],
    //             ":idantiguo" => $idAntiguo,
    //         ];
    //         $sentencia = $this->conexion->prepare($sql);
    //         return $sentencia->execute($arrayDatos);
    //     } catch (Exception $e) {
    //         echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
    //         return false;
    //     }
    // }

    // public function search(string $dato): array
    // {
    //     $sentencia = $this->conexion->prepare("SELECT * FROM pedido WHERE numpedido LIKE :dato");
    //     //ojo el si ponemos % siempre en comillas dobles "
    //     $arrayDatos = [":dato" => "%$dato%"];
    //     $resultado = $sentencia->execute($arrayDatos);
    //     if (!$resultado) return [];
    //     $pedidos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    //     return $pedidos;
    // }
}
