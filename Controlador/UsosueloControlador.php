<?php 
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Metodos/SolicitudM.php';
require_once './Modelo/Metodos/ProvinciaM.php';
require_once './Modelo/Metodos/PersonaM.php';
require_once './Modelo/Entidades/DetalleSolicitud.php';

class UsosueloControlador {
    private function LlamarVistaActualizar($msg, $id){
        $solicitudM = new SolicitudM();
        $personaM = new PersonaM();
        $provinciaM = new ProvinciaM();
        $jsonData = $solicitudM->BuscarDetallesSolicitud($id);
        $solicitud = $solicitudM->BuscarCabeceraSolicitud($id);
        $personas = $personaM->ListadoPersonas();
        $distritos = $provinciaM->BuscarDistritos();
        $vista = './Vista/Dashboard/Tramites/UsoSuelo/actualizar.php';
        require_once './Vista/Utilidades/sidebar.php';
    }
    function VActualizar(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            $id = $_GET['id'];
            $this->LlamarVistaActualizar('', $id);
        }
    }
    private function LlamarVistaIngresar($msg){
        $personaM = new PersonaM();
        $provinciaM = new ProvinciaM();
        $personas = $personaM->ListadoPersonas();
        $distritos = $provinciaM->BuscarDistritos();
        $vista = './Vista/Dashboard/Tramites/UsoSuelo/nuevo.php';
        require_once './Vista/Utilidades/sidebar.php';
    }
    function VIngresar(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            $this->LlamarVistaIngresar('');
        }
    }
    function Ingresar(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            if (isset($_POST['persona']) && isset($_POST['direccionPropiedad']) &&
            isset($_POST['finca']) && isset($_POST['plano']) &&
            isset($_POST['usoSolicitado'])){
                if (isset($_FILES['planoCatastro']) && $_FILES['planoCatastro']['error'] === UPLOAD_ERR_OK) {
                    $rutaDestino = './repo/';
                    $urlArchivo = $rutaDestino.basename($_FILES['planoCatastro']['name']);
                    if (!is_writable('./repo/')) {
                        $this->LlamarVistaIngresar('El directorio no tiene permisos de escritura, comuníquese con el profesional de TI');
                    }                
                    if (!is_dir($rutaDestino)) {
                        mkdir($rutaDestino, 0777, true);
                    }
                    if (move_uploaded_file($_FILES['planoCatastro']['tmp_name'], $urlArchivo)) {
                        //Si todos los datos están correctos, guarda la solicitud y obtiene el id
                        $solicitudM = new SolicitudM();
                        $solicitud = new Solicitud();
                        session_start();
                        $solicitud->setIdUsuario($_SESSION['usuario']->getId());
                        $solicitud->setTipoSolicitud(2);
                        $solicitud->setEstadoSolicitud($_POST['estadoSolicitud']);
                        $solicitud->setIdPersona($_POST['persona']);
                        $idSolicitud = $solicitudM->IngresarSolicitud($solicitud);
                        //Si el id es válido, genera un arreglo con los detalles
                        if ($idSolicitud != 0) {
                            $registrar = array();
                            //distrito
                            $distrito = new DetalleSolicitud();
                            $distrito->setCumple(1);
                            $distrito->setCampoRequisito($_POST['distrito']);
                            $distrito->setIdSolicitud($idSolicitud);
                            $distrito->setTipoRequisito(10);
                            $registrar[] = $distrito;
                            //direccion de la propiedad
                            $direccionPropiedad = new DetalleSolicitud();
                            $direccionPropiedad->setCumple(1);
                            $direccionPropiedad->setCampoRequisito($_POST['direccionPropiedad']);
                            $direccionPropiedad->setIdSolicitud($idSolicitud);
                            $direccionPropiedad->setTipoRequisito(11);
                            $registrar[] = $direccionPropiedad;
                            //numero de finca
                            $finca = new DetalleSolicitud();
                            $finca->setCumple(1);
                            $finca->setCampoRequisito($_POST['finca']);
                            $finca->setIdSolicitud($idSolicitud);
                            $finca->setTipoRequisito(12);
                            $registrar[] = $finca;
                            //numero de plano
                            $plano = new DetalleSolicitud();
                            $plano->setCumple(1);
                            $plano->setCampoRequisito($_POST['plano']);
                            $plano->setIdSolicitud($idSolicitud);
                            $plano->setTipoRequisito(13);
                            $registrar[] = $plano;
                            //motivo
                            $motivoUso = new DetalleSolicitud();
                            $motivoUso->setCumple(1);
                            $motivoUso->setCampoRequisito($_POST['motivoUso']);
                            $motivoUso->setIdSolicitud($idSolicitud);
                            $motivoUso->setTipoRequisito(14);
                            $registrar[] = $motivoUso;
                            //uso solicitado
                            $usoSolicitado = new DetalleSolicitud();
                            $usoSolicitado->setCumple(1);
                            $usoSolicitado->setCampoRequisito($_POST['usoSolicitado']);
                            $usoSolicitado->setIdSolicitud($idSolicitud);
                            $usoSolicitado->setTipoRequisito(15);
                            $registrar[] = $usoSolicitado;                            
                            //archivo adjunto
                            $adjunto = new DetalleSolicitud();
                            $adjunto->setCumple(1);
                            $adjunto->setCampoRequisito($urlArchivo);
                            $adjunto->setIdSolicitud($idSolicitud);
                            $adjunto->setTipoRequisito(16);
                            $registrar[] = $adjunto;
                            //digital
                            $digital = new DetalleSolicitud();
                            $digital->setCumple(1);
                            $digital->setCampoRequisito($_POST['digital']);
                            $digital->setIdSolicitud($idSolicitud);
                            $digital->setTipoRequisito(17);
                            $registrar[] = $digital;
                            if ($solicitudM->IngresarDetalles($registrar)){
                                header('location: index.php?controlador=Tramites&metodo=UsoSuelo');
                            } else {
                                $this->LlamarVistaIngresar('Ha habido un error con la subida de los datos, si el problema persiste, comuniquese con el profesional de TI');        
                            }
                        } else {
                            $this->LlamarVistaIngresar('Ha habido un error con la subida de los datos, si el problema persiste, comuniquese con el profesional de TI');        
                        }
                    } else {
                        $this->LlamarVistaIngresar('Ha habido un error con la subida de los datos, si el problema persiste, comuniquese con el profesional de TI');
                    }
                } else {
                    $this->LlamarVistaIngresar('Debe adjuntar el plano catastro');    
                }
            } else {
                $this->LlamarVistaIngresar('Debe llenar todos los datos marcados con asterisco (*)');
            }    
        }
    }
    function Actualizar(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            if (isset($_POST['persona']) && isset($_POST['direccionPropiedad']) &&
            isset($_POST['finca']) && isset($_POST['plano']) &&
            isset($_POST['usoSolicitado'])){
                //Cabecera solicitud
                $solicitudM = new SolicitudM();
                $solicitud = new Solicitud();
                $idSolicitud = $_POST['idSolicitud'];
                session_start();
                $solicitud->setId($idSolicitud);
                $solicitud->setIdUsuario($_SESSION['usuario']->getId());
                $solicitud->setTipoSolicitud(2);
                $solicitud->setEstadoSolicitud($_POST['estadoSolicitud']);
                $solicitud->setIdPersona($_POST['persona']);
                if ($solicitudM->ActualizarCabeceraSolicitud($solicitud)) {
                    $registrar = array();
                    //distrito
                    $distrito = new DetalleSolicitud();
                    $distrito->setId($_POST['idDistrito']);
                    $distrito->setCumple(1);
                    $distrito->setCampoRequisito($_POST['distrito']);
                    $distrito->setIdSolicitud($idSolicitud);
                    $distrito->setTipoRequisito(10);
                    $registrar[] = $distrito;
                    //direccion de la propiedad
                    $direccionPropiedad = new DetalleSolicitud();
                    $direccionPropiedad->setId($_POST['idDireccionPropiedad']);
                    $direccionPropiedad->setCumple(1);
                    $direccionPropiedad->setCampoRequisito($_POST['direccionPropiedad']);
                    $direccionPropiedad->setIdSolicitud($idSolicitud);
                    $direccionPropiedad->setTipoRequisito(11);
                    $registrar[] = $direccionPropiedad;
                    //numero de finca
                    $finca = new DetalleSolicitud();
                    $finca->setId($_POST['idFinca']);
                    $finca->setCumple(1);
                    $finca->setCampoRequisito($_POST['finca']);
                    $finca->setIdSolicitud($idSolicitud);
                    $finca->setTipoRequisito(12);
                    $registrar[] = $finca;
                    //numero de plano
                    $plano = new DetalleSolicitud();
                    $plano->setId($_POST['idPlano']);
                    $plano->setCumple(1);
                    $plano->setCampoRequisito($_POST['plano']);
                    $plano->setIdSolicitud($idSolicitud);
                    $plano->setTipoRequisito(13);
                    $registrar[] = $plano;
                    //Si se subió un archivo, se actualiza
                    if (isset($_FILES['planoCatastro']) && $_FILES['planoCatastro']['error'] === UPLOAD_ERR_OK) {
                        $rutaDestino = './repo/';
                        $urlArchivo = $rutaDestino.basename($_FILES['planoCatastro']['name']);
                        if (!is_writable('./repo/')) {
                            $this->LlamarVistaIngresar('El directorio no tiene permisos de escritura, comuníquese con el profesional de TI');
                        }                
                        if (!is_dir($rutaDestino)) {
                            mkdir($rutaDestino, 0777, true);
                        }
                        if (move_uploaded_file($_FILES['planoCatastro']['tmp_name'], $urlArchivo)) {
                            //archivo adjunto
                            $adjunto = new DetalleSolicitud();
                            $adjunto->setId($_POST['idPlanoCatastro']);
                            $adjunto->setCumple(1);
                            $adjunto->setCampoRequisito($urlArchivo);
                            $adjunto->setIdSolicitud($idSolicitud);
                            $adjunto->setTipoRequisito(16);
                            $registrar[] = $adjunto;
                        } else {
                            $this->LlamarVistaIngresar('Ha habido un error con la subida de los datos, si el problema persiste, comuniquese con el profesional de TI');
                        }
                    }
                    //motivo
                    $motivoUso = new DetalleSolicitud();
                    $motivoUso->setId($_POST['idMotivoUso']);
                    $motivoUso->setCumple(1);
                    $motivoUso->setCampoRequisito($_POST['motivoUso']);
                    $motivoUso->setIdSolicitud($idSolicitud);
                    $motivoUso->setTipoRequisito(14);
                    $registrar[] = $motivoUso;
                    //uso solicitado
                    $usoSolicitado = new DetalleSolicitud();
                    $usoSolicitado->setId($_POST['idUsoSolicitado']);
                    $usoSolicitado->setCumple(1);
                    $usoSolicitado->setCampoRequisito($_POST['usoSolicitado']);
                    $usoSolicitado->setIdSolicitud($idSolicitud);
                    $usoSolicitado->setTipoRequisito(15);
                    $registrar[] = $usoSolicitado;
                    //digital
                    $digital = new DetalleSolicitud();
                    $digital->setId($_POST['idDigital']);
                    $digital->setCumple(1);
                    $digital->setCampoRequisito($_POST['digital']);
                    $digital->setIdSolicitud($idSolicitud);
                    $digital->setTipoRequisito(17);
                    $registrar[] = $digital;
                    if ($solicitudM->ActualizarDetallesSolicitud($registrar)){
                        header('location: index.php?controlador=Tramites&metodo=UsoSuelo');
                    } else {
                        $this->LlamarVistaIngresar('Ha habido un error con la subida de los datos, si el problema persiste, comuniquese con el profesional de TI');        
                    }
                } else {
                    $this->LlamarVistaIngresar('Ha habido un error con la subida de los datos, si el problema persiste, comuniquese con el profesional de TI');        
                }
            } else { 
                $this->LlamarVistaIngresar('Debe llenar todos los datos marcados con asterisco (*)');  
            }
        } 
    }
}