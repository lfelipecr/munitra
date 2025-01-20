<?php
require_once './Utilidades/Utilidades.php';

class UsuarioControlador
{
    function Listado()
    {
        $u = new Utilidades();
        $u->LlamarVista('./Vista/Dashboard/Usuarios/listado.php');
    }
    function VIngresar(){
        $u = new Utilidades();
        $u->LlamarVista('./Vista/Dashboard/Usuarios/nuevo.php');
    }
}