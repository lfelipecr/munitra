<?php
    require_once './Core/RutaFija.php';
    require_once './Core/Rutas.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require_once './Libraries/PHPMailer-6.9.3/src/PHPMailer.php';
    require_once './Libraries/PHPMailer-6.9.3/src/SMTP.php';
    require_once './Libraries/PHPMailer-6.9.3/src/Exception.php';
    
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    $ruta=new Rutas();

    if(isset($_GET['controlador']))
    {
        $controlador=$ruta->CargarControlador($_GET['controlador']);
        if(isset($_GET['metodo']))
        {
            $ruta->CargarMetodo($controlador,$_GET['metodo']);
        }
        else
        {
            $ruta->CargarMetodo($controlador,ACCION_PRINCIPAL);
        }
    }
    else
    {
        $controlador=$ruta->CargarControlador(CONTROLADOR_PRINCIPAL);
        $ruta->CargarMetodo($controlador,ACCION_PRINCIPAL);
    }
