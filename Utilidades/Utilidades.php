<?php

class Utilidades
{
    public static function VerificarSesion()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['usuario'])) {
            return true;
        } else {
            Logger::info("Intento de ingreso sin sesión");
            header('location: index.php?controlador=Login&metodo=CerrarSesion');
            exit;
        }
    }
    public static function LlamarVista($vista)
    {
        require_once './Vista/Utilidades/sidebar.php';
    }
    public static function ValidarUsuarioActivo() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['usuario'])) {
            $usuario = $_SESSION['usuario'];
            if ($usuario->getIdEstado() == 2){
                return false;
            } else {
                return true;
            }
        }
    }
}
