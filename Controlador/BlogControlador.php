<?php 
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Metodos/NoticiaM.php';
require_once './Modelo/Metodos/SesionM.php';

class BlogControlador {
    function Index(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            $u->LlamarVista('./Vista/Dashboard/Blog/listadoOpciones.php');
        }
    }
    function Sesiones(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            $sesionM = new SesionM();
            $jsonData = $sesionM->BuscarSesiones();
            $vista = './Vista/Dashboard/Blog/Sesiones/listado.php';
            require_once './Vista/Utilidades/sidebar.php';
        }
    }
    function Noticias(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            $idUsuario = $_SESSION['usuario']->getId();
            $notiM = new NoticiaM();
            $jsonData = $notiM->BuscarNoticias();
            $vista = './Vista/Dashboard/Blog/Noticias/listado.php';
            require_once './Vista/Utilidades/sidebar.php';
        }
    }
    function Actividades(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            $u->LlamarVista('./Vista/Dashboard/Blog/Actividades/listado.php');
        }
    }
}