<?php
require_once './Modelo/Entidades/Persona.php';
require_once './Modelo/Entidades/Usuario.php';
require_once './Modelo/Entidades/DTO/PersonaDTO.php';
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
    function ListadoPersonasJSON(){
        $conexion= new Conexion();
        $sql="CALL SpConsultarTodosUsuarios();";
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            return json_encode($resultado->fetch_all());
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
}