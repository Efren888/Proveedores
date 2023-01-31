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
            $sql = "INSERT INTO   VALUES (numpieza=:numpieza, numvend=:numvend, preciounit=:preciounit,diassum=:diassum, descuento=:descuento);";
            $sentencia = $this->conexion->prepare($sql);
            $arrayDatos = [
                "numpieza" => $preciosum["numpieza"],
                "numvend" => $preciosum["numvend"],
                "preciounit" => $preciosum["preciounit"],
                "diassum" => $preciosum["diassum"],
                "descuento" => $preciosum["descuento"],
            ];
            $resultado = $sentencia->execute($arrayDatos);
            return ($resultado == true) ? $preciosum["numpieza"] : null;
        } catch (Exception $e) {
            echo 'Excepción capturada: ', $e->getMessage(), "<bR>";
            return null;
        }
    }

    public function read(string $id1, string $id2): ?stdClass
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM preciosum WHERE numpieza=:id1 AND numvend=:id2");
        $arrayDatos = [
            ":id1" => $id1,
            ":id2" => $id2
        ];

        $resultado = $sentencia->execute($arrayDatos);

        if (!$resultado)
            return null;

        $preciosum = $sentencia->fetch(PDO::FETCH_OBJ);

        return ($preciosum == false) ? null : $preciosum;
    }

    public function readAll(): array
    {
        $sentencia = $this->conexion->query("SELECT ps.numpieza AS numpieza, p.NOMpieza AS 'nombre pieza' , ps.NUMVEND AS numvend, v.NOMVEND AS 'nombre de  vendedor' , preciounit, diassum, descuento  
        FROM preciosum ps, vendedor v , piezas p
        WHERE ps.NUMpieza= p.NUMpieza AND v.NUMVEND= ps.NUMVEND;");
        //usamos método query
        $preciosums = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $preciosums;
    }

    public function delete(string $id1, string $id2): bool
    {

        $sql = "DELETE FROM preciosum WHERE numpieza =:id1 AND numvend=:id2";
        try {
            $sentencia = $this->conexion->prepare($sql);

            $resultado = $sentencia->execute([
                ":id1" => $id1,
                ":id2" => $id2
            ]);
            // Si no ha borrado nada considero borrado error
            return ($sentencia->rowCount() <= 0) ? false : true;
        } catch (Exception $e) {
            echo 'Excepción capturada: ', $e->getMessage(), "<bR>";
            return false;
        }
    }

    public function edit(array $preciosum): bool
    {

        try {
            $sql = "UPDATE preciosum SET  preciounit=:preciounit,descuento=:descuento";
            $sql .= " WHERE numpieza = :numpieza AND numvend=:numve;";
            $arrayDatos = [

                ":numpe" => $preciosum["numpieza"],
                ":numve" => $preciosum["numvend"],
                ":preciounit" => $preciosum["preciounit"],
                ":diassum" => $preciosum["diassum"],
                ":descuento" => $preciosum["descuento"],
            ];

            $sentencia = $this->conexion->prepare($sql);

            return $sentencia->execute($arrayDatos);

        } catch (Exception $e) {

            echo 'Excepción capturada: ', $e->getMessage(), "<bR>";

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
        if (!$resultado)
            return [];
        $preciosums = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $preciosums;
    }
}
