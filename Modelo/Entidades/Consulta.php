<?php

class Consulta
{
    private $id;
    private $identificacion;
    private $nombreCompleto;
    private $telefono;
    private $correo;
    private $asunto;
    private $consulta;
    private $idConsultado;
    private $fecha;
    private $atendido;
    private $respuesta;
    private $respondidoPor;
    
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

    public function getConsulta() {
        return $this->consulta;
    }

    public function setConsulta($consulta) {
        $this->consulta = $consulta;
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

    public function getRespuesta() {
        return $this->respuesta;
    }

    public function setRespuesta($respuesta) {
        $this->respuesta = $respuesta;
    }

    public function getRespondidoPor() {
        return $this->atendido;
    }

    public function setRespondidoPor($atendido) {
        $this->atendido = $atendido;
    }
}
