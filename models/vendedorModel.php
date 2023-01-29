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


    public function insert(array $vendedor): ?string //devuelvo entero o null

    {

        try {
            $sql = "INSERT INTO vendedor  VALUES (NUMVEND=:numvend,NOMVEND=:nomvend ,NOMBRECOMER=:nombrecomer ,TELEFONO=:telefono, CALLE=:calle,CIUDAD=:ciudad, PROVINCIA=: provincia,COD_POSTAL=:cod_post);";
            $sentencia = $this->conexion->prepare($sql);

            $arrayDatos = [

                ":NUMVEND" => $vendedor["numvend"],
                ":NOMVEND" => $vendedor["nomvend"],
                ":NOMBRECOMER" => $vendedor["nombrecomer"],
                ":TELEFONO" => $vendedor["telefono"],
                ":CALLE" => $vendedor["calle"],
                ":CIUDAD" => $vendedor["ciudad"],
                ":PROVINCIA" => $vendedor["provincia"],
                ":COD_POSTAL" => $vendedor["cod_post"],

            ];
            $resultado = $sentencia->execute($arrayDatos);
            return ($resultado == true) ? $vendedor["numvend"] : null;
        } catch (Exception $e) {
            echo 'Excepción capturada: ', $e->getMessage(), "<bR>";
            return null;
        }
    }


    public function read(int $id): ?stdClass
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM vendedor WHERE NUMVEND=:id");

        $arrayDatos = [":id" => $id];

        $resultado = $sentencia->execute($arrayDatos);

        if (!$resultado)
            return null;

        $vendedor = $sentencia->fetch(PDO::FETCH_OBJ);

        return ($vendedor == false) ? null : $vendedor;
    }


    public function readAll(): array
    {
        $sentencia = $this->conexion->query("SELECT * from vendedor");

        $v = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $v;
    }


    public function delete(int $id): bool
    {
        $sql = "DELETE FROM vendedor WHERE numvend =:id";
        try {
            $sentencia = $this->conexion->prepare($sql);

            $resultado = $sentencia->execute([":id" => $id]);

            return ($sentencia->rowCount() <= 0) ? false : true;
        } catch (Exception $e) {
            echo 'Excepción capturada: ', $e->getMessage(), "<bR>";
            return false;
        }
    }

    public function edit(int $id, array $vendedor): bool
    {
        $sql = "UPDATE vendedor SET NUMVEND=:numvend,NOMVEND = :nomvend, NOMBRECOMER = :nombrecomer, TELEFONO = :telefono, CALLE = :calle, CIUDAD = :ciudad, PROVINCIA = :provincia, COD_POSTAL = :cod_postal";
        $sql .= " WHERE NUMVEND = :id;";

        try {
            $arrayDatos = [
                ":id" => $id,
                ":numvend"=>$vendedor["numvend"],
                ":nomvend" => $vendedor["nomvend"],
                ":nombrecomer" => $vendedor["nombrecomer"],
                ":telefono" => $vendedor["telefono"],
                ":calle" => $vendedor["calle"],
                ":ciudad" => $vendedor["ciudad"],
                ":provincia" => $vendedor["provincia"],
                ":cod_postal" => $vendedor["cod_postal"],

            ];
            $sentencia = $this->conexion->prepare($sql);
            return $sentencia->execute($arrayDatos);
        } catch (Exception $e) {
            echo 'Excepción capturada: ', $e->getMessage(), "<br>";
            return false;
        }
    }

    public function search(string $campo, string $metodoBusqueda, string $dato): array
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM vendedor WHERE NUMVEND LIKE :dato");
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
        $inventarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $inventarios;
    }
    public function exists(string $campo, string $valor): bool
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM vendedor WHERE $campo=:valor");
        $arrayDatos = [":valor" => $valor];
        $resultado = $sentencia->execute($arrayDatos);
        return (!$resultado || $sentencia->rowCount() <= 0) ? false : true;
    }
}