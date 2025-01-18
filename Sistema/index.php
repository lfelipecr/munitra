<?php
    require_once './Core/RutaFija.php';
    require_once './Core/Rutas.php';

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
