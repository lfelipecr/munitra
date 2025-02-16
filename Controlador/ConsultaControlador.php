<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Entidades/Usuario.php';
require_once './Modelo/Metodos/PersonaM.php';
require_once './Modelo/Metodos/ConsultaM.php';
require_once './Modelo/Entidades/Consulta.php';

class ConsultaControlador{
    function ResponderConsulta()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            $idUsuario = $_SESSION['usuario']->getIdPersona();
            unset($_SESSION['consulta']);
            $idConsulta = $_POST['idConsulta'];
            $cuerpo = $_POST['cuerpo'];
            $consultaM = new ConsultaM();
            $personaM = new PersonaM();
            $consulta = new Consulta();
            $persona = $personaM->BuscarPersonaUsuario($idUsuario);
            $consulta = $consultaM->BuscarConsulta($idConsulta);
            if ($consulta->getRespuesta() == NULL){
                $conv = array();
                $conv[] = $cuerpo.' - '.date("Y-m-d H:i:s").' - '.$persona->getNombre().' '.$persona->getPrimerApellido().' '.$persona->getSegundoApellido();
            } else {
                $conv = json_decode($consulta->getRespuesta());
                $conv[] = $cuerpo.' - '.date("Y-m-d H:i:s").' - '.$persona->getNombre().' '.$persona->getPrimerApellido().' '.$persona->getSegundoApellido();
            }
            $consulta->setAtendido(1);
            $consulta->setRespondidoPor($idUsuario);
            $consulta->setRespuesta(json_encode($conv));
            if ($consultaM->AtenderConsulta($consulta)){
                echo 'OK';
            } else {
                echo 'ERROR';
            }
        }
    }
    function ActualizarConsulta(){
        $idConsulta = $_POST['idConsulta'];
        $consultaCuerpo = $_POST['consulta'];
        $consultaM = new ConsultaM();
        $consulta = new Consulta();
        $consulta = $consultaM->BuscarConsulta($idConsulta);
        $conv = json_decode($consulta->getConsulta());
        $conv[] = $consultaCuerpo.' - '.date("Y-m-d H:i:s").' - '.$consulta->getNombreCompleto().' ('.$consulta->getIdentificacion().')';
        $consulta->setConsulta(json_encode($conv));
        var_dump($consulta);
        if ($consultaM->ActualizarConsulta($consulta)){
            echo 'OK';
        } else {
            echo 'ERROR';
        }
    }
    function EnviarConsulta()
    {
        $conv = array();
        $conv[] = $_POST['consulta'].' - '.date("Y-m-d H:i:s").' - '.$_POST['nombreCompleto'].' ('.$_POST['identificacion'].')';
        $consulta = new Consulta();
        $consultaM = new ConsultaM();
        $consulta->setIdentificacion($_POST['identificacion']);
        $consulta->setNombreCompleto($_POST['nombreCompleto']);
        $consulta->setTelefono($_POST['telefono']);
        $consulta->setCorreo($_POST['correo']);
        $consulta->setAsunto($_POST['asunto']);
        $consulta->setConsulta(json_encode($conv));
        $consulta->setIdConsultado($_POST['idConsultado']);
        $consulta->setTipoConsulta(1);
        if ($consultaM->IngresarConsulta($consulta)){
            //enviar correo
            $id = $consultaM->MaxId();
            echo $id;
            session_start();
            $consulta->setId($id);
            $_SESSION['consulta'] = $consulta;
        } else {
            echo '0';
        }
    }
}