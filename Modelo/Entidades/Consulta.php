<?php

class Consulta
{
    private $id;
    private $identificacion;
    private $nombreCompleto;
    private $telefono;
    private $correo;
    private $asunto;
    private $idConsultado;
    private $fecha;
    private $atendido;
    private $tipoConsulta;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIdentificacion() {
        return $this->identificacion;
    }

    public function setIdentificacion($identificacion) {
        $this->identificacion = $identificacion;
    }

    public function getNombreCompleto() {
        return $this->nombreCompleto;
    }

    public function setNombreCompleto($nombreCompleto) {
        $this->nombreCompleto = $nombreCompleto;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function getAsunto() {
        return $this->asunto;
    }

    public function setAsunto($asunto) {
        $this->asunto = $asunto;
    }

    public function getIdConsultado() {
        return $this->idConsultado;
    }

    public function setIdConsultado($idConsultado) {
        $this->idConsultado = $idConsultado;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function getAtendido() {
        return $this->atendido;
    }

    public function setAtendido($atendido) {
        $this->atendido = $atendido;
    }
    
    public function getTipoConsulta() {
        return $this->tipoConsulta;
    }

    public function setTipoConsulta($tipoConsulta) {
        $this->tipoConsulta = $tipoConsulta;
    }
}
