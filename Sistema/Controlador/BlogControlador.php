<?php 
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Metodos/NoticiaM.php';

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
            $u->LlamarVista('./Vista/Dashboard/Blog/Sesiones/listado.php');
        }
    }
    function Noticias(){
        $u = new Utilidades();
        if ($u->VerificarSesion()){
            $notiM = new NoticiaM();
            $noticias = $notiM->BuscarNoticias();
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