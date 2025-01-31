<?php 

class ImagenUsuario{
    private $id;
    private $idUsuario;
    private $urlImagen;
    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario): void
    {
        $this->idUsuario = $idUsuario;
    }

    public function getUrlImagen()
    {
        return $this->urlImagen;
    }

    public function setUrlImagen($urlImagen): void
    {
        $this->urlImagen = $urlImagen;
    }

}