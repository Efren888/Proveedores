<?php
require_once "models/vendedorModel.php";
//nombre de los controladores suele ir en plural
class VendedorController
{
    private $model;

    public function __construct()
    {
        $this->model = new vendedorModel();
    }

    // public function crear(array $arrayPedido): void
    // {
    //     $id = $this->model->insert($arrayPedido);
    //     ($id == null) ? header("location:index.php?accion=crear&tabla=pedido&error=true&id={$id}") : header("location:index.php?accion=ver&tabla=pedido&id=" . $id);
    // }
    // public function ver(int $id): ?stdClass
    // {
    //     return $this->model->read($id);
    // }
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
    //     public function editar(int $id, array $arrayPedido): void
    //     {
    //         $editadoCorrectamente = $this->model->edit($id, $arrayPedido);
    //         if ($editadoCorrectamente == false) {
    //             $redireccion = "location:index.php?accion=editar&tabla=pedido&evento=guardar&id={$id}&error=true";
    //         } else {
    //             $id = $arrayPedido["numpedido"];
    //             $redireccion = "location:index.php?accion=editar&tabla=pedido&evento=guardar&id={$id}";
    //         }
    //         //vuelvo a la pagina donde estaba
    //         header($redireccion);
    //     }

    //     public function buscar(string $texto): array
    //     {
    //         return $this->model->search($texto);
    //     }
}
