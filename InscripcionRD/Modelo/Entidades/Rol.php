<?php

class Rol
{
    private $id;
    private $descripcion;
    private $activo;

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
    public function getActivo()
    {
        return $this->activo;
    }
    public function setActivo($activo): void
    {
        $this->activo = $activo;
    }
}