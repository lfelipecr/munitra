<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Entidades/Usuario.php';
require_once './Modelo/Metodos/PersonaM.php';
require_once './Modelo/Metodos/ConsultaM.php';
require_once './Modelo/Entidades/Consulta.php';
require_once './Modelo/Metodos/BitacoraSolicitudM.php';
require_once './Modelo/Metodos/UsuarioM.php';

class ConsultaControlador{
    function ResponderConsulta()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            $idUsuario = $_SESSION['usuario']->getIdPersona();
            //unset($_SESSION['consulta']);
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
                //Email
                try{
                    $bitacoraM = new BitacoraSolicitudM();
                    $credenciales = $bitacoraM->CredencialesSMTP();
                    $mail = new PHPMailer();
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                    $mail->isSMTP();
                    $mail->Encoding = "base64";
                    $mail->CharSet = "UTF-8";
                    $mail->Host = $credenciales['host'];
                    $mail->SMTPAuth = true;
                    $mail->Username = $credenciales['user'];
                    $mail->Password = $credenciales['key'];
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;
                    $mail->setFrom($credenciales['from']);
                    //cambiar
                    $mail->addAddress(trim($consulta->getCorreo()));
                    $mail->isHTML(true);
                    //Trata la string para que sea solo el contenido y no todo el JSON
                    //preg_match('/^(.*?) - \d{4}-\d{2}-\d{2}/', substr($cuerpo, 2, -2), $matches);
                    $cuerpoEmail = '<html><head><meta charset="UTF-8"><style>body {font-family: Arial, sans-serif; line-height: 1.6;color: #333;}.container { max-width: 600px; margin: 0 auto;padding: 20px;border: 1px solid #ddd;border-radius: 8px;background-color: #f9f9f9; }.title {font-size: 18px;font-weight: bold; color: #555;}.content {margin-top: 10px;}.info {margin-top: 15px;padding: 10px; background-color: #eef;border-left: 4px solidrgb(10, 41, 75);}</style></head><body><div class="container">';
                    $mail->Subject = 'Respuesta - Municipalidad de Río Cuarto: '.$consulta->getAsunto();
                    $cuerpoEmail = $cuerpoEmail.'<p class="title">Municipalidad de Río Cuarto</p>';
                    $cuerpoEmail = $cuerpoEmail.'<div class="content">">
                                            <p><strong>Respuesta:</strong> </br></p>
                                            <p id="consulta">
                                                '.$cuerpo.'
                                            </p>
                                            <p><strong>Atte:</strong> '.$persona->getNombre().' '.$persona->getPrimerApellido().' '.$persona->getSegundoApellido().'</p>
                                            </div>
                                        </div>
                                    </body>
                                    </html>';
                    $mail->Body = $cuerpoEmail;
                    $mail->send();
                    //$_SESSION['consulta'] = $consulta;
                    echo 'OK';
                } catch(Exception $e){
                    var_dump($e);
                }
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
        $consulta->setTipoConsulta($_POST['tipo']);
        if ($consultaM->IngresarConsulta($consulta)){
            $id = $consultaM->MaxId();
            session_start();
            $consulta->setId($id);
            try{
                $bitacoraM = new BitacoraSolicitudM();
                $credenciales = $bitacoraM->CredencialesSMTP();
                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->Encoding = "base64";
                $mail->CharSet = "UTF-8";
                $mail->Host = $credenciales['host'];
                $mail->SMTPAuth = true;
                $mail->Username = $credenciales['user'];
                $mail->Password = $credenciales['key'];
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                $mail->setFrom($credenciales['from']);
                //cambiar
                if ($_POST['idConsultado'] == '0'){
                    $mail->addAddress('martinezcgabriel24@gmail.com');
                } else {
                    $usuarioM = new UsuarioM();
                    $email = $usuarioM->BuscarUsuarioId($_POST['idConsultado'])->getCorreo();
                    $mail->addAddress($email);
                }
                
                $mail->isHTML(true);
                //Trata la string para que sea solo el contenido y no todo el JSON
                preg_match('/^(.*?) - \d{4}-\d{2}-\d{2}/', substr($consulta->getConsulta(), 2, -2), $matches);
                $consultaTrim = trim($matches[1]);
                $cuerpoEmail = '<html><head><meta charset="UTF-8"><title>Nueva Consulta</title><style>body {font-family: Arial, sans-serif; line-height: 1.6;color: #333;}.container { max-width: 600px; margin: 0 auto;padding: 20px;border: 1px solid #ddd;border-radius: 8px;background-color: #f9f9f9; }.title {font-size: 18px;font-weight: bold; color: #555;}.content {margin-top: 10px;}.info {margin-top: 15px;padding: 10px; background-color: #eef;border-left: 4px solidrgb(10, 41, 75);}</style></head><body><div class="container">';
                if ($consulta->getTipoConsulta() == 1){
                    $mail->Subject = 'Consulta: '.$consulta->getAsunto();
                    $cuerpoEmail = $cuerpoEmail.'<p class="title">Nueva Consulta de '.$consulta->getNombreCompleto().' ('.$consulta->getIdentificacion().')</p>';
                } else {
                    $mail->Subject = 'Denuncia: '.$consulta->getAsunto();
                    $cuerpoEmail = $cuerpoEmail.'<p class="title">Nueva Denuncia de '.$consulta->getNombreCompleto().' ('.$consulta->getIdentificacion().')</p>';
                }
                $cuerpoEmail = $cuerpoEmail.'<div class="content">">
                                        <p><strong>Asunto:</strong> '.$consulta->getAsunto().'</p>
                                        <p><strong>Consulta:</strong> </br></p>
                                        <p id="consulta">'.$consultaTrim.'</p>
                                        <div class="info">
                                            <h3 class="">Información del remitente:</h3>
                                            <p><strong>Identificación:</strong> '.$consulta->getIdentificacion().'</p>
                                            <p><strong>Nombre Completo:</strong> '.$consulta->getNombreCompleto().'</p>
                                            <p><strong>Teléfono:</strong> '.$consulta->getTelefono().'</p>
                                            <p><strong>Correo:</strong> '.$consulta->getCorreo().'</p>
                                        </div>
                                        </div>
                                    </div>
                                </body>
                                </html>';
                $mail->Body = $cuerpoEmail;
                $mail->send();
                //$_SESSION['consulta'] = $consulta;
                echo $id;
            } catch(Exception $e){
                var_dump($e);
            }
        } else {
            echo '0';
        }
    }
}