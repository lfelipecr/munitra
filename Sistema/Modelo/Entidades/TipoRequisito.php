<?php

class TipoRequisito
{
    private $id;
    private $descripcion;
    private $idTipoCampo;
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

    public function getIdTipoCampo()
    {
        return $this->idTipoCampo;
    }

    public function setIdTipoCampo($idTipoCampo): void
    {
        $this->idTipoCampo = $idTipoCampo;
    }
}