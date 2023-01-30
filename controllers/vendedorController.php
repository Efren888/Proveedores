<?php
require_once "models/vendedorModel.php";
require_once "assets/php/funciones.php";
//nombre de los controladores suele ir en plural
class VendedorController
{
    private $model;

    public function __construct()
    {
        $this->model = new VendedorModel();
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



    public function editar(int $idOriginal, array $arrayVendedor): void
    {
        // validacion de datos

        $error = false;
        $errores = [];
        $_SESSION["errores"] = [];
        $_SESSION["datos"] = [];

        // numero de vendedor 

        if ($arrayVendedor["numvend"] < 0) {
            $error = true;
            $errores["numvend"][] = "El numero no puede ser menor a 0";
        }

        if (validarEntero($arrayVendedor["numvend"])) {
            $error = true;
            $errores["numvend"][] = "Este parámetro debe ser sólo un número";
        }

        //nombre de vendedor
        if (!validarSoloLetras($arrayVendedor["nomvend"])) {
            $error = true;
            $errores["nomvend"][] = "El nombre solo debe contener letras, no se permiten números";
        }

        //nombre comercial


        if (!validarSoloLetras($arrayVendedor["nombrecomer"])) {
            $error = true;
            $errores["nomvend"][] = "El nombre del comercial sólo debe contener letras, no se permiten números";
        }

        // telefono

        if (validarEntero($arrayVendedor["telefono"])) {
            $error = true;
            $errores["telefono"][] = "Este parámetro debe ser sólo un número";
        }

        //campos NO VACIOS
        $arrayNoNulos = ["numvend", "nomvend", "nombrecomer", "telefono"];
        $nulos = HayNulos($arrayNoNulos, $arrayVendedor);
        if (count($nulos) > 0) {
            $error = true;
            for ($i = 0; $i < count($nulos); $i++) {
                $errores[$nulos[$i]][] = "El campo {$nulos[$i]} está vacio.";
            }
        }
        //CAMPOS UNICOS
        $arrayUnicos = [];
        if ($arrayVendedor["numvend"] != $idOriginal)
            $arrayUnicos[] = "numvend";


        foreach ($arrayUnicos as $CampoUnico) {
            if ($this->model->exists($CampoUnico, $arrayVendedor[$CampoUnico])) {
                $errores[$CampoUnico][] = "El {$arrayVendedor[$CampoUnico]} de {$CampoUnico} ya existe. Por favor no lo utilice, pues puede a problemas con los datos";
            }
        }

        $editado = false;
        if (!$error)
            $editado = $this->model->edit($idOriginal, $arrayVendedor);

        if ($editado == false) {

            $_SESSION["errores"] = $errores;
            $_SESSION["datos"] = $arrayVendedor;

            $redireccion = "location:index.php?accion=editar&tabla=vendedor&evento=guardar&id={$idOriginal}&error=true";
        } else {
            unset($_SESSION["errores"]);
            unset($_SESSION["datos"]);
            $id = $arrayVendedor["numpieza"];
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