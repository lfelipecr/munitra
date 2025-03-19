<?php
require_once './Modelo/Conexion.php';
require_once './Modelo/Entidades/Documentacion.php';
require_once './Modelo/Entidades/TipoDocumento.php';
require_once './Modelo/Entidades/Banner.php';

class BannerM
{
    function BuscarBanners()
    {
        $banner = null;
        $conexion = new Conexion();
        $sql = "SELECT * FROM BANNER";
        $resultado = $conexion->Ejecutar($sql);
        if (mysqli_num_rows($resultado) > 0) {
            return $resultado;
        } else
            $banner = null;
        $conexion->Cerrar();
        return $banner;
    }
    function BuscarBannerActivo()
    {
        $listado = $this->BuscarBanners();
        if ($listado == null){
            return '';
        } else {
            while ($fila = $listado->fetch_assoc()) {
                if ($fila['ACTIVO'] == '1') {
                    return $fila['URL_BANNER'];
                }
            }
        }
        return '0';
    }
    function IngresarBanner($descripcion, $url)
    {
        $retVal = false;
        $conexion = new Conexion();
        $sql = "INSERT INTO BANNER (DESCRIPCION, URL_BANNER, ACTIVO)
        VALUES ('$descripcion', '$url', 0);";
        try {
            if ($conexion->Ejecutar($sql)) {
                $retVal = true;
            } else 
                Logger::error("Ejecución incorrecta BannerM IngresarBanner. SQL: (".$sql.")");
        } catch (Exception $ex) {
            Logger::error("Ejecución incorrecta BannerM IngresarBanner. Exception: (".$ex->getMessage().")");
            $retVal = false;
        }
        $conexion->Cerrar();
        return $retVal;
    }
    function EliminarBanner($id)
    {
        $retVal = false;
        $conexion = new Conexion();
        $sql = "DELETE FROM BANNER WHERE ID = $id";
        try {
            if ($conexion->Ejecutar($sql)) {
                $retVal = true;
            } else {
                Logger::error("Ejecución incorrecta BannerM EliminarBanner. SQL: (".$sql.")");
            }
        } catch (Exception $ex) {
            Logger::error("Ejecución incorrecta BannerM IngresarBanner. Exception: (".$ex->getMessage().")");
            $retVal = false;
        }
        $conexion->Cerrar();
        return $retVal;
    }
    function GenerarActivo($id)
    {
        $retVal = false;
        $conexion = new Conexion();
        $sql = "UPDATE BANNER SET ACTIVO = 0;";
        try {
            $conexion->Ejecutar($sql);
            $sql = 'UPDATE BANNER SET ACTIVO = 1 WHERE ID = ' . $id;
            if ($conexion->Ejecutar($sql)) {
                $retVal = true;
            } else {
                Logger::error("Ejecución incorrecta BannerM IngresarBanner. SQL: (".$sql.")");
            }
        } catch (Exception $ex) {
            $retVal = false;
        }
        $conexion->Cerrar();
        return $retVal;
    }
}
