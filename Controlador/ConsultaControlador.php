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

    }
    function EnviarConsulta()
    {
        $conv = array();
        $conv[] = $_POST['consulta'].'-'.date("Y-m-d H:i:s");
        $consulta = new Consulta();
        $consultaM = new ConsultaM();
        $consulta->setIdentificacion($_POST['identificacion']);
        $consulta->setNombreCompleto($_POST['nombreCompleto']);
        $consulta->setTelefono($_POST['telefono']);
        $consulta->setCorreo($_POST['correo']);
        $consulta->setAsunto($_POST['asunto']);
        $consulta->setConsulta(json_encode($conv));
        $consulta->setIdConsultado($_POST['idConsultado']);
        if ($consultaM->IngresarConsulta($consulta)){
            //enviar correo
            echo $consultaM->MaxId();
        } else {
            echo '0';
        }
    }
}