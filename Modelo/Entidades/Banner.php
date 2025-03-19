<?php

class Banner implements JsonSerializable
{
    private $id;
    private $descripcion;
    private $url;
    private $activo;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id): void
    {
        $this->id = $id;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function setDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
    }
    public function getUrl()
    {
        return $this->url;
    }
    public function setUrl($url): void
    {
        $this->url = $url;
    }
    public function getActivo()
    {
        return $this->activo;
    }
    public function setActivo($activo): void
    {
        $this->activo = $activo;
    }
    public function jsonSerialize(): array {
        return [
            'id' => $this->id,
            'descripcion' => $this->descripcion,
            'url' => $this->url,
            'activo' => $this->activo,
        ];
    }
}