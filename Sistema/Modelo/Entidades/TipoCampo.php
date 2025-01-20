<?php

class TipoCampo{
    private $id;
    private $descripcion;
    private $formatoCampo;
    private $tipoControl;
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

    public function getFormatoCampo()
    {
        return $this->formatoCampo;
    }

    public function setFormatoCampo($formatoCampo): void
    {
        $this->formatoCampo = $formatoCampo;
    }

    public function getTipoControl()
    {
        return $this->tipoControl;
    }

    public function setTipoControl($tipoControl): void
    {
        $this->tipoControl = $tipoControl;
    }

}