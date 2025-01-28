<?php
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Metodos/PersonaM.php';
class BitacoraControlador{
    function EnviarEmail(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            $personaM = new PersonaM();
            $persona = $personaM->BuscarPersona($_POST['idSolicitante']);
            $cuerpoEmail = $_POST['cuerpoEmail'];
            $asuntoEmail = $_POST['asuntoEmail'];
            var_dump($persona);
        }
    }
}