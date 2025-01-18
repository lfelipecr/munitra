<?php

class ListaM
{
    function AforoEvento(){
        $aforo = 0;
        $conexion= new Conexion();
        $sql="SELECT AFORO FROM EVENTO;";
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
                $aforo = $fila["AFORO"];
        }
        $conexion->Cerrar();
        return $aforo;
    }
    function MaxID(){
        $idMax = 0;
        $conexion= new Conexion();
        $sql="SELECT MAX(ID) FROM LISTA;";
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
                $idMax = $fila["MAX(ID)"];
        }
        $conexion->Cerrar();
        return $idMax;
    }
    function Nuevo(Lista $l) {
        $retVal=0;
        $conexion= new Conexion();

        $sql="INSERT INTO `LISTA`(`ID_EVENTO`, `ID_USUARIO`, `ACTIVO`) VALUES"
        ." ('".$l->getIdEvento()."', '".$l->getIdUsuario()."', 0)";
        if($conexion->Ejecutar($sql))
            $retVal = $this->MaxID();
        $conexion->Cerrar();
        return $retVal;
    }
    function Buscar() {
        $conexion= new Conexion();
        $sql="SELECT LISTA.ID, USUARIO.NOMBRE, USUARIO.APELLIDO1, USUARIO.APELLIDO2, USUARIO.TELEFONO, USUARIO.CORREO, USUARIO.ID_CEDULA, LISTA.ACTIVO FROM LISTA JOIN USUARIO ON LISTA.ID_USUARIO = USUARIO.ID; ";
        $resultado=$conexion->Ejecutar($sql);
        $conexion->Cerrar();
        return $resultado;
    }
    function BuscarTicket($id){
        $conexion= new Conexion();
        $sql="SELECT LISTA.ID, USUARIO.NOMBRE, USUARIO.APELLIDO1, USUARIO.APELLIDO2, USUARIO.TELEFONO, USUARIO.CORREO, USUARIO.ID_CEDULA, LISTA.ACTIVO FROM LISTA JOIN USUARIO ON LISTA.ID_USUARIO = USUARIO.ID WHERE LISTA.ID_USUARIO = ".$id.";";
        $resultado=$conexion->Ejecutar($sql);
        $conexion->Cerrar();
        return $resultado;
    }
    function Habilitar($id) {
        $retVal=false;
        $conexion= new Conexion();
        $sql="UPDATE LISTA SET ACTIVO = 1 WHERE ID = ".$id."; ";
        if($conexion->Ejecutar($sql))
            $retVal = true;
        $conexion->Cerrar();
        return $retVal;       
    }
    function Inhabilitar($id) {
        $retVal=false;
        $conexion= new Conexion();
        $sql="UPDATE LISTA SET ACTIVO = 0 WHERE ID = ".$id."; ";
        if($conexion->Ejecutar($sql))
            $retVal = true;
        $conexion->Cerrar();
        return $retVal;       
    }
    function ModificarAforo($aforo){
        $retVal=false;
        $conexion= new Conexion();
        $sql="UPDATE EVENTO SET AFORO = ".$aforo." WHERE ID = 1; ";
        if($conexion->Ejecutar($sql))
            $retVal = true;
        $conexion->Cerrar();
        return $retVal;       
    }
}