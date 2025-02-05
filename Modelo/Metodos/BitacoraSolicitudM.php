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
    function CredencialesSMTP(){
        $registro=array();
        $conexion= new Conexion();
        $sql="SELECT * FROM PARAMETROS";
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
            {
                $registro[$fila['DESCRIPCION']] = $fila['VALOR'];
            }
        }
        else
            $registro=null;
        $conexion->Cerrar();
        return $registro;
    }
}