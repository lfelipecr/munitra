<?php
require_once './Modelo/Entidades/Credenciales.php';
require_once './Modelo/Conexion.php';

class CredencialesM{
    function IngresarCredenciales(Credenciales $credenciales)
    {
        $retVal = false;
        $conexion= new Conexion();
        $sql="CALL IngresarCredenciales(".$credenciales->getIdUsuario().
        ", '".$credenciales->getCodigo().
        "', '".$credenciales->getUrlImagen()."', '".$credenciales->getFirma()."')";
        $resultado=$conexion->Ejecutar($sql);
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
    function ModificarCredenciales(Credenciales $credenciales){
        $retVal = false;
        $conexion= new Conexion();
        $sql="CALL ActualizarCredenciales(".$credenciales->getId().
        ", '".$credenciales->getCodigo().
        "', '".$credenciales->getUrlImagen()."', '".$credenciales->getFirma()."')";
        $resultado=$conexion->Ejecutar($sql);
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
    function BuscarCredenciales($id){

    }
}