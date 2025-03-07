<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once './Utilidades/Utilidades.php';
require_once './Modelo/Metodos/ProvinciaM.php';
require_once './Modelo/Metodos/DepartamentoM.php';
require_once './Modelo/Metodos/UsuarioM.php';
require_once './Modelo/Metodos/PersonaM.php';
require_once './Modelo/Entidades/Persona.php';
require_once './Modelo/Entidades/ImagenUsuario.php';
require_once './Modelo/Entidades/Usuario.php';
require_once './Modelo/Metodos/CredencialesM.php';
require_once './Modelo/Metodos/BitacoraSolicitudM.php';

class UsuarioControlador
{
    function Perfil()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $personaM = new PersonaM();
            $usuario = $_SESSION['usuario'];
            $persona = $personaM->BuscarPersona($usuario->getIdPersona());
            if ($usuario->getIdDepartamento() == 1) {
                $vista = './Vista/TramitesUsuario/Dashboard/perfil.php';
                require_once './Vista/Utilidades/navbar.php';
            } else {
                $imagen = $personaM->BuscarImagen($usuario->getIdPersona());
                $vista = './Vista/Dashboard/usuario.php';
                require_once './Vista/Utilidades/sidebar.php';
            }
        }
    }
    function CambiarFotoPerfil()
    {
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            if (
                $_FILES['foto']['type'] == 'image/jpeg' ||
                $_FILES['foto']['type'] == 'image/jpg' || $_FILES['foto']['type'] == 'image/png'
            ) {
                $rutaDestino = './repo/';
                $urlArchivo = $rutaDestino . time() . basename($_FILES['foto']['name']);
                if (!is_writable($rutaDestino)) {
                    $msg = 'El directorio no tiene permisos de escritura, comuníquese con el profesional de TI';
                    $vista = './Vista/Dashboard/usuario.php';
                    require_once './Vista/Utilidades/sidebar.php';
                }
                if (move_uploaded_file($_FILES['foto']['tmp_name'], $urlArchivo)) {
                    session_start();

                    $personaM = new PersonaM();
                    $imagen = new ImagenUsuario();
                    $imagen->setId($_POST['idFoto']);
                    $imagen->setIdUsuario($_SESSION['usuario']->getIdPersona());
                    $imagen->setUrlImagen($urlArchivo);
                    if ($personaM->ActualizarImagen($imagen)) {
                        $this->Perfil();
                    }
                } else {
                    $msg = 'Ha habido un error con la subida del archivo, intente con otro archivo';
                    $vista = './Vista/Dashboard/usuario.php';
                    require_once './Vista/Utilidades/sidebar.php';
                }
            }
        }
    }
    //Llama a la vista de ingresar GET
    private function LlamarVistaIngresar($msg)
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $locaciones = new ProvinciaM();
            $deptoM = new DepartamentoM();
            $arrLocaciones  = $locaciones->BuscarLocaciones();
            $deptos = $deptoM->BuscarDepartamentos();
            //Vista a llamar dentro del template
            $vista = './Vista/Dashboard/Usuarios/nuevo.php';
            require_once './Vista/Utilidades/sidebar.php';
        }
    }
    //Llama a la vista de actualizar GET 
    private function LlamarVistaActualizar($msg, $usuario, $persona)
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $locaciones = new ProvinciaM();
            $deptoM = new DepartamentoM();
            $arrLocaciones  = $locaciones->BuscarLocaciones();
            $deptos = $deptoM->BuscarDepartamentos();
            //Vista a llamar dentro del template
            $vista = './Vista/Dashboard/Usuarios/actualizar.php';
            require_once './Vista/Utilidades/sidebar.php';
        }
    }
    //Valida un array de campos y devuelve un mensaje
    private function ValidarCampos(array $campos)
    {
        $msg = "";
        foreach ($campos as $campo) {
            if (empty($_POST[$campo])) {
                $msg = "El campo $campo es obligatorio.";
            }
        }
        return $msg;
    }
    //Lista de personas en una tabla
    function Listado()
    {
        $u = new Utilidades();
        $personaM = new PersonaM();
        $jsonData = $personaM->ListadoPersonasJSON();
        if ($u->VerificarSesion()) {
            $vista = './Vista/Dashboard/Usuarios/listado.php';
            require_once './Vista/Utilidades/sidebar.php';
        }
    }
    //Vista de actualizar GET
    function VActualizar()
    {
        //Id de URL
        $id = $_GET['id'];
        $idUsuario = $_GET['idUsuario'];
        $u = new Utilidades();
        $usuario = new Usuario();
        $persona = new Persona();
        $usuarioM = new UsuarioM();
        $personaM = new PersonaM();
        if ($idUsuario != 'null') {
            $usuario = $usuarioM->BuscarUsuarioId($idUsuario);
        } else {
            $usuario->setId('');
            $usuario->setNombreUsuario('');
            $usuario->setPass('');
        }
        $persona = $personaM->BuscarPersona($id);
        if ($u->VerificarSesion()) {
            $msg = "";
            $this->LlamarVistaActualizar($msg, $usuario, $persona);
        }
    }
    //Actualizar POST
    function Actualizar()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            session_start();
            //Instancia la persona para llamar al metodo de vista
            $persona = new Persona();
            $persona->setId($_POST['idPersona']);
            $persona->setIdTipoIdentificacion($_POST['tipoIdentificacion']);
            $persona->setIdentificacion(trim($_POST['identificacion']));
            $persona->setNombre(trim($_POST['nombre']));
            $persona->setPrimerApellido(trim($_POST['apellido1']));
            $persona->setSegundoApellido(trim($_POST['apellido2']));
            $persona->setDireccion(trim($_POST['direccion']));
            $persona->setTelefono(trim($_POST['telefono']));
            $persona->setWhatsapp(trim($_POST['whatsapp']));
            $persona->setCorreo(trim($_POST['correo']));
            $persona->setSituacion(trim($_POST['situacion']));
            $persona->setEstado($_POST['estado']);
            $persona->setMontoMorosidad($_POST['montoMorosidad']);
            $persona->setMontoAdeudado($_POST['montoAdeudado']);
            $persona->setPropiedadFuera($_POST['propiedadFuera']);
            $persona->setConsentimiento($_POST['consentimiento']);
            $persona->setIdProvincia($_POST['provincia']);
            $persona->setIdCanton($_POST['canton']);
            $persona->setIdDistrito($_POST['distrito']);
            $persona->setUsuarioCreacion($_SESSION['usuario']->getId());
            //Verifica si se está creando cuenta de usuario
            if (isset($_POST['nombreUsuario']) && $_POST['nombreUsuario'] != '') {
                //Array de campos obligatorios usuario
                $camposObligatorios = [
                    'identificacion',
                    'nombre',
                    'apellido1',
                    'direccion',
                    'correo',
                    'provincia',
                    'canton',
                    'distrito',
                    'nombreUsuario',
                    'depto',
                    'estado'
                ];
                //Si se va a trabajar con usuarios, se instancia el usuario
                $usuario = new Usuario();
                $usuario->setId($_POST['idUsuario']);
                $usuario->setNombreUsuario(trim($_POST['nombreUsuario']));
                $usuario->setCorreo(trim($_POST['correo']));
                $usuario->setResponsable($_POST['responsable']);
                $usuario->setIdPersona($_POST['idPersona']);
                $usuario->setIdDepartamento($_POST['depto']);
                $usuario->setIdEstado($_POST['estado']);
            } else {
                //Array de campos obligatorios solo persona
                $camposObligatorios = [
                    'identificacion',
                    'nombre',
                    'apellido1',
                    'direccion',
                    'correo',
                    'provincia',
                    'canton',
                    'distrito',
                    'depto'
                ];
            }
            $msg = $this->ValidarCampos($camposObligatorios);
            if ($msg == '') {
                $personaM = new PersonaM();
                if ($personaM->Actualizar($persona)) {
                    if (isset($_POST['nombreUsuario']) && $_POST['nombreUsuario'] != '') {
                        $usuarioM = new UsuarioM();
                        if ($usuarioM->Actualizar($usuario)) {
                            $this->Listado('Usuario registrado correctamente');
                        } else {
                            $msg = 'Ha habido un problema con los datos de usuario de ' . $persona->getNombre();
                            $this->LlamarVistaActualizar($msg, $usuario, $persona);
                        }
                    } else {
                        $this->Listado('Persona registrada correctamente');
                    }
                } else {
                    $msg = 'Ha habido un problema con los datos de ' . $persona->getNombre();
                    $this->LlamarVistaActualizar($msg, $usuario, $persona);
                }
            } else {
                $this->LlamarVistaActualizar($msg, $usuario, $persona);
            }
        }
    }
    function VIngresar()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $msg = "";
            $this->LlamarVistaIngresar($msg);
        }
    }
    function Ingresar()
    {
        if (isset($_POST['nombreUsuario']) && $_POST['nombreUsuario'] != '') {
            $camposObligatorios = [
                'identificacion',
                'nombre',
                'apellido1',
                'direccion',
                'correo',
                'provincia',
                'canton',
                'distrito',
                'nombreUsuario',
                'pass',
                'depto',
                'estado'
            ];
        } else {
            $camposObligatorios = [
                'identificacion',
                'nombre',
                'apellido1',
                'direccion',
                'correo',
                'provincia',
                'canton',
                'distrito',
                'depto'
            ];
        }
        $msg = $this->ValidarCampos($camposObligatorios);
        if ($msg == '') {
            session_start();
            $personaM = new PersonaM();
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
            $persona->setSituacion(trim($_POST['situacion']));
            $persona->setEstado($_POST['estado']);
            $persona->setMontoMorosidad($_POST['montoMorosidad']);
            $persona->setMontoAdeudado($_POST['montoAdeudado']);
            $persona->setPropiedadFuera($_POST['propiedadFuera']);
            $persona->setConsentimiento($_POST['consentimiento']);
            $persona->setIdProvincia($_POST['provincia']);
            $persona->setIdCanton($_POST['canton']);
            $persona->setIdDistrito($_POST['distrito']);
            $persona->setUsuarioCreacion($_SESSION['usuario']->getId());
            $idUsuario = $personaM->IngresarPersona($persona);
            if ($idUsuario != 0) {
                //cedula (opcional)
                if (isset($_FILES['cedulaFrontal']) && $_FILES['cedulaFrontal']['error'] === UPLOAD_ERR_OK) {
                    if (isset($_FILES['cedulaTrasera']) && $_FILES['cedulaTrasera']['error'] === UPLOAD_ERR_OK) {
                        $persona->setId($idUsuario);
                        $rutaDestino = './repo/';
                        $urlArchivo = $rutaDestino . time() . basename($_FILES['cedulaFrontal']['name']);
                        $persona->setCedulaFrontal($urlArchivo);
                        if (!is_writable('./repo/')) {
                            $this->LlamarVistaIngresar('El directorio no tiene permisos de escritura, comuníquese con el profesional de TI');
                        }
                        //Guarda la cedula por delante
                        if (move_uploaded_file($_FILES['cedulaFrontal']['tmp_name'], $urlArchivo)) {
                            //Si se guarda la cedula por delante, guarda la cedula por detrás
                            $urlArchivo = $rutaDestino . time() . basename($_FILES['cedulaTrasera']['name']);
                            if (move_uploaded_file($_FILES['cedulaTrasera']['tmp_name'], $urlArchivo)) {
                                $persona->setCedulaTrasera($urlArchivo);
                            } else {
                                $this->LlamarVistaIngresar('El directorio no tiene permisos de escritura, comuníquese con el profesional de TI');
                            }
                            $personaM->GestionarCedula($persona);
                        } else {
                            $this->LlamarVistaIngresar('El directorio no tiene permisos de escritura, comuníquese con el profesional de TI');
                        }
                    }
                }
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
                        $imagen = new ImagenUsuario();
                        $imagen->setIdUsuario($idUsuario);
                        $imagen->setUrlImagen('./repo/serverside/placeholder.jpg');
                        if ($personaM->IngresarImagen($imagen)) {
                            $this->Listado();
                        }
                    } else {
                        $personaM->EliminarPersona($idUsuario);
                        $this->LlamarVistaIngresar('Credenciales de usuario ya existen');
                    }
                } else {
                    $this->Listado();
                }
            } else {
                $msg = 'Los datos de esta persona ya existen';
                $this->LlamarVistaIngresar($msg);
            }
        } else {
            $this->LlamarVistaIngresar($msg);
        }
    }
    function VerCredenciales()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $id = $_GET['id'];
            $credencialesM = new CredencialesM();
            $jsonData = $credencialesM->BuscarCredenciales($id);
            require_once './Vista/Dashboard/Usuarios/credenciales.php';
        }
    }
    function ValidarCredenciales()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $id = $_GET['id'];
            $idCredencial = $_GET['idCredencial'];
            $usuarioM = new UsuarioM();
            $usuario = $usuarioM->BuscarUsuarioId($id);
            $msg = '';
            $asunto = '';
            $codigo = bin2hex(random_bytes(4));
            if ($_GET['validar'] == 'true') {
                //base de datos
                $usuario->setIdEstado(5);
                $usuarioM->Actualizar($usuario);
                $credencialesM = new CredencialesM();
                $credenciales = new Credenciales();
                $credenciales->setCodigo($codigo);
                $credenciales->setId($idCredencial);
                $credencialesM->ModificarCredenciales($credenciales);
                $asunto = 'Código de verificación | Municipalidad de Río Cuarto';
                $msg = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Código de Confirmación</title><style>body {font-family: Arial, sans-serif;background-color: #f4f4f4;margin: 0;padding: 20px;}.container {max-width: 600px;background-color: #ffffff;padding: 20px;margin: auto;border-radius: 10px;box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);text-align: center;}.header {font-size: 24px;color: #333;margin-bottom: 20px;}.code {font-size: 30px;font-weight: bold;color: #0f1a4f;background-color: #f0f8ff;display: inline-block;padding: 10px 20px;border-radius: 5px;letter-spacing: 5px;margin: 10px 0;}.footer {font-size: 14px;color: #666;margin-top: 20px;}</style></head><body><div class="container"><div class="header"><img src="https://155.138.227.216/munitra/Web/assets/img/Municipalidad%20de%20Rio%20Cuarto.png" alt=""></div><div class="header">Código de Confirmación - Municipalidad de Río Cuarto</div><p>Usa el siguiente código para completar tu proceso de verificación:</p><div class="code">' . $codigo . '</div><p>Si no solicitaste este código, ignora este mensaje.</p><div class="footer">© 2024 Municipalidad de Río Cuarto. Todos los derechos reservados.</div></div></body></html>';
            }
            if ($_GET['validar'] == 'false') {
                $credencialesM = new CredencialesM();
                $credencialesM->EliminarCredenciales($idCredencial);
                $asunto = 'Credenciales de Identificación | Municipalidad de Río Cuarto';
                $msg = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Código de Confirmación</title><style>body {font-family: Arial, sans-serif;background-color: #f4f4f4;margin: 0;padding: 20px;}.container {max-width: 600px;background-color: #ffffff;padding: 20px;margin: auto;border-radius: 10px;box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);text-align: center;}.header {font-size: 24px;color: #333;margin-bottom: 20px;}.code {font-size: 30px;font-weight: bold;color: #0f1a4f;background-color: #f0f8ff;display: inline-block;padding: 10px 20px;border-radius: 5px;letter-spacing: 5px;margin: 10px 0;}.footer {font-size: 14px;color: #666;margin-top: 20px;}</style></head><body><div class="container"><div class="header"><img src="https://155.138.227.216/munitra/Web/assets/img/Municipalidad%20de%20Rio%20Cuarto.png" alt=""></div><div class="header">Código de Confirmación - Municipalidad de Río Cuarto</div><p>Sus credenciales no son correctas o no pudieron ser verificadas, intente de nuevo</p><div class="footer">© 2024 Municipalidad de Río Cuarto. Todos los derechos reservados.</div></div></body></html>';
                $usuario->setIdEstado(3);
                $usuarioM->Actualizar($usuario);
            }
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
                $mail->addAddress($usuario->getCorreo());
                $mail->isHTML(true);
                $mail->Subject = $asunto;
                $mail->Body = $msg;
                $mail->send();
                $this->Listado();
            } catch (Exception $ex) {
                var_dump($ex);
            }
        }
    }
    function ValidarCodigo()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $credencialesM = new CredencialesM();
            $codigo = $_POST['codigo'];
            $usuario = $_SESSION['usuario'];
            $datos = $credencialesM->ValidarCodigo($codigo);
            if ($datos != NULL) {
                $usuarioM = new UsuarioM();
                $usuario->setIdEstado(1);
                if ($usuarioM->Actualizar($usuario)) {
                    header('location: index.php?controlador=Tramites&metodo=InicioExterno');
                }
            } else {
                $msg = 'El código proporcionado no es el correcto, intente de nuevo o reciba otro código';
                require_once './Vista/Login/codigo.php';
            }
        }
    }
    function BuscarCedula()
    {
        $personaM = new PersonaM();
        $cedula = $_GET['cedula'];
        $persona = $personaM->BuscarPersonaCedula($cedula);
        if ($persona != null) {
            $arreglo = array();
            $arreglo['nombre'] = $persona->getNombre();
            $arreglo['tipoId'] = $persona->getIdTipoIdentificacion();
            $arreglo['apellido1'] = $persona->getPrimerApellido();
            $arreglo['apellido2'] = $persona->getSegundoApellido();
            $arreglo['telefono'] = $persona->getTelefono();
            $arreglo['whatsapp'] = $persona->getWhatsapp();
            $arreglo['direccion'] = $persona->getDireccion();
            $arreglo['correo'] = $persona->getCorreo();
            $arreglo['provincia'] = $persona->getIdProvincia();
            $arreglo['distrito'] = $persona->getIdDistrito();
            $arreglo['canton'] = $persona->getIdCanton();
            echo json_encode($arreglo);
        } else {
            echo 'null';
        }
    }
    function BuscarCedulaCuenta()
    {
        $personaM = new PersonaM();
        $usuarioM = new UsuarioM();
        $cedula = $_GET['cedula'];
        $persona = $personaM->BuscarPersonaCedula($cedula);
        if ($persona != null) {
            $usuario = $usuarioM->BuscarUsuarioIdPersona($persona->getId());
            if ($usuario != null) {
                echo '1';
            } else {
                echo '0';
            }
        } else {
            echo '0';
        }
    }
    function RecuperarCuenta()
    {
        $codigo = '0';
        if (isset($_POST['identificacion'])) {
            $personaM = new PersonaM();
            $identificacion = $_POST['identificacion'];
            $usuario = $personaM->BuscarPersonaCedula($identificacion);
            if ($usuario != null) {
                session_start();
                $correo = $usuario->getCorreo();
                $mail = new PHPMailer();
                $codigo = substr(bin2hex(random_bytes(8)), 0, 8);
                echo $codigo;
                $_SESSION['codigo'] = $codigo;
                $_SESSION['usuario'] = $usuario;
                $msg = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Código de Confirmación</title><style>body {font-family: Arial, sans-serif;background-color: #f4f4f4;margin: 0;padding: 20px;}.container {max-width: 600px;background-color: #ffffff;padding: 20px;margin: auto;border-radius: 10px;box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);text-align: center;}.header {font-size: 24px;color: #333;margin-bottom: 20px;}.code {font-size: 30px;font-weight: bold;color: #0f1a4f;background-color: #f0f8ff;display: inline-block;padding: 10px 20px;border-radius: 5px;letter-spacing: 5px;margin: 10px 0;}.footer {font-size: 14px;color: #666;margin-top: 20px;}</style></head><body><div class="container"><div class="header"><img src="https://155.138.227.216/munitra/Web/assets/img/Municipalidad%20de%20Rio%20Cuarto.png" alt=""></div><div class="header">Código de Confirmación - Municipalidad de Río Cuarto</div><p>Usa el siguiente código para completar tu proceso de verificación:</p><div class="code">' . $codigo . '</div><p>Si no solicitaste este código, ignora este mensaje.</p><div class="footer">© 2024 Municipalidad de Río Cuarto. Todos los derechos reservados.</div></div></body></html>';
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
                    //$mail->send();
                    $msg = '';
                    require_once './Vista/Login/codigoRecuperacion.php';
                } catch (Exception $ex) {
                    var_dump($ex);
                }
            } else {
                $msg = "Su usuario no se encuentra, puede crear su cuenta en <a href='index.php?controlador=Login&metodo=Registro'>este enlace</a>";
                require_once './Vista/Login/recuperacion.php';
            }
        } else {
            $msg = '';
            require_once './Vista/Login/recuperacion.php';
        }
    }
    function VerificarCodigo()
    {
        session_start();
        if (isset($_POST['codigo'])) {
            $codigo = $_POST['codigo'];
            $codigoSesion = $_SESSION['codigo'];
            if ($codigo == $codigoSesion) {
                unset($_SESSION['codigo']);
                //cambia contraseña
                $usuarioM = new UsuarioM();
                $contra = $_POST['contra'];
                $id = $_SESSION['usuario']->getId();
                $idUsuario = $usuarioM->BuscarUsuarioIdPersona($id)->getId();
                unset($_SESSION['usuario']);
                if ($usuarioM->CambiarContra($contra, $idUsuario)) {
                    $msg = 'Su contraseña ha sido modificada, ahora puede acceder con sus nuevas credenciales';
                    require_once './Vista/Login/login.php';
                } else {
                    $msg = 'Su código no es correcto, ingrese el código de nuevo o solicite otro código';
                    require_once './Vista/Login/codigoRecuperacion.php';
                }
            } else {
                $msg = 'Su código no es correcto, ingrese el código de nuevo o solicite otro código';
                require_once './Vista/Login/codigoRecuperacion.php';
            }
        }
    }
    function GestionarCedulas()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $fls = true;
            $persona = new Persona();
            $personaM = new PersonaM();
            $urls = array();
            $persona->setId($_POST['idPersona']);
            $rutaDestino = './repo/';
            if (!is_writable('./repo/')) {
                echo '0';
            }
            if (isset($_FILES['cedulaFrontal']) && $_FILES['cedulaFrontal']['error'] === UPLOAD_ERR_OK) {
                $urlArchivo = $rutaDestino . time() . basename($_FILES['cedulaFrontal']['name']);
                $persona->setCedulaFrontal($urlArchivo);
                if (move_uploaded_file($_FILES['cedulaFrontal']['tmp_name'], $urlArchivo)) {
                    $urls[] = $urlArchivo;
                } else {
                    echo '0';
                }
            } else {
                $urls[] = '0';
            }
            if (isset($_FILES['cedulaTrasera']) && $_FILES['cedulaTrasera']['error'] === UPLOAD_ERR_OK) {
                $urlArchivo = $rutaDestino . time() . basename($_FILES['cedulaTrasera']['name']);
                $persona->setCedulaTrasera($urlArchivo);
                if (move_uploaded_file($_FILES['cedulaTrasera']['tmp_name'], $urlArchivo)) {
                    $urls[] = $urlArchivo;
                } else {
                    echo '0';
                }
            } else {
                $urls[] = '0';
            }
            if ($personaM->GestionarCedula($persona))
                echo json_encode($urls);
        }
    }
}
