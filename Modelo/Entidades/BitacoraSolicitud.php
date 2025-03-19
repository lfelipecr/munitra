<?php
class BitacoraSolicitud implements JsonSerializable
{
    private $id;
    private $idSolicitud;
    private $idUsuario;
    private $idEstado;
    private $fecha;
    private $nota;
    private $detalle;
    private $interno;
    private $adjuntos;
    private $usuario;

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

    public function getAdjuntos()
    {
        return $this->adjuntos;
    }

    public function setAdjuntos($adjuntos): void
    {
        $this->adjuntos = $adjuntos;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario): void
    {
        $this->usuario = $usuario;
    }
    
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'idSolicitud' => $this->idSolicitud,
            'idUsuario' => $this->idUsuario,
            'idEstado' => $this->idEstado,
            'fecha' => $this->fecha instanceof DateTime ? $this->fecha->format('Y-m-d H:i:s') : $this->fecha,
            'nota' => $this->nota,
            'detalle' => $this->detalle,
            'interno' => $this->interno,
            'adjuntos' => is_array($this->adjuntos) ? $this->adjuntos : ($this->adjuntos ? [$this->adjuntos] : []),
            'usuario' => $this->usuario instanceof JsonSerializable ? $this->usuario->jsonSerialize() : $this->usuario
        ];
    }
}
