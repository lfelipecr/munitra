<?php
class Sesion{
    private $id;
    private $fecha;
    private $descripcion;
    private $actaAprobada;
    private $urlActa;
    private $urlAgenda;
    private $urlVideo;
    
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

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    public function getActaAprobada()
    {
        return $this->actaAprobada;
    }

    public function setActaAprobada($actaAprobada): void
    {
        $this->actaAprobada = $actaAprobada;
    }

    public function getUrlActa()
    {
        return $this->urlActa;
    }

    public function setUrlActa($urlActa): void
    {
        $this->urlActa = $urlActa;
    }

    public function getUrlAgenda()
    {
        return $this->urlAgenda;
    }

    public function setUrlAgenda($urlAgenda): void
    {
        $this->urlAgenda = $urlAgenda;
    }

    public function getUrlVideo()
    {
        return $this->urlVideo;
    }

    public function setUrlVideo($urlVideo): void
    {
        $this->urlVideo = $urlVideo;
    }


}