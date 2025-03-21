<?php

class Rutas
{
    function CargarControlador($controlador)
    {
        $nombreControlador = ucwords(strtolower($controlador)) . "Controlador";
        $archivoControlador = "./Controlador/" . $nombreControlador . ".php";

        if (!is_file($archivoControlador)) {
            Logger::warning("Controlador '".$archivoControlador."' no encontrado, redirige a Index");
            $nombreControlador = "IndexControlador";
            $archivoControlador = RUTA_FIJA;
        }

        require_once $archivoControlador;
        $controladorObjeto = new $nombreControlador();
        return $controladorObjeto;
    }

    function CargarMetodo($controlador, $metodo)
    {
        if (isset($metodo) && method_exists($controlador, $metodo)) {
            $controlador->$metodo();
        } else {
            Logger::warning("Metodo '".$metodo."' no encontrado, redirige a Index");
            require_once RUTA_FIJA;
            $controlador = new IndexControlador();
            $controlador->Index();
        }
    }
}
