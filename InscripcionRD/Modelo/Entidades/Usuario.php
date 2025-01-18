<?php

class Usuario
{
    private $id;
    private $idCedula;
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $idRol;
    private $activo;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id): void
    {
        $this->id = $id;
    }
    public function getIdCedula()
    {
        return $this->idCedula;
    }
    public function setIdCedula($idCedula): void
    {
        $this->idCedula = $idCedula;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }
    public function getApellido1()
    {
        return $this->apellido1;
    }
    public function setApellido1($apellido1): void
    {
        $this->apellido1 = $apellido1;
    }
    public function getApellido2()
    {
        return $this->apellido2;
    }
    public function setApellido2($apellido2): void
    {
        $this->apellido2 = $apellido2;
    }
    public function getIdRol()
    {
        return $this->idRol;
    }
    public function setIdRol($idRol): void
    {
        $this->idRol = $idRol;
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