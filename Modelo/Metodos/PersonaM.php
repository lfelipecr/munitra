<?php
require_once './Modelo/Entidades/Persona.php';
require_once './Modelo/Entidades/Usuario.php';
require_once './Modelo/Entidades/DTO/PersonaDTO.php';
require_once './Modelo/Entidades/ImagenUsuario.php';
require_once './Modelo/Conexion.php';

class PersonaM
{
    private function MaxID()
    {
        $idMax = 0;
        $conexion = new Conexion();
        $sql = "SELECT MAX(ID) FROM PERSONA;";
        $resultado = $conexion->Ejecutar($sql);
        if (mysqli_num_rows($resultado) > 0) {
            while ($fila = $resultado->fetch_assoc())
                $idMax = $fila["MAX(ID)"];
        }
        $conexion->Cerrar();
        return $idMax;
    }
    function ActualizarImagen(ImagenUsuario $imagen)
    {
        $retVal = false;
        $conexion = new Conexion();
        $sql = "UPDATE IMAGEN_USUARIO SET URL_IMAGEN = '" . $imagen->getUrlImagen() . "' WHERE ID = " . $imagen->getId() . ";";
        $resultado = $conexion->Ejecutar($sql);
        try {
            if ($conexion->Ejecutar($sql)) {
                Logger::info("Modificación de imagen de usuario: " . $imagen->getId());
                $retVal = true;
            } else {
                Logger::error("No se pudo modificar imágen de usuario: " . $imagen->getId());
            }
        } catch (Exception $ex) {
            Logger::error("Excepción en BD: " . $ex->getMessage());
            $retVal = false;
        }
        $conexion->Cerrar();
        return $retVal;
    }
    function IngresarImagen(ImagenUsuario $imagen)
    {
        $retVal = false;
        $conexion = new Conexion();
        $sql = "INSERT INTO IMAGEN_USUARIO (ID_USUARIO, URL_IMAGEN) VALUES (" . $imagen->getIdUsuario() . ", '" . $imagen->getUrlImagen() . "')";
        $resultado = $conexion->Ejecutar($sql);
        try {
            if ($conexion->Ejecutar($sql)) {
                Logger::info("Se ingresa imagen de usuario: " . $sql);
                $retVal = true;
            } else {
                Logger::error("No se pudo ingresar imágen de usuario: " . $sql);
            }
        } catch (Exception $ex) {
            Logger::error("Excepción en BD: " . $ex->getMessage());
            $retVal = false;
        }
        $conexion->Cerrar();
        return $retVal;
    }
    function BuscarImagen($idUsuario)
    {
        $imagenUsuario = null;
        $conexion = new Conexion();
        $sql = "SELECT * FROM IMAGEN_USUARIO WHERE ID_USUARIO = $idUsuario";
        $resultado = $conexion->Ejecutar($sql);
        if (mysqli_num_rows($resultado) > 0) {
            while ($fila = $resultado->fetch_assoc()) {
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
    function EliminarPersona($id)
    {
        $retVal = false;
        $conexion = new Conexion();
        $sql = "DELETE FROM PERSONA WHERE ID = $id";
        try {
            if ($conexion->Ejecutar($sql)) {
                Logger::info("Se elimina persona: " . $id);
                $retVal = true;
            } else {
                Logger::error("No se puede eliminar persona: " . $id);
            }
        } catch (Exception $ex) {
            Logger::error("Excepción en BD: " . $ex->getMessage());
            $retVal = false;
        }
        $conexion->Cerrar();
        return $retVal;
    }
    function BuscarPersona($id)
    {
        $persona = null;
        $conexion = new Conexion();
        $sql = "CALL SpConsultarPersona($id)";
        $resultado = $conexion->Ejecutar($sql);
        if (mysqli_num_rows($resultado) > 0) {
            while ($fila = $resultado->fetch_assoc()) {
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
                $persona->setCedulaFrontal($fila['CEDULA_FRONTAL']);
                $persona->setCedulaTrasera($fila['CEDULA_TRASERA']);
            }
            Logger::info("Se consulta persona: " . $id);
        }
        $conexion->Cerrar();
        return $persona;
    }
    function ListadoPersonas()
    {
        $registro = null;
        $conexion = new Conexion();
        $sql = "CALL SpConsultarPersonas()";
        $resultado = $conexion->Ejecutar($sql);
        if (mysqli_num_rows($resultado) > 0) {
            while ($fila = $resultado->fetch_assoc()) {
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
    function BuscarPersonaCedula($cedula)
    {
        $listado = $this->ListadoPersonas();
        if ($listado != null) {
            for ($i = 0; $i < count($listado); $i++) {
                if ($cedula == $listado[$i]->getIdentificacion()) {
                    Logger::info("Se consulta persona: " . $cedula);
                    return $listado[$i];
                }
            }
        } else {
            return null;
        }
        return null;
    }
    function BuscarPersonaUsuario($idUsuario)
    {
        $listado = $this->ListadoPersonas();
        if ($listado != null) {
            for ($i = 0; $i < count($listado); $i++) {
                if ($idUsuario == $listado[$i]->getId()) {
                    Logger::info("Se consulta persona de usuario: " . $idUsuario);
                    return $listado[$i];
                }
            }
        } else {
            return null;
        }
        return null;
    }
    function ListadoPersonasJSON()
    {
        $conexion = new Conexion();
        $sql = "CALL SpConsultarTodosUsuarios();";
        $resultado = $conexion->Ejecutar($sql);
        $registro = array();
        if (mysqli_num_rows($resultado) > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $usuario = [
                    'id' => $fila['ID'],
                    'idTipoIdentificacion' => $fila['ID_TIPO_IDENTIFICACION'],
                    'identificacion' => $fila['IDENTIFICACION'],
                    'nombre' => $fila['NOMBRE'],
                    'primerApellido' => $fila['PRIMER_APELLIDO'],
                    'segundoApellido' => $fila['SEGUNDO_APELLIDO'],
                    'direccion' => $fila['DIRECCION'],
                    'telefono' => $fila['TELEFONO'],
                    'whatsapp' => $fila['WHATSAPP'],
                    'estado' => $fila['ESTADO'],
                    'situacion' => $fila['SITUACION'],
                    'montoMorosidad' => $fila['MONTO_MOROSIDAD'],
                    'montoAdeudado' => $fila['MONTO_ADEUDADO'],
                    'consentimiento' => $fila['CONSENTIMIENTO'],
                    'fechaConsentimiento' => $fila['FECHA_CONSENTIMIENTO'],
                    'propiedadFuera' => $fila['PROPIEDAD_FUERA'],
                    'idDistrito' => $fila['ID_DISTRITO'],
                    'idCanton' => $fila['ID_CANTON'],
                    'idProvincia' => $fila['ID_PROVINCIA'],
                    'correo' => $fila['CORREO'],
                    'usuarioId' => $fila['UsuarioID'],
                    'nombreUsuario' => $fila['NOMBRE_USUARIO'],
                    'responsable' => $fila['RESPONSABLE'],
                    'idDepartamento' => $fila['ID_DEPARTAMENTO'],
                    'idEstado' => $fila['ID_ESTADO'],
                ];
                $registro[] = $usuario;
            }
            $registro = json_encode($registro);
        } else
            $registro = null;
        $conexion->Cerrar();
        return $registro;
    }
    function IngresarPersona(Persona $persona)
    {
        $retVal = 0;
        $conexion = new Conexion();
        if ($persona->getMontoAdeudado() == null) {
            $persona->setMontoAdeudado(0);
        }
        if ($persona->getMontoMorosidad() == null) {
            $persona->setMontoMorosidad(0);
        }
        if ($persona->getPropiedadFuera() == null) {
            $persona->setPropiedadFuera(0);
        }
        $sql = "Call SpIngresarPersona('" . $persona->getIdTipoIdentificacion() .
            "', '" . $persona->getIdentificacion() .
            "', '" . $persona->getNombre() .
            "', '" . $persona->getPrimerApellido() .
            "', '" . $persona->getSegundoApellido() .
            "', '" . $persona->getDireccion() .
            "', '" . $persona->getTelefono() .
            "', '" . $persona->getWhatsapp() .
            "', '" . $persona->getEstado() .
            "', '" . $persona->getCorreo() .
            "', '" . $persona->getSituacion() .
            "', " . $persona->getMontoMorosidad() .
            ", " . $persona->getMontoAdeudado() .
            ", " . $persona->getConsentimiento() . ", NOW()," .
            " " . $persona->getPropiedadFuera() .
            ", '" . $persona->getIdDistrito() .
            "', '" . $persona->getIdCanton() .
            "', '" . $persona->getIdProvincia() .
            "', '" . $persona->getUsuarioCreacion() .
            "')";
        try {
            if ($conexion->Ejecutar($sql)) {
                $retVal = $this->MaxID();
                Logger::info("Se ingresa nueva persona, ID: " . $retVal);
            } else {
                Logger::error("No se pudo ingresar persona");
            }
        } catch (Exception $ex) {
            Logger::error("Excepción en BD: " . $ex->getMessage());
            $retVal = 0;
        }

        $conexion->Cerrar();
        return $retVal;
    }
    function Actualizar(Persona $persona)
    {
        $retVal = false;
        $conexion = new Conexion();
        if ($persona->getMontoAdeudado() == null) {
            $persona->setMontoAdeudado(0);
        }
        if ($persona->getMontoMorosidad() == null) {
            $persona->setMontoMorosidad(0);
        }
        if ($persona->getPropiedadFuera() == null) {
            $persona->setPropiedadFuera(0);
        }
        $sql = "Call SpActualizarPersona(" . $persona->getId() .
            ", '" . $persona->getIdTipoIdentificacion() .
            "', '" . $persona->getIdentificacion() .
            "', '" . $persona->getNombre() .
            "', '" . $persona->getPrimerApellido() .
            "', '" . $persona->getSegundoApellido() .
            "', '" . $persona->getDireccion() .
            "', '" . $persona->getTelefono() .
            "', '" . $persona->getWhatsapp() .
            "', '" . $persona->getEstado() .
            "', '" . $persona->getCorreo() .
            "', '" . $persona->getSituacion() .
            "', " . $persona->getMontoMorosidad() .
            ", " . $persona->getMontoAdeudado() .
            ", " . $persona->getConsentimiento() . ", NOW()," .
            " " . $persona->getPropiedadFuera() .
            ", '" . $persona->getIdDistrito() .
            "', '" . $persona->getIdCanton() .
            "', '" . $persona->getIdProvincia() .
            "', " . $persona->getUsuarioCreacion() .
            ")";
        try {
            if ($conexion->Ejecutar($sql)) {
                Logger::info("Se modifica persona: " . $persona->getId());
                $retVal = true;
            } else {
                Logger::error("No se pudo modificar persona:" . $persona->getId());
            }
        } catch (Exception $ex) {
            Logger::error("Excepción en BD: " . $ex->getMessage());
            $retVal = false;
        }
        $conexion->Cerrar();
        return $retVal;
    }
    function GestionarCedula(Persona $persona)
    {
        $retVal = false;
        $conexion = new Conexion();
        $sql = "CALL SpGestionarCopiasCedula(" . $persona->getId() .
            ", '" . $persona->getCedulaFrontal() . "', '" . $persona->getCedulaTrasera() . "');";
        try {
            if ($conexion->Ejecutar($sql)) {
                Logger::info("Se modifica cédula de la persona: " . $persona->getId());
                $retVal = true;
            }
        } catch (Exception $ex) {
            Logger::error("Excepción en BD: " . $ex->getMessage());
            $retVal = false;
        }
        $conexion->Cerrar();
        return $retVal;
    }
}
