<?php 
require_once './Modelo/Entidades/Usuario.php';
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Metodos/SolicitudM.php';

class TramitesControlador {
    function Index(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            $u->LlamarVista('./Vista/Dashboard/Tramites/listadoOpciones.php');
        }
    }
    function ListadoTramites(){
        session_start();
        $usuario = $_SESSION['usuario']->getIdPersona();
        $vista = './Vista/TramitesUsuario/listadoTramites.php';
        require_once './Vista/Utilidades/navbar.php';
    }
    function Patentes(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            session_start();
            if ($_SESSION['usuario']->getIdDepartamento() == 1){
                $solicitudM = new SolicitudM();
                $jsonData = $solicitudM->BuscarSolicitudes(1);
                $usuario = $_SESSION['usuario']->getId();
                $vista = './Vista/TramitesUsuario/Patentes/listado.php';
                require_once './Vista/Utilidades/navbar.php';
            } else {
                $solicitudM = new SolicitudM();
                $jsonData = $solicitudM->BuscarSolicitudes(1);
                $vista = './Vista/Dashboard/Tramites/Patentes/listado.php';
                require_once './Vista/Utilidades/sidebar.php';
            }
            
        }
    }
    function UsoSuelo(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            session_start();
            if ($_SESSION['usuario']->getIdDepartamento() == 1){
                $solicitudM = new SolicitudM();
                $jsonData = $solicitudM->BuscarSolicitudes(2);
                $vista = './Vista/TramitesUsuario/UsoSuelo/listado.php';
                require_once './Vista/Utilidades/navbar.php';
            } else {
                $solicitudM = new SolicitudM();
                $jsonData = $solicitudM->BuscarSolicitudes(2);
                $vista = './Vista/Dashboard/Tramites/UsoSuelo/listado.php';
                require_once './Vista/Utilidades/sidebar.php';
            }
        }
    }
    function Visado (){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            session_start();
            if ($_SESSION['usuario']->getIdDepartamento() == 1){
                $solicitudM = new SolicitudM();
                $jsonData = $solicitudM->BuscarSolicitudes(3);
                $vista = './Vista/TramitesUsuario/Visado/listado.php';
                require_once './Vista/Utilidades/navbar.php';
            } else {
                $solicitudM = new SolicitudM();
                $jsonData = $solicitudM->BuscarSolicitudes(3);
                $vista = './Vista/Dashboard/Tramites/Visado/listado.php';
                require_once './Vista/Utilidades/sidebar.php';
            }
        }
    }
    function Condonacion(){

    }
    function Declaraciones(){

    }
}