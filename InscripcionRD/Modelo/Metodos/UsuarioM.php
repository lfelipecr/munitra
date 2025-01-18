<?php

class UsuarioM
{
    function MaxID(){
        $idMax = 0;
        $conexion= new Conexion();
        $sql="SELECT MAX(ID) FROM USUARIO;";
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
                $idMax = $fila["MAX(ID)"];
        }
        $conexion->Cerrar();
        return $idMax;
    }
    function Nuevo(Usuario $u) {
        $retVal=0;
        $conexion= new Conexion();
        $sql = 'INSERT INTO USUARIO(ID_CEDULA, NOMBRE, APELLIDO1, APELLIDO2, TELEFONO, CORREO, ID_ROL, ACTIVO)
        VALUES ("'.$u->getIdCedula().
        '","'.$u->getNombre().
        '","'.$u->getApellido1().
        '","'.$u->getApellido2().
        '","","",2,1);';
        if($conexion->Ejecutar($sql)){
            $retVal = $this->MaxID();
        }
        $conexion->Cerrar();
        return $retVal;
    }
    function Buscar() {
        $registro=array();
            $conexion= new Conexion();
            $sql="SELECT * FROM USUARIO";
            $resultado=$conexion->Ejecutar($sql);
            if(mysqli_num_rows($resultado)>0)
            {
                while($fila=$resultado->fetch_assoc())
                {
                    $u = new Usuario();
                    $u->setId($fila["ID"]);
                    $u->setIdCedula($fila["ID_CEDULA"]);
                    $u->setNombre($fila["NOMBRE"]);
                    $u->setApellido1($fila["APELLIDO1"]);
                    $u->setApellido2($fila["APELLIDO2"]);
                    $u->setIdRol($fila["ID_ROL"]);
                    $registro[] = $u;
                }
            }
            else
                $registro=null;
    
            $conexion->Cerrar();
    
            return $registro;
    }
}