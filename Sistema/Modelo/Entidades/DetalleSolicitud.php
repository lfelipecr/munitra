<?php

class DetalleSolicitud
{
    private $id;
    private $campoRequisito;
    private $adjuntoRequisito;
    private $cumple;
    private $idSolicitud;
    private $tipoRequisito;
    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getCampoRequisito()
    {
        return $this->campoRequisito;
    }

    public function setCampoRequisito($campoRequisito): void
    {
        $this->campoRequisito = $campoRequisito;
    }

    public function getAdjuntoRequisito()
    {
        return $this->adjuntoRequisito;
    }

    public function setAdjuntoRequisito($adjuntoRequisito): void
    {
        $this->adjuntoRequisito = $adjuntoRequisito;
    }

    public function getCumple()
    {
        return $this->cumple;
    }

    public function setCumple($cumple): void
    {
        $this->cumple = $cumple;
    }

    public function getIdSolicitud()
    {
        return $this->idSolicitud;
    }

    public function setIdSolicitud($idSolicitud): void
    {
        $this->idSolicitud = $idSolicitud;
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