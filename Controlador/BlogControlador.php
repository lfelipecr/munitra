<?php
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Metodos/NoticiaM.php';
require_once './Modelo/Metodos/SesionM.php';
require_once './Modelo/Metodos/ActividadM.php';
require_once './Modelo/Metodos/BannerM.php';

class BlogControlador
{
    function Index()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $u->LlamarVista('./Vista/Dashboard/Blog/listadoOpciones.php');
        }
    }
    function Sesiones()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $sesionM = new SesionM();
            $jsonData = $sesionM->BuscarSesiones();
            $comisiones = json_encode($sesionM->Comisiones());
            $vista = './Vista/Dashboard/Blog/Sesiones/listado.php';
            require_once './Vista/Utilidades/sidebar.php';
        }
    }
    function Noticias()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $idUsuario = $_SESSION['usuario']->getId();
            $notiM = new NoticiaM();
            $jsonData = $notiM->BuscarNoticias();
            $vista = './Vista/Dashboard/Blog/Noticias/listado.php';
            require_once './Vista/Utilidades/sidebar.php';
        }
    }
    function Actividades()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $actividadM = new ActividadM();
            $jsonData = $actividadM->BuscarTodas();
            $idUsuario = $_SESSION['usuario']->getId();
            $vista = './Vista/Dashboard/Blog/Actividades/listado.php';
            require_once './Vista/Utilidades/sidebar.php';
        }
    }
    function Banner()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $bannerM = new BannerM();
            $listado = $bannerM->BuscarBanners();
            $msg = '';
            $vista = './Vista/Dashboard/Blog/Banner/banner.php';
            require_once './Vista/Utilidades/sidebar.php';
        }
    }
    function NuevoBanner()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            if (isset($_FILES['banner']) && $_FILES['banner']['error'] === UPLOAD_ERR_OK) {
                $rutaDestino = './repo/';
                $urlArchivo = $rutaDestino . time() . basename($_FILES['banner']['name']);
                if (!is_writable('./repo/')) {
                    echo 'El directorio no tiene permisos de escritura, comuníquese con el profesional de TI';
                }
                if (!is_dir($rutaDestino)) {
                    mkdir($rutaDestino, 0777, true);
                }
                if (move_uploaded_file($_FILES['banner']['tmp_name'], $urlArchivo)) {
                    $bannerM = new BannerM();
                    $descripcion = $_POST['descripcion'];
                    $url = basename($_FILES['banner']['name']);
                    if ($bannerM->IngresarBanner($descripcion, $url)) {
                        echo 'Ok';
                    } else {
                        echo 'Ha habido un problema con los datos del banner';
                    }
                }
            } else {
                echo 'No se ha subido el archivo';
            }
        }
    }
    function EliminarBanner()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $bannerM = new BannerM();
            $id = $_GET['id'];
            $bannerM->EliminarBanner($id);
            $this->Banner();
        }
    }
    function ActivarBanner()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $bannerM = new BannerM();
            $id = $_GET['id'];
            $bannerM->GenerarActivo($id);
            $this->Banner();
        }
    }
}
