<?php
require_once './Modelo/Entidades/BitacoraSolicitud.php';
require_once './Modelo/Conexion.php';

class BitacoraSolicitudM
{
    function IngresarBitacora(BitacoraSolicitud $bitacora)
    {
        $retVal = false;
        $conexion = new Conexion();
        $sql = "CALL SpIngresarBitacora(" . $bitacora->getIdSolicitud() .
            ", " . $bitacora->getIdUsuario() .
            ", " . $bitacora->getIdEstado() .
            ", '" . $bitacora->getNota() .
            "', '" . $bitacora->getDetalle() . "', " . $bitacora->getInterno() . ",
        '" . $bitacora->getAdjuntos() . "')";
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
    function BuscarConversacion($id, $tipo)
    {
        $registro = array();
        $conexion = new Conexion();
        $sql = "CALL SpBuscarConversacion($id, $tipo)";
        $resultado = $conexion->Ejecutar($sql);
        $egistro = array();
        if (mysqli_num_rows($resultado) > 0) {
            while ($fila = $resultado->fetch_assoc()){
                $bitacora = new BitacoraSolicitud();
                $bitacora->setId($fila['BitacoraID']);
                $bitacora->setIdSolicitud($fila['ID_SOLICITUD']);
                $bitacora->setIdEstado($fila['ID_ESTADO']);
                $bitacora->setFecha($fila['FECHA']);
                $bitacora->setNota($fila['NOTA']);
                $bitacora->setDetalle($fila['DETALLE']);
                $bitacora->setIdUsuario($fila['UsuarioID']);
                $bitacora->setAdjuntos($fila['ADJUNTOS']);
                $bitacora->setUsuario($fila['NOMBRE'].' '.$fila['PRIMER_APELLIDO'].' '.$fila['SEGUNDO_APELLIDO'].' ('.$fila['IDENTIFICACION'].')');
                $registro[] = $bitacora;
            }
        } else
            $registro = null;
        $conexion->Cerrar();
        return $registro;
    }
    function CredencialesSMTP()
    {
        $registro = array();
        $conexion = new Conexion();
        $sql = "SELECT * FROM PARAMETROS";
        $resultado = $conexion->Ejecutar($sql);
        if (mysqli_num_rows($resultado) > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $registro[$fila['DESCRIPCION']] = $fila['VALOR'];
            }
        } else
            $registro = null;
        $conexion->Cerrar();
        return $registro;
    }
}
