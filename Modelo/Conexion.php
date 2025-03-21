<?php

class Conexion
{
    private $mysqli;

    function Ejecutar($query)
    {
        $name = "MUNITRA";
        $user = "root";
        $pass = "";

        $this->mysqli = new mysqli('localhost', $user, $pass, $name);

        if ($this->mysqli->connect_error) {
            Logger::error("Error en Conexión: " . $this->mysqli->connect_error);
            die('Error en conexión: ' . $this->mysqli->connect_error);
        }

        $this->mysqli->autocommit(TRUE);
        $resultado = $this->mysqli->query($query);

        if (!$resultado) {
            Logger::error("Error en ejecución SQL: " . $this->mysqli->error . " | Query: " . $query);
            return false;
        }

        Logger::info("Ejecución Correcta BD: " . $query);
        return $resultado;
    }


    function Cerrar()
    {
        $this->mysqli->close();
    }
}
