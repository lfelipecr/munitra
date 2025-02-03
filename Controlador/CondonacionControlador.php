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
                $post = ['representante', 'identificacionRepresentante', 'direccion', 'notificaciones',
                'tipoSolicitud', 'firma', 'recibido', 'fecha', 'funcionario', 'consecutivo',
                'totalContado', 'montoCondonarContado', 'fechaPago', 'totalArreglo',
                'montoCondonarArreglo', 'fechaInicio', 'plazoMeses', 'cantidadCuotas', 'adelanto',
                'pagoPorCuota', 'resolucion', 'plazo', 'fechaNotificacion', 'cumple'];
                $postIds = ['idRepresentante', 'idIdentificacionRepresentante', 'idDireccion', 'idNotificaciones',
                'idTipoSolicitud', 'idFirma', 'idRecibido', 'idFecha', 'idFuncionario', 'idConsecutivo',
                'totalCondonado', 'montoCondonarContado', 'fechaPago', 'totalArreglo',
                'montoCondonarArreglo', 'fechaInicio', 'plazoMeses', 'cantidadCuotas', 'adelanto',
                'pagoPorCuota', 'resolucion', 'plazo', 'fechaNotificacion', 'cumple'];
                $tipoRequisito = 32;
                for ($i = 0; $i < count($post); $i++){
                    if ($tipoRequisito == 37){
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
                    } else {
                        $detalle = new DetalleSolicitud();
                        $detalle->setId($_POST[$postIds[$i]]);
                        $detalle->setCumple(1);
                        $detalle->setCampoRequisito($_POST[$post[$i]]);
                        $detalle->setIdSolicitud($idSolicitud);
                        $detalle->setTipoRequisito($tipoRequisito);
                        $registrar[] = $detalle;
                    }
                    $tipoRequisito++;
                }
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
                $post = ['representante', 'identificacionRepresentante', 'direccion', 'notificaciones',
                'tipoSolicitud', 'firma', 'recibido', 'fecha', 'funcionario', 'consecutivo',
                'totalContado', 'montoCondonarContado', 'fechaPago', 'totalArreglo',
                'montoCondonarArreglo', 'fechaInicio', 'plazoMeses', 'cantidadCuotas', 'adelanto',
                'pagoPorCuota', 'resolucion', 'plazo', 'fechaNotificacion', 'cumple'];
                $tipoRequisito = 32;
                //representante legal
                
                for ($i = 0; $i < count($post); $i++){
                    if ($tipoRequisito == 37){
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
                        $soliFirma->setTipoRequisito($tipoRequisito);
                        $registrar[] = $soliFirma;
                    } else {
                        $detalle = new DetalleSolicitud();
                        $detalle->setCumple(1);
                        $detalle->setCampoRequisito($_POST[$post[$i]]);
                        $detalle->setIdSolicitud($idSolicitud);
                        $detalle->setTipoRequisito($tipoRequisito);
                        $registrar[] = $detalle;
                    }
                    $tipoRequisito++;
                }
                
                
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