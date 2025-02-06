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
    function Perfil(){
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $personaM = new PersonaM();
            $usuario = $_SESSION['usuario'];
            $persona = $personaM->BuscarPersona($usuario->getIdPersona());
            $imagen = $personaM->BuscarImagen($usuario->getIdPersona());
            $vista = './Vista/Dashboard/usuario.php';
            require_once './Vista/Utilidades/sidebar.php';
        }
    }
    function CambiarFotoPerfil(){
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            if ($_FILES['foto']['type'] == 'image/jpeg' ||
            $_FILES['foto']['type'] == 'image/jpg' || $_FILES['foto']['type'] == 'image/png'){
                $rutaDestino = './repo/';
                $urlArchivo = $rutaDestino.basename($_FILES['foto']['name']);
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
                    if ($personaM->ActualizarImagen($imagen)){
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
    private function LlamarVistaIngresar($msg){
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
    private function LlamarVistaActualizar($msg, $usuario, $persona){
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
    private function ValidarCampos(array $campos){
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
    function VActualizar(){
        //Id de URL
        $id = $_GET['id'];
        $idUsuario = $_GET['idUsuario'];
        $u = new Utilidades();
        $usuario = new Usuario();
        $persona = new Persona();
        $usuarioM = new UsuarioM();
        $personaM = new PersonaM();
        if ($idUsuario != 'null'){
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
    function Actualizar(){
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
            if (isset($_POST['nombreUsuario']) && $_POST['nombreUsuario'] != ''){
                //Array de campos obligatorios usuario
                $camposObligatorios = ['identificacion','nombre', 'apellido1', 'direccion', 'correo',
                'provincia', 'canton', 'distrito', 'nombreUsuario', 'depto', 'estado'];
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
                $camposObligatorios = ['identificacion','nombre', 'apellido1', 'direccion', 'correo',
                'provincia', 'canton', 'distrito', 'depto'];
            }
            $msg = $this->ValidarCampos($camposObligatorios);
            if ($msg == ''){
                $personaM = new PersonaM();
                if ($personaM->Actualizar($persona)){
                    if (isset($_POST['nombreUsuario']) && $_POST['nombreUsuario'] != ''){
                        $usuarioM = new UsuarioM();
                        if ($usuarioM->Actualizar($usuario)){
                            $this->Listado('Usuario registrado correctamente');    
                        } else {
                            $msg = 'Ha habido un problema con los datos de usuario de '.$persona->getNombre();
                            $this->LlamarVistaActualizar($msg, $usuario, $persona);        
                        }
                    } else {
                        $this->Listado('Persona registrada correctamente');
                    }
                } else {
                    $msg = 'Ha habido un problema con los datos de '.$persona->getNombre();
                    $this->LlamarVistaActualizar($msg, $usuario, $persona);
                }
            } else {
                $this->LlamarVistaActualizar($msg, $usuario, $persona);
            }
        }
    }
    function VIngresar(){
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $msg = "";
            $this->LlamarVistaIngresar($msg);
        }
    }
    function Ingresar(){
        if (isset($_POST['nombreUsuario']) && $_POST['nombreUsuario'] != ''){
            $camposObligatorios = ['identificacion','nombre', 'apellido1', 'direccion', 'correo',
            'provincia', 'canton', 'distrito', 'nombreUsuario', 'pass', 'depto', 'estado'];
        } else {
            $camposObligatorios = ['identificacion','nombre', 'apellido1', 'direccion', 'correo',
            'provincia', 'canton', 'distrito', 'depto'];
        }
        $msg = $this->ValidarCampos($camposObligatorios);
        if ($msg == ''){
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
            if ($idUsuario != 0){
                if (isset($_POST['nombreUsuario']) && $_POST['nombreUsuario'] != ''){
                    $usuarioM = new UsuarioM();
                    $usuario = new Usuario();
                    $usuario->setNombreUsuario(trim($_POST['nombreUsuario']));
                    $usuario->setCorreo(trim($_POST['correo']));
                    $usuario->setPass(trim($_POST['pass']));
                    $usuario->setResponsable($_POST['responsable']);
                    $usuario->setIdPersona($idUsuario);
                    $usuario->setIdDepartamento($_POST['depto']);
                    $usuario->setIdEstado($_POST['estado']);
                    if ($usuarioM->IngresarUsuario($usuario)){
                        $imagen = new ImagenUsuario();
                        $imagen->setIdUsuario($idUsuario);
                        $imagen->setUrlImagen('./repo/serverside/placeholder.jpg');
                        if ($personaM->IngresarImagen($imagen)){
                            header('location: index.php?controlador=Usuario&metodo=Listado');
                        }
                    } else {
                        $personaM->EliminarPersona($idUsuario);
                        $this->LlamarVistaIngresar('Credenciales de usuario ya existen');    
                    }
                } else {
                    $this->Listado('Persona registrada correctamente');
                }
            } else {
                $msg = 'Los datos de esta persona ya existen';
                $this->LlamarVistaIngresar($msg);
            }
        } else {
            $this->LlamarVistaIngresar($msg);
        }
    }
    function VerCredenciales(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            $id = $_GET['id'];
            $credencialesM = new CredencialesM();
            $jsonData = $credencialesM->BuscarCredenciales($id);
            require_once './Vista/Dashboard/Usuarios/credenciales.php';
        }
    }
    function ValidarCredenciales(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            $id = $_GET['id'];
            $idCredencial = $_GET['idCredencial'];
            $usuarioM = new UsuarioM();
            $usuario = $usuarioM->BuscarUsuarioId($id);
            $msg = '';
            $asunto = '';
            $codigo = bin2hex(random_bytes(4));
            if ($_GET['validar'] == 'true'){
                //base de datos
                $usuario->setIdEstado(5);
                $usuarioM->Actualizar($usuario);
                $credencialesM = new CredencialesM();
                $credenciales = new Credenciales();
                $credenciales->setCodigo($codigo);
                $credenciales->setId($idCredencial);
                $credencialesM->ModificarCredenciales($credenciales);
                $asunto = 'Código de verificación | Municipalidad de Río Cuarto';
                $msg = 'Sus credenciales han sido aceptadas! Su código de verificación es: '.$codigo;
                
                
            }
            if ($_GET['validar'] == 'false'){
                $credencialesM = new CredencialesM();
                $credencialesM->EliminarCredenciales($idCredencial);
                $asunto = 'Credenciales de Identificación | Municipalidad de Río Cuarto';
                $msg = 'Sus credenciales no son correctas o no pudieron ser verificadas, intente de nuevo';
                $usuario->setIdEstado(3);
                $usuarioM->Actualizar($usuario);
            }
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
                $mail->addAddress($usuario->getCorreo());
                $mail->isHTML(true);
                $mail->Subject = $asunto;
                $mail->Body = $msg;
                $mail->send();
                header('location: index.php?controlador=Usuario&metodo=Listado');
                
            } catch (Exception $ex){
                var_dump($ex);
            }
        }
    }
    function ValidarCodigo(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            $credencialesM = new CredencialesM();
            $codigo = $_POST['codigo'];
            $usuario = $_SESSION['usuario'];
            var_dump($codigo);
            $datos = $credencialesM->ValidarCodigo($codigo);
            if ($datos != NULL){
                $usuarioM = new UsuarioM();
                $usuario->setIdEstado(1);
                if ($usuarioM->Actualizar($usuario)){
                    header('location: index.php?controlador=Tramites&metodo=ListadoTramites');
                }
            } else {
                $msg = 'El código proporcionado no es el correcto, intente de nuevo o reciba otro código';
                require_once './Vista/Login/codigo.php';
            }
        }
    }
}