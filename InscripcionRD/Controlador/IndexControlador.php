<?php
require_once './Modelo/Conexion.php';
require_once './Modelo/Entidades/Usuario.php';
require_once './Modelo/Metodos/UsuarioM.php';
class IndexControlador
{
    function Index()
    {
        require_once './Vista/Login/login.php';
    }
}