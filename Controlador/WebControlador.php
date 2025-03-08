<?php

require_once './Modelo/Metodos/DepartamentoM.php';
require_once './Modelo/Metodos/NoticiaM.php';
require_once './Modelo/Metodos/SesionM.php';
require_once './Modelo/Metodos/ActividadM.php';
require_once './Modelo/Entidades/Documentacion.php';
require_once './Modelo/Metodos/DocumentacionM.php';
require_once './Modelo/Entidades/Departamento.php';
require_once './Modelo/Entidades/Consulta.php';
require_once './Modelo/Metodos/ConsultaM.php';
require_once './Modelo/Metodos/PersonaM.php';
require_once './Modelo/Metodos/UsuarioM.php';
require_once './Controlador/LoginControlador.php';

class WebControlador
{
    function ListadoDocsWeb()
    {
        $documentacionM = new DocumentacionM();
        $idDepartamento = $_GET['idDepto'];
        $jsonData = $documentacionM->ListarDocumentos($idDepartamento);
        echo $jsonData;
    }
    function Actividad()
    {
        $id = $_GET['id'];
        $actividadM = new ActividadM();
        $actividad = $actividadM->BuscarActividad($id);
        require_once './Web/actividad.php';
    }
    function Alcaldia()
    {
        session_start();
        $deptomodel = new DepartamentoM();
        $consultaM = new ConsultaM();
        $personaM = new PersonaM();
        $jsonData = $deptomodel->BuscarDepartamentosUsuario();
        $consulta = null;
        require_once './Web/alcaldia.php';
    }
    function Conformacion()
    {
        session_start();
        $consultaM = new ConsultaM();
        $deptomodel = new DepartamentoM();
        $personaM = new PersonaM();
        $consulta = null;
        $jsonData = $deptomodel->BuscarDepartamentosUsuario();
        require_once './Web/conformacion.php';
    }
    function Contacto()
    {
        session_start();
        $consultaM = new ConsultaM();
        $consulta = null;
        $personaM = new PersonaM();
        $estadisticas = $consultaM->GenerarEstadisticas();
        require_once './Web/contacto.php';
    }
    function Helper()
    {
        session_start();
        session_unset();
        session_destroy();
    }
    function Departamentos()
    {
        session_start();
        $consultaM = new ConsultaM();
        $deptomodel = new DepartamentoM();
        $personaM = new PersonaM();
        $deptos = json_encode($deptomodel->BuscarDepartamentos());
        $tiposSolicitud = $deptomodel->BuscarTiposSolicitud();
        $consulta = null;
        $jsonData = $deptomodel->BuscarDepartamentosUsuario();
        require_once './Web/departamentos.php';
    }
    function Himno()
    {
        require_once './Web/himno.html';
    }
    function Municipalidad()
    {
        require_once './Web/municipalidad.php';
    }
    function Noticias()
    {
        $noticiaM = new NoticiaM();
        $jsonData = $noticiaM->BuscarNoticias();
        require_once './Web/noticias.php';
    }
    function Noticia()
    {
        $noticiaM = new NoticiaM();
        $noticia = $noticiaM->BuscarNoticia($_GET['id']);
        require_once './Web/noticia.php';
    }
    function Actividades()
    {
        $actividadM = new ActividadM();
        $jsonData = $actividadM->BuscarTodas();
        require_once './Web/quehacer.php';
    }
    function Sesiones()
    {
        $sesionM = new SesionM();
        $jsonData = $sesionM->BuscarSesiones();
        require_once './Web/sesiones.php';
    }
    function NuestroCanton()
    {
        require_once './Web/inicio.php';
    }
    function SolicitarTramite()
    {
        session_start();
        $idTramite = $_GET['tramite'];
        $_SESSION['tramite'] = $idTramite;
        $login = new LoginControlador();
        $msg = 'Será redirigido al trámite solicitado pronto, ingrese a su cuenta';
        require_once './Vista/Login/login.php';
    }
}
