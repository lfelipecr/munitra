<?php
require_once './Modelo/Metodos/UsuarioM.php';
require_once './Utilidades/Utilidades.php';
require_once './Modelo/Metodos/SolicitudM.php';
require_once './Libraries/dompdf-3.1.0/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use FontLib\Table\Type\head;

class TramitesControlador
{
    function Index()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $depto = $_SESSION['usuario']->getIdDepartamento();
            $vista = './Vista/Dashboard/Tramites/listadoOpciones.php';
            require_once './Vista/Utilidades/sidebar.php';
        }
    }
    function ListadoTramites()
    {
        session_start();
        $usuarioM = new UsuarioM();
        $usuario = $_SESSION['usuario']->getIdPersona();
        $estado = $usuarioM->BuscarUsuarioIdPersona($usuario)->getIdEstado();
        $vista = './Vista/TramitesUsuario/listadoTramites.php';
        require_once './Vista/Utilidades/navbar.php';
    }
    function InicioExterno()
    {
        session_start();
        $usuario = $_SESSION['usuario']->getIdPersona();
        $estado = $_SESSION['usuario']->getIdEstado();
        $tramite = 0;
        if (isset($_SESSION['tramite'])) {
            $tramite = $_SESSION['tramite'];
            unset($_SESSION['tramite']);
        }
        switch ($tramite) {
            case '1':
                $this->Patentes();
                break;
            case '2':
                $this->UsoSuelo();
                break;
            case '3':
                $this->Visado();
                break;
            case '4':
                $this->Condonacion();
                break;
            case '5':
            case '6':
                $this->Declaraciones();
                break;
            default:
                header('location: index.php?controlador=Externo&metodo=Index');
                break;
        }
    }
    function Patentes()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            session_start();
            if ($_SESSION['usuario']->getIdDepartamento() == 1) {
                $solicitudM = new SolicitudM();
                $jsonData = $solicitudM->BuscarSolicitudes(1);
                $usuario = $_SESSION['usuario']->getId();
                $vista = './Vista/TramitesUsuario/Patentes/listado.php';
                require_once './Vista/Utilidades/navbar.php';
            } else {
                $solicitudM = new SolicitudM();
                $jsonData = $solicitudM->BuscarSolicitudes(1);
                $vista = './Vista/Dashboard/Tramites/Patentes/listado.php';
                require_once './Vista/Utilidades/sidebar.php';
            }
        }
    }
    function UsoSuelo()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            if ($_SESSION['usuario']->getIdDepartamento() == 1) {
                $solicitudM = new SolicitudM();
                $jsonData = $solicitudM->BuscarSolicitudes(2);
                $vista = './Vista/TramitesUsuario/UsoSuelo/listado.php';
                require_once './Vista/Utilidades/navbar.php';
            } else {
                $solicitudM = new SolicitudM();
                $jsonData = $solicitudM->BuscarSolicitudes(2);
                $vista = './Vista/Dashboard/Tramites/UsoSuelo/listado.php';
                require_once './Vista/Utilidades/sidebar.php';
            }
        }
    }
    function Visado()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            session_start();
            if ($_SESSION['usuario']->getIdDepartamento() == 1) {
                $solicitudM = new SolicitudM();
                $jsonData = $solicitudM->BuscarSolicitudes(3);
                $vista = './Vista/TramitesUsuario/Visado/listado.php';
                require_once './Vista/Utilidades/navbar.php';
            } else {
                $solicitudM = new SolicitudM();
                $jsonData = $solicitudM->BuscarSolicitudes(3);
                $vista = './Vista/Dashboard/Tramites/Visado/listado.php';
                require_once './Vista/Utilidades/sidebar.php';
            }
        }
    }
    function Condonacion()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            session_start();
            if ($_SESSION['usuario']->getIdDepartamento() == 1) {
                $solicitudM = new SolicitudM();
                $jsonData = $solicitudM->BuscarSolicitudes(4);
                $vista = './Vista/TramitesUsuario/Condonacion/listado.php';
                require_once './Vista/Utilidades/navbar.php';
            } else {
                $solicitudM = new SolicitudM();
                $jsonData = $solicitudM->BuscarSolicitudes(4);
                $vista = './Vista/Dashboard/Tramites/Condonacion/listado.php';
                require_once './Vista/Utilidades/sidebar.php';
            }
        }
    }
    function Declaraciones()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            session_start();
            if ($_SESSION['usuario']->getIdDepartamento() == 1) {
                $vista = './Vista/TramitesUsuario/Declaraciones/listado.php';
                require_once './Vista/Utilidades/navbar.php';
            } else {
                $vista = './Vista/Dashboard/Tramites/Declaraciones/listado.php';
                require_once './Vista/Utilidades/sidebar.php';
            }
        }
    }
    function Credenciales()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            session_start();
            $idUsuario = $_SESSION['usuario']->getId();
            require_once './Vista/Login/credenciales.php';
        }
    }
    function IngresarCodigo()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $msg = '';
            require_once './Vista/Login/codigo.php';
        }
    }
    function Descargar()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $ruta = $_SESSION['archivo'];
            unset($_SESSION['archivo']);
            echo $ruta;
            //header('location: '.$ruta);
        }
    }
    function ImprimirPDF()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $baseUrl = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . "/";
            $html = $_POST['html'];
            $html = str_replace('src="./Web/assets/img/', 'src="' . $baseUrl . 'Web/assets/img/', $html);
            $dompdf = new Dompdf();
            $options = $dompdf->getOptions();
            $options->set(array('isRemoteEnabled' => true));
            $dompdf->setOptions($options);
            $dompdf->loadHtml($html);
            $dompdf->setPaper('letter');
            $dompdf->render();
            $ruta = './repo/' . time() . 'solicitud.pdf';
            file_put_contents($ruta, $dompdf->output());
            echo $ruta;
            exit;
        }
    }
}
