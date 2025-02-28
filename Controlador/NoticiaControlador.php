<?php
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Entidades/Noticia.php';
require_once './Modelo/Metodos/NoticiaM.php';
require_once './Modelo/Metodos/UsuarioM.php';

class NoticiaControlador
{
    function VIngresar()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $msg = '';
            $vista = './Vista/Dashboard/Blog/Noticias/nuevo.php';
            require_once './Vista/Utilidades/sidebar.php';
        }
    }
    function Eliminar()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $noticiaM = new NoticiaM();
            $noticiaM->Eliminar($_GET['id']);
            header('location: index.php?controlador=Blog&metodo=Noticias');
        }
    }
    function Ingresar()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            if (isset($_POST['titulo']) && isset($_POST['descripcionLarga'])) {
                $noticia = new Noticia();
                session_start();
                if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                    $rutaDestino = './repo/';
                    $urlArchivo = $rutaDestino . time() . basename($_FILES['imagen']['name']);
                    if (!is_writable('./repo/')) {
                        $msg = 'El directorio no tiene permisos de escritura, comuníquese con el profesional de TI';
                        $vista = './Vista/Dashboard/Blog/Noticias/nuevo.php';
                        require_once './Vista/Utilidades/sidebar.php';
                    }
                    if (!is_dir($rutaDestino)) {
                        mkdir($rutaDestino, 0777, true);
                    }
                    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $urlArchivo)) {
                        $noticia->setUrlImagen($urlArchivo);
                    } else {
                        $msg = 'Ha habido un error con la subida del archivo, intente con otro archivo';
                        $vista = './Vista/Dashboard/Blog/Noticias/nuevo.php';
                        require_once './Vista/Utilidades/sidebar.php';
                    }
                }
                if (isset($_FILES['adjunto']) && $_FILES['adjunto']['error'] === UPLOAD_ERR_OK) {
                    $rutaDestino = './repo/';
                    $urlArchivo = $rutaDestino . time() . basename($_FILES['adjunto']['name']);
                    if (!is_writable('./repo/')) {
                        $msg = 'El directorio no tiene permisos de escritura, comuníquese con el profesional de TI';
                        $vista = './Vista/Dashboard/Blog/Noticias/nuevo.php';
                        require_once './Vista/Utilidades/sidebar.php';
                    }
                    if (!is_dir($rutaDestino)) {
                        mkdir($rutaDestino, 0777, true);
                    }
                    if (move_uploaded_file($_FILES['adjunto']['tmp_name'], $urlArchivo)) {
                        $noticia->setUrlAdjunto($urlArchivo);
                    } else {
                        $msg = 'Ha habido un error con la subida del archivo, intente con otro archivo';
                        $vista = './Vista/Dashboard/Blog/Noticias/nuevo.php';
                        require_once './Vista/Utilidades/sidebar.php';
                    }
                }
                $noticia->setIdUsuario($_SESSION['usuario']->getId());
                $noticia->setTitulo(trim($_POST['titulo']));
                $noticia->setDescripcionLarga(trim($_POST['descripcionLarga']));
                $noticia->setFecha($_POST['fecha']);
                $noticiaM = new NoticiaM();
                if ($noticiaM->IngresarNoticia($noticia)) {
                    header('location: index.php?controlador=Blog&metodo=Noticias');
                }
            }
        }
    }
    function VActualizar()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $noticiaM = new NoticiaM();
            $noticia = $noticiaM->BuscarNoticia($_GET['id']);
            $msg = '';
            $vista = './Vista/Dashboard/Blog/Noticias/actualizar.php';
            require_once './Vista/Utilidades/sidebar.php';
        }
    }
    function Actualizar()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            if (isset($_POST['titulo']) && isset($_POST['descripcionLarga'])) {
                $noticiaM = new NoticiaM();
                $noticia = new Noticia();
                $noticia->setId($_POST['id']);
                $noticia->setTitulo(trim($_POST['titulo']));
                $noticia->setDescripcionLarga(trim($_POST['descripcionLarga']));
                $noticia->setFecha($_POST['fecha']);
                if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                    $rutaDestino = './repo/';
                    $urlArchivo = $rutaDestino . time() . basename($_FILES['imagen']['name']);
                    if (!is_writable('./repo/')) {
                        $msg = 'El directorio no tiene permisos de escritura, comuníquese con el profesional de TI';
                        $vista = './Vista/Dashboard/Blog/Noticias/actualizar.php';
                        require_once './Vista/Utilidades/sidebar.php';
                    }
                    if (!is_dir($rutaDestino)) {
                        mkdir($rutaDestino, 0777, true);
                    }
                    if (file_exists($urlArchivo)) {
                        $noticia->setUrlImagen($urlArchivo);
                    } else {
                        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $urlArchivo)) {
                            $noticia->setUrlImagen($urlArchivo);
                        } else {
                            $msg = 'Ha habido un error con la subida del archivo, intente con otro archivo';
                            $vista = './Vista/Dashboard/Blog/Noticias/actualizar.php';
                            require_once './Vista/Utilidades/sidebar.php';
                        }
                    }
                }
                if (isset($_FILES['adjunto']) && $_FILES['adjunto']['error'] === UPLOAD_ERR_OK) {
                    $rutaDestino = './repo/';
                    $urlArchivo = $rutaDestino . time() . basename($_FILES['adjunto']['name']);
                    if (!is_writable('./repo/')) {
                        $msg = 'El directorio no tiene permisos de escritura, comuníquese con el profesional de TI';
                        $vista = './Vista/Dashboard/Blog/Noticias/actualizar.php';
                        require_once './Vista/Utilidades/sidebar.php';
                    }
                    if (!is_dir($rutaDestino)) {
                        mkdir($rutaDestino, 0777, true);
                    }
                    if (file_exists($urlArchivo)) {
                        $noticia->setUrlAdjunto($urlArchivo);
                    } else {
                        if (move_uploaded_file($_FILES['adjunto']['tmp_name'], $urlArchivo)) {
                            $noticia->setUrlAdjunto($urlArchivo);
                        } else {
                            $msg = 'Ha habido un error con la subida del archivo, intente con otro archivo';
                            $vista = './Vista/Dashboard/Blog/Noticias/actualizar.php';
                            require_once './Vista/Utilidades/sidebar.php';
                        }
                    }
                }
                if ($noticiaM->ActualizarNoticia($noticia)) {
                    header('location: index.php?controlador=Blog&metodo=Noticias');
                }
            }
        }
    }
}
