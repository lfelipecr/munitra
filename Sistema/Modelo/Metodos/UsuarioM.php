<?php
require_once './Modelo/Entidades/Persona.php';
require_once './Modelo/Entidades/Usuario.php';
require_once './Modelo/Conexion.php';

class UsuarioM {
    function ValidarCredenciales($correo, $pass){
        $conexion= new Conexion();
        $sql="CALL SpConsultarCredenciales('".$correo."', '".$pass."')";
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
            {
                $usuario = new Usuario();
                $usuario->setId($fila["ID"]);
                $usuario->setNombreUsuario($fila["NOMBRE_USUARIO"]);
                $usuario->setPass($fila["PASS"]);
                $usuario->setResponsable($fila["RESPONSABLE"]);
                $usuario->setIdPersona($fila["ID_PERSONA"]);
                $usuario->setIdDepartamento($fila["ID_DEPARTAMENTO"]);
                $usuario->setIdEstado($fila["ID_ESTADO"]);
            }
        }
        else
            $registro=null;
        $conexion->Cerrar();
        return $usuario;
    }
}