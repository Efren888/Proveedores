<?php
require_once('config/db.php');


class PiezasModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = db::conexion();
    }

    public function insert(array $pieza): ?string
    {
        try {
            $sql = "INSERT INTO piezas(numpieza, nompieza, preciovent)  VALUES (:numpi,:nompi,:precio);";
            $sentencia = $this->conexion->prepare($sql);
            $arrayDatos = [
                ":numpi" => $pieza["numpieza"],
                ":nompi" => $pieza["nompieza"],
                ":precio" => $pieza["preciovent"]
            ];
            $resultado = $sentencia->execute($arrayDatos);
            return ($resultado == true) ? $pieza["numpieza"] : null;
        } catch (Exception $e) {
            echo 'Excepción capturada: ', $e->getMessage(), "<bR>";
            return null;
        }
    }

    public function read(string $id): ?stdClass
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM piezas WHERE numpieza=:id");
        $arrayDatos = [":id" => $id];
        $resultado = $sentencia->execute($arrayDatos);

        if (!$resultado)
            return null;

        $pieza = $sentencia->fetch(PDO::FETCH_OBJ);

        return ($pieza == false) ? null : $pieza;
    }
    public function readAll(): array
    {
        $sentencia = $this->conexion->query("SELECT * FROM piezas;");

        $piezas = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $piezas;
    }
    public function delete(string $id): bool
    {
        $sql = "DELETE FROM piezas WHERE numpieza =:id";
        try {
            $sentencia = $this->conexion->prepare($sql);

            $resultado = $sentencia->execute([":id" => $id]);

            return ($sentencia->rowCount() <= 0) ? false : true;

        } catch (Exception $e) {

            echo 'Excepción capturada: ', $e->getMessage(), "<bR>";

            return false;
        }
    }

    public function edit(string $idAntiguo, array $pieza): bool
    {

        try {
            $sql = "UPDATE piezas SET numpieza = :numpi, nompieza=:nompi, preciovent=:precio";
            $sql .= " WHERE numpieza = :idantiguo;";
            $arrayDatos = [
                ":numpi" => $pieza["numpieza"],
                ":nompi" => $pieza["nompieza"],
                ":precio" => $pieza["preciovent"],
                ":idantiguo" => $idAntiguo,
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

        $sentencia = $this->conexion->prepare("SELECT * FROM piezas WHERE $campo LIKE :dato");
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
        $pedidos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $pedidos;
    }

    public function exists(string $campo, string $valor): bool
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM piezas WHERE $campo=:valor");
        
        $arrayDatos = [":valor" => $valor];

        $resultado = $sentencia->execute($arrayDatos);

        return (!$resultado || $sentencia->rowCount() <= 0) ? false : true;
    }
}