<?php

class Conexion
{
    private $mysqli;

    function Ejecutar($query)
    {
        $name = "MUNITRA";
        $user = "root";
        $pass = "";

        if (!$this->mysqli = new mysqli('localhost', $user, $pass, $name)) {
            die('Error en conexion');
        }

        $this->mysqli->autocommit(TRUE);
        $resultado = $this->mysqli->query($query);
        return $resultado;
    }

    function Cerrar()
    {
        $this->mysqli->close();
    }
}
