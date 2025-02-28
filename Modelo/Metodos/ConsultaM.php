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
                $retVal = true;
            }
        } catch (Exception $ex) {
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
            }
        } catch (Exception $ex) {
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
        //BORRAR
        echo $sql;
        try {
            if ($conexion->Ejecutar($sql)) {
                $retVal = true;
            }
        } catch (Exception $ex) {
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
        return $datos;
    }
    function BuscarConsultas()
    {
        $registro = null;
        $conexion = new Conexion();
        $sql = "CALL SpBuscarConsultas()";
        $resultado = $conexion->Ejecutar($sql);
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
        $resultado = $conexion->Ejecutar($sql);
        if (mysqli_num_rows($resultado) > 0) {
            $registro = json_encode($resultado->fetch_all());
        } else
            $registro = null;
        $conexion->Cerrar();
        return $registro;
    }
}
