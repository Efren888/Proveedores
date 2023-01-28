<?php
require_once "models/inventarioModel.php";
//nombre de los controladores suele ir en plural
class InventariosController
{
    private $model;

    public function __construct()
    {
        $this->model = new InventarioModel();
    }
/*
    public function crear(array $arrayPedido): void
    {
        $id = $this->model->insert($arrayPedido);
        ($id == null) ? header("location:index.php?accion=crear&tabla=pedido&error=true&id={$id}") : header("location:index.php?accion=ver&tabla=pedido&id=" . $id);
    }
    */
    public function ver(int $id): ?stdClass
    {
        return $this->model->read($id);
    }
    /*
    public function listar()
    {
        return $this->model->readAll();
    }
    public function borrar(int $id): void
    {
        $borrado = $this->model->delete($id);
        $redireccion = "location:index.php?accion=listar&tabla=pedido&evento=borrar&id={$id}";
        $redireccion .= ($borrado == false) ? "&error=true" : "";
        header($redireccion);
    }
    public function editar(int $id, array $arrayPedido): void
    {
        $editadoCorrectamente = $this->model->edit($id, $arrayPedido);
        if ($editadoCorrectamente==false){
            $redireccion = "location:index.php?accion=editar&tabla=pedido&evento=guardar&id={$id}&error=true";    
        }
        else{
            $id=$arrayPedido["numpedido"];
            $redireccion = "location:index.php?accion=editar&tabla=pedido&evento=guardar&id={$id}";
        }
        //vuelvo a la pagina donde estaba
        header($redireccion);
    }
    //accion= contiene, empieza, acaba,  igual
    */
    public function buscar (string $campo,string $metodoBusqueda, string $texto):array {
        return $this->model->search ($campo, $metodoBusqueda, $texto);
    }
}
