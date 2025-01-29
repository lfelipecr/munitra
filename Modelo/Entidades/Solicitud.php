<?php

class Solicitud{
    private $id;
    private $fecha;
    private $idPersona;
    private $idUsuario;
    private $estadoSolicitud;
    private $tipoSolicitud;
    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha): void
    {
        $this->fecha = $fecha;
    }

    public function getIdPersona()
    {
        return $this->idPersona;
    }

    public function setIdPersona($idPersona): void
    {
        $this->idPersona = $idPersona;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario): void
    {
        $this->idUsuario = $idUsuario;
    }

    public function getEstadoSolicitud()
    {
        return $this->estadoSolicitud;
    }

    public function setEstadoSolicitud($estadoSolicitud): void
    {
        $this->estadoSolicitud = $estadoSolicitud;
    }

    public function getTipoSolicitud()
    {
        return $this->tipoSolicitud;
    }

    public function setTipoSolicitud($tipoSolicitud): void
    {
        $this->tipoSolicitud = $tipoSolicitud;
    }

}