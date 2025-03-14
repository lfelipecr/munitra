<?php
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Metodos/SolicitudM.php';
require_once './Modelo/Metodos/ProvinciaM.php';
require_once './Modelo/Metodos/PersonaM.php';
require_once './Modelo/Entidades/DetalleSolicitud.php';

class VisadoControlador
{
    function Imprimir()
    {
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
        $tiposId = [
            'n/a',
            'Cédula de Identidad',
            'Pasaporte',
            'Cédula de Residencia',
            'Número Interno',
            'Número asegurado',
            'DIMEX',
            'NITE',
            'DIDI'
        ];
        $locaciones = $provinciaM->LocacionesId($persona->getIdProvincia(), $persona->getIdCanton(), $persona->getIdDistrito());
        require_once './Vista/Dashboard/Tramites/Visado/impresion.php';
    }
    private function LlamarVistaActualizar($msg, $id)
    {
        if ($_SESSION['usuario']->getIdDepartamento() == 1) {
            $personaM = new PersonaM();
            $solicitudM = new SolicitudM();
            $provinciaM = new ProvinciaM();
            $jsonData = $solicitudM->BuscarDetallesSolicitud($id);
            $solicitud = $solicitudM->BuscarCabeceraSolicitud($id);
            $id = $_SESSION['usuario']->getIdPersona();
            $arrLocaciones  = $provinciaM->BuscarLocaciones();
            $distritos = $provinciaM->BuscarDistritos();
            $persona = $personaM->BuscarPersona($solicitud->getIdPersona());
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
    private function LlamarVistaIngresar($msg)
    {
        if ($_SESSION['usuario']->getIdDepartamento() == 1) {
            $provinciaM = new ProvinciaM();
            $id = $_SESSION['usuario']->getIdPersona();
            $personaM = new PersonaM();
            $identificacion = $personaM->BuscarPersona($id)->getIdentificacion();
            $distritos = $provinciaM->BuscarDistritos();
            $arrLocaciones  = $provinciaM->BuscarLocaciones();
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
    function VIngresar()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $this->LlamarVistaIngresar('');
        }
    }
    function VActualizar()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $this->LlamarVistaActualizar('', $_GET['id']);
        }
    }
    function Actualizar()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $solicitudM = new SolicitudM();
            $solicitud = new Solicitud();
            session_start();
            $idSolicitud = $_POST['idSolicitud'];
            $solicitud->setId($idSolicitud);
            $solicitud->setIdUsuario($_SESSION['usuario']->getId());
            $solicitud->setTipoSolicitud(3);
            $solicitud->setEstadoSolicitud($_POST['estadoSolicitud']);
            $solicitud->setIdPersona($_POST['persona']);
            if ($solicitudM->ActualizarCabeceraSolicitud($solicitud)) {
                $registrar = array();
                //datos de inputs
                //variables del POST
                $post = ['direccionPropiedad', 'distrito', 'numeroPlano', 'areaPlano', 'numeroFinca', 'areaRegistroPublico', 'frente', 'numeroContrato'];
                $postIds = ['idDireccionPropiedad', 'idDistrito', 'idNumeroPlano', 'idAreaPlano', 'idNumeroFinca', 'idAreaRegistroPublico', 'idFrente', 'idNumeroContrato'];
                $tipoRequisito = 18;
                for ($i = 0; $i < count($post); $i++) {
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
                } else {
                    if (!is_dir($rutaDestino)) {
                        mkdir($rutaDestino, 0777, true);
                    }
                    $post = ['flCartaDisponibilidad', 'flCroquis', 'flPlanoCorregido', 'flMinuta', 'flCartaMOPT', 'flImagenMinuta'];
                    $postIds = ['idCartaDisponibilidad', 'idCroquis', 'idPlanoCorregido', 'idMinuta', 'idCartaMOPT'];
                    $tipoRequisito = 26;
                    //carta de disponibilidad
                    for ($i = 0; $i < count($post); $i++) {
                        if (isset($_FILES[$post[$i]]) && $_FILES[$post[$i]]['error'] === UPLOAD_ERR_OK) {
                            $urlArchivo = $rutaDestino . time() . basename($_FILES[$post[$i]]['name']);
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
                }
                if ($solicitudM->ActualizarDetallesSolicitud($registrar)) {
                    header('location: index.php?controlador=Tramites&metodo=Visado');
                } else {
                    $this->Actualizar('Ha habido un error con la subida de los datos, si el problema persiste, comuniquese con el profesional de TI', $idSolicitud);
                }
            }
        }
    }
    function Ingresar()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            //arreglo a mandar a BD 
            $registrar = array();
            //Variable verifica que todos los archivos sean correctos
            $validacionArchivos = true;
            //Archivos
            $rutaDestino = './repo/';
            if (!is_writable('./repo/')) {
                $this->LlamarVistaIngresar('El directorio no tiene permisos de escritura, comuníquese con el profesional de TI');
                $validacionArchivos = true;
            } else {
                if (!is_dir($rutaDestino)) {
                    mkdir($rutaDestino, 0777, true);
                }
                //variables de $_FILES
                $filePost = ['flCartaDisponibilidad', 'flCroquis', 'flPlanoCorregido', 'flMinuta', 'flCartaMOPT', 'flImagenMinuta'];
                $tipoRequisito = 26;
                for ($i = 0; $i < 6; $i++) {
                    if (isset($_FILES[$filePost[$i]]) && $_FILES[$filePost[$i]]['error'] === UPLOAD_ERR_OK) {
                        $urlArchivo = $rutaDestino . time() . basename($_FILES[$filePost[$i]]['name']);
                        if (move_uploaded_file($_FILES[$filePost[$i]]['tmp_name'], $urlArchivo)) {
                            $adjunto = new DetalleSolicitud();
                            $adjunto->setCumple(1);
                            $adjunto->setCampoRequisito($urlArchivo);
                            $adjunto->setTipoRequisito($tipoRequisito);
                            $registrar[] = $adjunto;
                            $tipoRequisito++;
                        }
                    }
                }
            }
            $solicitudM = new SolicitudM();
            $solicitud = new Solicitud();
            session_start();
            $solicitud->setIdUsuario($_SESSION['usuario']->getId());
            $solicitud->setTipoSolicitud(3);
            $solicitud->setEstadoSolicitud($_POST['estadoSolicitud']);
            //si un administrador ingresa la persona, manda el id
            //si un usuario externo lo hace, busca los datos de la persona
            if (isset($_POST['persona'])) {
                $solicitud->setIdPersona($_POST['persona']);
            } else {
                $cedula = $_POST['identificacion'];
                $personaM = new PersonaM();
                //busca una cedula coincidente y la asigna, si no la encuentra, crea a la persona
                $persona = $personaM->BuscarPersonaCedula($cedula);
                if ($persona != null) {
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
                    $persona->setIdDistrito($_POST['distrito']);
                    $persona->setUsuarioCreacion($_SESSION['usuario']->getId());
                    $idUsuario = $personaM->IngresarPersona($persona);
                    $solicitud->setIdPersona($idUsuario);
                }
            }
            $idSolicitud = $solicitudM->IngresarSolicitud($solicitud);
            //Valida que la solicitud se haya ingresado
            if ($idSolicitud != 0) {
                //Agrega los id de solicitud
                for ($i = 0; $i < count($registrar); $i++) {
                    $registrar[$i]->setIdSolicitud($idSolicitud);
                }
                //datos de inputs
                //variables del POST
                $post = ['direccionPropiedad', 'distrito', 'numeroPlano', 'areaPlano', 'numeroFinca', 'areaRegistroPublico', 'frente', 'numeroContrato'];
                $tipoRequisito = 18;
                for ($i = 0; $i < 8; $i++) {
                    $detalle = new DetalleSolicitud();
                    $detalle->setCumple(1);
                    $detalle->setCampoRequisito($_POST[$post[$i]]);
                    $detalle->setIdSolicitud($idSolicitud);
                    $detalle->setTipoRequisito($tipoRequisito);
                    $registrar[] = $detalle;
                    $tipoRequisito++;
                }
                if ($solicitudM->IngresarDetalles($registrar)) {
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
