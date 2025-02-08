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
            $persona = $personaM->BuscarPersona($solicitud->getIdPersona());
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
            $provinciaM = new ProvinciaM();
            $id = $_SESSION['usuario']->getIdPersona();
            $arrLocaciones  = $provinciaM->BuscarLocaciones();
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
                $adjuntos = array();
                $archivo = false;
                $rutaDestino = './repo/';
                foreach($_FILES['requisitos']['tmp_name'] as $adjunto => $tmp_name){
                    $archivo = true;
                    $urlArchivo = $rutaDestino.basename($_FILES['requisitos']['name'][$adjunto]);
                    if (move_uploaded_file($tmp_name, $urlArchivo)) {
                        $adjuntos[] = $urlArchivo;
                    } else {
                        $msg = 'Ha habido un error con la subida del archivo'.$_FILES['requisitos']['name'][$adjunto].', intente con otro archivo';
                        $this->LlamarVistaIngresar($msg);
                        $archivo = false;
                        break;
                    }
                }
                if ($archivo){
                    //Si todos los datos están correctos, guarda la solicitud y obtiene el id
                    $solicitudM = new SolicitudM();
                    $solicitud = new Solicitud();
                    session_start();
                    $solicitud->setIdUsuario($_SESSION['usuario']->getId());
                    $solicitud->setTipoSolicitud(1);
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
                        var_dump($persona);
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
                    //Si el id es válido, genera un arreglo con los detalles
                    if ($idSolicitud != 0) {
                        $registrar = array();
                        //archivo adjunto
                        $adjunto = new DetalleSolicitud();
                        $adjunto->setCumple(1);
                        $adjunto->setCampoRequisito(json_encode($adjuntos));
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
                    //archivos adjuntos
                    $rutaDestino = './repo/';
                    $archivos = false;
                    if (!empty($_FILES['requisitos']['name'][0])){
                        $archivos = true;
                        $adjuntos = array();
                        foreach($_FILES['requisitos']['tmp_name'] as $adjunto => $tmp_name){
                            $urlArchivo = $rutaDestino.basename($_FILES['requisitos']['name'][$adjunto]);
                            if (move_uploaded_file($tmp_name, $urlArchivo)) {
                                $archivos = true;
                                $adjuntos[] = $urlArchivo;
                            } else {
                                $archivos = false;
                                $this->LlamarVistaActualizar('Ha habido un error con la subida del archivo'.$_FILES['adjuntos']['name'][$adjunto].', intente con otro archivo', $_POST['idSolicitud']);
                                break;
                            }
                        }
                    }
                    if ($archivos){
                        $adjunto = new DetalleSolicitud();
                        $adjunto->setCumple(1);
                        $adjunto->setId($_POST['idAdjuntos']);
                        $adjunto->setTipoRequisito(1);
                        $adjunto->setCampoRequisito($urlArchivo);
                        $registrar[] = $adjunto;
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