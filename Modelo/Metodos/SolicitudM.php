<?php
require_once './Modelo/Entidades/Solicitud.php';
require_once './Modelo/Entidades/DetalleSolicitud.php';
require_once './Modelo/Conexion.php';

class SolicitudM {
    function BuscarCabeceraSolicitud ($id){
        $conexion= new Conexion();
        $sql="CALL SpConsultarSolicitudPorID($id);";
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
            {
                $solicitud = new Solicitud();
                $solicitud->setId($fila["ID"]);
                $solicitud->setFecha($fila['FECHA']);
                $solicitud->setEstadoSolicitud($fila['ESTADO_SOLICITUD']);
                $solicitud->setTipoSolicitud($fila['TIPO_SOLICITUD']);
                $solicitud->setIdPersona($fila['PERSONA_ID']);
                $registro = $solicitud;
            }
        }
        else
            $registro=null;
        $conexion->Cerrar();
        return $registro;
    }
    function BuscarDetallesSolicitud($id){
        $conexion= new Conexion();
        $sql="CALL SpBuscarDetallesPorSolicitud($id);";
        
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
    function MaxID(){
        $idMax = 0;
        $conexion= new Conexion();
        $sql="SELECT MAX(ID) FROM SOLICITUD;";
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
                $idMax = $fila["MAX(ID)"];
        }
        $conexion->Cerrar();
        return $idMax;
    }
    function IngresarDetalles($arregloDetalles){
        $retVal=true;
        $conexion= new Conexion();
        for ($i = 0; $i < count($arregloDetalles); $i++){
            $sql = "CALL SpIngresarDetalleSolicitud('".$arregloDetalles[$i]->getCampoRequisito().
            "', '', ".$arregloDetalles[$i]->getCumple().
            ", ".$arregloDetalles[$i]->getIdSolicitud().
            ", ".$arregloDetalles[$i]->getTipoRequisito().")";
            try{
                if($conexion->Ejecutar($sql)){
                    $retVal = true;
                } else {
                    $retVal = false;
                    break;
                }
            } catch (Exception $ex){
                $retVal=false;
            }
        }
        $conexion->Cerrar();
        return $retVal;
    }
    function IngresarSolicitud(Solicitud $solicitud){
        $retVal=0;
        $conexion= new Conexion();
        $sql = "CALL SpIngresarSolicitud(".$solicitud->getIdPersona().
        ", ".$solicitud->getIdUsuario().
        ", ".$solicitud->getEstadoSolicitud().
        ", ".$solicitud->getTipoSolicitud().")";
        try{
            if($conexion->Ejecutar($sql)){
                $retVal = $this->MaxID();
            }
        } catch (Exception $ex){
            $retVal=0;
        }        
        $conexion->Cerrar();
        return $retVal;
    }
    function EliminarSolicitud($id){
        $retVal=false;
        $conexion= new Conexion();
        $sql = "DELETE FROM  SOLICITUD WHERE ID = $id";
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
    function BuscarSolicitudes($idTipo){
        $conexion= new Conexion();
        if ($_SESSION['usuario']->getIdDepartamento() == 1){
            $idUsuario = $_SESSION['usuario']->getIdPersona();
            $sql="CALL SpConsultarTodasSolicitudesUsuario($idTipo, $idUsuario);";
        } else {
            $sql="CALL SpConsultarTodasSolicitudes($idTipo);";
        }
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
    function ActualizarCabeceraSolicitud(Solicitud $solicitud){
        $retVal=false;
        $conexion= new Conexion();
        $sql = "CALL SpActualizarSolicitud(".$solicitud->getId().
        ", ".$solicitud->getEstadoSolicitud().")";
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
    function ActualizarDetallesSolicitud($arregloDetalles){
        $retVal=true;
        $conexion= new Conexion();
        for ($i = 0; $i < count($arregloDetalles); $i++){
            $sql = "CALL SpActualizarDetalleSolicitud( ".$arregloDetalles[$i]->getId().
            ", '".$arregloDetalles[$i]->getCampoRequisito().
            "', ".$arregloDetalles[$i]->getCumple().")";
            try{
                if($conexion->Ejecutar($sql)){
                    $retVal = true;
                } else {
                    $retVal = false;
                    break;
                }
            } catch (Exception $ex){
                $retVal=false;
            }
        }
        $conexion->Cerrar();
        return $retVal;       
    }
}