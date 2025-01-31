<?php
require_once './Modelo/Entidades/BitacoraSolicitud.php';
require_once './Modelo/Conexion.php';

class BitacoraSolicitudM {
    function IngresarBitacora(BitacoraSolicitud $bitacora){
        $retVal=false;
        $conexion= new Conexion();
        $sql = "CALL SpIngresarBitacora(".$bitacora->getIdSolicitud().
        ", ".$bitacora->getIdUsuario().
        ", ".$bitacora->getIdEstado().
        ", '".$bitacora->getNota().
        "', '".$bitacora->getDetalle()."')";
        try{
            if($conexion->Ejecutar($sql)){
                $retVal = true;
            }
        } catch (Exception $ex){
            $retVal=false;
        }
        $conexion->Cerrar();
        return $retVal;
    }
}