<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use setasign\Fpdi\Fpdi;
use setasign\Fpdf\Fpdf;

require_once './vendor/autoload.php';
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Metodos/UsuarioM.php';
require_once './Modelo/Entidades/Usuario.php';
require_once './Modelo/Metodos/ProvinciaM.php';
require_once './Modelo/Entidades/Credenciales.php';
require_once './Modelo/Metodos/CredencialesM.php';
require_once './Modelo/Metodos/PersonaM.php';
require_once './Modelo/Entidades/Consulta.php';
require_once './Modelo/Metodos/ConsultaM.php';
require_once './Modelo/Metodos/BitacoraSolicitudM.php';

class LoginControlador
{
    function CambiarContra()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $contra = $_POST['contra'];
            $id = $_SESSION['usuario']->getId();
            $usuarioM = new UsuarioM();
            if ($usuarioM->CambiarContra($contra, $id))
                echo '200';
            else
                echo '401';
        }
    }
    //Codigo para cambio de contraseña
    function VerificarCodigo()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            if (isset($_SESSION['codigo'])) {
                $codigo = $_SESSION['codigo'];
                $codigoEnviado = $_POST['codigo'];
                if ($codigo == $codigoEnviado) {
                    Logger::info("Código verificado correctamente");
                    unset($_SESSION['codigo']);
                    echo '200';
                } else {
                    Logger::warning("El código no se ha podido verificar");
                    echo '401';
                }
            } else {
                echo '404';
            }
        }
    }
    //Codigo para cambio de contraseña
    function GenerarCodigo()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $codigo = substr(bin2hex(random_bytes(8)), 0, 8);
            $correo = $_SESSION['usuario']->getCorreo();
            $_SESSION['codigo'] = $codigo;
            echo $codigo;
            //enviar correo
            $msg = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Código de Confirmación</title><style>body {font-family: Arial, sans-serif;background-color: #f4f4f4;margin: 0;padding: 20px;}.container {max-width: 600px;background-color: #ffffff;padding: 20px;margin: auto;border-radius: 10px;box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);text-align: center;}.header {font-size: 24px;color: #333;margin-bottom: 20px;}.code {font-size: 30px;font-weight: bold;color: #0f1a4f;background-color: #f0f8ff;display: inline-block;padding: 10px 20px;border-radius: 5px;letter-spacing: 5px;margin: 10px 0;}.footer {font-size: 14px;color: #666;margin-top: 20px;}</style></head><body><div class="container"><div class="header"><img src="https://155.138.227.216/munitra/Web/assets/img/Municipalidad%20de%20Rio%20Cuarto.png" alt=""></div><div class="header">Código de Confirmación - Municipalidad de Río Cuarto</div><p>Usa el siguiente código para completar tu proceso de verificación:</p><div class="code">' . $codigo . '</div><p>Si no solicitaste este código, ignora este mensaje.</p><div class="footer">© 2024 Municipalidad de Río Cuarto. Todos los derechos reservados.</div></div></body></html>';
            $mail = new PHPMailer();
            try {
                session_start();
                $bitacoraM = new BitacoraSolicitudM();
                $credenciales = $bitacoraM->CredencialesSMTP();
                $mail->isSMTP();
                $mail->CharSet = "UTF-8";
                $mail->Encoding = "base64";
                $mail->Host = $credenciales['host'];
                $mail->SMTPAuth = true;
                $mail->Username = $credenciales['user'];
                $mail->Password = $credenciales['key'];
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                $mail->setFrom($credenciales['from']);
                $mail->addAddress($correo);
                $mail->isHTML(true);
                $mail->Subject = 'Municipalidad de Río Cuarto | Cambiar Contraseña';
                $mail->Body = $msg;
                ob_start();
                if (!$mail->send()) {
                    echo "Error: " . $mail->ErrorInfo;
                }
                $log = ob_get_clean();
                Logger::info("Correo de validación de código para cambio de contraseña: " . $log);
            } catch (Exception $ex) {
                Logger::error("Excepción en controlador (phpmailer): " . $ex->getMessage());
            }
        }
    }
    function Index()
    {
        session_start();
        $msg = '';
        require_once './Vista/Login/login.php';
    }
    function InicioTramites()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            header('location: index.php?controlador=Tramites&metodo=InicioExterno');
        }
    }
    function AdminInicio()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $consultaM = new ConsultaM();
            $personaM = new PersonaM();
            $idUsuario = $_SESSION['usuario']->getId();
            $depto = $_SESSION['usuario']->getIdDepartamento();
            $persona = $personaM->BuscarPersonaUsuario($_SESSION['usuario']->getIdPersona());
            $jsonData = $consultaM->BuscarConsultas();
            $vista = './Vista/Dashboard/inicio.php';
            require_once './Vista/Utilidades/sidebar.php';
        }
    }
    function IngresarCredenciales()
    {
        $credenciales = new Credenciales();
        $credencialesM = new CredencialesM();
        if (isset($_POST['firma'])) {
            //guarda la firma del usuario
            $firma = $_POST['firma'];
            $firma = str_replace("data:image/png;base64,", "", $firma);
            $firma = str_replace(" ", "+", $firma);
            $imagen = base64_decode($firma);
            $archivo = "repo/firmas/firma_" . time() . ".png";
            file_put_contents($archivo, $imagen);
            Logger::info("Generación de firma en: " . $archivo);
            //modifica el objeto de credenciales
            $credenciales->setFirma($archivo);
            $credenciales->setIdUsuario($_POST['idUsuario']);
            session_start();
            //modifica el estado del usuario
            $usuarioM = new UsuarioM();
            $usuario = $_SESSION['usuario'];
            $usuario->setIdEstado(5);
            //obtiene los datos de la persona
            $personaM = new PersonaM();
            $persona = $personaM->BuscarPersonaUsuario($usuario->getIdPersona());
            //obtiene el distrito
            $provinciaM = new ProvinciaM();
            $descLocaciones = $provinciaM->LocacionesId($persona->getIdProvincia(), $persona->getIdCanton(), $persona->getIdDistrito());
            //arma el pdf
            $pdf = new Fpdi();
            $pdf->SetAutoPageBreak(false);
            $sourceFile = './repo/serverside/consentimientoInformado.pdf';
            $numberOfPages = $pdf->setSourceFile($sourceFile);
            //primera página
            Logger::info("Empieza a armar pdf de consentimiento");
            $pdf->AddPage();
            $tplIdx = $pdf->importPage(1);
            $size = $pdf->getTemplateSize($tplIdx);
            $pdf->useTemplate($tplIdx, 0, 0);

            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(70, 50);
            $pdf->Write(10, $persona->getNombre() . ' ' . $persona->getPrimerApellido() . ' ' . $persona->getSegundoApellido());

            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(60, 57);
            $pdf->Write(10, $descLocaciones['canton'] . ' ' . $descLocaciones['distrito'] . '. ' . $persona->getDireccion());

            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(145, 62);
            $pdf->Write(10, $persona->getIdentificacion());

            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(105, 67);
            $pdf->Write(10, $persona->getCorreo());

            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(85, 72);
            $pdf->Write(10, $persona->getTelefono());

            // Agregar texto a la segunda página
            $pdf->AddPage();
            $tplIdx = $pdf->importPage(2);
            $size = $pdf->getTemplateSize($tplIdx);
            $pdf->useTemplate($tplIdx, 0, 0);
            $meses = [
                1 => 'enero',
                2 => 'febrero',
                3 => 'marzo',
                4 => 'abril',
                5 => 'mayo',
                6 => 'junio',
                7 => 'julio',
                8 => 'agosto',
                9 => 'septiembre',
                10 => 'octubre',
                11 => 'noviembre',
                12 => 'diciembre'
            ];
            date_default_timezone_set('America/Mexico_City');
            $dia = date('d');
            $mes = $meses[date('n')];
            $anio = date('Y');
            $anio = substr($anio, -1);

            // Agregar texto en la segunda página
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(51, 202);
            $pdf->Write(10, $dia);

            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(65, 202);
            $pdf->Write(10, $mes);

            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(98.5, 202);
            $pdf->Write(10, $anio);

            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(50, 235);
            $pdf->Write(10, $persona->getNombre() . ' ' . $persona->getPrimerApellido() . ' ' . $persona->getSegundoApellido());

            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(48, 240);
            $pdf->Write(10, $persona->getIdentificacion());

            //firma
            $imageX = 50;
            $imageY = 210;
            $imageWidth = 30;
            $imageHeight = 30;
            $pdf->Image($archivo, $imageX, $imageY, $imageWidth, $imageHeight);
            $ruta = './repo/' . time() . 'consentimiento.pdf';
            $pdf->Output('F', $ruta);
            Logger::info("Termina de armar el pdf de consentimiento");
            Logger::info("Genera las credenciales del usuario");
            $codigo = bin2hex(random_bytes(4));
            //guarda la ruta del consentimiento
            $credenciales->setUrlConsentimiento($ruta);
            $credenciales->setCodigo($codigo);
            if ($credencialesM->IngresarCredenciales($credenciales)) {
                $persona->setConsentimiento(1);
                $personaM->Actualizar($persona);
                $usuarioM->Actualizar($usuario);
                //correo phpmailer                
                $asunto = 'Código de verificación | Municipalidad de Río Cuarto';
                $msg = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Código de Confirmación</title><style>body {font-family: Arial, sans-serif;background-color: #f4f4f4;margin: 0;padding: 20px;}.container {max-width: 600px;background-color: #ffffff;padding: 20px;margin: auto;border-radius: 10px;box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);text-align: center;}.header {font-size: 24px;color: #333;margin-bottom: 20px;}.code {font-size: 30px;font-weight: bold;color: #0f1a4f;background-color: #f0f8ff;display: inline-block;padding: 10px 20px;border-radius: 5px;letter-spacing: 5px;margin: 10px 0;}.footer {font-size: 14px;color: #666;margin-top: 20px;}</style></head><body><div class="container"><div class="header"><img src="https://155.138.227.216/munitra/Web/assets/img/Municipalidad%20de%20Rio%20Cuarto.png" alt=""></div><div class="header">Código de Confirmación - Municipalidad de Río Cuarto</div><p>Usa el siguiente código para completar tu proceso de verificación:</p><div class="code">' . $codigo . '</div><p>Si no solicitaste este código, ignora este mensaje.</p><div class="footer">© 2024 Municipalidad de Río Cuarto. Todos los derechos reservados.</div></div></body></html>';
                $mail = new PHPMailer();
                try {
                    $bitacoraM = new BitacoraSolicitudM();
                    $credencialesSmtp = $bitacoraM->CredencialesSMTP();
                    $mail->isSMTP();
                    $mail->CharSet = "UTF-8";
                    $mail->Encoding = "base64";
                    $mail->Host = $credencialesSmtp['host'];
                    $mail->SMTPAuth = true;
                    $mail->Username = $credencialesSmtp['user'];
                    $mail->Password = $credencialesSmtp['key'];
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;
                    $mail->setFrom($credencialesSmtp['from']);
                    $mail->addAddress($usuario->getCorreo());
                    $mail->isHTML(true);
                    $mail->Subject = $asunto;
                    $mail->Body = $msg;
                    $mail->addAttachment($ruta);
                    ob_start();
                    if (!$mail->send()) {
                        echo "Error: " . $mail->ErrorInfo;
                    }
                    $log = ob_get_clean();
                    Logger::info("Correo de envío de código para confirmar cuenta: " . $log);
                } catch (Exception $ex) {
                    Logger::error("Excepción en controlador (phpmailer): " . $ex->getMessage());
                }
                require_once './Vista/Login/aviso.php';
            } else {
                $idUsuario = $_SESSION['usuario']->getId();
                require_once './Vista/Login/credenciales.php';
            }
        } else {
            $idUsuario = $_POST['idUsuario'];
            require_once './Vista/Login/credenciales.php';
        }
    }
    function Login()
    {
        if (isset($_POST['correo'])) {
            $correo = $_POST['correo'];
            $pass = $_POST['pass'];
            $usuarioM = new UsuarioM();
            Logger::info("Empieza a validar usuario");
            $usuario = $usuarioM->ValidarCredenciales($correo, $pass);
            if ($usuario == null) {
                Logger::warning("Error al iniciar sesión");
                $msg = 'El usuario no se encuentra, </br> verifique sus credenciales';
                require_once './Vista/Login/login.php';
            } else {
                //Usuario no está inactivo
                if ($usuario->getIdEstado() != 2) {
                    session_start();
                    $_SESSION['usuario'] = $usuario;
                    if ($usuario->getIdDepartamento() == 1) {
                        Logger::info("Usuario " . $usuario->getId() . " inicia sesión. Externo");
                        $this->InicioTramites();
                    } else {
                        Logger::info("Usuario " . $usuario->getId() . " inicia sesión. Interno");
                        $this->AdminInicio();
                    }
                } else {
                    Logger::warning("Usuario inactivo " . $usuario->getId() . " intenta iniciar sesión");
                    $msg = 'El usuario se encuentra inactivo, </br> comuniquese con la municipalidad';
                    require_once './Vista/Login/login.php';
                }
            }
        }
    }
    function LlamarVistaRegistro($msg)
    {
        $locaciones = new ProvinciaM();
        $arrLocaciones  = $locaciones->BuscarLocaciones();
        require_once './Vista/Login/registro.php';
    }
    function CerrarSesion()
    {
        Logger::info("Usuario " . $_SESSION['usuario']->getId() . " cierra sesión");
        session_start();
        unset($_SESSION['usuario']);
        header('Location: index.php');
    }
    function Registro()
    {
        $locaciones = new ProvinciaM();
        $arrLocaciones  = $locaciones->BuscarLocaciones();
        $msg = '';
        require_once './Vista/Login/registro.php';
    }
    function RegistrarUsuario()
    {
        $personaM = new PersonaM();
        $cedula =  $_POST['identificacion'];
        $persona = $personaM->BuscarPersonaCedula($cedula);
        if ($persona != NULL) {
            $idUsuario = $persona->getId();
        } else {
            $persona = new Persona();
            $persona->setIdTipoIdentificacion($_POST['tipoIdentificacion']);
            $persona->setIdentificacion(trim($_POST['identificacion']));
            $persona->setNombre(trim($_POST['nombre']));
            $persona->setPrimerApellido(trim($_POST['apellido1']));
            $persona->setSegundoApellido(trim($_POST['apellido2']));
            $persona->setDireccion(trim($_POST['direccion']));
            $persona->setTelefono(trim($_POST['telefono']));
            $persona->setWhatsapp(trim($_POST['whatsapp']));
            $persona->setCorreo(trim($_POST['correo']));
            $persona->setEstado($_POST['estado']);
            $persona->setConsentimiento($_POST['consentimiento']);
            $persona->setIdProvincia($_POST['provincia']);
            $persona->setIdCanton($_POST['canton']);
            $persona->setIdDistrito($_POST['distrito']);
            $persona->setUsuarioCreacion(0);
            $idUsuario = $personaM->IngresarPersona($persona);
        }
        if ($idUsuario != 0) {
            if (isset($_POST['nombreUsuario']) && $_POST['nombreUsuario'] != '') {
                $usuarioM = new UsuarioM();
                $usuario = new Usuario();
                $usuario->setNombreUsuario(trim($_POST['nombreUsuario']));
                $usuario->setCorreo(trim($_POST['correo']));
                $usuario->setPass(trim($_POST['pass']));
                $usuario->setResponsable($_POST['responsable']);
                $usuario->setIdPersona($idUsuario);
                $usuario->setIdDepartamento($_POST['depto']);
                $usuario->setIdEstado($_POST['estado']);
                if ($usuarioM->IngresarUsuario($usuario)) {
                    session_start();
                    $idUsuario = $usuarioM->IdMax();
                    $usuario->setId($idUsuario);
                    $_SESSION['usuario'] = $usuario;
                    //cedula (opcional)
                    if (isset($_FILES['cedulaFrontal']) && $_FILES['cedulaFrontal']['error'] === UPLOAD_ERR_OK) {
                        if (isset($_FILES['cedulaTrasera']) && $_FILES['cedulaTrasera']['error'] === UPLOAD_ERR_OK) {
                            $persona->setId($usuario->getIdPersona());
                            $rutaDestino = './repo/';
                            $urlArchivo = $rutaDestino . time() . basename($_FILES['cedulaFrontal']['name']);
                            $persona->setCedulaFrontal($urlArchivo);
                            if (!is_writable('./repo/')) {
                                $this->LlamarVistaRegistro('El directorio no tiene permisos de escritura, comuníquese con el profesional de TI');
                            }
                            //Guarda la cedula por delante
                            if (move_uploaded_file($_FILES['cedulaFrontal']['tmp_name'], $urlArchivo)) {
                                //Si se guarda la cedula por delante, guarda la cedula por detrás
                                $urlArchivo = $rutaDestino . time() . basename($_FILES['cedulaTrasera']['name']);
                                if (move_uploaded_file($_FILES['cedulaTrasera']['tmp_name'], $urlArchivo)) {
                                    $persona->setCedulaTrasera($urlArchivo);
                                } else {
                                    $this->LlamarVistaRegistro('El directorio no tiene permisos de escritura, comuníquese con el profesional de TI');
                                }
                                $personaM->GestionarCedula($persona);
                            } else {
                                $this->LlamarVistaRegistro('El directorio no tiene permisos de escritura, comuníquese con el profesional de TI');
                            }
                        }
                    }
                    require_once './Vista/Login/credenciales.php';
                } else {
                    $personaM->EliminarPersona($idUsuario);
                    $this->LlamarVistaRegistro('Ha ocurrido un problema con los datos de usuario, verifique los datos');
                }
            } else {
                $personaM->EliminarPersona($idUsuario);
                $this->LlamarVistaRegistro('Ha ocurrido un problema con sus datos, verifique los datos');
            }
        } else {
            $this->LlamarVistaRegistro('Ha ocurrido un problema, verifique los datos');
        }
    }
}
