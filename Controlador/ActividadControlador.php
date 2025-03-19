<?php
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Entidades/Actividad.php';
require_once './Modelo/Metodos/ActividadM.php';
require_once './Modelo/Metodos/UsuarioM.php';
require_once './Controlador/BlogControlador.php';

class ActividadControlador
{
    function VIngresar()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $msg = '';
            $vista = './Vista/Dashboard/Blog/Actividades/nuevo.php';
            require_once './Vista/Utilidades/sidebar.php';
        }
    }
    function Ingresar()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $rutaDestino = './repo/';
            $adjuntos = array();
            if (!is_writable('./repo/')) {
                $msg = 'El directorio no tiene permisos de escritura, comuníquese con el profesional de TI';
                $vista = './Vista/Dashboard/Blog/Actividades/nuevo.php';
                require_once './Vista/Utilidades/sidebar.php';
            }
            if (!empty($_FILES['adjuntos']['name'][0])) {
                foreach ($_FILES['adjuntos']['tmp_name'] as $adjunto => $tmp_name) {
                    $urlArchivo = $rutaDestino . time() . basename($_FILES['adjuntos']['name'][$adjunto]);
                    if (move_uploaded_file($tmp_name, $urlArchivo)) {
                        $adjuntos[] = $urlArchivo;
                    } else {
                        $msg = 'Ha habido un error con la subida del archivo' . $_FILES['adjuntos']['name'][$adjunto] . ', intente con otro archivo';
                        $vista = './Vista/Dashboard/Blog/Actividades/nuevo.php';
                        require_once './Vista/Utilidades/sidebar.php';
                    }
                }
            }
            session_start();
            $actividad = new Actividad();
            $actividadM = new ActividadM();
            $actividad->setTitulo($_POST['titulo']);
            $actividad->setDescripcionLarga($_POST['descripcionLarga']);
            $actividad->setUrlAdjunto(json_encode($adjuntos));
            $actividad->setIdUsuario($_SESSION['usuario']->getId());
            $actividad->setFecha($_POST['fecha']);
            if ($actividadM->Ingresar($actividad)) {
                header('location: index.php?controlador=Blog&metodo=Actividades');
            } else {
                $msg = 'Ha ocurrido un problema, intente de nuevo';
                $vista = './Vista/Dashboard/Blog/Actividades/nuevo.php';
                require_once './Vista/Utilidades/sidebar.php';
            }
        }
    }
    private function LlamarVistaActualizar($id, $msg)
    {
        $actividadM = new ActividadM();
        $actividad = $actividadM->BuscarActividad($id);
        $msg = '';
        $vista = './Vista/Dashboard/Blog/Actividades/actualizar.php';
        require_once './Vista/Utilidades/sidebar.php';
    }
    function VActualizar()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $actividadM = new ActividadM();
            $this->LlamarVistaActualizar($_GET['id'], '');
        }
    }
    function Actualizar()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $rutaDestino = './repo/';
            $id = $_POST['id'];
            $adjuntos = null;
            if (!is_writable('./repo/')) {
                $this->LlamarVistaActualizar($id, 'El directorio no tiene permisos de escritura, comuníquese con el profesional de TI');
            }

            if (!empty($_FILES['adjuntos']['name'][0])) {
                $adjuntos = array();
                foreach ($_FILES['adjuntos']['tmp_name'] as $adjunto => $tmp_name) {
                    $urlArchivo = $rutaDestino . time() . basename($_FILES['adjuntos']['name'][$adjunto]);
                    if (move_uploaded_file($tmp_name, $urlArchivo)) {
                        $adjuntos[] = $urlArchivo;
                    } else {
                        $this->LlamarVistaActualizar($id, 'Ha habido un error con la subida del archivo' . $_FILES['adjuntos']['name'][$adjunto] . ', intente con otro archivo');
                    }
                }
            }
            session_start();
            $actividad = new Actividad();
            $actividadM = new ActividadM();
            $actividad->setId($id);
            $actividad->setTitulo($_POST['titulo']);
            $actividad->setDescripcionLarga($_POST['descripcionLarga']);
            $actividad->setUrlAdjunto(json_encode($adjuntos));
            $actividad->setIdUsuario($_SESSION['usuario']->getId());
            $actividad->setFecha($_POST['fecha']);
            if ($actividadM->Actualizar($actividad)) {
                $blog = new BlogControlador();
                $blog->Actividades();
            } else {
                $this->LlamarVistaActualizar($id, 'Ha ocurrido un problema, intente de nuevo');
            }
        }
    }
    function Eliminar()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $actividadM = new ActividadM();
            $actividadM->Eliminar($_GET['id']);
            header('location: index.php?controlador=Blog&metodo=Actividades');
        }
    }
}
