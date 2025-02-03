<?php 
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Metodos/SolicitudM.php';
require_once './Modelo/Metodos/ProvinciaM.php';
require_once './Modelo/Metodos/PersonaM.php';
require_once './Modelo/Entidades/DetalleSolicitud.php';

class VisadoControlador {
    private function LlamarVistaActualizar($msg, $id){
        if ($_SESSION['usuario']->getIdDepartamento() == 1){
            $solicitudM = new SolicitudM();
            $provinciaM = new ProvinciaM();
            $jsonData = $solicitudM->BuscarDetallesSolicitud($id);
            $solicitud = $solicitudM->BuscarCabeceraSolicitud($id);
            $id = $_SESSION['usuario']->getIdPersona();
            $distritos = $provinciaM->BuscarDistritos();
            $vista = './Vista/TramitesUsuario/Visado/actualizar.php';
            require_once './Vista/Utilidades/navbar.php';
        } else {
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
                    //variables del POST
                    $post = ['direccionPropiedad', 'distrito', 'numeroPlano', 'areaPlano', 'numeroFinca', 'areaRegistroPublico', 'frente', 'numeroContrato'];
                    $postIds = ['idDireccionPropiedad', 'idDistrito', 'idNumeroPlano', 'idAreaPlano', 'idNumeroFinca', 'idAreaRegistroPublico', 'idFrente', 'idNumeroContrato'];
                    $tipoRequisito = 18;
                    for ($i = 0; $i < count($post); $i++){
                        $detalle = new DetalleSolicitud();
                        $detalle->setId($_POST[$postIds[$i]]);
                        $detalle->setCumple(1);
                        $detalle->setCampoRequisito($_POST[$post[$i]]);
                        $detalle->setIdSolicitud($idSolicitud);
                        $detalle->setTipoRequisito($tipoRequisito);
                        $registrar[] = $detalle;
                        $tipoRequisito++;
                    }
                    //archivos
                    $rutaDestino = './repo/';
                    if (!is_writable('./repo/')) {
                        $this->LlamarVistaIngresar('El directorio no tiene permisos de escritura, comuníquese con el profesional de TI');
                        $validacionArchivos = false;
                    }  else {
                        if (!is_dir($rutaDestino)) {
                            mkdir($rutaDestino, 0777, true);
                        }
                        $post = ['flCartaDisponibilidad', 'flCroquis', 'flPlanoCorregido', 'flMinuta', 'flCartaMOPT'];
                        $postIds = ['idCartaDisponibilidad', 'idCroquis', 'idPlanoCorregido', 'idMinuta', 'idCartaMOPT'];
                        $tipoRequisito = 26;
                        //carta de disponibilidad
                        for ($i = 0; $i < count($post); $i++){
                            if (isset($_FILES[$post[$i]]) && $_FILES[$post[$i]]['error'] === UPLOAD_ERR_OK) {
                                $urlArchivo = $rutaDestino.basename($_FILES[$post[$i]]['name']);
                                if (move_uploaded_file($_FILES[$post[$i]]['tmp_name'], $urlArchivo)) {
                                    $cartaDisponibilidad = new DetalleSolicitud();
                                    $cartaDisponibilidad->setId($_POST[$postIds[$i]]);
                                    $cartaDisponibilidad->setCumple(1);
                                    $cartaDisponibilidad->setCampoRequisito($urlArchivo);
                                    $cartaDisponibilidad->setIdSolicitud($idSolicitud);
                                    $cartaDisponibilidad->setTipoRequisito($tipoRequisito);
                                    $registrar[] = $cartaDisponibilidad;
                                }
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
            $validacionArchivos = true;
            //Archivos
            $rutaDestino = './repo/';
            if (!is_writable('./repo/')) {
                $this->LlamarVistaIngresar('El directorio no tiene permisos de escritura, comuníquese con el profesional de TI');
                $validacionArchivos = true;
            }  else {
                if (!is_dir($rutaDestino)) {
                    mkdir($rutaDestino, 0777, true);
                }
                //variables de $_FILES
                $filePost = ['flCartaDisponibilidad', 'flCroquis', 'flPlanoCorregido', 'flMinuta', 'flCartaMOPT'];
                $tipoRequisito = 26;
                for($i = 0; $i < 5; $i++)
                {
                    if (isset($_FILES[$filePost[$i]]) && $_FILES[$filePost[$i]]['error'] === UPLOAD_ERR_OK){
                        $urlArchivo = $rutaDestino.basename($_FILES[$filePost[$i]]['name']);
                        if (move_uploaded_file($_FILES[$filePost[$i]]['tmp_name'], $urlArchivo)) {
                            $adjunto = new DetalleSolicitud();
                            $adjunto->setCumple(1);
                            $adjunto->setCampoRequisito($urlArchivo);
                            $adjunto->setTipoRequisito($tipoRequisito);
                            $registrar[] = $adjunto;
                            $tipoRequisito++;
                        }
                    } else {
                        $validacionArchivos = false;
                        break;
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
                    $soliFirma->setCumple(1);
                    $soliFirma->setCampoRequisito($archivo);
                    $soliFirma->setTipoRequisito(31);
                    $registrar[] = $soliFirma;
                } else {
                    $validacionArchivos = false;
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
                    for ($i = 0; $i < count($registrar); $i++){
                        $registrar[$i]->setIdSolicitud($idSolicitud);
                    }
                    //datos de inputs
                    //variables del POST
                    $post = ['direccionPropiedad', 'distrito', 'numeroPlano', 'areaPlano', 'numeroFinca', 'areaRegistroPublico', 'frente', 'numeroContrato'];
                    $tipoRequisito = 18;
                    for ($i = 0; $i < 8; $i++){
                        $detalle = new DetalleSolicitud();
                        $detalle->setCumple(1);
                        $detalle->setCampoRequisito($_POST[$post[$i]]);
                        $detalle->setIdSolicitud($idSolicitud);
                        $detalle->setTipoRequisito($tipoRequisito);
                        $registrar[] = $detalle;
                        $tipoRequisito++;
                    }
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