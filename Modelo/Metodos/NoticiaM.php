<?php
require_once './Modelo/Conexion.php';
require_once './Modelo/Entidades/Persona.php';
require_once './Modelo/Entidades/Usuario.php';
require_once './Modelo/Entidades/Noticia.php';
class NoticiaM
{
    function ActualizarNoticia(Noticia $noticia)
    {
        $retVal = false;
        $conexion = new Conexion();
        $sql = "CALL SpActualizarNoticia(" . $noticia->getId() .
            ", '" . $noticia->getTitulo() .
            "', '" . $noticia->getDescripcionLarga() .
            "', '" . $noticia->getUrlImagen() . "', '" . $noticia->getUrlAdjunto() . "', '" . $noticia->getFecha() . "')";
        try {
            if ($conexion->Ejecutar($sql)) {
                Logger::info("Se modifica noticia: " . $sql);
                $retVal = true;
            } else {
                Logger::error("No se puede modificar noticia: " . $sql);
            }
        } catch (Exception $ex) {
            Logger::error("Excepción en BD: " . $ex->getMessage());
            $retVal = false;
        }
        $conexion->Cerrar();
        return $retVal;
    }
    function IngresarNoticia(Noticia $noticia)
    {
        $retVal = false;
        $conexion = new Conexion();
        $sql = "CALL SpIngresarNoticia(" . $noticia->getIdUsuario() .
            ", '" . $noticia->getTitulo() .
            "', '" . $noticia->getDescripcionLarga() .
            "', '" . $noticia->getUrlAdjunto() . "', '" . $noticia->getUrlImagen() . "', '" . $noticia->getFecha() . "')";
        try {
            if ($conexion->Ejecutar($sql)) {
                Logger::info("Registro de nueva noticia: " . $sql);
                $retVal = true;
            } else {
                Logger::error("No se puede conpletar registro de nueva noticia: " . $sql);
            }
        } catch (Exception $ex) {
            Logger::error("Excepción en BD: " . $ex->getMessage());
            $retVal = false;
        }
        $conexion->Cerrar();
        return $retVal;
    }
    function Eliminar($id)
    {
        $retVal = false;
        $conexion = new Conexion();
        $sql = "UPDATE NOTICIA SET INHABILITADA = 1 WHERE ID = $id";
        try {
            if ($conexion->Ejecutar($sql)) {
                Logger::info("Eliminación de Noticia: " . $id);
                $retVal = true;
            } else {
                Logger::error("No se pudo eliminar Noticia: " . $id);
            }
        } catch (Exception $ex) {
            Logger::error("Excepción en BD: " . $ex->getMessage());
            $retVal = false;
        }
        $conexion->Cerrar();
        return $retVal;
    }
    function BuscarNoticia($id)
    {
        $registro = null;
        $conexion = new Conexion();
        $sql = "CALL SpBuscarNoticia($id);";
        $resultado = $conexion->Ejecutar($sql);
        if (mysqli_num_rows($resultado) > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $noticia = new Noticia();
                $noticia->setId($fila["ID"]);
                $noticia->setIdUsuario($fila['ID_USUARIO']);
                $noticia->setTitulo($fila["TITULO"]);
                $noticia->setDescripcionLarga($fila["DESCRIPCION_LARGA"]);
                $noticia->setUrlImagen($fila["URL_IMAGEN"]);
                $noticia->setUrlAdjunto($fila['URL_ADJUNTO']);
                $noticia->setFecha($fila['FECHA']);
                $noticia->setInhabilitada($fila["INHABILITADA"]);
                $registro = $noticia;
            }
            Logger::info("Consulta a noticia: " . $id);
        } else
            $registro = null;
        $conexion->Cerrar();
        return $registro;
    }
    function BuscarNoticias()
    {
        $registro = array();
        $conexion = new Conexion();
        $sql = "CALL SpBuscarNoticias();";
        $resultado = $conexion->Ejecutar($sql);
        $registro = array();
        if (mysqli_num_rows($resultado) > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $noticia = new Noticia();
                $noticia->setId($fila['NOTICIA_ID']);
                $noticia->setTitulo($fila['NOTICIA_TITULO']);
                $noticia->setDescripcionLarga($fila['NOTICIA_DESCRIPCION']);
                $noticia->setUrlImagen($fila['NOTICIA_URL_IMAGEN']);
                $noticia->setIdUsuario($fila['USUARIO_ID']);
                $noticia->setFecha($fila['FECHA']);
                $noticia->setAutor($fila['PERSONA_NOMBRE'] . ' '
                    . $fila['PERSONA_PRIMER_APELLIDO'] . ' ' . $fila['PERSONA_SEGUNDO_APELLIDO']);
                $registro[] = $noticia;
            }
        } else
            $registro = null;
        $conexion->Cerrar();
        return $registro;
    }
}
