<?php
class PersonaSesion{
    private $id;
    private $idSesion;
    private $idPersona;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getIdSesion()
    {
        return $this->idSesion;
    }

    public function setIdSesion($idSesion): void
    {
        $this->idSesion = $idSesion;
    }

    public function getIdPersona()
    {
        return $this->idPersona;
    }

    public function setIdPersona($idPersona): void
    {
        $this->idPersona = $idPersona;
    }

}