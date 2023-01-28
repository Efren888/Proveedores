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
            $sql = "INSERT INTO vendedor  VALUES (:NUMVEND,:NOMVEND ,:NOMBRECOMER ,:TELEFONO, :CALLE,:CIUDAD ,:PROVINCIA ,:COD_POSTAL);";
            $sentencia = $this->conexion->prepare($sql);
            $arrayDatos = [

                ":NUMVEND" => $vendedor["numvend"],
                ":NOMVEND" => $vendedor["nomvend"],
                ":NOMBRECOMER" => $vendedor["nombrecomer"],
                ":TELEFONO" => $vendedor["telefono"],
                ":CALLE" => $vendedor["domicilio"],
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
        try {
            $sql = "UPDATE vendedor SET (numvend=:NUMVEND,NOMVEND=:nomvend ,NOMBRECOMER=:nombrecomer ,TELEFONO=:telefono, CALLE=:domicilio, CIUDAD=:ciudad , PROVINCIA=:provincia ,COD_POSTAL=:cod_post);";
            $sql .= " WHERE NUMVEND = :id;";
            /*
            nomvend
nombrecomer
telefono
calle
ciudad
provincia
cod_postalPROVINCIA
            */
            $arrayDatos = [
                ":NUMVEND" => $vendedor["numvend"],
                ":NOMVEND" => $vendedor["nomvend"],
                ":NOMBRECOMER" => $vendedor["nombrecomer"],
                ":TELEFONO" => $vendedor["telefono"],
                ":CALLE" => $vendedor["calle"],
                ":CIUDAD" => $vendedor["ciudad"],
                ":PROVINCIA" => $vendedor["PROVINCIA"],
                ":COD_POSTAL" => $vendedor["provincia"],
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

}