<?php

class EstadoSolicitud
{
    private $id;
    private $descripcion;
    private $prefijo;
    private $ultimoNumero;
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

    public function getPrefijo()
    {
        return $this->prefijo;
    }

    public function setPrefijo($prefijo): void
    {
        $this->prefijo = $prefijo;
    }

    public function getUltimoNumero()
    {
        return $this->ultimoNumero;
    }

    public function setUltimoNumero($ultimoNumero): void
    {
        $this->ultimoNumero = $ultimoNumero;
    }
}