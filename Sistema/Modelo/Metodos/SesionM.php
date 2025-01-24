<?php
class SesionM{
    function BuscarSesiones(){
        $conexion= new Conexion();
        $sql="CALL SpBuscarSesiones();";
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