<?php

class InteraccionConsulta
{
    private $id;
    private $texto;
    private $adjuntos;
    private $fecha;
    private $interactor;
    private $respuesta;
    private $idConsulta;    
    
    public function getId() {
        return $this->id;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function getAdjuntos() {
        return $this->adjuntos;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getInteractor() {
        return $this->interactor;
    }

    public function getRespuesta() {
        return $this->respuesta;
    }

    public function getIdConsulta() {
        return $this->idConsulta;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTexto($texto) {
        $this->texto = $texto;
    }

    public function setAdjuntos($adjuntos) {
        $this->adjuntos = $adjuntos;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setInteractor($interactor) {
        $this->interactor = $interactor;
    }

    public function setRespuesta($respuesta) {
        $this->respuesta = $respuesta;
    }

    public function setIdConsulta($idConsulta) {
        $this->idConsulta = $idConsulta;
    }
}
