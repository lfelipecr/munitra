<?php
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Metodos/ProvinciaM.php';
require_once './Modelo/Metodos/DepartamentoM.php';
require_once './Modelo/Metodos/UsuarioM.php';
require_once './Modelo/Entidades/Persona.php';
require_once './Modelo/Entidades/Usuario.php';

class UsuarioControlador
{
    function Listado()
    {
        $u = new Utilidades();
        $u->LlamarVista('./Vista/Dashboard/Usuarios/listado.php');
    }
    function VIngresar(){
        $msg = "";
        $locaciones = new ProvinciaM();
        $deptoM = new DepartamentoM();
        $arrLocaciones  = $locaciones->BuscarLocaciones();
        $deptos = $deptoM->BuscarDepartamentos();
        //Vista a llamar dentro del template
        $vista = './Vista/Dashboard/Usuarios/nuevo.php';
        require_once './Vista/Utilidades/sidebar.php';
    }
    function Ingresar(){
        $usuario = new Usuario();
        echo 'Ingresar';
    }
}