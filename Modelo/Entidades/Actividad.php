<?php
class Actividad {
    private $id;
    private $idUsuario;
    private $titulo;
    private $descripcionLarga;
    private $urlImagen;
    private $urlAdjunto;
    private $inhabilitada;
    private $fecha;
    
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function getIdUsuario() {
        return $this->idUsuario;
    }
    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }
    public function getTitulo() {
        return $this->titulo;
    }
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }
    public function getDescripcionLarga() {
        return $this->descripcionLarga;
    }
    public function setDescripcionLarga($descripcionLarga) {
        $this->descripcionLarga = $descripcionLarga;
    }
    public function getUrlImagen() {
        return $this->urlImagen;
    }
    public function setUrlImagen($urlImagen) {
        $this->urlImagen = $urlImagen;
    }
    public function getUrlAdjunto() {
        return $this->urlAdjunto;
    }
    public function setUrlAdjunto($urlAdjunto) {
        $this->urlAdjunto = $urlAdjunto;
    }
    public function getInhabilitada() {
        return $this->inhabilitada;
    }
    public function setInhabilitada($inhabilitada) {
        $this->inhabilitada = $inhabilitada;
    }
    public function getFecha() {
        return $this->fecha;
    }
    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }
}
