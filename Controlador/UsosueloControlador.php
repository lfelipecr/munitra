<?php
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Metodos/SolicitudM.php';
require_once './Modelo/Metodos/ProvinciaM.php';
require_once './Modelo/Metodos/PersonaM.php';
require_once './Modelo/Entidades/DetalleSolicitud.php';

class UsosueloControlador
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
        require_once './Vista/Dashboard/Tramites/UsoSuelo/impresion.php';
    }
    private function LlamarVistaActualizar($msg, $id)
    {
        if ($_SESSION['usuario']->getIdDepartamento() == 1) {
            $personaM = new PersonaM();
            $solicitudM = new SolicitudM();
            $provinciaM = new ProvinciaM();
            $idUsuario = $_SESSION['usuario']->getIdPersona();
            $jsonData = $solicitudM->BuscarDetallesSolicitud($id);
            $solicitud = $solicitudM->BuscarCabeceraSolicitud($id);
            $distritos = $provinciaM->BuscarDistritos();
            $persona = $personaM->BuscarPersona($solicitud->getIdPersona());
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
    function VActualizar()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $id = $_GET['id'];
            $this->LlamarVistaActualizar('', $id);
        }
    }
    private function LlamarVistaIngresar($msg)
    {
        if ($_SESSION['usuario']->getIdDepartamento() == 1) {
            $id = $_SESSION['usuario']->getIdPersona();
            $provinciaM = new ProvinciaM();
            $personaM = new PersonaM();
            $identificacion = $personaM->BuscarPersona($id)->getIdentificacion();
            $arrLocaciones = $provinciaM->BuscarLocaciones();
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
    function VIngresar()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $this->LlamarVistaIngresar('');
        }
    }
    function Ingresar()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            if (
                isset($_POST['direccionPropiedad']) &&
                isset($_POST['finca']) && isset($_POST['plano']) &&
                isset($_POST['usoSolicitado'])
            ) {
                if (isset($_FILES['planoCatastro']) && $_FILES['planoCatastro']['error'] === UPLOAD_ERR_OK) {
                    $rutaDestino = './repo/';
                    $urlArchivo = $rutaDestino . time() . basename($_FILES['planoCatastro']['name']);
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
                            //variables del POST 
                            $post = ['distrito', 'direccionPropiedad', 'finca', 'plano', 'motivoUso', 'usoSolicitado', 'planoCatastro', 'digital'];
                            $contador = 10;
                            for ($i = 0; $i < 8; $i++) {
                                if ($contador == 16) {
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
                            if ($solicitudM->IngresarDetalles($registrar)) {
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
    function Actualizar()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            if (
                isset($_POST['direccionPropiedad']) &&
                isset($_POST['finca']) && isset($_POST['plano']) &&
                isset($_POST['usoSolicitado'])
            ) {
                //Cabecera solicitud
                $solicitudM = new SolicitudM();
                $solicitud = new Solicitud();
                $idSolicitud = $_POST['idSolicitud'];
                session_start();
                $solicitud->setId($idSolicitud);
                $solicitud->setIdUsuario($_SESSION['usuario']->getId());
                $solicitud->setTipoSolicitud(2);
                $solicitud->setEstadoSolicitud($_POST['estadoSolicitud']);
                if ($solicitudM->ActualizarCabeceraSolicitud($solicitud)) {
                    $registrar = array();
                    //variables del POST 
                    $post = ['distrito', 'direccionPropiedad', 'finca', 'plano', 'motivoUso', 'usoSolicitado', 'planoCatastro', 'digital'];
                    $ids = ['idDistrito', 'idDireccionPropiedad', 'idFinca', 'idPlano', 'idMotivoUso', 'idUsoSolicitado', 'idPlanoCatastro', 'idDigital'];
                    $contador = 10;
                    for ($i = 0; $i < 8; $i++) {
                        if ($contador == 16) {
                            if (isset($_FILES['planoCatastro']) && $_FILES['planoCatastro']['error'] === UPLOAD_ERR_OK) {
                                $rutaDestino = './repo/';
                                $urlArchivo = $rutaDestino . time() . basename($_FILES['planoCatastro']['name']);
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
                                    $this->LlamarVistaActualizar('Ha habido un error con la subida de los datos, si el problema persiste, comuniquese con el profesional de TI', $idSolicitud);
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
                        $contador++;
                    }
                    if ($solicitudM->ActualizarDetallesSolicitud($registrar)) {
                        header('location: index.php?controlador=Tramites&metodo=UsoSuelo');
                    } else {
                        $this->LlamarVistaActualizar('Ha habido un error con la subida de los datos, si el problema persiste, comuniquese con el profesional de TI', $idSolicitud);
                    }
                } else {
                    $this->LlamarVistaActualizar('Ha habido un error con la subida de los datos, si el problema persiste, comuniquese con el profesional de TI', $idSolicitud);
                }
            } else {
                $this->LlamarVistaActualizar('Debe llenar todos los datos marcados con asterisco (*)', $_POST['idSolicitud']);
            }
        }
    }
}
