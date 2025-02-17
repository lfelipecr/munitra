<?php 
class BitacoraSolicitud {
    private $id;
    private $idSolicitud;
    private $idUsuario;
    private $idEstado;
    private $fecha;
    private $nota;
    private $detalle;
    private $interno;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getIdSolicitud()
    {
        return $this->idSolicitud;
    }

    public function setIdSolicitud($idSolicitud): void
    {
        $this->idSolicitud = $idSolicitud;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario): void
    {
        $this->idUsuario = $idUsuario;
    }

    public function getIdEstado()
    {
        return $this->idEstado;
    }

    public function setIdEstado($idEstado): void
    {
        $this->idEstado = $idEstado;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha): void
    {
        $this->fecha = $fecha;
    }

    public function getNota()
    {
        return $this->nota;
    }

    public function setNota($nota): void
    {
        $this->nota = $nota;
    }

    public function getDetalle()
    {
        return $this->detalle;
    }

    public function setDetalle($detalle): void
    {
        $this->detalle = $detalle;
    }

    public function getInterno()
    {
        return $this->interno;
    }

    public function setInterno($interno): void
    {
        $this->interno = $interno;
    }

}