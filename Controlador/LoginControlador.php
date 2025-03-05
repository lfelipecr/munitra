<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
    function VerificarCodigo()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            if (isset($_SESSION['codigo'])) {
                $codigo = $_SESSION['codigo'];
                $codigoEnviado = $_POST['codigo'];
                if ($codigo == $codigoEnviado) {
                    unset($_SESSION['codigo']);
                    echo '200';
                } else {
                    echo '401';
                }
            } else {
                echo '404';
            }
        }
    }
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
                $mail->send();
            } catch (Exception $ex) {
                var_dump($ex);
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
            $firma = $_POST['firma'];
            $firma = str_replace("data:image/png;base64,", "", $firma);
            $firma = str_replace(" ", "+", $firma);
            $imagen = base64_decode($firma);
            $archivo = "repo/firmas/firma_" . time() . ".png";
            file_put_contents($archivo, $imagen);
            $credenciales->setFirma($archivo);
            $credenciales->setIdUsuario($_POST['idUsuario']);
            if ($credencialesM->IngresarCredenciales($credenciales)) {
                session_start();
                //modifica el estado del usuario
                $usuarioM = new UsuarioM();
                $usuario = $_SESSION['usuario'];
                $usuario->setIdEstado(4);
                $usuarioM->Actualizar($usuario);
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
        $correo = $_POST['correo'];
        $pass = $_POST['pass'];
        $usuarioM = new UsuarioM();
        $usuario = $usuarioM->ValidarCredenciales($correo, $pass);
        if ($usuario == null) {
            $msg = 'El usuario no se encuentra, </br> verifique sus credenciales';
            require_once './Vista/Login/login.php';
        } else {
            //Usuario no está inactivo
            if ($usuario->getIdEstado() != 2) {
                session_start();
                $_SESSION['usuario'] = $usuario;
                if ($usuario->getIdDepartamento() == 1) {
                    $this->InicioTramites();
                } else {
                    //Permisos
                    header('location: index.php?controlador=Login&metodo=AdminInicio');
                }
            } else {
                $msg = 'El usuario se encuentra inactivo, </br> comuniquese con la municipalidad';
                require_once './Vista/Login/login.php';
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
