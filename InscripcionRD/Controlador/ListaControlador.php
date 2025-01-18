<?php
require_once './Modelo/Conexion.php';
require_once './Modelo/Entidades/Usuario.php';
require_once './Modelo/Metodos/UsuarioM.php';
require_once './Modelo/Metodos/ListaM.php';

class ListaControlador
{
    function Lista(){
        $listaM = new ListaM();
        $lista = $listaM->Buscar();
        $aforo = $listaM->AforoEvento();
        $datosJSON = json_encode($lista->fetch_all());
        require_once './Vista/Lista/lista.php';
    }
    function Ticket($id){
        $listaM = new ListaM();
        $lista = $listaM->BuscarTicket($id);
        $datosJSON = json_encode($lista->fetch_all());
        require_once './Vista/Lista/ticket.php';
    }
    function Error(){
        require_once './Vista/Login/login.php';
    }
}