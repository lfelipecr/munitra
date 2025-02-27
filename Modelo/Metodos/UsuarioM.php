<?php
require_once './Modelo/Entidades/Persona.php';
require_once './Modelo/Entidades/Usuario.php';
require_once './Modelo/Conexion.php';

class UsuarioM {
    function IdMax(){
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
    function IngresarUsuario(Usuario $usuario){
        $retVal = false;
        $conexion= new Conexion();
        $passHash = password_hash($usuario->getPass(), PASSWORD_DEFAULT);
        $sql = "Call SpInsertarUsuario('".$usuario->getNombreUsuario().
        "','".$usuario->getCorreo().
        "','".$passHash.
        "', ".$usuario->getResponsable().
        ", ".$usuario->getIdPersona().
        ", ".$usuario->getIdDepartamento().
        ", ".$usuario->getIdEstado().")";
        try{
            if($conexion->Ejecutar($sql)){
                $retVal = true;
            }
        } catch (Exception $ex){
            $retVal = false;
        }
        
        $conexion->Cerrar();
        return $retVal;
    }
    function ValidarCredenciales($correo, $pass){
        $hashPass = password_hash($pass, PASSWORD_DEFAULT);
        $conexion= new Conexion();
        $sql="CALL SpConsultarCredenciales('".$correo."')";
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
            {
                $usuario = new Usuario();
                $usuario->setId($fila["ID"]);
                $usuario->setNombreUsuario($fila["NOMBRE_USUARIO"]);
                $usuario->setPass($fila["PASS"]);
                $usuario->setCorreo($correo);
                $usuario->setResponsable($fila["RESPONSABLE"]);
                $usuario->setIdPersona($fila["ID_PERSONA"]);
                $usuario->setIdDepartamento($fila["ID_DEPARTAMENTO"]);
                $usuario->setIdEstado($fila["ID_ESTADO"]);
            }
        }
        else
            $usuario=null;
        if ($usuario != null){
            if(!password_verify($pass, $usuario->getPass())){
                $usuario=null;
            }
        }
        $conexion->Cerrar();
        return $usuario;
    }
    function BuscarUsuarioId($id){
        $usuario=null;
        $conexion= new Conexion();
        $sql="CALL SpConsultarUsuario($id)";
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
            {
                $usuario = new Usuario();
                $usuario->setId($fila["ID"]);
                $usuario->setNombreUsuario($fila["NOMBRE_USUARIO"]);
                $usuario->setCorreo($fila['CORREO']);
                $usuario->setPass($fila["PASS"]);
                $usuario->setResponsable($fila["RESPONSABLE"]);
                $usuario->setIdPersona($fila["ID_PERSONA"]);
                $usuario->setIdDepartamento($fila["ID_DEPARTAMENTO"]);
                $usuario->setIdEstado($fila["ID_ESTADO"]);
            }
        }
        $conexion->Cerrar();
        return $usuario;
    }
    function BuscarUsuarioIdPersona($idPersona)
    {
        $usuario=null;
        $conexion= new Conexion();
        $sql="SELECT * FROM USUARIO WHERE ID_PERSONA = $idPersona";
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
            {
                $usuario = new Usuario();
                $usuario->setId($fila["ID"]);
                $usuario->setNombreUsuario($fila["NOMBRE_USUARIO"]);
                $usuario->setCorreo($fila['CORREO']);
                $usuario->setPass($fila["PASS"]);
                $usuario->setResponsable($fila["RESPONSABLE"]);
                $usuario->setIdPersona($fila["ID_PERSONA"]);
                $usuario->setIdDepartamento($fila["ID_DEPARTAMENTO"]);
                $usuario->setIdEstado($fila["ID_ESTADO"]);
            }
        }
        $conexion->Cerrar();
        return $usuario;
    }
    function Actualizar($usuario){
        $retVal = false;
        $conexion= new Conexion();
        $passHash = password_hash($usuario->getPass(), PASSWORD_DEFAULT);
        $sql = "Call SpActualizarUsuario( ".$usuario->getID().
        ", '".$usuario->getNombreUsuario().
        "','".$usuario->getCorreo().
        "', ".$usuario->getResponsable().
        ", ".$usuario->getIdPersona().
        ", ".$usuario->getIdDepartamento().
        ", ".$usuario->getIdEstado().")";
        try{
            if($conexion->Ejecutar($sql)){
                $retVal = true;
            }
        } catch (Exception $ex){
            $retVal = false;
        }
        
        $conexion->Cerrar();
        return $retVal;
    }
    function CambiarContra($contra, $id){
        $retVal = false;
        $conexion= new Conexion();
        $passHash = password_hash($contra, PASSWORD_DEFAULT);
        $sql = "UPDATE USUARIO SET PASS = '$passHash' WHERE ID = $id";
        try{
            if($conexion->Ejecutar($sql)){
                $retVal = true;
            }
        } catch (Exception $ex){
            $retVal = false;
        }
        
        $conexion->Cerrar();
        return $retVal;
    }
}