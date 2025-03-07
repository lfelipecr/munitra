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
            $personaM = new PersonaM();
            $persona = $personaM->BuscarPersonaUsuario($_SESSION['usuario']->getIdPersona());
            $vista = './Vista/TramitesUsuario/Dashboard/inicio.php';
            require_once './Vista/Utilidades/navbar.php';
        }
    }
}
