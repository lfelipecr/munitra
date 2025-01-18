<?php

class Lista
{
    private $id;
    private $idEvento;
    private $idUsuario;
    private $activo;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id): void
    {
        $this->id = $id;
    }
    public function getIdEvento()
    {
        return $this->idEvento;
    }
    public function setIdEvento($idEvento): void
    {
        $this->idEvento = $idEvento;
    }
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
    public function setIdUsuario($idUsuario): void
    {
        $this->idUsuario = $idUsuario;
    }
    public function getActivo()
    {
        return $this->activo;
    }
    public function setActivo($activo): void
    {
        $this->activo = $activo;
    }
}