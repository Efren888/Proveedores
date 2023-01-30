<?php
require_once("models/precioSumModel.php");
class PrecioSumsController
{
    private $model;

    public function __construct()
    {
        $this->model = new precioSumModel();
    }

    public function crear(array $arrayPrecioSum): void
    {
        
            $id = $this->model->insert($arrayPrecioSum);

        if ($id == null) {
           
            // header("location:index.php?accion=crear&tabla=preciosum&error=true&id={$id}");
        } else {
         
            // header("location:index.php?accion=ver&tabla=preciosum&id=" . $id);
        }
    }

    public function ver(string $id1, string $id2): ?stdClass
    {
        return $this->model->read($id1, $id2);
    }

    public function listar()
    {
        return $this->model->readAll();
    }

    public function borrar(int $id): void
    {
        $borrado = $this->model->delete($id);

        $redireccion = "location:index.php?accion=listar&tabla=preciosum&evento=borrar&id={$id}";


        $redireccion .= ($borrado == false) ? "&error=true" : "";

        header($redireccion);

    }

    public function editar(int $idOriginal, array $arrayVendedor): void
    {
        $editado = $this->model->edit($idOriginal, $arrayVendedor);

        if ($editado == false) {

            $redireccion = "location:index.php?accion=editar&tabla=vendedor&evento=guardar&id={$idOriginal}&error=true";
        } else {
          
            $id = $arrayVendedor[""];
            $redireccion = "location:index.php?accion=editar&tabla=vendedor&evento=guardar&id={$id}";
        }
    
        header($redireccion);
    }

    public function buscar(string $campo, string $metodoBusqueda, string $texto): array
    {
        return $this->model->search($campo, $metodoBusqueda, $texto);
    }
    
}