<?php
require_once './Modelo/Conexion.php';

class DocumentacionM
{
    function ListarDocumentos($id){
        $registro='';
        $conexion= new Conexion();
        $sql="CALL SpListarDocumentos($id)";
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            $registro = json_encode($resultado->fetch_all());
        }
        else
            $registro=null;
        $conexion->Cerrar();
        return $registro;
    }
    function IngresarDocumento(Documentacion $documentacion){
        $retVal=false;
        $conexion= new Conexion();
        $sql = "CALL SpIngresarDocumento( ".$documentacion->getDepartamento().
        ", '".$documentacion->getDescripcion().
        "', '".$documentacion->getUrlArchivo()."', ".$documentacion->getUsuarioCreacion().")";
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
    function EliminarDocumento($id){
        $retVal=false;
        $conexion= new Conexion();
        $sql="CALL SpEliminarDocumento($id)";
        echo $sql;
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