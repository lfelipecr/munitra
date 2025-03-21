<?php
require_once './Modelo/Entidades/Credenciales.php';
require_once './Modelo/Conexion.php';

class CredencialesM
{
    function IngresarCredenciales(Credenciales $credenciales)
    {
        $retVal = false;
        $conexion = new Conexion();
        $sql = "CALL SpIngresarCredenciales(" . $credenciales->getIdUsuario() .
            ", '" . $credenciales->getCodigo() .
            "', '" . $credenciales->getUrlImagen() . "', '" . $credenciales->getFirma() .
            "', '" . $credenciales->getUrlConsentimiento() . "')";
        try {
            if ($conexion->Ejecutar($sql)) {
                $retVal = true;
                Logger::info("Ingreso de credenciales para usuario:" . $credenciales->getIdUsuario());
            } else {
                Logger::error("Error en ingreso de credenciales para usuario:" . $credenciales->getIdUsuario());
            }
        } catch (Exception $ex) {
            $retVal = false;
            Logger::error("Excepción en ingreso de credenciales: " . $ex->getMessage());
        }
        $conexion->Cerrar();
        return $retVal;
    }
    function ModificarCredenciales(Credenciales $credenciales)
    {
        $retVal = false;
        $conexion = new Conexion();
        $sql = "CALL SpActualizarCredenciales(" . $credenciales->getId() .
            ", '" . $credenciales->getCodigo() .
            "', '" . $credenciales->getUrlImagen() . "', '" . $credenciales->getFirma() .
            "', '" . $credenciales->getUrlConsentimiento() . "')";
        $resultado = $conexion->Ejecutar($sql);
        try {
            if ($conexion->Ejecutar($sql)) {
                Logger::info("Modificacion de credenciales de ID: " . $credenciales->getId());
                $retVal = true;
            } else {
                Logger::error("Error en modificación de credenciales: " . $credenciales->getId());
            }
        } catch (Exception $ex) {
            Logger::error("Excepción en modificación de credenciales: " . $ex->getMessage());
            $retVal = false;
        }
        $conexion->Cerrar();
        return $retVal;
    }
    function EliminarCredenciales($id)
    {
        $retVal = false;
        $conexion = new Conexion();
        $sql = "DELETE FROM CREDENCIALES WHERE ID = $id";
        $resultado = $conexion->Ejecutar($sql);
        try {
            if ($conexion->Ejecutar($sql)) {
                $retVal = true;
                Logger::info("Credenciales Removidas");
            }
        } catch (Exception $ex) {
            Logger::error("Excepción en remoción de credenciales: " . $ex->getMessage());
            $retVal = false;
        }
        $conexion->Cerrar();
        return $retVal;
    }
    //JSON -> PHP
    function BuscarCredenciales($id)
    {
        $registro = null;
        $conexion = new Conexion();
        $sql = "CALL SpBuscarCredenciales($id)";
        $resultado = $conexion->Ejecutar($sql);
        Logger::info("Consulta a credenciales de ID: " . $id);
        if (mysqli_num_rows($resultado) > 0) {
            $registro = json_encode($resultado->fetch_assoc());
        } else
            $registro = null;
        $conexion->Cerrar();
        return $registro;
    }
    //Valida existencia del código enviado por correo electrónico para confirmar la cuenta
    function ValidarCodigo($codigo)
    {
        $registro = null;
        $conexion = new Conexion();
        $sql = "CALL SpValidarCodigo('$codigo')";
        Logger::info("Validación de Código: " . $codigo);
        $resultado = $conexion->Ejecutar($sql);
        if (mysqli_num_rows($resultado) > 0) {
            $registro = json_encode($resultado->fetch_assoc());
        } else
            $registro = null;
        $conexion->Cerrar();
        return $registro;
    }
}
