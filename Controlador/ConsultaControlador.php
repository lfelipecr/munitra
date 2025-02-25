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
            $consulta = new InteraccionConsulta();
            $persona = $personaM->BuscarPersonaUsuario($idUsuario);
            $consultaDatos = $consultaM->BuscarConsulta($idConsulta);
            //c:Se genera nuevo objeto
            //c:Se asocian los datos del ultimo registro de conv[]
            //c: Se asocia un array JSON con los adjuntos de la consulta
            $consulta->setTexto($cuerpo);
            $consulta->setInteractor($persona->getNombre().' '.$persona->getPrimerApellido().' '.$persona->getSegundoApellido());
            $consulta->setAdjuntos('');
            if (isset($_FILES['adjuntos'])){
                $archivo = false;
                $rutaDestino = './repo/';
                foreach($_FILES['adjuntos']['tmp_name'] as $adjunto => $tmp_name){
                    $archivo = true;
                    $urlArchivo = $rutaDestino.time().basename($_FILES['adjuntos']['name'][$adjunto]);
                    if (move_uploaded_file($tmp_name, $urlArchivo)) {
                        $adjuntos[] = $urlArchivo;
                    } else {
                        echo 'Ha habido un error con la subida del archivo'.$_FILES['adjuntos']['name'][$adjunto].', intente con otro archivo';
                        $archivo = false;
                        break;
                    }
                }
                if ($archivo){
                    $consulta->setAdjuntos(json_encode($adjuntos));
                }
            }
            $consulta->setIdConsulta($idConsulta);
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
                    $mail->addAddress(trim($consultaDatos->getCorreo()));
                    $mail->isHTML(true);
                    $cuerpoEmail = '<html><head><meta charset="UTF-8"><style>body {font-family: Arial, sans-serif; line-height: 1.6;color: #333;}.container { max-width: 600px; margin: 0 auto;padding: 20px;border: 1px solid #ddd;border-radius: 8px;background-color: #f9f9f9; }.title {font-size: 18px;font-weight: bold; color: #555;}.content {margin-top: 10px;}.info {margin-top: 15px;padding: 10px; background-color: #eef;border-left: 4px solidrgb(10, 41, 75);}</style></head><body><div class="container">';
                    $mail->Subject = 'Respuesta - Municipalidad de Río Cuarto: '.$consultaDatos->getAsunto();
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
                    if (!empty($_FILES['adjuntos']['name'][0])) {
                        for ($i = 0; $i < count($_FILES['adjuntos']['name']); $i++) {
                            $mail->addAttachment($_FILES['adjuntos']['tmp_name'][$i], $_FILES['adjuntos']['name'][$i]);
                        }
                    }
                    $mail->send();
                    echo 'OK';
                } catch(Exception $e){
                    var_dump($e);
                }
            } else {
                echo 'ERROR';
            }
        }
    }
    function EnviarConsulta()
    {
        $adjuntos = array();
        $consulta = new Consulta();
        $consultaM = new ConsultaM();
        $consulta->setIdentificacion($_POST['identificacion']);
        $consulta->setNombreCompleto($_POST['nombreCompleto']);
        $consulta->setTelefono($_POST['telefono']);
        $consulta->setCorreo($_POST['correo']);
        $consulta->setAsunto($_POST['asunto']);
        $consulta->setIdConsultado($_POST['idConsultado']);
        $consulta->setTipoConsulta($_POST['tipo']);
        $consultaInteraccion = new InteraccionConsulta();
        $consultaInteraccion->setTexto($_POST['consulta']);
        $consultaInteraccion->setInteractor($_POST['nombreCompleto']);
        $consultaInteraccion->setAdjuntos('');
        if (isset($_FILES['adjuntos'])){
            $archivo = false;
            $rutaDestino = './repo/';
            foreach($_FILES['adjuntos']['tmp_name'] as $adjunto => $tmp_name){
                $archivo = true;
                $urlArchivo = $rutaDestino.time().basename($_FILES['adjuntos']['name'][$adjunto]);
                if (move_uploaded_file($tmp_name, $urlArchivo)) {
                    $adjuntos[] = $urlArchivo;
                } else {
                    echo 'Ha habido un error con la subida del archivo'.$_FILES['adjuntos']['name'][$adjunto].', intente con otro archivo';
                    $archivo = false;
                    break;
                }
            }
            if ($archivo){
                $consultaInteraccion->setAdjuntos(json_encode($adjuntos));
            }
        }
        $consultaInteraccion->setRespuesta(0);
        //guarda los datos de la consulta
        if ($consultaM->IngresarConsulta($consulta)){
            $id = $consultaM->MaxId();
            //guarda la interacción
            $consultaInteraccion->setIdConsulta($id);
            if ($consultaM->IngresarDatosConsulta($consultaInteraccion)){
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
                                            <p id="consulta">'.$_POST['consulta'].'</p>
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
                    if (isset($_FILES['adjuntos'])){
                        for ($i = 0; $i < count($_FILES['adjuntos']['name']); $i++) {
                            $mail->addAttachment($_FILES['adjuntos']['tmp_name'][$i], $_FILES['adjuntos']['name'][$i]);
                        }
                    }
                    $mail->send();
                    echo $id;
                } catch(Exception $e){
                    var_dump($e);
                }
            }
        } else {
            echo '0';
        }
    }
    function ObtenerInteracciones(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            $id = $_GET['idConsulta'];
            $consultaM = new ConsultaM();
            echo $consultaM->BuscarInteracciones($id);
        }
    }
}