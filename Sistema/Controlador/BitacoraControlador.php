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
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'fallguy012@gmail.com';
                $mail->Password = 'sxoyyegflksvnvip';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                $mail->setFrom('fallguy012@gmail.com');
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