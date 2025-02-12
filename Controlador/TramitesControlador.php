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
        $estado = $_SESSION['usuario']->getIdEstado();
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
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            session_start();
            if ($_SESSION['usuario']->getIdDepartamento() == 1){
                $solicitudM = new SolicitudM();
                $jsonData = $solicitudM->BuscarSolicitudes(4);
                $vista = './Vista/TramitesUsuario/Condonacion/listado.php';
                require_once './Vista/Utilidades/navbar.php';
            } else {
                $solicitudM = new SolicitudM();
                $jsonData = $solicitudM->BuscarSolicitudes(4);
                $vista = './Vista/Dashboard/Tramites/Condonacion/listado.php';
                require_once './Vista/Utilidades/sidebar.php';
            }
        }
    }
    function Declaraciones(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            session_start();
            if ($_SESSION['usuario']->getIdDepartamento() == 1){
                $vista = './Vista/TramitesUsuario/Declaraciones/listado.php';
                require_once './Vista/Utilidades/navbar.php';
            } else {
                $vista = './Vista/Dashboard/Tramites/Declaraciones/listado.php';
                require_once './Vista/Utilidades/sidebar.php';
            }
        }
    }
    function Credenciales(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            session_start();
            $idUsuario = $_SESSION['usuario']->getId();
            require_once './Vista/Login/credenciales.php';
        }       
    }
    function IngresarCodigo(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            $msg = '';
            require_once './Vista/Login/codigo.php';
        }
    }
}