<?php
class Noticia implements JsonSerializable
{
    private $id;
    private $idUsuario;
    private $titulo;
    private $descripcionLarga;
    private $urlImagen;
    private $urlAdjunto;
    private $inhabilitada;
    private $fecha;
    private $autor;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }
    public function getTitulo()
    {
        return $this->titulo;
    }
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }
    public function getDescripcionLarga()
    {
        return $this->descripcionLarga;
    }
    public function setDescripcionLarga($descripcionLarga)
    {
        $this->descripcionLarga = $descripcionLarga;
    }
    public function getUrlImagen()
    {
        return $this->urlImagen;
    }
    public function setUrlImagen($urlImagen)
    {
        $this->urlImagen = $urlImagen;
    }
    public function getUrlAdjunto()
    {
        return $this->urlAdjunto;
    }
    public function setUrlAdjunto($urlAdjunto)
    {
        $this->urlAdjunto = $urlAdjunto;
    }
    public function getFecha()
    {
        return $this->fecha;
    }
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
    public function getInhabilitada()
    {
        return $this->inhabilitada;
    }
    public function setInhabilitada($inhabilitada)
    {
        $this->inhabilitada = $inhabilitada;
    }
    public function getAutor()
    {
        return $this->autor;
    }
    public function setAutor($autor)
    {
        $this->autor = $autor;
    }
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'idUsuario' => $this->idUsuario,
            'titulo' => $this->titulo,
            'descripcionLarga' => $this->descripcionLarga,
            'urlImagen' => $this->urlImagen,
            'urlAdjunto' => $this->urlAdjunto,
            'inhabilitada' => $this->inhabilitada,
            'fecha' => $this->fecha instanceof DateTime ? $this->fecha->format('Y-m-d H:i:s') : $this->fecha,
            'autor' => $this->autor
        ];
    }
}
