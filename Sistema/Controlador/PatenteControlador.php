<?php 
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Metodos/SolicitudM.php';
require_once './Modelo/Metodos/ProvinciaM.php';
require_once './Modelo/Metodos/PersonaM.php';
require_once './Modelo/Entidades/DetalleSolicitud.php';

class PatenteControlador {
    private function LlamarVistaActualizar($msg, $id){
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
    private function LlamarVistaIngresar($msg){
        $personaM = new PersonaM();
        $provinciaM = new ProvinciaM();
        $personas = $personaM->ListadoPersonas();
        $distritos = $provinciaM->BuscarDistritos();
        $vista = './Vista/Dashboard/Tramites/Patentes/nuevo.php';
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
            if (isset($_POST['usoPatente']) && isset($_POST['nombreFantasia']) &&
            isset($_POST['actividadComercial']) && isset($_POST['direccionExacta']) &&
            isset($_POST['area']) && isset($_POST['dimensiones'])){
                if (isset($_FILES['requisitos']) && $_FILES['requisitos']['error'] === UPLOAD_ERR_OK) {
                    $rutaDestino = './repo/';
                    $urlArchivo = $rutaDestino.basename($_FILES['requisitos']['name']);
                    if (!is_writable('./repo/')) {
                        $this->LlamarVistaIngresar('El directorio no tiene permisos de escritura, comuníquese con el profesional de TI');
                    }                
                    if (!is_dir($rutaDestino)) {
                        mkdir($rutaDestino, 0777, true);
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
                            //uso de patente
                            $usoPatente = new DetalleSolicitud();
                            $usoPatente->setCumple(1);
                            $usoPatente->setCampoRequisito($_POST['usoPatente']);
                            $usoPatente->setIdSolicitud($idSolicitud);
                            $usoPatente->setTipoRequisito(2);
                            $registrar[] = $usoPatente;
                            //nombre de fantasia
                            $nombreFantasia = new DetalleSolicitud();
                            $nombreFantasia->setCumple(1);
                            $nombreFantasia->setCampoRequisito($_POST['nombreFantasia']);
                            $nombreFantasia->setIdSolicitud($idSolicitud);
                            $nombreFantasia->setTipoRequisito(3);
                            $registrar[] = $nombreFantasia;
                            //actividad comercial
                            $actividadComercial = new DetalleSolicitud();
                            $actividadComercial->setCumple(1);
                            $actividadComercial->setCampoRequisito($_POST['actividadComercial']);
                            $actividadComercial->setIdSolicitud($idSolicitud);
                            $actividadComercial->setTipoRequisito(4);
                            $registrar[] = $actividadComercial;
                            //uso de suelo
                            $numeroUsoSuelo = new DetalleSolicitud();
                            $numeroUsoSuelo->setCumple(1);
                            $numeroUsoSuelo->setCampoRequisito($_POST['numeroUsoSuelo']);
                            $numeroUsoSuelo->setIdSolicitud($idSolicitud);
                            $numeroUsoSuelo->setTipoRequisito(5);
                            $registrar[] = $numeroUsoSuelo;
                            //distrito
                            $distrito = new DetalleSolicitud();
                            $distrito->setCumple(1);
                            $distrito->setCampoRequisito($_POST['distrito']);
                            $distrito->setIdSolicitud($idSolicitud);
                            $distrito->setTipoRequisito(6);
                            $registrar[] = $distrito;
                            //direccion exacta del local
                            $direccionExacta = new DetalleSolicitud();
                            $direccionExacta->setCumple(1);
                            $direccionExacta->setCampoRequisito($_POST['direccionExacta']);
                            $direccionExacta->setIdSolicitud($idSolicitud);
                            $direccionExacta->setTipoRequisito(7);
                            $registrar[] = $direccionExacta;
                            //area
                            $area = new DetalleSolicitud();
                            $area->setCumple(1);
                            $area->setCampoRequisito($_POST['area']);
                            $area->setIdSolicitud($idSolicitud);
                            $area->setTipoRequisito(8);
                            $registrar[] = $area;
                            //dimensiones
                            $dimensiones = new DetalleSolicitud();
                            $dimensiones->setCumple(1);
                            $dimensiones->setCampoRequisito($_POST['dimensiones']);
                            $dimensiones->setIdSolicitud($idSolicitud);
                            $dimensiones->setTipoRequisito(9);
                            $registrar[] = $dimensiones;
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
                    //uso de patente
                    $usoPatente = new DetalleSolicitud();
                    $usoPatente->setId($_POST['idUsoPatentes']);
                    $usoPatente->setCumple(1);
                    $usoPatente->setCampoRequisito($_POST['usoPatente']);
                    $usoPatente->setTipoRequisito(2);
                    $registrar[] = $usoPatente;
                    //nombre de fantasia
                    $nombreFantasia = new DetalleSolicitud();
                    $nombreFantasia->setId($_POST['idNombreFantasia']);
                    $nombreFantasia->setCumple(1);
                    $nombreFantasia->setCampoRequisito($_POST['nombreFantasia']);
                    $nombreFantasia->setTipoRequisito(3);
                    $registrar[] = $nombreFantasia;
                    //actividad comercial
                    $actividadComercial = new DetalleSolicitud();
                    $actividadComercial->setId($_POST['idActividadComercial']);
                    $actividadComercial->setCumple(1);
                    $actividadComercial->setCampoRequisito($_POST['actividadComercial']);
                    $actividadComercial->setTipoRequisito(4);
                    $registrar[] = $actividadComercial;
                    //uso de suelo
                    $numeroUsoSuelo = new DetalleSolicitud();
                    $numeroUsoSuelo->setId($_POST['idNumeroUsoSuelo']);
                    $numeroUsoSuelo->setCumple(1);
                    $numeroUsoSuelo->setCampoRequisito($_POST['numeroUsoSuelo']);
                    $numeroUsoSuelo->setTipoRequisito(5);
                    $registrar[] = $numeroUsoSuelo;
                    //distrito
                    $distrito = new DetalleSolicitud();
                    $distrito->setId($_POST['idDistrito']);
                    $distrito->setCumple(1);
                    $distrito->setCampoRequisito($_POST['distrito']);
                    $distrito->setTipoRequisito(6);
                    $registrar[] = $distrito;
                    //direccion exacta del local
                    $direccionExacta = new DetalleSolicitud();
                    $direccionExacta->setId($_POST['idDireccionExacta']);
                    $direccionExacta->setCumple(1);
                    $direccionExacta->setCampoRequisito($_POST['direccionExacta']);
                    $direccionExacta->setTipoRequisito(7);
                    $registrar[] = $direccionExacta;
                    //area
                    $area = new DetalleSolicitud();
                    $area->setId($_POST['idArea']);
                    $area->setCumple(1);
                    $area->setCampoRequisito($_POST['area']);
                    $area->setTipoRequisito(8);
                    $registrar[] = $area;
                    //dimensiones
                    $dimensiones = new DetalleSolicitud();
                    $dimensiones->setId($_POST['idDimensiones']);
                    $dimensiones->setCumple(1);
                    $dimensiones->setCampoRequisito($_POST['dimensiones']);
                    $dimensiones->setTipoRequisito(9);
                    $registrar[] = $dimensiones;   
                    //Si se envió un archivo, se agrega a la lista de detalles para modificar

                    
                    if ($solicitudM->ActualizarDetallesSolicitud($registrar)){
                        header('location: index.php?controlador=Tramites&metodo=Patentes');
                    } else {
                        echo 'error';
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