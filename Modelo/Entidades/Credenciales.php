<?php
class Credenciales{
    private $id;
    private $idUsuario;
    private $codigo;
    private $urlImagen;
    private $urlConsentimiento;
    private $firma;
    
    public function getId() {
        return $this->id;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function getUrlImagen() {
        return $this->urlImagen;
    }

    public function getUrlConsentimiento() {
        return $this->urlConsentimiento;
    }
    public function getFirma() {
        return $this->firma;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function setUrlImagen($urlImagen) {
        $this->urlImagen = $urlImagen;
    }
    public function setUrlConsentimiento($urlConsentimiento) {
        $this->urlConsentimiento = $urlConsentimiento;
    }
    public function setFirma($firma) {
        $this->firma = $firma;
    }
}