<?php
require_once './Modelo/Conexion.php';
require_once './Modelo/Entidades/Consulta.php';
require_once './Modelo/Entidades/InteraccionConsulta.php';

class ConsultaM
{
    function MaxId()
    {
        $idMax = 0;
        $conexion = new Conexion();
        $sql = "SELECT MAX(ID) FROM CONSULTA;";
        $resultado = $conexion->Ejecutar($sql);
        Logger::info("Consulta a BD: " . $sql);
        if (mysqli_num_rows($resultado) > 0) {
            while ($fila = $resultado->fetch_assoc())
                $idMax = $fila["MAX(ID)"];
        }
        $conexion->Cerrar();
        return $idMax;
    }
    function IngresarConsulta(Consulta $consulta)
    {
        $retVal = false;
        $conexion = new Conexion();
        $sql = "CALL SpIngresarConsulta('" . $consulta->getIdentificacion() .
            "', '" . $consulta->getNombreCompleto() .
            "', '" . $consulta->getTelefono() .
            "', '" . $consulta->getCorreo() .
            "', '" . $consulta->getAsunto() .
            "', " . $consulta->getIdConsultado() . ", " . $consulta->getTipoConsulta() . ")";
        try {
            if ($conexion->Ejecutar($sql)) {
                Logger::info("Ingresar Consulta en BD: " . $sql);
                $retVal = true;
            }
        } catch (Exception $ex) {
            Logger::error("Excepción en BD Ingresar Consulta: Exception: " . $ex->getMessage());
            $retVal = false;
        }
        $conexion->Cerrar();
        return $retVal;
    }
    function IngresarDatosConsulta(InteraccionConsulta $consulta)
    {
        $retVal = false;
        $conexion = new Conexion();
        $sql = "CALL SpIngresarConsultaInteraccion(" . $consulta->getIdConsulta() .
            ", '" . $consulta->getTexto() .
            "', '" . $consulta->getInteractor() . "', '" . $consulta->getAdjuntos() . "')";
        try {
            if ($conexion->Ejecutar($sql)) {
                $retVal = true;
                Logger::info("Ingreso de linea de consulta: " . $consulta->getIdConsulta());
            } else {
                Logger::error("Error en llamada a SP de linea de consulta: " . $sql);
            }
        } catch (Exception $ex) {
            Logger::error("Excepción en ingreso de linea de consulta: " . $ex->getMessage());
            $retVal = false;
        }
        $conexion->Cerrar();
        return $retVal;
    }
    function AtenderConsulta(InteraccionConsulta $consulta)
    {
        $retVal = false;
        $conexion = new Conexion();
        $sql = "CALL SpAtenderConsulta( " . $consulta->getIdConsulta() . ", '" . $consulta->getTexto() . "', '" . $consulta->getInteractor() .
            "', '" . $consulta->getAdjuntos() . "')";
        try {
            if ($conexion->Ejecutar($sql)) {
                Logger::info("Ingreso a BD metodo AtenderConsulta - ID de consulta: " . $consulta->getIdConsulta());
                $retVal = true;
            } else {
                Logger::error("Problemas al atender consulta: " . $consulta->getIdConsulta());
            }
        } catch (Exception $ex) {
            Logger::error("Excepción al atender consulta: " . $ex->getMessage());
            $retVal = false;
        }
        $conexion->Cerrar();
        return $retVal;
    }
    function GenerarEstadisticas()
    {
        $registro = array();
        $datos = array();
        $conexion = new Conexion();
        $sql = "CALL SpBuscarConsultas()";
        $resultado = $conexion->Ejecutar($sql);
        if (mysqli_num_rows($resultado) > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $consulta = new Consulta();
                $consulta->setId($fila['ID']);
                $consulta->setIdentificacion($fila['IDENTIFICACION']);
                $consulta->setNombreCompleto($fila['NOMBRE_COMPLETO']);
                $consulta->setTelefono($fila['TELEFONO']);
                $consulta->setCorreo($fila['CORREO']);
                $consulta->setAsunto($fila['ASUNTO']);
                $consulta->setIdConsultado($fila['ID_CONSULTADO']);
                $consulta->setFecha($fila['FECHA']);
                $consulta->setAtendido($fila['ATENDIDO']);
                $registro[] = $consulta;
            }
        } else {
            $datos = null;
        }
        //Total
        $datos['Totales'] = mysqli_num_rows($resultado);
        //Pendientes
        $pendientes = 0;
        //Fecha
        date_default_timezone_set('America/Mexico_City');
        $fechaHoy = date("Y-m-d");
        $consultasHoy = 0;
        for ($i = 0; $i < count($registro); $i++) {
            if ($registro[$i]->getAtendido() == 0) {
                $pendientes++;
            }
            if (date('Y-m-d', strtotime($registro[$i]->getFecha())) == $fechaHoy) {
                $consultasHoy++;
            }
        }
        $datos['Pendientes'] = $pendientes;
        $datos['FechaHoy'] = $consultasHoy;
        $conexion->Cerrar();
        Logger::info("Generación de estadísticas: " . json_encode($datos));
        return $datos;
    }
    function BuscarConsultas()
    {
        $registro = null;
        $conexion = new Conexion();
        $sql = "CALL SpBuscarConsultas()";
        $resultado = $conexion->Ejecutar($sql);
        Logger::info("Listado de consultas: " . $sql);
        if (mysqli_num_rows($resultado) > 0) {
            $registro = json_encode($resultado->fetch_all());
        } else
            $registro = null;
        $conexion->Cerrar();
        return $registro;
    }
    function BuscarConsulta($id)
    {
        $registro = null;
        $conexion = new Conexion();
        $sql = "CALL SpBuscarConsulta($id)";
        $resultado = $conexion->Ejecutar($sql);
        Logger::info("Busqueda de consulta: " . $sql);
        if (mysqli_num_rows($resultado) > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $consulta = new Consulta();
                $consulta->setId($fila['ID']);
                $consulta->setIdentificacion($fila['IDENTIFICACION']);
                $consulta->setNombreCompleto($fila['NOMBRE_COMPLETO']);
                $consulta->setTelefono($fila['TELEFONO']);
                $consulta->setCorreo($fila['CORREO']);
                $consulta->setAsunto($fila['ASUNTO']);
                $consulta->setIdConsultado($fila['ID_CONSULTADO']);
                $consulta->setFecha($fila['FECHA']);
                $consulta->setAtendido($fila['ATENDIDO']);
                $registro = $consulta;
            }
        } else
            $registro = null;
        $conexion->Cerrar();
        return $registro;
    }
    function BuscarInteracciones($id)
    {
        $registro = null;
        $conexion = new Conexion();
        $sql = "CALL SpBuscarInteracciones($id)";
        Logger::info("Busqueda de Interacciones en consulta: " . $sql);
        $resultado = $conexion->Ejecutar($sql);
        if (mysqli_num_rows($resultado) > 0) {
            $registro = json_encode($resultado->fetch_all());
        } else
            $registro = null;
        $conexion->Cerrar();
        return $registro;
    }
}
