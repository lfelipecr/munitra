<?php

class Comision implements JsonSerializable
{
    private $id;
    private $descripcion;

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
    public function jsonSerialize(): array {
        return [
            'id' => $this->id,
            'descripcion' => $this->descripcion
        ];
    }
}