<?php 
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Metodos/SolicitudM.php';
require_once './Modelo/Metodos/ProvinciaM.php';
require_once './Modelo/Metodos/PersonaM.php';
require_once './Modelo/Entidades/DetalleSolicitud.php';

class VisadoControlador {
    private function LlamarVistaActualizar($msg, $id){
        $solicitudM = new SolicitudM();
        $personaM = new PersonaM();
        $provinciaM = new ProvinciaM();
        $jsonData = $solicitudM->BuscarDetallesSolicitud($id);
        $solicitud = $solicitudM->BuscarCabeceraSolicitud($id);
        $personas = $personaM->ListadoPersonas();
        $distritos = $provinciaM->BuscarDistritos();
        $vista = './Vista/Dashboard/Tramites/Visado/actualizar.php';
        require_once './Vista/Utilidades/sidebar.php';
    }
    private function LlamarVistaIngresar($msg){
        if ($_SESSION['usuario']->getIdDepartamento() == 1){
            $provinciaM = new ProvinciaM();
            $id = $_SESSION['usuario']->getIdPersona();
            $distritos = $provinciaM->BuscarDistritos();
            $vista = './Vista/TramitesUsuario/Visado/nuevo.php';
            require_once './Vista/Utilidades/navbar.php';
        } else {
            $personaM = new PersonaM();
            $provinciaM = new ProvinciaM();
            $personas = $personaM->ListadoPersonas();
            $distritos = $provinciaM->BuscarDistritos();
            $vista = './Vista/Dashboard/Tramites/Visado/nuevo.php';
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
            if (!isset($_POST['firma'])){
                $this->LlamarVistaActualizar('La firma es requerida', $_GET['idSolicitud']);
            } else {
                $solicitudM = new SolicitudM();
                $solicitud = new Solicitud();
                session_start();
                $idSolicitud = $_POST['idSolicitud'];
                $solicitud->setId($idSolicitud);
                $solicitud->setIdUsuario($_SESSION['usuario']->getId());
                $solicitud->setTipoSolicitud(3);
                $solicitud->setEstadoSolicitud($_POST['estadoSolicitud']);
                $solicitud->setIdPersona($_POST['persona']);
                if ($solicitudM->ActualizarCabeceraSolicitud($solicitud)){
                    $registrar = array();
                    //datos de inputs
                    //direccion de propiedad
                    $direccionPropiedad = new DetalleSolicitud();
                    $direccionPropiedad->setId($_POST['idDireccionPropiedad']);
                    $direccionPropiedad->setCumple(1);
                    $direccionPropiedad->setCampoRequisito($_POST['direccionPropiedad']);
                    $direccionPropiedad->setIdSolicitud($idSolicitud);
                    $direccionPropiedad->setTipoRequisito(18);
                    $registrar[] = $direccionPropiedad;
                    //distrito
                    $distrito = new DetalleSolicitud();
                    $distrito->setId($_POST['idDistrito']);
                    $distrito->setCumple(1);
                    $distrito->setCampoRequisito($_POST['distrito']);
                    $distrito->setIdSolicitud($idSolicitud);
                    $distrito->setTipoRequisito(19);
                    $registrar[] = $distrito;
                    //numero de plano
                    $numeroPlano = new DetalleSolicitud();
                    $numeroPlano->setId($_POST['idNumeroPlano']);
                    $numeroPlano->setCumple(1);
                    $numeroPlano->setCampoRequisito($_POST['numeroPlano']);
                    $numeroPlano->setIdSolicitud($idSolicitud);
                    $numeroPlano->setTipoRequisito(20);
                    $registrar[] = $numeroPlano;
                    //area de plano
                    $areaPlano = new DetalleSolicitud();
                    $areaPlano->setId($_POST['idAreaPlano']);
                    $areaPlano->setCumple(1);
                    $areaPlano->setCampoRequisito($_POST['areaPlano']);
                    $areaPlano->setIdSolicitud($idSolicitud);
                    $areaPlano->setTipoRequisito(21);
                    $registrar[] = $areaPlano;
                    //numero de finca
                    $numeroFinca = new DetalleSolicitud();
                    $numeroFinca->setId($_POST['idNumeroFinca']);
                    $numeroFinca->setCumple(1);
                    $numeroFinca->setCampoRequisito($_POST['numeroFinca']);
                    $numeroFinca->setIdSolicitud($idSolicitud);
                    $numeroFinca->setTipoRequisito(22);
                    $registrar[] = $numeroFinca;
                    //area segun registro publico
                    $areaRegistroPublico = new DetalleSolicitud();
                    $areaRegistroPublico->setId($_POST['idAreaRegistroPublico']);
                    $areaRegistroPublico->setCumple(1);
                    $areaRegistroPublico->setCampoRequisito($_POST['areaRegistroPublico']);
                    $areaRegistroPublico->setIdSolicitud($idSolicitud);
                    $areaRegistroPublico->setTipoRequisito(23);
                    $registrar[] = $areaRegistroPublico;
                    //frente
                    $frente = new DetalleSolicitud();
                    $frente->setId($_POST['idFrente']);
                    $frente->setCumple(1);
                    $frente->setCampoRequisito($_POST['frente']);
                    $frente->setIdSolicitud($idSolicitud);
                    $frente->setTipoRequisito(24);
                    $registrar[] = $frente;
                    //numero de contrato CFIA
                    $numeroContrato = new DetalleSolicitud();
                    $numeroContrato->setId($_POST['idNumeroContrato']);
                    $numeroContrato->setCumple(1);
                    $numeroContrato->setCampoRequisito($_POST['numeroContrato']);
                    $numeroContrato->setIdSolicitud($idSolicitud);
                    $numeroContrato->setTipoRequisito(25);
                    $registrar[] = $numeroContrato;
                    //archivos
                    $rutaDestino = './repo/';
                    if (!is_writable('./repo/')) {
                        $this->LlamarVistaIngresar('El directorio no tiene permisos de escritura, comuníquese con el profesional de TI');
                        $validacionArchivos = false;
                    }  else {
                        if (!is_dir($rutaDestino)) {
                            mkdir($rutaDestino, 0777, true);
                        }
                        //carta de disponibilidad
                        if (isset($_FILES['flCartaDisponibilidad']) && $_FILES['flCartaDisponibilidad']['error'] === UPLOAD_ERR_OK) {
                            $urlArchivo = $rutaDestino.basename($_FILES['flCartaDisponibilidad']['name']);
                            if (move_uploaded_file($_FILES['flCartaDisponibilidad']['tmp_name'], $urlArchivo)) {
                                $cartaDisponibilidad = new DetalleSolicitud();
                                $cartaDisponibilidad->setId($_POST['idCartaDisponibilidad']);
                                $cartaDisponibilidad->setCumple(1);
                                $cartaDisponibilidad->setCampoRequisito($urlArchivo);
                                $cartaDisponibilidad->setIdSolicitud($idSolicitud);
                                $cartaDisponibilidad->setTipoRequisito(26);
                                $registrar[] = $cartaDisponibilidad;
                            }
                        }
                        //croquis
                        if (isset($_FILES['flCroquis']) && $_FILES['flCroquis']['error'] === UPLOAD_ERR_OK) {
                            $urlArchivo = $rutaDestino.basename($_FILES['flCroquis']['name']);
                            if (move_uploaded_file($_FILES['flCroquis']['tmp_name'], $urlArchivo)) {
                                $croquis = new DetalleSolicitud();
                                $croquis->setId($_POST['idCroquis']);
                                $croquis->setCumple(1);
                                $croquis->setIdSolicitud($idSolicitud);
                                $croquis->setCampoRequisito($urlArchivo);
                                $croquis->setTipoRequisito(27);
                                $registrar[] = $croquis;
                            }
                        }
                        //plano corregido
                        if (isset($_FILES['flPlanoCorregido']) && $_FILES['flPlanoCorregido']['error'] === UPLOAD_ERR_OK) {
                            $urlArchivo = $rutaDestino.basename($_FILES['flPlanoCorregido']['name']);
                            if (move_uploaded_file($_FILES['flPlanoCorregido']['tmp_name'], $urlArchivo)) {
                                $planoCorregido = new DetalleSolicitud();
                                $planoCorregido->setId($_POST['idPlanoCorregido']);
                                $planoCorregido->setCumple(1);
                                $planoCorregido->setIdSolicitud($idSolicitud);
                                $planoCorregido->setCampoRequisito($urlArchivo);
                                $planoCorregido->setTipoRequisito(28);
                                $registrar[] = $planoCorregido;
                            }
                        }
                        //copia de la minuta
                        if (isset($_FILES['flMinuta']) && $_FILES['flMinuta']['error'] === UPLOAD_ERR_OK) {
                            $urlArchivo = $rutaDestino.basename($_FILES['flMinuta']['name']);
                            if (move_uploaded_file($_FILES['flMinuta']['tmp_name'], $urlArchivo)) {
                                $minuta = new DetalleSolicitud();
                                $minuta->setId($_POST['idMinuta']);
                                $minuta->setCumple(1);
                                $minuta->setIdSolicitud($idSolicitud);
                                $minuta->setCampoRequisito($urlArchivo);
                                $minuta->setTipoRequisito(29);
                                $registrar[] = $minuta;
                            }
                        }
                        //carta de certificacion mopt
                        if (isset($_FILES['flCartaMOPT']) && $_FILES['flCartaMOPT']['error'] === UPLOAD_ERR_OK) {
                            $urlArchivo = $rutaDestino.basename($_FILES['flCartaMOPT']['name']);
                            if (move_uploaded_file($_FILES['flCartaMOPT']['tmp_name'], $urlArchivo)) {
                                $cartaMopt = new DetalleSolicitud();
                                $cartaMopt->setId($_POST['idCartaMOPT']);
                                $cartaMopt->setCumple(1);
                                $cartaMopt->setIdSolicitud($idSolicitud);
                                $cartaMopt->setCampoRequisito($urlArchivo);
                                $cartaMopt->setTipoRequisito(30);
                                $registrar[] = $cartaMopt;
                            }
                        }
                        //Firma
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
                            $soliFirma->setTipoRequisito(31);
                            $registrar[] = $soliFirma;
                        }
                    }
                    if ($solicitudM->ActualizarDetallesSolicitud($registrar)){
                        header('location: index.php?controlador=Tramites&metodo=Visado');
                    } else {
                        $this->Actualizar('Ha habido un error con la subida de los datos, si el problema persiste, comuniquese con el profesional de TI', $idSolicitud);
                    }
                }
            }
        }
    }
    function Ingresar(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            //arreglo a mandar a BD 
            $registrar = array();
            //Variable verifica que todos los archivos sean correctos
            $validacionArchivos = false;
            //Archivos
            $rutaDestino = './repo/';
            if (!is_writable('./repo/')) {
                $this->LlamarVistaIngresar('El directorio no tiene permisos de escritura, comuníquese con el profesional de TI');
                $validacionArchivos = false;
            }  else {
                if (!is_dir($rutaDestino)) {
                    mkdir($rutaDestino, 0777, true);
                }
                //carta de disponibilidad
                if (isset($_FILES['flCartaDisponibilidad']) && $_FILES['flCartaDisponibilidad']['error'] === UPLOAD_ERR_OK) {
                    $urlArchivo = $rutaDestino.basename($_FILES['flCartaDisponibilidad']['name']);
                    if (move_uploaded_file($_FILES['flCartaDisponibilidad']['tmp_name'], $urlArchivo)) {
                        $validacionArchivos = true;
                        $cartaDisponibilidad = new DetalleSolicitud();
                        $cartaDisponibilidad->setCumple(1);
                        $cartaDisponibilidad->setCampoRequisito($urlArchivo);
                        $cartaDisponibilidad->setTipoRequisito(26);
                    }
                }
                //croquis
                if (isset($_FILES['flCroquis']) && $_FILES['flCroquis']['error'] === UPLOAD_ERR_OK) {
                    $urlArchivo = $rutaDestino.basename($_FILES['flCroquis']['name']);
                    if (move_uploaded_file($_FILES['flCroquis']['tmp_name'], $urlArchivo)) {
                        $validacionArchivos = true;
                        $croquis = new DetalleSolicitud();
                        $croquis->setCumple(1);
                        $croquis->setCampoRequisito($urlArchivo);
                        $croquis->setTipoRequisito(27);
                    }
                }
                //plano corregido
                if (isset($_FILES['flPlanoCorregido']) && $_FILES['flPlanoCorregido']['error'] === UPLOAD_ERR_OK) {
                    $urlArchivo = $rutaDestino.basename($_FILES['flPlanoCorregido']['name']);
                    if (move_uploaded_file($_FILES['flPlanoCorregido']['tmp_name'], $urlArchivo)) {
                        $validacionArchivos = true;
                        $planoCorregido = new DetalleSolicitud();
                        $planoCorregido->setCumple(1);
                        $planoCorregido->setCampoRequisito($urlArchivo);
                        $planoCorregido->setTipoRequisito(28);
                    }
                }
                //copia de la minuta
                if (isset($_FILES['flMinuta']) && $_FILES['flMinuta']['error'] === UPLOAD_ERR_OK) {
                    $urlArchivo = $rutaDestino.basename($_FILES['flMinuta']['name']);
                    if (move_uploaded_file($_FILES['flMinuta']['tmp_name'], $urlArchivo)) {
                        $validacionArchivos = true;
                        $minuta = new DetalleSolicitud();
                        $minuta->setCumple(1);
                        $minuta->setCampoRequisito($urlArchivo);
                        $minuta->setTipoRequisito(29);
                    }
                }
                //carta de certificacion mopt
                if (isset($_FILES['flCartaMOPT']) && $_FILES['flCartaMOPT']['error'] === UPLOAD_ERR_OK) {
                    $urlArchivo = $rutaDestino.basename($_FILES['flCartaMOPT']['name']);
                    if (move_uploaded_file($_FILES['flCartaMOPT']['tmp_name'], $urlArchivo)) {
                        $validacionArchivos = true;
                        $cartaMopt = new DetalleSolicitud();
                        $cartaMopt->setCumple(1);
                        $cartaMopt->setCampoRequisito($urlArchivo);
                        $cartaMopt->setTipoRequisito(30);
                    }
                }
                //Firma
                if (isset($_POST['firma'])){
                    $validacionArchivos = true;
                    $firma = $_POST['firma'];
                    $firma = str_replace("data:image/png;base64,", "", $firma);
                    $firma = str_replace(" ", "+", $firma);
                    $imagen = base64_decode($firma);
                    $archivo = "repo/firmas/firma_" . time() . ".png";
                    file_put_contents($archivo, $imagen);
                    $soliFirma = new DetalleSolicitud();
                    $soliFirma->setCumple(1);
                    $soliFirma->setCampoRequisito($archivo);
                    $soliFirma->setTipoRequisito(31);
                }
            }
            //Si todos los archivos se subieron, guarda la solicitud y obtiene el id
            if ($validacionArchivos){
                $solicitudM = new SolicitudM();
                $solicitud = new Solicitud();
                session_start();
                $solicitud->setIdUsuario($_SESSION['usuario']->getId());
                $solicitud->setTipoSolicitud(3);
                $solicitud->setEstadoSolicitud($_POST['estadoSolicitud']);
                $solicitud->setIdPersona($_POST['persona']);
                $idSolicitud = $solicitudM->IngresarSolicitud($solicitud);
                //Valida que la solicitud se haya ingresado
                if ($idSolicitud != 0){
                    //Agrega los id de solicitud
                    $cartaDisponibilidad->setIdSolicitud($idSolicitud);
                    $registrar[] = $cartaDisponibilidad;
                    $croquis->setIdSolicitud($idSolicitud);
                    $registrar[] = $croquis;
                    $planoCorregido->setIdSolicitud($idSolicitud);
                    $registrar[] = $planoCorregido;
                    $minuta->setIdSolicitud($idSolicitud);
                    $registrar[] = $minuta;
                    $cartaMopt->setIdSolicitud($idSolicitud);
                    $registrar[] = $cartaMopt;
                    $soliFirma->setIdSolicitud($idSolicitud);
                    $registrar[] = $soliFirma;
                    //datos de inputs
                    //direccion de propiedad
                    $direccionPropiedad = new DetalleSolicitud();
                    $direccionPropiedad->setCumple(1);
                    $direccionPropiedad->setCampoRequisito($_POST['direccionPropiedad']);
                    $direccionPropiedad->setIdSolicitud($idSolicitud);
                    $direccionPropiedad->setTipoRequisito(18);
                    $registrar[] = $direccionPropiedad;
                    //distrito
                    $distrito = new DetalleSolicitud();
                    $distrito->setCumple(1);
                    $distrito->setCampoRequisito($_POST['distrito']);
                    $distrito->setIdSolicitud($idSolicitud);
                    $distrito->setTipoRequisito(19);
                    $registrar[] = $distrito;
                    //numero de plano
                    $numeroPlano = new DetalleSolicitud();
                    $numeroPlano->setCumple(1);
                    $numeroPlano->setCampoRequisito($_POST['numeroPlano']);
                    $numeroPlano->setIdSolicitud($idSolicitud);
                    $numeroPlano->setTipoRequisito(20);
                    $registrar[] = $numeroPlano;
                    //area de plano
                    $areaPlano = new DetalleSolicitud();
                    $areaPlano->setCumple(1);
                    $areaPlano->setCampoRequisito($_POST['areaPlano']);
                    $areaPlano->setIdSolicitud($idSolicitud);
                    $areaPlano->setTipoRequisito(21);
                    $registrar[] = $areaPlano;
                    //numero de finca
                    $numeroFinca = new DetalleSolicitud();
                    $numeroFinca->setCumple(1);
                    $numeroFinca->setCampoRequisito($_POST['numeroFinca']);
                    $numeroFinca->setIdSolicitud($idSolicitud);
                    $numeroFinca->setTipoRequisito(22);
                    $registrar[] = $numeroFinca;
                    //area segun registro publico
                    $areaRegistroPublico = new DetalleSolicitud();
                    $areaRegistroPublico->setCumple(1);
                    $areaRegistroPublico->setCampoRequisito($_POST['areaRegistroPublico']);
                    $areaRegistroPublico->setIdSolicitud($idSolicitud);
                    $areaRegistroPublico->setTipoRequisito(23);
                    $registrar[] = $areaRegistroPublico;
                    //frente
                    $frente = new DetalleSolicitud();
                    $frente->setCumple(1);
                    $frente->setCampoRequisito($_POST['frente']);
                    $frente->setIdSolicitud($idSolicitud);
                    $frente->setTipoRequisito(24);
                    $registrar[] = $frente;
                    //numero de contrato CFIA
                    $numeroContrato = new DetalleSolicitud();
                    $numeroContrato->setCumple(1);
                    $numeroContrato->setCampoRequisito($_POST['numeroContrato']);
                    $numeroContrato->setIdSolicitud($idSolicitud);
                    $numeroContrato->setTipoRequisito(25);
                    $registrar[] = $numeroContrato;
                    if ($solicitudM->IngresarDetalles($registrar)){
                        header('location: index.php?controlador=Tramites&metodo=Visado');
                    } else {
                        $this->LlamarVistaIngresar('Verfique los datos de la solicitud');    
                    }
                } else {
                    $this->LlamarVistaIngresar('Verfique los datos de la solicitud');
                }
            } else {
                $this->LlamarVistaIngresar('Debe subir todos los archivos obligatorios');
            }
        }
    }
}