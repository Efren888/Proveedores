<?php
require_once "models/vendedorModel.php";
require_once "assets/php/funciones.php";
//nombre de los controladores suele ir en plural
class VendedorController
{
    private $model;

    public function __construct()
    {
        $this->model = new vendedorModel();
    }

    public function crear(array $arrayVendedor): void
    {
        $error = false;
        $errores = [];
        $_SESSION["errores"] = [];
        $_SESSION["datos"] = [];

        // control del id 
        if ($arrayVendedor["numvend"] <= 0) {
            $error = true;
            $errores["numvend"][] = "El numero del vendedor no puede ser menor a 1 ";
        }
        $arrayNoNulos = ["nomvend", "nombrecomer", "telefono"];
        $nulos = HayNulos($arrayNoNulos, $arrayVendedor);
        if (count($nulos) > 0) {
            $error = true;
            for ($i = 0; $i < count($nulos); $i++) {
                $errores[$nulos[$i]][] = "El campo {$nulos[$i]} es nulo";
            }
        }


        $id = null;
        if (!$error)
            $id = $this->model->insert($arrayVendedor);

        if ($id == null) {
            $_SESSION["errores"] = $errores;
            $_SESSION["datos"] = $arrayVendedor;
            header("location:index.php?accion=crear&tabla=vendedor&error=true&id={$id}");
        } else {
            unset($_SESSION["errores"]);
            unset($_SESSION["datos"]);
            header("location:index.php?accion=ver&tabla=vendedor&id=" . $id);
        }
    }


    public function ver(int $id): ?stdClass
    {
        return $this->model->read($id);
    }

    public function listar()
    {
        return $this->model->readAll();
    }

    public function borrar(int $id): void
    {
        $borrado = $this->model->delete($id);
        $redireccion = "location:index.php?accion=listar&tabla=vendedor&evento=borrar&id={$id}";
        $redireccion .= ($borrado == false) ? "&error=true" : "";
        header($redireccion);
    }


    public function editar(int $id, array $arrayVendedor): void
    {

        $editadoCorrectamente = $this->model->edit($id, $arrayVendedor);


        if ($editadoCorrectamente == false) {
            $redireccion = "location:index.php?accion=editar&tabla=vendedor&evento=guardar&id={$id}&error=true";
        } else {
            $id = $arrayVendedor["numvend"];
            $redireccion = "location:index.php?accion=editar&tabla=vendedor&evento=guardar&id={$id}";
        }
        //vuelvo a la pagina donde estaba
        header($redireccion);
    }

    public function buscar(string $campo, string $metodoBusqueda, string $dato): array
    {
        return $this->model->search($campo, $metodoBusqueda, $dato);
    }
}