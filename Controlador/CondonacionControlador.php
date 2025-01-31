<?php 
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Metodos/SolicitudM.php';
require_once './Modelo/Metodos/PersonaM.php';
require_once './Modelo/Entidades/DetalleSolicitud.php';

class CondonacionControlador {
    private function LlamarVistaActualizar($msg, $id){
        if ($_SESSION['usuario']->getIdDepartamento() == 1){
            $id = $_SESSION['usuario']->getIdPersona();
            $vista = './Vista/TramitesUsuario/Condonacion/actualizar.php';
            require_once './Vista/Utilidades/navbar.php';
        } else {
            $solicitudM = new SolicitudM();
            $personaM = new PersonaM();
            $personas = $personaM->ListadoPersonas();
            $jsonData = $solicitudM->BuscarDetallesSolicitud($id);
            $solicitud = $solicitudM->BuscarCabeceraSolicitud($id);
            $vista = './Vista/Dashboard/Tramites/Condonacion/actualizar.php';
            require_once './Vista/Utilidades/sidebar.php';
        }
    }
    private function LlamarVistaIngresar($msg){
        if ($_SESSION['usuario']->getIdDepartamento() == 1){
            $id = $_SESSION['usuario']->getIdPersona();
            $vista = './Vista/TramitesUsuario/Condonacion/nuevo.php';
            require_once './Vista/Utilidades/navbar.php';
        } else {
            $personaM = new PersonaM();
            $personas = $personaM->ListadoPersonas();
            $vista = './Vista/Dashboard/Tramites/Condonacion/nuevo.php';
            require_once './Vista/Utilidades/sidebar.php';
        }
    }

    function VIngresar(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            $this->LlamarVistaIngresar('');
        }
    }
    function VActualizar(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            $this->LlamarVistaActualizar('', $_GET['id']);
        }
    }
    function Actualizar(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            //if
            //Si todos los datos están correctos, guarda la solicitud y obtiene el id
            $solicitudM = new SolicitudM();
            $solicitud = new Solicitud();
            session_start();
            $idSolicitud = $_POST['idSolicitud'];
            $solicitud->setId($idSolicitud);
            $solicitud->setIdUsuario($_SESSION['usuario']->getId());
            $solicitud->setTipoSolicitud(4);
            $solicitud->setEstadoSolicitud($_POST['estadoSolicitud']);
            $solicitud->setIdPersona($_POST['persona']);
            if ($solicitudM->ActualizarCabeceraSolicitud($solicitud)){
                $registrar = array();
                //representante legal
                $representante = new DetalleSolicitud();
                $representante->setId($_POST['idRepresentante']);
                $representante->setCumple(1);
                $representante->setCampoRequisito($_POST['representante']);
                $representante->setIdSolicitud($idSolicitud);
                $representante->setTipoRequisito(32);
                $registrar[] = $representante;
                //identificacion
                $identificacionRepresentante = new DetalleSolicitud();
                $identificacionRepresentante->setId($_POST['idIdentificacionRepresentante']);
                $identificacionRepresentante->setCumple(1);
                $identificacionRepresentante->setCampoRequisito($_POST['identificacionRepresentante']);
                $identificacionRepresentante->setIdSolicitud($idSolicitud);
                $identificacionRepresentante->setTipoRequisito(33);
                $registrar[] = $identificacionRepresentante;
                //direccion
                $direccion = new DetalleSolicitud();
                $direccion->setId($_POST['idDireccion']);
                $direccion->setCumple(1);
                $direccion->setCampoRequisito($_POST['direccion']);
                $direccion->setIdSolicitud($idSolicitud);
                $direccion->setTipoRequisito(34);
                $registrar[] = $direccion;
                //notificaciones
                $notificaciones = new DetalleSolicitud();
                $notificaciones->setId($_POST['idNotificaciones']);
                $notificaciones->setCumple(1);
                $notificaciones->setCampoRequisito($_POST['notificaciones']);
                $notificaciones->setIdSolicitud($idSolicitud);
                $notificaciones->setTipoRequisito(35);
                $registrar[] = $notificaciones;
                //tipo de solicitud
                $tipoSolicitud = new DetalleSolicitud();
                $tipoSolicitud->setId($_POST['idTipoSolicitud']);
                $tipoSolicitud->setCumple(1);
                $tipoSolicitud->setCampoRequisito($_POST['tipoSolicitud']);
                $tipoSolicitud->setIdSolicitud($idSolicitud);
                $tipoSolicitud->setTipoRequisito(36);
                $registrar[] = $tipoSolicitud;
                //firma
                $firma = $_POST['firma'];
                $firma = str_replace("data:image/png;base64,", "", $firma);
                $firma = str_replace(" ", "+", $firma);
                $imagen = base64_decode($firma);
                $archivo = "repo/firmas/firma_" . time() . ".png";
                file_put_contents($archivo, $imagen);
                $soliFirma = new DetalleSolicitud();
                $soliFirma->setId($_POST['idFirma']);
                $soliFirma->setCumple(1);
                $soliFirma->setIdSolicitud($idSolicitud);
                $soliFirma->setCampoRequisito($archivo);
                $soliFirma->setTipoRequisito(37);
                $registrar[] = $soliFirma;
                //recibido por
                $recibido = new DetalleSolicitud();
                $recibido->setId($_POST['idRecibido']);
                $recibido->setCumple(1);
                $recibido->setCampoRequisito($_POST['recibido']);
                $recibido->setIdSolicitud($idSolicitud);
                $recibido->setTipoRequisito(38);
                $registrar[] = $recibido;
                //fecha
                $fecha = new DetalleSolicitud();
                $fecha->setId($_POST['idFecha']);
                $fecha->setCumple(1);
                $fecha->setCampoRequisito($_POST['fecha']);
                $fecha->setIdSolicitud($idSolicitud);
                $fecha->setTipoRequisito(39);
                $registrar[] = $fecha;
                //funcionario
                $funcionario = new DetalleSolicitud();
                $funcionario->setId($_POST['idFuncionario']);
                $funcionario->setCumple(1);
                $funcionario->setCampoRequisito($_POST['funcionario']);
                $funcionario->setIdSolicitud($idSolicitud);
                $funcionario->setTipoRequisito(40);
                $registrar[] = $funcionario;
                //consecutivo
                $consecutivo = new DetalleSolicitud();
                $consecutivo->setId($_POST['idConsecutivo']);
                $consecutivo->setCumple(1);
                $consecutivo->setCampoRequisito($_POST['consecutivo']);
                $consecutivo->setIdSolicitud($idSolicitud);
                $consecutivo->setTipoRequisito(41);
                $registrar[] = $consecutivo;
                //total de contado
                $totalContado = new DetalleSolicitud();
                $totalContado->setId($_POST['idTotalContado']);
                $totalContado->setCumple(1);
                $totalContado->setCampoRequisito($_POST['totalContado']);
                $totalContado->setIdSolicitud($idSolicitud);
                $totalContado->setTipoRequisito(42);
                $registrar[] = $totalContado;
                //monto a condonar de contado
                $montoCondonarContado = new DetalleSolicitud();
                $montoCondonarContado->setId($_POST['idMontoCondonarContado']);
                $montoCondonarContado->setCumple(1);
                $montoCondonarContado->setCampoRequisito($_POST['montoCondonarContado']);
                $montoCondonarContado->setIdSolicitud($idSolicitud);
                $montoCondonarContado->setTipoRequisito(43);
                $registrar[] = $montoCondonarContado;
                //fecha de pago
                $fechaPago = new DetalleSolicitud();
                $fechaPago->setId($_POST['idFechaPago']);
                $fechaPago->setCumple(1);
                $fechaPago->setCampoRequisito($_POST['fechaPago']);
                $fechaPago->setIdSolicitud($idSolicitud);
                $fechaPago->setTipoRequisito(44);
                $registrar[] = $fechaPago;
                //total arreglo de pago
                $totalArreglo = new DetalleSolicitud();
                $totalArreglo->setId($_POST['idTotalArreglo']);
                $totalArreglo->setCumple(1);
                $totalArreglo->setCampoRequisito($_POST['totalArreglo']);
                $totalArreglo->setIdSolicitud($idSolicitud);
                $totalArreglo->setTipoRequisito(45);
                $registrar[] = $totalArreglo;
                //monto a condonar arreglo de pago
                $montoCondonarArreglo = new DetalleSolicitud();
                $montoCondonarArreglo->setId($_POST['idMontoCondonarArreglo']);
                $montoCondonarArreglo->setCumple(1);
                $montoCondonarArreglo->setCampoRequisito($_POST['montoCondonarArreglo']);
                $montoCondonarArreglo->setIdSolicitud($idSolicitud);
                $montoCondonarArreglo->setTipoRequisito(46);
                $registrar[] = $montoCondonarArreglo;
                //fecha de inicio
                $fechaInicio = new DetalleSolicitud();
                $fechaInicio->setId($_POST['idFechaInicio']);
                $fechaInicio->setCumple(1);
                $fechaInicio->setCampoRequisito($_POST['fechaInicio']);
                $fechaInicio->setIdSolicitud($idSolicitud);
                $fechaInicio->setTipoRequisito(47);
                $registrar[] = $fechaInicio;
                //plazo en meses
                $plazoMeses = new DetalleSolicitud();
                $plazoMeses->setId($_POST['idPlazoMeses']);
                $plazoMeses->setCumple(1);
                $plazoMeses->setCampoRequisito($_POST['plazoMeses']);
                $plazoMeses->setIdSolicitud($idSolicitud);
                $plazoMeses->setTipoRequisito(48);
                $registrar[] = $plazoMeses;
                //cantidad de cuotas
                $cantidadCuotas = new DetalleSolicitud();
                $cantidadCuotas->setId($_POST['idCantidadCuotas']);
                $cantidadCuotas->setCumple(1);
                $cantidadCuotas->setCampoRequisito($_POST['cantidadCuotas']);
                $cantidadCuotas->setIdSolicitud($idSolicitud);
                $cantidadCuotas->setTipoRequisito(49);
                $registrar[] = $cantidadCuotas;
                //adelanto 20%
                $adelanto = new DetalleSolicitud();
                $adelanto->setId($_POST['idAdelanto']);
                $adelanto->setCumple(1);
                $adelanto->setCampoRequisito($_POST['adelanto']);
                $adelanto->setIdSolicitud($idSolicitud);
                $adelanto->setTipoRequisito(50);
                $registrar[] = $adelanto;
                //pago por cuota
                $pagoPorCuota = new DetalleSolicitud();
                $pagoPorCuota->setId($_POST['idPagoPorCuota']);
                $pagoPorCuota->setCumple(1);
                $pagoPorCuota->setCampoRequisito($_POST['pagoPorCuota']);
                $pagoPorCuota->setIdSolicitud($idSolicitud);
                $pagoPorCuota->setTipoRequisito(51);
                $registrar[] = $pagoPorCuota;
                //resolucion
                $resolucion = new DetalleSolicitud();
                $resolucion->setId($_POST['idResolucion']);
                $resolucion->setCumple(1);
                $resolucion->setCampoRequisito($_POST['resolucion']);
                $resolucion->setIdSolicitud($idSolicitud);
                $resolucion->setTipoRequisito(52);
                $registrar[] = $resolucion;
                //plazo de prevención
                $plazo = new DetalleSolicitud();
                $plazo->setId($_POST['idPlazo']);
                $plazo->setCumple(1);
                $plazo->setCampoRequisito($_POST['plazo']);
                $plazo->setIdSolicitud($idSolicitud);
                $plazo->setTipoRequisito(53);
                $registrar[] = $plazo;
                //fecha de notificacion
                $fechaNotificacion = new DetalleSolicitud();
                $fechaNotificacion->setId($_POST['idFechaNotificacion']);
                $fechaNotificacion->setCumple(1);
                $fechaNotificacion->setCampoRequisito($_POST['fechaNotificacion']);
                $fechaNotificacion->setIdSolicitud($idSolicitud);
                $fechaNotificacion->setTipoRequisito(54);
                $registrar[] = $fechaNotificacion;
                //cumple
                $cumple = new DetalleSolicitud();
                $cumple->setId($_POST['idCumple']);
                $cumple->setCumple(1);
                $cumple->setCampoRequisito($_POST['cumple']);
                $cumple->setIdSolicitud($idSolicitud);
                $cumple->setTipoRequisito(55);
                $registrar[] = $cumple;
                if ($solicitudM->ActualizarDetallesSolicitud($registrar)){
                    header('location: index.php?controlador=Tramites&metodo=Condonacion');
                } else {
                    $this->LlamarVistaActualizar('Verfique los detalles de la solicitud', $idSolicitud);    
                }
            } else {
                $this->LlamarVistaActualizar('Verfique los datos de la solicitud', $idSolicitud);
            }
        }
    }
    function Ingresar(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            //if
            //Si todos los datos están correctos, guarda la solicitud y obtiene el id
            $solicitudM = new SolicitudM();
            $solicitud = new Solicitud();
            session_start();
            $solicitud->setIdUsuario($_SESSION['usuario']->getId());
            $solicitud->setTipoSolicitud(4);
            $solicitud->setEstadoSolicitud($_POST['estadoSolicitud']);
            $solicitud->setIdPersona($_POST['persona']);
            $idSolicitud = $solicitudM->IngresarSolicitud($solicitud);
            if ($idSolicitud != 0){
                $registrar = array();
                //representante legal
                $representante = new DetalleSolicitud();
                $representante->setCumple(1);
                $representante->setCampoRequisito($_POST['representante']);
                $representante->setIdSolicitud($idSolicitud);
                $representante->setTipoRequisito(32);
                $registrar[] = $representante;
                //identificacion
                $identificacionRepresentante = new DetalleSolicitud();
                $identificacionRepresentante->setCumple(1);
                $identificacionRepresentante->setCampoRequisito($_POST['identificacionRepresentante']);
                $identificacionRepresentante->setIdSolicitud($idSolicitud);
                $identificacionRepresentante->setTipoRequisito(33);
                $registrar[] = $identificacionRepresentante;
                //direccion
                $direccion = new DetalleSolicitud();
                $direccion->setCumple(1);
                $direccion->setCampoRequisito($_POST['direccion']);
                $direccion->setIdSolicitud($idSolicitud);
                $direccion->setTipoRequisito(34);
                $registrar[] = $direccion;
                //notificaciones
                $notificaciones = new DetalleSolicitud();
                $notificaciones->setCumple(1);
                $notificaciones->setCampoRequisito($_POST['notificaciones']);
                $notificaciones->setIdSolicitud($idSolicitud);
                $notificaciones->setTipoRequisito(35);
                $registrar[] = $notificaciones;
                //tipo de solicitud
                $tipoSolicitud = new DetalleSolicitud();
                $tipoSolicitud->setCumple(1);
                $tipoSolicitud->setCampoRequisito($_POST['tipoSolicitud']);
                $tipoSolicitud->setIdSolicitud($idSolicitud);
                $tipoSolicitud->setTipoRequisito(36);
                $registrar[] = $tipoSolicitud;
                //firma
                $firma = $_POST['firma'];
                $firma = str_replace("data:image/png;base64,", "", $firma);
                $firma = str_replace(" ", "+", $firma);
                $imagen = base64_decode($firma);
                $archivo = "repo/firmas/firma_" . time() . ".png";
                file_put_contents($archivo, $imagen);
                $soliFirma = new DetalleSolicitud();
                $soliFirma->setCumple(1);
                $soliFirma->setIdSolicitud($idSolicitud);
                $soliFirma->setCampoRequisito($archivo);
                $soliFirma->setTipoRequisito(37);
                $registrar[] = $soliFirma;
                //recibido por
                $recibido = new DetalleSolicitud();
                $recibido->setCumple(1);
                $recibido->setCampoRequisito($_POST['recibido']);
                $recibido->setIdSolicitud($idSolicitud);
                $recibido->setTipoRequisito(38);
                $registrar[] = $recibido;
                //fecha
                $fecha = new DetalleSolicitud();
                $fecha->setCumple(1);
                $fecha->setCampoRequisito($_POST['fecha']);
                $fecha->setIdSolicitud($idSolicitud);
                $fecha->setTipoRequisito(39);
                $registrar[] = $fecha;
                //funcionario
                $funcionario = new DetalleSolicitud();
                $funcionario->setCumple(1);
                $funcionario->setCampoRequisito($_POST['funcionario']);
                $funcionario->setIdSolicitud($idSolicitud);
                $funcionario->setTipoRequisito(40);
                $registrar[] = $funcionario;
                //consecutivo
                $consecutivo = new DetalleSolicitud();
                $consecutivo->setCumple(1);
                $consecutivo->setCampoRequisito($_POST['consecutivo']);
                $consecutivo->setIdSolicitud($idSolicitud);
                $consecutivo->setTipoRequisito(41);
                $registrar[] = $consecutivo;
                //total de contado
                $totalContado = new DetalleSolicitud();
                $totalContado->setCumple(1);
                $totalContado->setCampoRequisito($_POST['totalContado']);
                $totalContado->setIdSolicitud($idSolicitud);
                $totalContado->setTipoRequisito(42);
                $registrar[] = $totalContado;
                //monto a condonar de contado
                $montoCondonarContado = new DetalleSolicitud();
                $montoCondonarContado->setCumple(1);
                $montoCondonarContado->setCampoRequisito($_POST['montoCondonarContado']);
                $montoCondonarContado->setIdSolicitud($idSolicitud);
                $montoCondonarContado->setTipoRequisito(43);
                $registrar[] = $montoCondonarContado;
                //fecha de pago
                $fechaPago = new DetalleSolicitud();
                $fechaPago->setCumple(1);
                $fechaPago->setCampoRequisito($_POST['fechaPago']);
                $fechaPago->setIdSolicitud($idSolicitud);
                $fechaPago->setTipoRequisito(44);
                $registrar[] = $fechaPago;
                //total arreglo de pago
                $totalArreglo = new DetalleSolicitud();
                $totalArreglo->setCumple(1);
                $totalArreglo->setCampoRequisito($_POST['totalArreglo']);
                $totalArreglo->setIdSolicitud($idSolicitud);
                $totalArreglo->setTipoRequisito(45);
                $registrar[] = $totalArreglo;
                //monto a condonar arreglo de pago
                $montoCondonarArreglo = new DetalleSolicitud();
                $montoCondonarArreglo->setCumple(1);
                $montoCondonarArreglo->setCampoRequisito($_POST['montoCondonarArreglo']);
                $montoCondonarArreglo->setIdSolicitud($idSolicitud);
                $montoCondonarArreglo->setTipoRequisito(46);
                $registrar[] = $montoCondonarArreglo;
                //fecha de inicio
                $fechaInicio = new DetalleSolicitud();
                $fechaInicio->setCumple(1);
                $fechaInicio->setCampoRequisito($_POST['fechaInicio']);
                $fechaInicio->setIdSolicitud($idSolicitud);
                $fechaInicio->setTipoRequisito(47);
                $registrar[] = $fechaInicio;
                //plazo en meses
                $plazoMeses = new DetalleSolicitud();
                $plazoMeses->setCumple(1);
                $plazoMeses->setCampoRequisito($_POST['plazoMeses']);
                $plazoMeses->setIdSolicitud($idSolicitud);
                $plazoMeses->setTipoRequisito(48);
                $registrar[] = $plazoMeses;
                //cantidad de cuotas
                $cantidadCuotas = new DetalleSolicitud();
                $cantidadCuotas->setCumple(1);
                $cantidadCuotas->setCampoRequisito($_POST['cantidadCuotas']);
                $cantidadCuotas->setIdSolicitud($idSolicitud);
                $cantidadCuotas->setTipoRequisito(49);
                $registrar[] = $cantidadCuotas;
                //adelanto 20%
                $adelanto = new DetalleSolicitud();
                $adelanto->setCumple(1);
                $adelanto->setCampoRequisito($_POST['adelanto']);
                $adelanto->setIdSolicitud($idSolicitud);
                $adelanto->setTipoRequisito(50);
                $registrar[] = $adelanto;
                //pago por cuota
                $pagoPorCuota = new DetalleSolicitud();
                $pagoPorCuota->setCumple(1);
                $pagoPorCuota->setCampoRequisito($_POST['pagoPorCuota']);
                $pagoPorCuota->setIdSolicitud($idSolicitud);
                $pagoPorCuota->setTipoRequisito(51);
                $registrar[] = $pagoPorCuota;
                //resolucion
                $resolucion = new DetalleSolicitud();
                $resolucion->setCumple(1);
                $resolucion->setCampoRequisito($_POST['resolucion']);
                $resolucion->setIdSolicitud($idSolicitud);
                $resolucion->setTipoRequisito(52);
                $registrar[] = $resolucion;
                //plazo de prevención
                $plazo = new DetalleSolicitud();
                $plazo->setCumple(1);
                $plazo->setCampoRequisito($_POST['plazo']);
                $plazo->setIdSolicitud($idSolicitud);
                $plazo->setTipoRequisito(53);
                $registrar[] = $plazo;
                //fecha de notificacion
                $fechaNotificacion = new DetalleSolicitud();
                $fechaNotificacion->setCumple(1);
                $fechaNotificacion->setCampoRequisito($_POST['fechaNotificacion']);
                $fechaNotificacion->setIdSolicitud($idSolicitud);
                $fechaNotificacion->setTipoRequisito(54);
                $registrar[] = $fechaNotificacion;
                //cumple
                $cumple = new DetalleSolicitud();
                $cumple->setCumple(1);
                $cumple->setCampoRequisito($_POST['cumple']);
                $cumple->setIdSolicitud($idSolicitud);
                $cumple->setTipoRequisito(55);
                $registrar[] = $cumple;
                if ($solicitudM->IngresarDetalles($registrar)){
                    header('location: index.php?controlador=Tramites&metodo=Condonacion');
                } else {
                    $this->LlamarVistaIngresar('Verfique los datos de la solicitud');    
                }
            } else {
                $this->LlamarVistaIngresar('Verfique los datos de la solicitud');
            }
        }
    }
    
}