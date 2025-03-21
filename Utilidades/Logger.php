<?php
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Entidades/Usuario.php';

class Logger
{
    private static $archivoLog = "./sistema.log";

    public static function setLogFile($rutaArchivo)
    {
        self::$archivoLog = $rutaArchivo;
        if (!file_exists(dirname(self::$archivoLog))) {
            mkdir(dirname(self::$archivoLog), 0777, true);
        }
    }

    private static function writeLog($nivel, $mensaje)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['usuario'])) {
            $mensaje = $mensaje." - Usuario: ".$_SESSION['usuario']->getId();
        }
        date_default_timezone_set('America/Costa_Rica');
        $fecha = date("Y-m-d H:i:s");
        $mensajeLog = "[$fecha] [$nivel] $mensaje" . PHP_EOL;
        file_put_contents(self::$archivoLog, $mensajeLog, FILE_APPEND);
    }

    public static function info($mensaje)
    {
        self::writeLog("INFO", $mensaje);
    }

    public static function warning($mensaje)
    {
        self::writeLog("WARNING", $mensaje);
    }

    public static function error($mensaje)
    {
        self::writeLog("ERROR", $mensaje);
    }
}
