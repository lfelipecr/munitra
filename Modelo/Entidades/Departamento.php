<?php

class Departamento implements JsonSerializable
{
    private $id;
    private $descripcion;
    private $jefe;
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
    public function getJefe()
    {
        return $this->jefe;
    }
    public function setJefe($jefe): void
    {
        $this->jefe = $jefe;
    }
    public function getBorrado()
    {
        return $this->borrado;
    }
    public function setBorrado($borrado): void
    {
        $this->borrado = $borrado;
    }
    public function jsonSerialize(): array {
        return [
            'id' => $this->id,
            'descripcion' => $this->descripcion,
            'jefe' => $this->jefe
        ];
    }
}