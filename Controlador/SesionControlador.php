<?php 
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Entidades/Sesion.php';
require_once './Modelo/Entidades/PersonaSesion.php';
require_once './Modelo/Metodos/SesionM.php';
require_once './Modelo/Metodos/PersonaM.php';

class SesionControlador{
    function VIngresar(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            $personaM = new PersonaM();
            $msg = '';
            $vista = './Vista/Dashboard/Blog/Sesiones/nuevo.php';
            require_once './Vista/Utilidades/sidebar.php';
        }
    }
    function Ingresar(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            if (isset($_POST['descripcion']) && isset($_POST['fechaSesion'])){
                $sesion = new Sesion();
                $sesion->setDescripcion($_POST['descripcion']);
                $sesion->setFecha(str_replace('T', ' ', $_POST['fechaSesion']));                
                $sesion->setUrlVideo($_POST['urlVideo']);
                $rutaDestino = './repo/';
                //Archivo de acta
                if (isset($_FILES['acta']) && $_FILES['acta']['error'] === UPLOAD_ERR_OK) {
                    $sesion->setActaAprobada(1);
                    $urlArchivo = $rutaDestino.basename($_FILES['acta']['name']);
                    if (!is_writable($rutaDestino)) {
                        $msg = 'El directorio no tiene permisos de escritura, comuníquese con el profesional de TI';
                        $vista = './Vista/Dashboard/Blog/Sesiones/nuevo.php';
                        require_once './Vista/Utilidades/sidebar.php';
                    }                
                    if (!is_dir($rutaDestino)) {
                        mkdir($rutaDestino, 0777, true);
                    }
                    if (move_uploaded_file($_FILES['acta']['tmp_name'], $urlArchivo)) {
                        $sesion->setUrlActa($urlArchivo);
                    } else {
                        $msg = 'Ha habido un error con la subida del archivo, intente con otro archivo';
                        $vista = './Vista/Dashboard/Blog/Sesiones/nuevo.php';
                        require_once './Vista/Utilidades/sidebar.php';
                    }
                } else {
                    $sesion->setActaAprobada(0);
                }
                //Archivo de agenda
                if (isset($_FILES['agenda']) && $_FILES['agenda']['error'] === UPLOAD_ERR_OK) {
                    $urlArchivo = $rutaDestino.basename($_FILES['agenda']['name']);
                    if (!is_writable($rutaDestino)) {
                        $msg = 'El directorio no tiene permisos de escritura, comuníquese con el profesional de TI';
                        $vista = './Vista/Dashboard/Blog/Sesiones/nuevo.php';
                        require_once './Vista/Utilidades/sidebar.php';
                    }                
                    if (!is_dir($rutaDestino)) {
                        mkdir($rutaDestino, 0777, true);
                    }
                    if (move_uploaded_file($_FILES['agenda']['tmp_name'], $urlArchivo)) {
                        $sesion->setUrlAgenda($urlArchivo);
                    } else {
                        $msg = 'Ha habido un error con la subida del archivo, intente con otro archivo';
                        $vista = './Vista/Dashboard/Blog/Sesiones/nuevo.php';
                        require_once './Vista/Utilidades/sidebar.php';
                    }
                }
                $sesionM = new SesionM();
                if ($sesionM->IngresarSesion($sesion)){
                    header('location: index.php?controlador=Blog&metodo=Sesiones');
                } else {
                    $msg = 'Ha habido un error con los datos de la sesión, intente de nuevo';
                    $vista = './Vista/Dashboard/Blog/Sesiones/nuevo.php';
                    require_once './Vista/Utilidades/sidebar.php';
                }
            } else {
                $msg = 'Debe proporcionar todos los datos marcados con asterisco (*)';
                $vista = './Vista/Dashboard/Blog/Seseiones/nuevo.php';
                require_once './Vista/Utilidades/sidebar.php';
            }            
        }        
    }
    function VActualizar(){
        $id = $_GET['id'];
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            $sesionM = new SesionM();
            $sesion = $sesionM->BuscarSesion($id);
            $fecha = $sesion->getFecha();
            $sesion->setFecha(str_replace(' ', 'T', $fecha));
            $msg = '';
            $vista = './Vista/Dashboard/Blog/Sesiones/actualizar.php';
            require_once './Vista/Utilidades/sidebar.php';           
        }
    }
    function Actualizar(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            if (isset($_POST['descripcion']) && isset($_POST['fechaSesion'])){
                $sesion = new Sesion();
                $sesion->setId($_POST['id']);
                $sesion->setDescripcion($_POST['descripcion']);
                $sesion->setFecha(str_replace('T', ' ', $_POST['fechaSesion']));
                $sesion->setActaAprobada($_POST['valorActa']);
                $sesion->setUrlVideo($_POST['urlVideo']);
                $rutaDestino = './repo/';
                //Archivo de acta
                if (isset($_FILES['acta']) && $_FILES['acta']['error'] === UPLOAD_ERR_OK) {
                    $sesion->setActaAprobada(1);
                    $urlArchivo = $rutaDestino.basename($_FILES['acta']['name']);
                    if (!is_writable($rutaDestino)) {
                        $msg = 'El directorio no tiene permisos de escritura, comuníquese con el profesional de TI';
                        $vista = './Vista/Dashboard/Blog/Sesiones/actualizar.php';
                        require_once './Vista/Utilidades/sidebar.php';
                    }                
                    if (!is_dir($rutaDestino)) {
                        mkdir($rutaDestino, 0777, true);
                    }
                    if (move_uploaded_file($_FILES['acta']['tmp_name'], $urlArchivo)) {
                        $sesion->setUrlActa($urlArchivo);
                    } else {
                        $msg = 'Ha habido un error con la subida del archivo, intente con otro archivo';
                        $vista = './Vista/Dashboard/Blog/Sesiones/actualizar.php';
                        require_once './Vista/Utilidades/sidebar.php';
                    }
                } else {
                    $sesion->setActaAprobada(0);
                }
                //Archivo de agenda
                if (isset($_FILES['agenda']) && $_FILES['agenda']['error'] === UPLOAD_ERR_OK) {
                    $urlArchivo = $rutaDestino.basename($_FILES['agenda']['name']);
                    if (!is_writable($rutaDestino)) {
                        $msg = 'El directorio no tiene permisos de escritura, comuníquese con el profesional de TI';
                        $vista = './Vista/Dashboard/Blog/Sesiones/actualizar.php';
                        require_once './Vista/Utilidades/sidebar.php';
                    }                
                    if (!is_dir($rutaDestino)) {
                        mkdir($rutaDestino, 0777, true);
                    }
                    if (move_uploaded_file($_FILES['agenda']['tmp_name'], $urlArchivo)) {
                        $sesion->setUrlAgenda($urlArchivo);
                    } else {
                        $msg = 'Ha habido un error con la subida del archivo, intente con otro archivo';
                        $vista = './Vista/Dashboard/Blog/Sesiones/actualizar.php';
                        require_once './Vista/Utilidades/sidebar.php';
                    }
                }
                $sesionM = new SesionM();
                if ($sesionM->ActualizarSesion($sesion)){
                    header('location: index.php?controlador=Blog&metodo=Sesiones');
                } else {
                    $msg = 'Ha habido un error con los datos de la sesión, intente con otro archivo';
                    $vista = './Vista/Dashboard/Blog/Sesiones/actualizar.php';
                    //require_once './Vista/Utilidades/sidebar.php';
                }
            } else {
                $msg = 'Debe proporcionar todos los datos marcados con asterisco (*)';
                $vista = './Vista/Dashboard/Blog/Seseiones/actualizar.php';
                require_once './Vista/Utilidades/sidebar.php';
            }            
        }
    }
}