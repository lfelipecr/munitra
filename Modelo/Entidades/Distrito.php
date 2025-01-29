<?php

class Distrito
{
    private $id;
    private $nombre;
    private $idProvincia;
    private $idCanton;

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
    public function getIdCanton()
    {
        return $this->idCanton;
    }
    public function setIdCanton($idCanton): void
    {
        $this->idCanton = $idCanton;
    }
}