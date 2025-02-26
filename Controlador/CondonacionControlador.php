<?php 
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Metodos/SolicitudM.php';
require_once './Modelo/Metodos/PersonaM.php';
require_once './Modelo/Metodos/ProvinciaM.php';
require_once './Modelo/Entidades/DetalleSolicitud.php';

class CondonacionControlador {
    function Imprimir(){
        $provinciaM = new ProvinciaM();
        $id = $_GET['id'];
        $solicitudM = new SolicitudM();
        $personaM = new PersonaM();
        $provinciaM = new ProvinciaM();
        $jsonData = $solicitudM->BuscarDetallesSolicitud($id);
        $solicitud = $solicitudM->BuscarCabeceraSolicitud($id);
        $persona = $personaM->BuscarPersona($solicitud->getIdPersona());
        $distritos = $provinciaM->BuscarDistritos();
        //Datos de impresión
        $tiposId = ['n/a', 'Cédula de Identidad', 'Pasaporte', 'Cédula de Residencia',
        'Número Interno', 'Número asegurado', 'DIMEX', 'NITE', 'DIDI'];
        $locaciones = $provinciaM->LocacionesId($persona->getIdProvincia(), $persona->getIdCanton(), $persona->getIdDistrito());
        require_once './Vista/Dashboard/Tramites/Condonacion/impresion.php';
    }
    private function LlamarVistaActualizar($msg, $id){
        if ($_SESSION['usuario']->getIdDepartamento() == 1){
            $provinciaM = new ProvinciaM();
            $solicitudM = new SolicitudM();
            $personaM = new PersonaM();
            $personas = $personaM->ListadoPersonas();
            $jsonData = $solicitudM->BuscarDetallesSolicitud($id);
            $solicitud = $solicitudM->BuscarCabeceraSolicitud($id);
            $arrLocaciones  = $provinciaM->BuscarLocaciones();
            $distritos = $provinciaM->BuscarDistritos();
            $personaM = new PersonaM();
            $id = $_SESSION['usuario']->getIdPersona();
            $persona = $personaM->BuscarPersona($solicitud->getIdPersona());
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
            $provinciaM = new ProvinciaM();
            $id = $_SESSION['usuario']->getIdPersona();
            $personaM = new PersonaM();
            $identificacion = $personaM->BuscarPersona($id)->getIdentificacion();
            $arrLocaciones  = $provinciaM->BuscarLocaciones();
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
            //Si todos los datos están correctos, guarda la solicitud y obtiene el id
            $solicitudM = new SolicitudM();
            $solicitud = new Solicitud();
            session_start();
            $idSolicitud = $_POST['idSolicitud'];
            $solicitud->setId($idSolicitud);
            $solicitud->setIdUsuario($_SESSION['usuario']->getId());
            $solicitud->setTipoSolicitud(4);
            $solicitud->setEstadoSolicitud($_POST['estadoSolicitud']);
            if ($solicitudM->ActualizarCabeceraSolicitud($solicitud)){
                $registrar = array();
                $post = ['representante', 'identificacionRepresentante', 'direccion', 'notificaciones',
                'tipoSolicitud', 'firma', 'recibido', 'fecha', 'funcionario', 'consecutivo',
                'totalContado', 'montoCondonarContado', 'fechaPago', 'totalArreglo',
                'montoCondonarArreglo', 'fechaInicio', 'plazoMeses', 'cantidadCuotas', 'adelanto',
                'pagoPorCuota', 'resolucion', 'plazo', 'fechaNotificacion', 'cumple'];
                $postIds = ['idRepresentante', 'idIdentificacionRepresentante', 'idDireccion', 'idNotificaciones',
                'idTipoSolicitud', 'idFirma', 'idRecibido', 'idFecha', 'idFuncionario', 'idConsecutivo',
                'idTotalContado', 'idMontoCondonarContado', 'idFechaPago', 'idTotalArreglo',
                'idMontoCondonarArreglo', 'idFechaInicio', 'idPlazoMeses', 'idCantidadCuotas', 'idAdelanto',
                'idPagoPorCuota', 'idResolucion', 'idPlazo', 'idFechaNotificacion', 'idCumple'];
                $tipoRequisito = 32;
                for ($i = 0; $i < count($post); $i++){
                    if ($tipoRequisito == 37){
                        if (isset($_POST['firma'])){
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
                        }
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
            //si un administrador ingresa la persona, manda el id
            //si un usuario externo lo hace, busca los datos de la persona
            if (isset($_POST['persona'])){
                $solicitud->setIdPersona($_POST['persona']);
            } else {
                $cedula = $_POST['identificacion'];
                $personaM = new PersonaM();
                //busca una cedula coincidente y la asigna, si no la encuentra, crea a la persona
                $persona = $personaM->BuscarPersonaCedula($cedula);
                if ($persona != null){
                    $solicitud->setIdPersona($persona->getId());
                } else {
                    //genera el usuario
                    session_start();
                    $persona = new Persona();
                    $persona->setIdTipoIdentificacion($_POST['tipoIdentificacion']);
                    $persona->setIdentificacion(trim($_POST['identificacion']));
                    $persona->setNombre(trim($_POST['nombre']));
                    $persona->setPrimerApellido(trim($_POST['apellido1']));
                    $persona->setSegundoApellido(trim($_POST['apellido2']));
                    $persona->setDireccion(trim($_POST['direccion']));
                    $persona->setTelefono(trim($_POST['telefono']));
                    $persona->setWhatsapp(trim($_POST['whatsapp']));
                    $persona->setCorreo(trim($_POST['correo']));
                    $persona->setSituacion(trim($_POST['situacion']));
                    $persona->setEstado(2);
                    $persona->setMontoMorosidad($_POST['montoMorosidad']);
                    $persona->setMontoAdeudado($_POST['montoAdeudado']);
                    $persona->setPropiedadFuera($_POST['propiedadFuera']);
                    $persona->setConsentimiento($_POST['consentimiento']);
                    $persona->setIdProvincia($_POST['provincia']);
                    $persona->setIdCanton($_POST['canton']);
                    $persona->setIdDistrito($_POST['distritoPersona']);
                    $persona->setUsuarioCreacion($_SESSION['usuario']->getId());
                    $idUsuario = $personaM->IngresarPersona($persona);
                    $solicitud->setIdPersona($idUsuario);
                }
            }            
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
                        if (isset($_POST['firma'])){
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
                        }
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