<?php
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Metodos/ProvinciaM.php';
require_once './Modelo/Metodos/DepartamentoM.php';
require_once './Modelo/Metodos/UsuarioM.php';
require_once './Modelo/Metodos/PersonaM.php';
require_once './Modelo/Entidades/Persona.php';
require_once './Modelo/Entidades/Usuario.php';

class UsuarioControlador
{
    private function LlamarVistaIngresar($msg){
        $locaciones = new ProvinciaM();
        $deptoM = new DepartamentoM();
        $arrLocaciones  = $locaciones->BuscarLocaciones();
        $deptos = $deptoM->BuscarDepartamentos();
        //Vista a llamar dentro del template
        $vista = './Vista/Dashboard/Usuarios/nuevo.php';
        require_once './Vista/Utilidades/sidebar.php';
    }
    private function LlamarVistaActualizar($msg, $usuario, $persona){
        $locaciones = new ProvinciaM();
        $deptoM = new DepartamentoM();
        $arrLocaciones  = $locaciones->BuscarLocaciones();
        $deptos = $deptoM->BuscarDepartamentos();
        //Vista a llamar dentro del template
        $vista = './Vista/Dashboard/Usuarios/actualizar.php';
        require_once './Vista/Utilidades/sidebar.php';
    }
    private function ValidarCampos(array $campos){
        $msg = "";
        foreach ($campos as $campo) {
            if (empty($_POST[$campo])) {
                $msg = "El campo $campo es obligatorio.";
            }
        }
        return $msg;
    }
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
    function VActualizar(){
        $id = $_GET['id'];
        $u = new Utilidades();
        $usuario = new Usuario();
        $persona = new Persona();
        $usuarioM = new UsuarioM();
        $personaM = new PersonaM();
        $usuario = $usuarioM->BuscarUsuarioId($id);
        $persona = $personaM->BuscarPersona($usuario->getIdPersona());
        if ($u->VerificarSesion()) {
            $msg = "";
            $this->LlamarVistaActualizar($msg, $usuario, $persona);
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
                        $this->LlamarVistaIngresar('Persona y usuario registrados correctamente');    
                    } else {
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
}