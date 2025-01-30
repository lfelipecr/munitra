<?php
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Metodos/UsuarioM.php';
require_once './Modelo/Entidades/Usuario.php';

class LoginControlador
{   
    function Index(){
        $msg = '';
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
            //Usuario activo
            if ($usuario->getIdEstado() == 1){
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