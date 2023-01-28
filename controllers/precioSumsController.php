<?php
require_once("models/precioSumModel.php");
class precioSumsController
{
    private $model;

    public function __construct()
    {
        $this->model = new precioSumModel();
    }

    public function ver(int $id): ?stdClass
    {
        return $this->model->read($id);
    }

    public function buscar(string $campo, string $metodoBusqueda, string $texto): array
    {
        return $this->model->search($campo, $metodoBusqueda, $texto);
    }
}
