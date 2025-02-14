<?php
require_once './Modelo/Entidades/Persona.php';
require_once './Modelo/Entidades/Usuario.php';
require_once './Modelo/Entidades/DTO/PersonaDTO.php';
require_once './Modelo/Entidades/ImagenUsuario.php';
require_once './Modelo/Conexion.php';

class PersonaM {
    private function MaxID(){
        $idMax = 0;
        $conexion= new Conexion();
        $sql="SELECT MAX(ID) FROM PERSONA;";
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
                $idMax = $fila["MAX(ID)"];
        }
        $conexion->Cerrar();
        return $idMax;
    }
    function ActualizarImagen(ImagenUsuario $imagen){
        $retVal = false;
        $conexion= new Conexion();
        $sql="UPDATE IMAGEN_USUARIO SET URL_IMAGEN = '".$imagen->getUrlImagen()."' WHERE ID = ".$imagen->getId().";";
        $resultado=$conexion->Ejecutar($sql);
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
    function IngresarImagen(ImagenUsuario $imagen){
        $retVal = false;
        $conexion= new Conexion();
        $sql="INSERT INTO IMAGEN_USUARIO (ID_USUARIO, URL_IMAGEN) VALUES (".$imagen->getIdUsuario().", '".$imagen->getUrlImagen()."')";
        $resultado=$conexion->Ejecutar($sql);
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
    function BuscarImagen($idPersona){
        $imagenUsuario=null;
        $conexion= new Conexion();
        $sql="SELECT * FROM IMAGEN_USUARIO WHERE ID_USUARIO = $idPersona";
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
            {
                $imagenUsuario = new ImagenUsuario();
                $imagenUsuario->setId($fila["ID"]);
                $imagenUsuario->setIdUsuario($fila["ID_USUARIO"]);
                $imagenUsuario->setUrlImagen($fila["URL_IMAGEN"]);
            }
        }
        $conexion->Cerrar();
        return $imagenUsuario;
    }
    //Solo se usa dentro de controladores, no se llama directamente
    function EliminarPersona($id){
        $retVal=false;
        $conexion= new Conexion();
        $sql = "DELETE FROM PERSONA WHERE ID = $id";
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
    function BuscarPersona($id){
        $persona=null;
        $conexion= new Conexion();
        $sql="CALL SpConsultarPersona($id)";
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
            {
                $persona = new Persona();
                $persona->setId($fila["ID"]);
                $persona->setIdTipoIdentificacion($fila["ID_TIPO_IDENTIFICACION"]);
                $persona->setIdentificacion($fila["IDENTIFICACION"]);
                $persona->setNombre($fila["NOMBRE"]);
                $persona->setPrimerApellido($fila["PRIMER_APELLIDO"]);
                $persona->setSegundoApellido($fila["SEGUNDO_APELLIDO"]);
                $persona->setDireccion($fila["DIRECCION"]);
                $persona->setTelefono($fila["TELEFONO"]);
                $persona->setWhatsapp($fila["WHATSAPP"]);
                $persona->setEstado($fila["ESTADO"]);
                $persona->setSituacion($fila["SITUACION"]);
                $persona->setMontoMorosidad($fila["MONTO_MOROSIDAD"]);
                $persona->setMontoAdeudado($fila["MONTO_ADEUDADO"]);
                $persona->setConsentimiento($fila["CONSENTIMIENTO"]);
                $persona->setFechaConsentimiento($fila["FECHA_CONSENTIMIENTO"]);
                $persona->getPropiedadFuera($fila["PROPIEDAD_FUERA"]);
                $persona->setFechaActualizacion($fila["FECHA_ACTUALIZACION"]);
                $persona->setFechaCreacion($fila["FECHA_CREACION"]);
                $persona->setIdDistrito($fila["ID_DISTRITO"]);
                $persona->setIdCanton($fila["ID_CANTON"]);
                $persona->setIdProvincia($fila["ID_PROVINCIA"]);
                $persona->setUsuarioCreacion($fila["USUARIO_CREACION"]);
                $persona->setCorreo($fila["CORREO"]);
            }
        }
        $conexion->Cerrar();
        return $persona;
    }
    function ListadoPersonas(){
        $registro = null;
        $conexion= new Conexion();
        $sql="CALL SpConsultarPersonas()";
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
            {
                $persona = new Persona();
                $persona->setId($fila["ID"]);
                $persona->setIdTipoIdentificacion($fila["ID_TIPO_IDENTIFICACION"]);
                $persona->setIdentificacion($fila["IDENTIFICACION"]);
                $persona->setNombre($fila["NOMBRE"]);
                $persona->setPrimerApellido($fila["PRIMER_APELLIDO"]);
                $persona->setSegundoApellido($fila["SEGUNDO_APELLIDO"]);
                $persona->setDireccion($fila["DIRECCION"]);
                $persona->setTelefono($fila["TELEFONO"]);
                $persona->setWhatsapp($fila["WHATSAPP"]);
                $persona->setEstado($fila["ESTADO"]);
                $persona->setSituacion($fila["SITUACION"]);
                $persona->setMontoMorosidad($fila["MONTO_MOROSIDAD"]);
                $persona->setMontoAdeudado($fila["MONTO_ADEUDADO"]);
                $persona->setConsentimiento($fila["CONSENTIMIENTO"]);
                $persona->setFechaConsentimiento($fila["FECHA_CONSENTIMIENTO"]);
                $persona->getPropiedadFuera($fila["PROPIEDAD_FUERA"]);
                $persona->setFechaActualizacion($fila["FECHA_ACTUALIZACION"]);
                $persona->setFechaCreacion($fila["FECHA_CREACION"]);
                $persona->setIdDistrito($fila["ID_DISTRITO"]);
                $persona->setIdCanton($fila["ID_CANTON"]);
                $persona->setIdProvincia($fila["ID_PROVINCIA"]);
                $persona->setUsuarioCreacion($fila["USUARIO_CREACION"]);
                $persona->setCorreo($fila["CORREO"]);
                $registro[] = $persona;
            }
        }
        $conexion->Cerrar();
        return $registro;
    }
    function BuscarPersonaCedula($cedula){
        $listado = $this->ListadoPersonas();
        if ($listado != 'null'){
            for($i = 0; $i < count($listado); $i++)
            {
                if ($cedula == $listado[$i]->getIdentificacion()){
                    return $listado[$i];
                }
            }
        } else {
            return null;
        }
        return null;
    }
    function BuscarPersonaUsuario($idUsuario){
        $listado = $this->ListadoPersonas();
        if ($listado != 'null'){
            for($i = 0; $i < count($listado); $i++)
            {
                if ($idUsuario == $listado[$i]->getId()){
                    return $listado[$i];
                }
            }
        } else {
            return null;
        }
        return null;
    }
    function ListadoPersonasJSON(){
        $conexion= new Conexion();
        $sql="CALL SpConsultarTodosUsuarios();";
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
    function IngresarPersona(Persona $persona){
        $retVal=0;
        $conexion= new Conexion();
        if ($persona->getMontoAdeudado() == null){
            $persona->setMontoAdeudado(0);
        }
        if ($persona->getMontoMorosidad() == null){
            $persona->setMontoMorosidad(0);
        }
        if ($persona->getPropiedadFuera() == null){
            $persona->setPropiedadFuera(0);
        }
        $sql = "Call SpIngresarPersona('".$persona->getIdTipoIdentificacion().
        "', '".$persona->getIdentificacion().
        "', '".$persona->getNombre().
        "', '".$persona->getPrimerApellido().
        "', '".$persona->getSegundoApellido().
        "', '".$persona->getDireccion().
        "', '".$persona->getTelefono().
        "', '".$persona->getWhatsapp().
        "', '".$persona->getEstado().
        "', '".$persona->getCorreo().
        "', '".$persona->getSituacion().
        "', ".$persona->getMontoMorosidad().
        ", ".$persona->getMontoAdeudado().
        ", ".$persona->getConsentimiento().", NOW(),".
        " ".$persona->getPropiedadFuera().
        ", '".$persona->getIdDistrito().
        "', '".$persona->getIdCanton().
        "', '".$persona->getIdProvincia().
        "', '".$persona->getUsuarioCreacion().
        "')";
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
    function Actualizar(Persona $persona){
        $retVal=false;
        $conexion= new Conexion();
        if ($persona->getMontoAdeudado() == null){
            $persona->setMontoAdeudado(0);
        }
        if ($persona->getMontoMorosidad() == null){
            $persona->setMontoMorosidad(0);
        }
        if ($persona->getPropiedadFuera() == null){
            $persona->setPropiedadFuera(0);
        }
        $sql = "Call SpActualizarPersona(".$persona->getId().
        ", '".$persona->getIdTipoIdentificacion().
        "', '".$persona->getIdentificacion().
        "', '".$persona->getNombre().
        "', '".$persona->getPrimerApellido().
        "', '".$persona->getSegundoApellido().
        "', '".$persona->getDireccion().
        "', '".$persona->getTelefono().
        "', '".$persona->getWhatsapp().
        "', '".$persona->getEstado().
        "', '".$persona->getCorreo().
        "', '".$persona->getSituacion().
        "', ".$persona->getMontoMorosidad().
        ", ".$persona->getMontoAdeudado().
        ", ".$persona->getConsentimiento().", NOW(),".
        " ".$persona->getPropiedadFuera().
        ", '".$persona->getIdDistrito().
        "', '".$persona->getIdCanton().
        "', '".$persona->getIdProvincia().
        "', ".$persona->getUsuarioCreacion().
        ")";
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