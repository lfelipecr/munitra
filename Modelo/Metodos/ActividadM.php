<?php
require_once './Modelo/Entidades/Actividad.php';
require_once './Modelo/Conexion.php';

class ActividadM
{
    function Ingresar(Actividad $actividad)
    {
        $retVal = false;
        $conexion = new Conexion();
        $sql = "INSERT INTO ACTIVIDAD (ID_USUARIO, TITULO, DESCRIPCION_LARGA, ADJUNTOS, INHABILITADA, FECHA) VALUES (" .
            $actividad->getIdUsuario() . ", '" . $actividad->getTitulo() . "', '" . $actividad->getDescripcionLarga() . "', '" .
            $actividad->getUrlAdjunto() . "', 0, '" . $actividad->getFecha() . "')";
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
    function Eliminar($id)
    {
        $retVal = false;
        $conexion = new Conexion();
        $sql = "UPDATE ACTIVIDAD SET INHABILITADA = 1 WHERE ID = $id";
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
    function Actualizar(Actividad $actividad)
    {
        $retVal = false;
        $conexion = new Conexion();

        if ($actividad->getUrlAdjunto() == 'null') {
            $sql = "UPDATE ACTIVIDAD SET TITULO = '" . $actividad->getTitulo() .
                "', DESCRIPCION_LARGA = '" . $actividad->getDescripcionLarga() .
                "', FECHA = '" . $actividad->getFecha() . "' WHERE ID = " . $actividad->getId();
        } else {
            $sql = "UPDATE ACTIVIDAD SET TITULO = '" . $actividad->getTitulo() .
                "', DESCRIPCION_LARGA = '" . $actividad->getDescripcionLarga() .
                "', FECHA = '" . $actividad->getFecha() . "', ADJUNTOS = '"
                . $actividad->getUrlAdjunto() . "' WHERE ID = " . $actividad->getId();;
        }
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
    function BuscarTodas()
    {
        $registro = null;
        $conexion = new Conexion();
        $sql = "SELECT * FROM ACTIVIDAD WHERE INHABILITADA = 0;";
        $resultado = $conexion->Ejecutar($sql);
        if (mysqli_num_rows($resultado) > 0) {
            $registro = json_encode($resultado->fetch_all());
        } else
            $registro = null;
        $conexion->Cerrar();
        return $registro;
    }
    function BuscarActividad($id)
    {
        $actividad = null;
        $conexion = new Conexion();
        $sql = "SELECT * FROM ACTIVIDAD WHERE INHABILITADA = 0 AND ID = $id;";
        $resultado = $conexion->Ejecutar($sql);
        if (mysqli_num_rows($resultado) > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $actividad = new Actividad();
                $actividad->setId($id);
                $actividad->setIdUsuario($fila['ID_USUARIO']);
                $actividad->setTitulo($fila['TITULO']);
                $actividad->setDescripcionLarga($fila['DESCRIPCION_LARGA']);
                $actividad->setUrlAdjunto($fila['ADJUNTOS']);
                $actividad->setFecha($fila['FECHA']);
            }
        } else
            $actividad = null;
        $conexion->Cerrar();
        return $actividad;
    }
}
