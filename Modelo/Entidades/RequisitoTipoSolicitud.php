<?php

class RequisitoTipoSolicitud
{
    private $id;
    private $descripcion;
    private $requerido;
    private $adjunto;
    private $tipoSolicitud; 
    private $tipoRequisito;
    
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

    public function getRequerido()
    {
        return $this->requerido;
    }

    public function setRequerido($requerido): void
    {
        $this->requerido = $requerido;
    }

    public function getAdjunto()
    {
        return $this->adjunto;
    }

    public function setAdjunto($adjunto): void
    {
        $this->adjunto = $adjunto;
    }

    public function getTipoSolicitud()
    {
        return $this->tipoSolicitud;
    }

    public function setTipoSolicitud($tipoSolicitud): void
    {
        $this->tipoSolicitud = $tipoSolicitud;
    }

    public function getTipoRequisito()
    {
        return $this->tipoRequisito;
    }

    public function setTipoRequisito($tipoRequisito): void
    {
        $this->tipoRequisito = $tipoRequisito;
    }
}