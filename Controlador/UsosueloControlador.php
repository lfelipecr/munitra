<?php 
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Metodos/SolicitudM.php';
require_once './Modelo/Metodos/ProvinciaM.php';
require_once './Modelo/Metodos/PersonaM.php';
require_once './Modelo/Entidades/DetalleSolicitud.php';

class UsosueloControlador {
    private function LlamarVistaActualizar($msg, $id){
        if ($_SESSION['usuario']->getIdDepartamento() == 1){
            $solicitudM = new SolicitudM();
            $provinciaM = new ProvinciaM();
            $idUsuario = $_SESSION['usuario']->getIdPersona();
            $jsonData = $solicitudM->BuscarDetallesSolicitud($id);
            $solicitud = $solicitudM->BuscarCabeceraSolicitud($id);
            $distritos = $provinciaM->BuscarDistritos();
            $vista = './Vista/TramitesUsuario/UsoSuelo/actualizar.php';
            require_once './Vista/Utilidades/navbar.php';
        } else {
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
    }
    function VActualizar(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            $id = $_GET['id'];
            $this->LlamarVistaActualizar('', $id);
        }
    }
    private function LlamarVistaIngresar($msg){
        if ($_SESSION['usuario']->getIdDepartamento() == 1){
            $id = $_SESSION['usuario']->getIdPersona();
            $provinciaM = new ProvinciaM();
            $distritos = $provinciaM->BuscarDistritos();
            $vista = './Vista/TramitesUsuario/UsoSuelo/nuevo.php';
            require_once './Vista/Utilidades/navbar.php';
        } else {
            $personaM = new PersonaM();
            $provinciaM = new ProvinciaM();
            $personas = $personaM->ListadoPersonas();
            $distritos = $provinciaM->BuscarDistritos();
            $vista = './Vista/Dashboard/Tramites/UsoSuelo/nuevo.php';
            require_once './Vista/Utilidades/sidebar.php';
        }
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
                            //variables del POST 
                            $post = ['distrito', 'direccionPropiedad', 'finca', 'plano', 'motivoUso', 'usoSolicitado', 'adjunto', 'digital'];
                            $contador = 10;
                            for ($i = 0; $i < 8; $i++){
                                if ($contador == 16){
                                    $adjunto = new DetalleSolicitud();
                                    $adjunto->setCumple(1);
                                    $adjunto->setCampoRequisito($urlArchivo);
                                    $adjunto->setIdSolicitud($idSolicitud);
                                    $adjunto->setTipoRequisito($contador);
                                    $registrar[] = $adjunto;
                                } else {
                                    $detalle = new DetalleSolicitud();
                                    $detalle->setCumple(1);
                                    $detalle->setCampoRequisito($_POST[$post[$i]]);
                                    $detalle->setIdSolicitud($idSolicitud);
                                    $detalle->setTipoRequisito($contador);
                                    $registrar[] = $detalle;
                                }
                                $contador++;
                            }
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
                    //variables del POST 
                    $post = ['distrito', 'direccionPropiedad', 'finca', 'plano', 'motivoUso', 'usoSolicitado', 'adjunto', 'digital'];
                    $ids = ['idDistrito', 'idDireccionPropiedad', 'idFinca', 'idPlano', 'idMotivoUso', 'idUsoSolicitado', 'idPlanoCatastro', 'idDigital'];
                    $contador = 10;
                    for($i = 0; $i < 8; $i++){
                        if ($contador == 16){
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
                                    $adjunto->setTipoRequisito($contador);
                                    $registrar[] = $adjunto;
                                } else {
                                    $this->LlamarVistaIngresar('Ha habido un error con la subida de los datos, si el problema persiste, comuniquese con el profesional de TI');
                                }
                            }
                        } else {
                            $detalle = new DetalleSolicitud();
                            $detalle->setId($_POST[$ids[$i]]);
                            $detalle->setCumple(1);
                            $detalle->setCampoRequisito($_POST[$post[$i]]);
                            $detalle->setIdSolicitud($idSolicitud);
                            $detalle->setTipoRequisito($contador);
                            $registrar[] = $detalle;
                        }
                    }
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