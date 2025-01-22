<?php

class PersonaDTO{
    private $id;
    private $idTipoIdentificacion;
    private $identificacion;
    private $nombre;
    private $primerApellido;
    private $segundoApellido;
    private $direccion;
    private $telefono;
    private $whatsapp;
    private $estado;
    private $situacion;
    private $montoMorosidad;
    private $montoAdeudado;
    private $consentimiento;
    private $fechaConsentimiento;
    private $propiedadFuera;
    private $fechaCreacion;
    private $fechaActualizacion;
    private $idDistrito;
    private $idCanton;
    private $idProvincia;
    private $usuarioCreacion;
    private $idUsuario;
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

    public function getIdTipoIdentificacion()
    {
        return $this->idTipoIdentificacion;
    }

    public function setIdTipoIdentificacion($idTipoIdentificacion): void
    {
        $this->idTipoIdentificacion = $idTipoIdentificacion;
    }

    public function getIdentificacion()
    {
        return $this->identificacion;
    }

    public function setIdentificacion($identificacion): void
    {
        $this->identificacion = $identificacion;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getPrimerApellido()
    {
        return $this->primerApellido;
    }

    public function setPrimerApellido($primerApellido): void
    {
        $this->primerApellido = $primerApellido;
    }

    public function getSegundoApellido()
    {
        return $this->segundoApellido;
    }

    public function setSegundoApellido($segundoApellido): void
    {
        $this->segundoApellido = $segundoApellido;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setDireccion($direccion): void
    {
        $this->direccion = $direccion;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setTelefono($telefono): void
    {
        $this->telefono = $telefono;
    }

    public function getWhatsapp()
    {
        return $this->whatsapp;
    }

    public function setWhatsapp($whatsapp): void
    {
        $this->whatsapp = $whatsapp;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado): void
    {
        $this->estado = $estado;
    }

    public function getSituacion()
    {
        return $this->situacion;
    }

    public function setSituacion($situacion): void
    {
        $this->situacion = $situacion;
    }

    public function getMontoMorosidad()
    {
        return $this->montoMorosidad;
    }

    public function setMontoMorosidad($montoMorosidad): void
    {
        $this->montoMorosidad = $montoMorosidad;
    }

    public function getMontoAdeudado()
    {
        return $this->montoAdeudado;
    }

    public function setMontoAdeudado($montoAdeudado): void
    {
        $this->montoAdeudado = $montoAdeudado;
    }

    public function getConsentimiento()
    {
        return $this->consentimiento;
    }

    public function setConsentimiento($consentimiento): void
    {
        $this->consentimiento = $consentimiento;
    }

    public function getFechaConsentimiento()
    {
        return $this->fechaConsentimiento;
    }

    public function setFechaConsentimiento($fechaConsentimiento): void
    {
        $this->fechaConsentimiento = $fechaConsentimiento;
    }

    public function getPropiedadFuera()
    {
        return $this->propiedadFuera;
    }

    public function setPropiedadFuera($propiedadFuera): void
    {
        $this->propiedadFuera = $propiedadFuera;
    }

    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    public function setFechaCreacion($fechaCreacion): void
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    public function getFechaActualizacion()
    {
        return $this->fechaActualizacion;
    }

    public function setFechaActualizacion($fechaActualizacion): void
    {
        $this->fechaActualizacion = $fechaActualizacion;
    }

    public function getIdDistrito()
    {
        return $this->idDistrito;
    }

    public function setIdDistrito($idDistrito): void
    {
        $this->idDistrito = $idDistrito;
    }

    public function getIdCanton()
    {
        return $this->idCanton;
    }

    public function setIdCanton($idCanton): void
    {
        $this->idCanton = $idCanton;
    }

    public function getIdProvincia()
    {
        return $this->idProvincia;
    }

    public function setIdProvincia($idProvincia): void
    {
        $this->idProvincia = $idProvincia;
    }

    public function getUsuarioCreacion()
    {
        return $this->usuarioCreacion;
    }

    public function setUsuarioCreacion($usuarioCreacion): void
    {
        $this->usuarioCreacion = $usuarioCreacion;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario): void
    {
        $this->idUsuario = $idUsuario;
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