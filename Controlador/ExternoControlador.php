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
            $usuarioM = new UsuarioM();
            $persona = $personaM->BuscarPersonaUsuario($_SESSION['usuario']->getIdPersona());
            $usuario = $_SESSION['usuario']->getIdPersona();
            $estado = $usuarioM->BuscarUsuarioIdPersona($usuario)->getIdEstado();
            $vista = './Vista/TramitesUsuario/Dashboard/inicio.php';
            require_once './Vista/Utilidades/navbar.php';
        }
    }
}
