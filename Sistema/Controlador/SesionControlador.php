<?php 
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Entidades/Sesion.php';
require_once './Modelo/Entidades/PersonaSesion.php';
require_once './Modelo/Metodos/SesionM.php';
require_once './Modelo/Metodos/PersonaM.php';

class SesionControlador{
    function VIngresar(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            $personaM = new PersonaM();
            $msg = '';
            $personas = $personaM->ListadoPersonas();
            $vista = './Vista/Dashboard/Blog/Sesiones/nuevo.php';
            require_once './Vista/Utilidades/sidebar.php';
        }
    }
    function VActualizar(){
        echo 'Actualizar';
    }
}