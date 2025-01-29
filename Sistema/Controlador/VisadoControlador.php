<?php 
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Metodos/SolicitudM.php';
require_once './Modelo/Metodos/ProvinciaM.php';
require_once './Modelo/Metodos/PersonaM.php';
require_once './Modelo/Entidades/DetalleSolicitud.php';

class VisadoControlador {
    private function LlamarVistaIngresar($msg){
        $personaM = new PersonaM();
        $provinciaM = new ProvinciaM();
        $personas = $personaM->ListadoPersonas();
        $distritos = $provinciaM->BuscarDistritos();
        $vista = './Vista/Dashboard/Tramites/Visado/nuevo.php';
        require_once './Vista/Utilidades/sidebar.php';
    }
    function VIngresar(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            $this->LlamarVistaIngresar('');
        }
    }
}