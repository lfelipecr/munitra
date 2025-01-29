<?php

class Barrio
{
    private $id;
    private $nombre;
    private $idProvincia;
    private $idDistrito;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id): void
    {
        $this->id = $id;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }
    public function getIdProvincia()
    {
        return $this->idProvincia;
    }
    public function setIdProvincia($idProvincia): void
    {
        $this->idProvincia = $idProvincia;
    }
    public function getIdDistrito()
    {
        return $this->idDistrito;
    }
    public function setIdDistrito($idDistrito): void
    {
        $this->idDistrito = $idDistrito;
    }
}