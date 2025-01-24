<?php
require_once './Modelo/Entidades/Barrio.php';
require_once './Modelo/Entidades/Provincia.php';
require_once './Modelo/Entidades/Distrito.php';
require_once './Modelo/Entidades/Canton.php';
require_once './Modelo/Conexion.php';

class ProvinciaM 
{
    private function BuscarDistritos() {
        $registro=array();
        $conexion= new Conexion();
        $sql="SELECT * FROM DISTRITO;";
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
            {
                $distrito = new Distrito();
                $distrito->setId($fila["ID"]);
                $distrito->setNombre($fila["NOMBRE"]);
                $distrito->setIdCanton($fila["ID_CANTON"]);
                $distrito->setIdProvincia($fila["ID_PROVINCIA"]);
                $registro[] = $distrito;
            }
        }
        else
            $registro=null;
        $conexion->Cerrar();
        return $registro;
    }
    private function BuscarCantones() {
        $registro=array();
        $conexion= new Conexion();
        $sql="SELECT * FROM CANTON;";
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
            {
                $canton = new Canton();
                $canton->setId($fila["ID"]);
                $canton->setNombre($fila["NOMBRE"]);
                $canton->setIdProvincia($fila["ID_PROVINCIA"]);
                $registro[] = $canton;
            }
        }
        else
            $registro=null;
        $conexion->Cerrar();
        return $registro;
    }
    private function BuscarProvincias() {
        $registro=array();
        $conexion= new Conexion();
        $sql="SELECT * FROM PROVINCIA;";
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
            {
                $provincia = new Provincia();
                $provincia->setId($fila["ID"]);
                $provincia->setNombre($fila["NOMBRE"]);
                $registro[] = $provincia;
            }
        }
        else
            $registro=null;
        $conexion->Cerrar();
        return $registro;
    }
    function BuscarLocaciones() {
        
        $registros = array();
        $registros[] = $this->BuscarProvincias();
        $registros[] = $this->BuscarCantones();
        $registros[] = $this->BuscarDistritos();
        return $registros;
    }
}