<?php 
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Metodos/SolicitudM.php';

class TramitesControlador {
    function Index(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            $u->LlamarVista('./Vista/Dashboard/Tramites/listadoOpciones.php');
        }
    }
    function Patentes(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            $solicitudM = new SolicitudM();
            $jsonData = $solicitudM->BuscarSolicitudes();
            $vista = './Vista/Dashboard/Tramites/Patentes/listado.php';
            require_once './Vista/Utilidades/sidebar.php';
        }
    }
    function UsoSuelo(){

    }
    function Visado (){

    }
    function Condonacion(){

    }
    function Declaraciones(){

    }
}