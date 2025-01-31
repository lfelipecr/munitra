<?php

class Utilidades
{
    public static function VerificarSesion(){
        session_start();
        if (isset($_SESSION['usuario'])) {
            
            return true;
        } else {
            header('location: index.php?controlador=Login&metodo=CerrarSesion');
            return false;
        }
    }
    public static function LlamarVista($vista){
        require_once './Vista/Utilidades/sidebar.php';
    }
}