<?php

class TipoSolicitud
{
    private $id;
    private $descripcion;
    private $idDepartamento;
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

    public function getIdDepartamento()
    {
        return $this->idDepartamento;
    }

    public function setIdDepartamento($idDepartamento): void
    {
        $this->idDepartamento = $idDepartamento;
    }
}