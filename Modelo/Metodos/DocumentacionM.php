<?php
require_once './Modelo/Conexion.php';
require_once './Modelo/Entidades/Documentacion.php';
require_once './Modelo/Entidades/TipoDocumento.php';

class DocumentacionM
{
    function ListarDocumentos($id)
    {
        $registro = '';
        $conexion = new Conexion();
        $sql = "CALL SpListarDocumentos($id)";
        $resultado = $conexion->Ejecutar($sql);
        $registro = array();
        if (mysqli_num_rows($resultado) > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $documentacion = new Documentacion();
                $documentacion->setId($fila['ID']);
                $documentacion->setDescripcion($fila['DESCRIPCION']);
                $documentacion->setUrlArchivo($fila['URL_ARCHIVO']);
                $documentacion->setUsuarioCreacion($fila['USUARIO_CREACION']);
                $documentacion->setDepartamento($fila['DEPARTAMENTO']);
                $documentacion->setTipoDocumento($fila['TIPO_DOCUMENTO']);
                $registro[] = $documentacion;
            }
        } else
            $registro = null;
        $conexion->Cerrar();
        return $registro;
    }
    function IngresarDocumento(Documentacion $documentacion)
    {
        $retVal = false;
        $conexion = new Conexion();
        $sql = "CALL SpIngresarDocumento( " . $documentacion->getDepartamento() .
            ", '" . $documentacion->getDescripcion() .
            "', '" . $documentacion->getUrlArchivo() . "', " . $documentacion->getUsuarioCreacion() .
            ", " . $documentacion->getTipoDocumento() . ")";
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
    function EliminarDocumento($id)
    {
        $retVal = false;
        $conexion = new Conexion();
        $sql = "CALL SpEliminarDocumento($id)";
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
    function TiposDocumento()
    {
        $tipos = array();
        $conexion = new Conexion();
        $sql = "SELECT * FROM TIPO_DOCUMENTO";
        $resultado = $conexion->Ejecutar($sql);
        if (mysqli_num_rows($resultado) > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $tipoDocumento = new TipoDocumento();
                $tipoDocumento->setId($fila["ID"]);
                $tipoDocumento->setDescripcion($fila["DESCRIPCION"]);
                $tipos[] = $tipoDocumento;
            }
        } else
            $tipos = null;
        $conexion->Cerrar();
        return $tipos;
    }
    function CrearCategoria($descripcion)
    {
        $retVal = false;
        $conexion = new Conexion();
        $sql = "INSERT INTO TIPO_DOCUMENTO (DESCRIPCION) VALUES ('$descripcion');";
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
    function EliminarCategoria($id)
    {
        $retVal = false;
        $conexion = new Conexion();
        $sql = "DELETE FROM TIPO_DOCUMENTO WHERE ID = $id";
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
}
