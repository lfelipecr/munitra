<?php
require_once './Utilidades/Utilidades.php';

class LoginControlador
{   
    function AdminInicio(){
        $u = new Utilidades();
        $u->LlamarVista('./Vista/Dashboard/inicio.php');
    }
    function Login()
    {
        $this->AdminInicio();
    }
    function Registro()
    {
    }
}