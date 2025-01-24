<?php

class Usuario
{
    private $id;
    private $nombreUsuario;
    private $correo;
    private $pass;
    private $responsable;
    private $idPersona;
    private $idDepartamento;
    private $idEstado;
    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    public function setNombreUsuario($nombreUsuario): void
    {
        $this->nombreUsuario = $nombreUsuario;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function setCorreo($correo): void
    {
        $this->correo = $correo;
    }

    public function getPass()
    {
        return $this->pass;
    }

    public function setPass($pass): void
    {
        $this->pass = $pass;
    }

    public function getResponsable()
    {
        return $this->responsable;
    }

    public function setResponsable($responsable): void
    {
        $this->responsable = $responsable;
    }

    public function getIdPersona()
    {
        return $this->idPersona;
    }

    public function setIdPersona($idPersona): void
    {
        $this->idPersona = $idPersona;
    }

    public function getIdDepartamento()
    {
        return $this->idDepartamento;
    }

    public function setIdDepartamento($idDepartamento): void
    {
        $this->idDepartamento = $idDepartamento;
    }

    public function getIdEstado()
    {
        return $this->idEstado;
    }

    public function setIdEstado($idEstado): void
    {
        $this->idEstado = $idEstado;
    }

}