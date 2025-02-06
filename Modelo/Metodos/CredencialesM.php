<?php
require_once './Modelo/Entidades/Credenciales.php';
require_once './Modelo/Conexion.php';

class CredencialesM{
    function IngresarCredenciales(Credenciales $credenciales)
    {
        $retVal = false;
        $conexion= new Conexion();
        $sql="CALL SpIngresarCredenciales(".$credenciales->getIdUsuario().
        ", '".$credenciales->getCodigo().
        "', '".$credenciales->getUrlImagen()."', '".$credenciales->getFirma().
        "', '".$credenciales->getUrlConsentimiento()."')";
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
        $sql="CALL SpActualizarCredenciales(".$credenciales->getId().
        ", '".$credenciales->getCodigo().
        "', '".$credenciales->getUrlImagen()."', '".$credenciales->getFirma().
        "', '".$credenciales->getUrlConsentimiento()."')";
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
    function EliminarCredenciales($id){
        $retVal = false;
        $conexion= new Conexion();
        $sql="DELETE FROM CREDENCIALES WHERE ID = $id";
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
        $registro=null;
        $conexion= new Conexion();
        $sql="CALL SpBuscarCredenciales($id)";
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            $registro = json_encode($resultado->fetch_assoc());
        }
        else
            $registro=null;
        $conexion->Cerrar();
        return $registro;
    }
    function ValidarCodigo($codigo){
        $registro=null;
        $conexion= new Conexion();
        $sql="CALL SpValidarCodigo('$codigo')";
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            $registro = json_encode($resultado->fetch_assoc());
        }
        else
            $registro=null;
        $conexion->Cerrar();
        return $registro;
    }
}