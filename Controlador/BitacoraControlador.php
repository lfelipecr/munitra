<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Entidades/BitacoraSolicitud.php';
require_once './Modelo/Metodos/BitacoraSolicitudM.php';
require_once './Modelo/Metodos/PersonaM.php';
require_once './Modelo/Metodos/SolicitudM.php';

class BitacoraControlador{
    function EnviarEmail(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            $personaM = new PersonaM();
            $solicitudM = new SolicitudM();
            $persona = $personaM->BuscarPersona($_POST['idSolicitante']);
            $solicitud = $solicitudM->BuscarCabeceraSolicitud($_POST['idSolicitud']);
            $cuerpoEmail = $_POST['cuerpoEmail'];
            $asuntoEmail = $_POST['asuntoEmail'];
            $mail = new PHPMailer();
            try{
                session_start();
                $bitacora = new BitacoraSolicitud();
                $bitacoraM = new BitacoraSolicitudM();
                $credenciales = $bitacoraM->CredencialesSMTP();
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Encoding = "base64";
                $mail->Host = $credenciales['host'];
                $mail->SMTPAuth = true;
                $mail->Username = $credenciales['user'];
                $mail->Password = $credenciales['key'];
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                $mail->setFrom($credenciales['from']);
                $mail->addAddress($persona->getCorreo());
                $mail->isHTML(true);
                $mail->Subject = $asuntoEmail;
                $mail->Body = $cuerpoEmail;
                $mail->send();
                $bitacora->setIdSolicitud($solicitud->getId());
                $bitacora->setIdUsuario($_SESSION['usuario']->getId());
                $bitacora->setIdEstado($solicitud->getEstadoSolicitud());
                $bitacora->setNota($asuntoEmail);
                $bitacora->setDetalle($cuerpoEmail);
                $bitacoraM->IngresarBitacora($bitacora);
                header('location: index.php?controlador=Tramites&metodo=Index');
            } catch (Exception $ex){
                var_dump($ex);
            }
        }
    }
}