<?php
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Metodos/UsuarioM.php';
require_once './Modelo/Entidades/Usuario.php';

class LoginControlador
{   
    function InicioTramites(){
        require_once './Vista/TramitesUsuario/listadoTramites.php';
    }
    function AdminInicio(){
        $u = new Utilidades();
        $u->LlamarVista('./Vista/Dashboard/inicio.php');
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
            session_start();
            $_SESSION['Usuario'] = $usuario;
            if ($usuario->getIdDepartamento() == 1){
                $this->InicioTramites();
            } else {
                //Permisos
                $this->AdminInicio();
            }
        }
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

    }
}