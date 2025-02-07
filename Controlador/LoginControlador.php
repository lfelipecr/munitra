<?php
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Metodos/UsuarioM.php';
require_once './Modelo/Entidades/Usuario.php';
require_once './Modelo/Metodos/ProvinciaM.php';
require_once './Modelo/Entidades/Credenciales.php';
require_once './Modelo/Metodos/CredencialesM.php';
require_once './Modelo/Metodos/PersonaM.php';

class LoginControlador
{   
    function Index(){
        $msg = '';
        session_start();
        require_once './Vista/Login/login.php';
    }
    function InicioTramites(){
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            header('location: index.php?controlador=Tramites&metodo=ListadoTramites');
        }
    }
    function AdminInicio(){
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $u->LlamarVista('./Vista/Dashboard/inicio.php');
        }
    }
    function IngresarCredenciales(){
        $credenciales = new Credenciales();
        $credencialesM = new CredencialesM();
        if (isset($_POST['foto']) && isset($_POST['firma'])){
            $firma = $_POST['firma'];
            $firma = str_replace("data:image/png;base64,", "", $firma);
            $firma = str_replace(" ", "+", $firma);
            $imagen = base64_decode($firma);
            $archivo = "repo/firmas/firma_" . time() . ".png";
            file_put_contents($archivo, $imagen);
            $credenciales->setFirma($archivo);
            $foto = $_POST['foto'];
            $foto = str_replace("data:image/png;base64,", "", $foto);
            $foto = str_replace(" ", "+", $foto);
            $imagen = base64_decode($foto);
            $archivo = "repo/foto_" . time() . ".png";
            file_put_contents($archivo, $imagen);
            $credenciales->setUrlImagen($archivo);
            $credenciales->setIdUsuario($_POST['idUsuario']);

            if (isset($_FILES['consentimiento']) && $_FILES['consentimiento']['error'] === UPLOAD_ERR_OK) {
                session_start();
                $rutaDestino = './repo/';
                //Cambia el nombre para que sea unico
                $urlArchivo = $rutaDestino.basename(time()."_".$_FILES['consentimiento']['name']);
                if (!is_writable($rutaDestino)) {
                    $idUsuario = $_SESSION['usuario']->getId();
                    require_once './Vista/Login/credenciales.php';
                }                
                if (!is_dir($rutaDestino)) {
                    mkdir($rutaDestino, 0777, true);
                }
                if (move_uploaded_file($_FILES['consentimiento']['tmp_name'], $urlArchivo)) {
                    $credenciales->setUrlConsentimiento($urlArchivo);
                    if($credencialesM->IngresarCredenciales($credenciales)){
                        //modifica el estado del usuario
                        $usuarioM = new UsuarioM();
                        $usuario = $_SESSION['usuario'];
                        $usuario->setIdEstado(4);
                        $usuarioM->Actualizar($usuario);
                        header('location: index.php?controlador=Tramites&metodo=ListadoTramites');
                    } else {
                        $idUsuario = $_SESSION['usuario']->getId();
                        require_once './Vista/Login/credenciales.php';    
                    }
                } else {
                    $idUsuario = $_SESSION['usuario']->getId();
                    require_once './Vista/Login/credenciales.php';
                }
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
        if ($usuario == null){
            $msg = 'El usuario no se encuentra, </br> verifique sus credenciales';
            require_once './Vista/Login/login.php';
        } else {
            //Usuario no está inactivo
            if ($usuario->getIdEstado() != 2){
                session_start();
                $_SESSION['usuario'] = $usuario;
                if ($usuario->getIdDepartamento() == 1){
                    $this->InicioTramites();
                } else {
                    //Permisos
                    $this->AdminInicio();
                }
            } else {
                $msg = 'El usuario se encuentra inactivo, </br> comuniquese con la municipalidad';
                require_once './Vista/Login/login.php';
            }
        }
    }
    function LlamarVistaRegistro($msg){
        $locaciones = new ProvinciaM();
        $arrLocaciones  = $locaciones->BuscarLocaciones();
        require_once './Vista/Login/registro.php';
    }
    function CerrarSesion()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: index.php');
    }
    function Registro()
    {
        $locaciones = new ProvinciaM();
        $arrLocaciones  = $locaciones->BuscarLocaciones();
        $msg = '';
        require_once './Vista/Login/registro.php';
    }
    function RegistrarUsuario(){
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
        $persona->setEstado($_POST['estado']);
        $persona->setConsentimiento($_POST['consentimiento']);
        $persona->setIdProvincia($_POST['provincia']);
        $persona->setIdCanton($_POST['canton']);
        $persona->setIdDistrito($_POST['distrito']);
        $persona->setUsuarioCreacion(0);
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
                    require_once './Vista/Login/aviso.php';
                } else {
                    $personaM->EliminarPersona($idUsuario);
                    $this->LlamarVistaRegistro('Ha ocurrido un problema, verifique los datos');
                }
            } else {
                $personaM->EliminarPersona($idUsuario);
                $this->LlamarVistaRegistro('Ha ocurrido un problema, verifique los datos');
            }
        } else {
            $this->LlamarVistaRegistro('Ha ocurrido un problema, verifique los datos');
        }
    }
}