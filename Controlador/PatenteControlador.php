<?php 
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Metodos/SolicitudM.php';
require_once './Modelo/Metodos/ProvinciaM.php';
require_once './Modelo/Metodos/PersonaM.php';
require_once './Modelo/Entidades/DetalleSolicitud.php';

class PatenteControlador {
    private function LlamarVistaActualizar($msg, $id){
        if ($_SESSION['usuario']->getIdDepartamento() == 1){
            $solicitudM = new SolicitudM();
            $personaM = new PersonaM();
            $provinciaM = new ProvinciaM();
            $jsonData = $solicitudM->BuscarDetallesSolicitud($id);
            $solicitud = $solicitudM->BuscarCabeceraSolicitud($id);
            $personas = $personaM->ListadoPersonas();
            $distritos = $provinciaM->BuscarDistritos();
            $vista = './Vista/TramitesUsuario/Patentes/actualizar.php';
            require_once './Vista/Utilidades/navbar.php';
        } else {
            $solicitudM = new SolicitudM();
            $personaM = new PersonaM();
            $provinciaM = new ProvinciaM();
            $jsonData = $solicitudM->BuscarDetallesSolicitud($id);
            $solicitud = $solicitudM->BuscarCabeceraSolicitud($id);
            $personas = $personaM->ListadoPersonas();
            $distritos = $provinciaM->BuscarDistritos();
            $vista = './Vista/Dashboard/Tramites/Patentes/actualizar.php';
            require_once './Vista/Utilidades/sidebar.php';
        }
    }
    private function LlamarVistaIngresar($msg){
        if ($_SESSION['usuario']->getIdDepartamento() == 1){
            $id = $_SESSION['usuario']->getIdPersona();
            $provinciaM = new ProvinciaM();
            $distritos = $provinciaM->BuscarDistritos();
            $vista = './Vista/TramitesUsuario/Patentes/nuevo.php';
            require_once './Vista/Utilidades/navbar.php';
        } else {
            $personaM = new PersonaM();
            $provinciaM = new ProvinciaM();
            $personas = $personaM->ListadoPersonas();
            $distritos = $provinciaM->BuscarDistritos();
            $vista = './Vista/Dashboard/Tramites/Patentes/nuevo.php';
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
            if (isset($_POST['usoPatente']) && isset($_POST['nombreFantasia']) &&
            isset($_POST['actividadComercial']) && isset($_POST['direccionExacta']) &&
            isset($_POST['area']) && isset($_POST['dimensiones'])){
                if (isset($_FILES['requisitos']) && $_FILES['requisitos']['error'] === UPLOAD_ERR_OK) {
                    $rutaDestino = './repo/';
                    $urlArchivo = $rutaDestino.basename($_FILES['requisitos']['name']);
                    if (!is_writable('./repo/')) {
                        $this->LlamarVistaIngresar('El directorio no tiene permisos de escritura, comuníquese con el profesional de TI');
                    }                
                    if (move_uploaded_file($_FILES['requisitos']['tmp_name'], $urlArchivo)) {
                        //Si todos los datos están correctos, guarda la solicitud y obtiene el id
                        $solicitudM = new SolicitudM();
                        $solicitud = new Solicitud();
                        session_start();
                        $solicitud->setIdUsuario($_SESSION['usuario']->getId());
                        $solicitud->setTipoSolicitud(1);
                        $solicitud->setEstadoSolicitud($_POST['estadoSolicitud']);
                        $solicitud->setIdPersona($_POST['persona']);
                        $idSolicitud = $solicitudM->IngresarSolicitud($solicitud);
                        //Si el id es válido, genera un arreglo con los detalles
                        if ($idSolicitud != 0) {
                            $registrar = array();
                            //archivo adjunto
                            $adjunto = new DetalleSolicitud();
                            $adjunto->setCumple(1);
                            $adjunto->setCampoRequisito($urlArchivo);
                            $adjunto->setIdSolicitud($idSolicitud);
                            $adjunto->setTipoRequisito(1);
                            $registrar[] = $adjunto;
                            //variables del post
                            $post = ['usoPatente', 'nombreFantasia', 'actividadComercial', 'numeroUsoSuelo',
                            'distrito', 'direccionExacta', 'area', 'dimensiones'];
                            $contador = 2;
                            //objetos
                            for($i = 0; $i < 8; $i++){
                                $detalle = new DetalleSolicitud();
                                $detalle->setCumple(1);
                                $detalle->setIdSolicitud($idSolicitud);
                                $detalle->setTipoRequisito($contador);
                                $detalle->setCampoRequisito($_POST[$post[$i]]);
                                $contador++;
                                $registrar[] = $detalle;
                            }
                            
                            if ($solicitudM->IngresarDetalles($registrar)){
                                header('location: index.php?controlador=Tramites&metodo=Patentes');
                            } else {
                                $solicitudM->EliminarSolicitud($idSolicitud);
                                $this->LlamarVistaIngresar('Ha habido un error con la subida de los datos, si el problema persiste, comuniquese con el profesional de TI');
                            }
                        }
                    } else {
                        $this->LlamarVistaIngresar('Ha habido un error con la subida del archivo, intente con otro archivo');
                    }
                } else {
                    $this->LlamarVistaIngresar('Debe adjuntar el documento de requisitos para solicitud de patente');
                }
            }
        }
    }
    function Actualizar(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            if (isset($_POST['usoPatente']) && isset($_POST['nombreFantasia']) &&
            isset($_POST['actividadComercial']) && isset($_POST['direccionExacta']) &&
            isset($_POST['area']) && isset($_POST['dimensiones'])){
                $solicitudM = new SolicitudM();
                $solicitud = new Solicitud();
                //cabecera solicitud
                $solicitud->setId($_POST['idSolicitud']);
                $solicitud->setEstadoSolicitud($_POST['estadoSolicitud']);
                if ($solicitudM->ActualizarCabeceraSolicitud($solicitud)){
                    //Si la actualización es exitosa, genera un arreglo
                    $registrar = array();
                    //archivo adjunto
                    if (isset($_FILES['requisitos']) && $_FILES['requisitos']['error'] === UPLOAD_ERR_OK) {
                        $rutaDestino = './repo/';
                        $urlArchivo = $rutaDestino.basename($_FILES['requisitos']['name']);
                        if (!is_writable('./repo/')) {
                            $this->LlamarVistaActualizar('El directorio no tiene permisos de escritura, comuníquese con el profesional de TI', $_POST['idSolicitud']);
                        }                
                        if (move_uploaded_file($_FILES['requisitos']['tmp_name'], $urlArchivo)) {
                            $adjunto = new DetalleSolicitud();
                            $adjunto->setCumple(1);
                            $adjunto->setId($_POST['idAdjuntos']);
                            $adjunto->setTipoRequisito(1);
                            $adjunto->setCampoRequisito($urlArchivo);
                            $registrar[] = $adjunto;
                        }                        
                    }
                    //variables del post
                    $post = ['usoPatente', 'nombreFantasia', 'actividadComercial', 'numeroUsoSuelo',
                    'distrito', 'direccionExacta', 'area', 'dimensiones'];
                    $ids = ['idUsoPatentes', 'idNombreFantasia', 'idActividadComercial', 'idNumeroUsoSuelo',
                    'idDistrito', 'idDireccionExacta', 'idArea', 'idDimensiones'];
                    $contador = 2;
                    for($i = 0; $i < 8; $i++){
                        $detalle = new DetalleSolicitud();
                        $detalle->setCumple(1);
                        $detalle->setId($_POST[$ids[$i]]);
                        $detalle->setTipoRequisito($contador);
                        $detalle->setCampoRequisito($_POST[$post[$i]]);
                        $registrar[] = $detalle;
                        $contador++;
                    }
                    //Si se envió un archivo, se agrega a la lista de detalles para modificar
                    if ($solicitudM->ActualizarDetallesSolicitud($registrar)){
                        header('location: index.php?controlador=Tramites&metodo=Patentes');
                    } else {
                        $this->LlamarVistaActualizar('Ha ocurrido un error interno, si el problema persiste, contacte al profesional de TI', $_POST['idSolicitud']);
                    }
                } else {
                    $this->LlamarVistaActualizar('Ha ocurrido un error interno, si el problema persiste, contacte al profesional de TI', $_POST['idSolicitud']);
                }
            }
        }
    }
    function VActualizar(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            $id = $_GET['id'];
            $this->LlamarVistaActualizar('', $id);
        }
    }
}