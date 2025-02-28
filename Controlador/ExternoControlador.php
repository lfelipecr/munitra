<?php
require_once './Modelo/Metodos/UsuarioM.php';
require_once './Modelo/Metodos/PersonaM.php';
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Metodos/SolicitudM.php';

class ExternoControlador
{
    function Index()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $vista = './Vista/TramitesUsuario/Dashboard/inicio.php';
            require_once './Vista/Utilidades/navbar.php';
        }
    }
}
