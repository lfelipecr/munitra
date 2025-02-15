<?php
require_once './Modelo/Conexion.php';
require_once './Modelo/Entidades/Persona.php';
require_once './Modelo/Entidades/Usuario.php';
require_once './Modelo/Entidades/Noticia.php';
class NoticiaM {
    function ActualizarNoticia(Noticia $noticia){
        $retVal=false;
        $conexion= new Conexion();
        $sql = "CALL SpActualizarNoticia(".$noticia->getId().
        ", '".$noticia->getTitulo().
        "', '".$noticia->getDescripcionLarga().
        "', '".$noticia->getUrlImagen()."', '".$noticia->getUrlAdjunto()."', '".$noticia->getFecha()."')";
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
    function IngresarNoticia(Noticia $noticia){
        $retVal=false;
        $conexion= new Conexion();
        $sql = "CALL SpIngresarNoticia(".$noticia->getIdUsuario().
        ", '".$noticia->getTitulo().
        "', '".$noticia->getDescripcionLarga().
        "', '".$noticia->getUrlAdjunto()."', '".$noticia->getUrlImagen()."', '".$noticia->getFecha()."')";
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
    function Eliminar($id){
        $retVal = false;
        $conexion= new Conexion();
        $sql="UPDATE NOTICIA SET INHABILITADA = 1 WHERE ID = $id";
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
    function BuscarNoticia($id){
        $registro=null;
        $conexion= new Conexion();
        $sql="CALL SpBuscarNoticia($id);";
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
            {
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
        }
        else
            $registro=null;
        $conexion->Cerrar();
        return $registro;
    }
    function BuscarNoticias(){
        $registro=array();
        $conexion= new Conexion();
        $sql="CALL SpBuscarNoticias();";
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
}