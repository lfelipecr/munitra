<?php 
require_once './Modelo/Metodos/DepartamentoM.php';

class WebControlador {
    function Actividad(){
        require_once './Web/actividad.php';
    }
    function Alcaldia(){
        $deptomodel = new DepartamentoM();
        $jsonData = $deptomodel->BuscarDepartamentosUsuario();
        require_once './Web/alcaldia.php';
    }
    function Conformacion(){
        $deptomodel = new DepartamentoM();
        $jsonData = $deptomodel->BuscarDepartamentosUsuario();
        require_once './Web/conformacion.php';
    }
    function Contacto(){
        require_once './Web/contacto.php';
    }
    function Departamentos(){
        $deptomodel = new DepartamentoM();
        $jsonData = $deptomodel->BuscarDepartamentosUsuario();
        require_once './Web/departamentos.php';
    }
    function Himno(){
        require_once './Web/himno.html';
    }
    function Municipalidad(){
        require_once './Web/municipalidad.php';
    }
    function Noticias(){
        require_once './Web/noticias.php';
    }
    function Noticia(){
        require_once './Web/noticia.php';
    }
    function Actividades(){
        require_once './Web/quehacer.php';
    }
    function Sesiones(){
        require_once './Web/sesiones.php';
    }
}