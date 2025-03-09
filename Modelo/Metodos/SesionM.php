<?php
require_once './Modelo/Entidades/Sesion.php';
require_once './Modelo/Conexion.php';
require_once './Modelo/Entidades/Comision.php';

class SesionM
{
    function BuscarSesiones()
    {
        $conexion = new Conexion();
        $sql = "CALL SpBuscarSesiones();";
        $resultado = $conexion->Ejecutar($sql);
        if (mysqli_num_rows($resultado) > 0) {
            $registro = json_encode($resultado->fetch_all());
        } else
            $registro = null;
        $conexion->Cerrar();
        return $registro;
    }
    function BuscarSesion($id)
    {
        $sesion = null;
        $conexion = new Conexion();
        $sql = "CALL SpBuscarSesion($id)";
        $resultado = $conexion->Ejecutar($sql);
        if (mysqli_num_rows($resultado) > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $sesion = new Sesion();
                $sesion->setId($fila["ID"]);
                $sesion->setFecha($fila["FECHA"]);
                $sesion->setDescripcion($fila["DESCRIPCION"]);
                $sesion->setActaAprobada($fila["ACTA_APROBADA"]);
                $sesion->setUrlActa($fila["URL_ACTA"]);
                $sesion->setUrlAgenda($fila["URL_AGENDA"]);
                $sesion->setUrlVideo($fila["URL_VIDEO"]);
                $sesion->setIdComision($fila['ID_COMISION']);
            }
        } else
            $sesion = null;
        $conexion->Cerrar();
        return $sesion;
    }

    function IngresarSesion(Sesion $sesion)
    {
        $retVal = false;
        $conexion = new Conexion();
        $sql = "CALL SpIngresarSesion('" . $sesion->getFecha() .
            "', '" . $sesion->getDescripcion() .
            "', " . $sesion->getActaAprobada() .
            ", '" . $sesion->getUrlActa() .
            "', '" . $sesion->getUrlAgenda() .
            "', '" . $sesion->getUrlVideo() . "', " . $sesion->getIdComision() . ")";
        try {
            if ($conexion->Ejecutar($sql)) {
                $retVal = true;
            }
        } catch (Exception $ex) {
            $retVal = false;
        }

        $conexion->Cerrar();
        return $retVal;
    }
    function ActualizarSesion(Sesion $sesion)
    {
        $retVal = false;
        $conexion = new Conexion();
        $sql = "CALL SpActualizarSesion( " . $sesion->getId() .
            ",'" . $sesion->getFecha() .
            "', '" . $sesion->getDescripcion() .
            "', " . $sesion->getActaAprobada() .
            ", '" . $sesion->getUrlActa() .
            "', '" . $sesion->getUrlAgenda() .
            "', '" . $sesion->getUrlVideo() . "', " . $sesion->getIdComision() . ")";
        try {
            if ($conexion->Ejecutar($sql)) {
                $retVal = true;
            }
        } catch (Exception $ex) {
            $retVal = false;
        }

        $conexion->Cerrar();
        return $retVal;
    }
    function Comisiones()
    {
        $comisiones = array();
        $conexion = new Conexion();
        $sql = "SELECT * FROM COMISIONES";
        $resultado = $conexion->Ejecutar($sql);
        if (mysqli_num_rows($resultado) > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $comision = new Comision();
                $comision->setId($fila["ID"]);
                $comision->setDescripcion($fila["DESCRIPCION"]);
                $comisiones[] = $comision;
            }
        } else
            $comisiones = null;
        $conexion->Cerrar();
        return $comisiones;
    }
}
