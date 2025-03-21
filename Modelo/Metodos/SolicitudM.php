<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once './Modelo/Entidades/Solicitud.php';
require_once './Modelo/Entidades/DetalleSolicitud.php';
require_once './Modelo/Metodos/BitacoraSolicitudM.php';
require_once './Modelo/Metodos/UsuarioM.php';
require_once './Modelo/Conexion.php';

class SolicitudM
{
    function BuscarCabeceraSolicitud($id)
    {
        $conexion = new Conexion();
        $sql = "CALL SpConsultarSolicitudPorID($id);";
        $resultado = $conexion->Ejecutar($sql);
        if (mysqli_num_rows($resultado) > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $solicitud = new Solicitud();
                $solicitud->setId($fila["ID"]);
                $solicitud->setFecha($fila['FECHA']);
                $solicitud->setEstadoSolicitud($fila['ESTADO_SOLICITUD']);
                $solicitud->setDescripEstadoSolicitud($fila['ESTADO_SOLICITUD_DESCRIPCION']);
                $solicitud->setTipoSolicitud($fila['TIPO_SOLICITUD']);
                $solicitud->setIdPersona($fila['PERSONA_ID']);
                $solicitud->setIdUsuario($fila['ID_USUARIO']);
                $registro = $solicitud;
            }
            Logger::info(
                "Se consultó la solicitud: " . $id
            );
        } else
            $registro = null;
        $conexion->Cerrar();
        return $registro;
    }
    function BuscarDetallesSolicitud($id)
    {
        $conexion = new Conexion();
        $sql = "CALL SpBuscarDetallesPorSolicitud($id);";

        $resultado = $conexion->Ejecutar($sql);
        if (mysqli_num_rows($resultado) > 0) {
            $registro = json_encode($resultado->fetch_all());
        } else
            $registro = null;
        $conexion->Cerrar();
        return $registro;
    }
    function MaxID()
    {
        $idMax = 0;
        $conexion = new Conexion();
        $sql = "SELECT MAX(ID) FROM SOLICITUD;";
        $resultado = $conexion->Ejecutar($sql);
        if (mysqli_num_rows($resultado) > 0) {
            while ($fila = $resultado->fetch_assoc())
                $idMax = $fila["MAX(ID)"];
        }
        $conexion->Cerrar();
        return $idMax;
    }
    function IngresarDetalles($arregloDetalles)
    {
        $retVal = true;
        $conexion = new Conexion();
        for ($i = 0; $i < count($arregloDetalles); $i++) {
            $sql = "CALL SpIngresarDetalleSolicitud('" . $arregloDetalles[$i]->getCampoRequisito() .
                "', '', " . $arregloDetalles[$i]->getCumple() .
                ", " . $arregloDetalles[$i]->getIdSolicitud() .
                ", " . $arregloDetalles[$i]->getTipoRequisito() . ")";
            try {
                if ($conexion->Ejecutar($sql)) {
                    Logger::info("Se ingresa detalle de solicitud");
                    $retVal = true;
                } else {
                    Logger::info("No se pudo ingresar el dato: " . $arregloDetalles[$i]->getCampoRequisito());
                    $retVal = false;
                    break;
                }
            } catch (Exception $ex) {
                Logger::error("Excepción en BD: " . $ex->getMessage());
                $retVal = false;
            }
        }
        $conexion->Cerrar();
        return $retVal;
    }
    function IngresarSolicitud(Solicitud $solicitud)
    {
        $retVal = 0;
        $conexion = new Conexion();
        $sql = "CALL SpIngresarSolicitud(" . $solicitud->getIdPersona() .
            ", " . $solicitud->getIdUsuario() .
            ", " . $solicitud->getEstadoSolicitud() .
            ", " . $solicitud->getTipoSolicitud() . ")";
        try {
            if ($conexion->Ejecutar($sql)) {
                $retVal = $this->MaxID();
                Logger::info("Se ingresa la cabecera de la solicitud: " . $retVal);
            }
        } catch (Exception $ex) {
            Logger::error("Excepción en BD: " . $ex->getMessage());
            $retVal = 0;
        }
        $conexion->Cerrar();
        return $retVal;
    }
    function EliminarSolicitud($id)
    {
        $retVal = false;
        $conexion = new Conexion();
        $sql = "DELETE FROM  SOLICITUD WHERE ID = $id";
        try {
            if ($conexion->Ejecutar($sql)) {
                Logger::info("Se elimina la solicitud: " . $id);
                $retVal = true;
            }
        } catch (Exception $ex) {
            Logger::error("Excepción en BD: " . $ex->getMessage());
            $retVal = false;
        }
        $conexion->Cerrar();
        return $retVal;
    }
    function BuscarSolicitudes($idTipo)
    {
        $conexion = new Conexion();
        if ($_SESSION['usuario']->getIdDepartamento() == 1) {
            $idUsuario = $_SESSION['usuario']->getId();
            $sql = "CALL SpConsultarTodasSolicitudesUsuario($idTipo, $idUsuario);";
        } else {
            $sql = "CALL SpConsultarTodasSolicitudes($idTipo);";
        }
        $resultado = $conexion->Ejecutar($sql);
        if (mysqli_num_rows($resultado) > 0) {
            $registro = json_encode($resultado->fetch_all());
        } else
            $registro = null;
        $conexion->Cerrar();
        return $registro;
    }
    function EnviarEstado($idUsuario, $idEstado, $codigo)
    {
        $estado = '';
        switch ($idEstado) {
            case '1':
                $estado = 'Nueva';
                break;
            case '2':
                $estado = 'En proceso';
                break;
            case '3':
                $estado = 'Prevención 1';
                break;
            case '4':
                $estado = 'Prevención 2';
                break;
            case '5':
                $estado = 'Aprobada';
                break;
            case '6':
                $estado = 'Rechazada';
                break;
            case '7':
                $estado = 'Cancelada';
                break;
            case '8':
                $estado = 'Retirada';
                break;
        }
        $usuarioM = new UsuarioM();
        $email = $usuarioM->BuscarUsuarioId($idUsuario)->getCorreo();
        $cuerpoEmail = '<html><head><meta charset="UTF-8"><style>body {font-family: Arial, sans-serif; line-height: 1.6;color: #333;}.container { max-width: 600px; margin: 0 auto;padding: 20px;border: 1px solid #ddd;border-radius: 8px;background-color: #f9f9f9; }.title {font-size: 18px;font-weight: bold; color: #555;}.content {margin-top: 10px;}.info {margin-top: 15px;padding: 10px; background-color: #eef;border-left: 4px solidrgb(10, 41, 75);}</style></head><body><div class="container">';
        $cuerpoEmail = $cuerpoEmail . '<p class="title">Municipalidad de Río Cuarto</p>';
        $cuerpoEmail = $cuerpoEmail . '<div class="content">">
                                <p><strong>Estimado Usuario</strong> </br></p>
                                <p id="consulta">Se ha actualizado su solicitud (codigo: #' . $codigo . ') por parte de la Municipalidad de Río Cuarto, el estado actual de su solicitud es ' . $estado . '</p>
                                </div>
                            </div>
                        </body>
                        </html>';
        try {
            $bitacoraM = new BitacoraSolicitudM();
            $credenciales = $bitacoraM->CredencialesSMTP();
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Encoding = "base64";
            $mail->CharSet = "UTF-8";
            $mail->Host = $credenciales['host'];
            $mail->SMTPAuth = true;
            $mail->Username = $credenciales['user'];
            $mail->Password = $credenciales['key'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->setFrom($credenciales['from']);
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Municipalidad de Río Cuarto - Estado de Solicitud';
            $mail->Body = $cuerpoEmail;
            ob_start();
            if (!$mail->send()) {
                echo "Error: " . $mail->ErrorInfo;
            }
            $log = ob_get_clean();
            Logger::info("Correo de cambio de solicitud: " . $log);
        } catch (Exception $e) {
            Logger::error("Excepción en BD: " . $e->getMessage());
            var_dump($e);
        }
    }
    function ActualizarCabeceraSolicitud(Solicitud $solicitud)
    {
        $retVal = false;
        $conexion = new Conexion();
        $sql = "CALL SpActualizarSolicitud(" . $solicitud->getId() .
            ", " . $solicitud->getEstadoSolicitud() . ")";
        $usuarioM = new UsuarioM();
        //$usuario = $usuarioM->BuscarUsuarioId($solicitud->getIdUsuario());
        if (true) {
            try {
                if ($conexion->Ejecutar($sql)) {
                    $retVal = true;
                }
            } catch (Exception $ex) {
                Logger::error("Excepción en BD: " . $ex->getMessage());
                $retVal = false;
            }
            $conexion->Cerrar();
            if ($retVal) {
                $solicitud = $this->BuscarCabeceraSolicitud($solicitud->getId());
                $this->EnviarEstado($solicitud->getIdUsuario(), $solicitud->getEstadoSolicitud(), $solicitud->getId());
            }
        } else $retVal = false;
        return $retVal;
    }
    function ActualizarDetallesSolicitud($arregloDetalles)
    {
        $retVal = true;
        $conexion = new Conexion();
        for ($i = 0; $i < count($arregloDetalles); $i++) {
            $sql = "CALL SpActualizarDetalleSolicitud( " . $arregloDetalles[$i]->getId() .
                ", '" . $arregloDetalles[$i]->getCampoRequisito() .
                "', " . $arregloDetalles[$i]->getCumple() . ")";
            if ($sql != "CALL SpActualizarDetalleSolicitud( , '', 1)") {
                try {
                    if ($conexion->Ejecutar($sql)) {
                        $retVal = true;
                    } else {
                        $retVal = false;
                        break;
                    }
                } catch (Exception $ex) {
                    Logger::error("Excepción en BD: " . $ex->getMessage());
                    $retVal = false;
                }
            }
        }
        $conexion->Cerrar();
        return $retVal;
    }
}
