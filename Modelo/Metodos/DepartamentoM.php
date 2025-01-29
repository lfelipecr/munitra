<?php
require_once './Modelo/Entidades/Departamento.php';
require_once './Modelo/Conexion.php';

class DepartamentoM
{
    function BuscarDepartamentos()
    {
        $registro=array();
        $conexion= new Conexion();
        $sql="SELECT * FROM DEPARTAMENTO;";
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
            {
                $departamento = new Departamento();
                $departamento->setId($fila["ID"]);
                $departamento->setDescripcion($fila["DESCRIPCION"]);
                $registro[] = $departamento;
            }
        }
        else
            $registro=null;
        $conexion->Cerrar();
        return $registro;
    }
}