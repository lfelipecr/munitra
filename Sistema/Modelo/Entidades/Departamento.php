<?php

class Departamento
{
    private $id;
    private $descripcion;
    private $borrado;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id): void
    {
        $this->id = $id;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function setDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
    }
    public function getBorrado()
    {
        return $this->borrado;
    }
    public function setBorrado($borrado): void
    {
        $this->borrado = $borrado;
    }
}