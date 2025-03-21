<?php

use Dom\Document;

require_once './Utilidades/Utilidades.php';
require_once './Modelo/Entidades/Documentacion.php';
require_once './Modelo/Metodos/DocumentacionM.php';
require_once './Modelo/Entidades/Usuario.php';
require_once './Modelo/Metodos/DepartamentoM.php';
require_once './Modelo/Entidades/Departamento.php';

class DocumentacionControlador
{
    function Listado()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $documentacionM = new DocumentacionM();
            $departamentoM = new DepartamentoM();
            $idDepartamento = $_SESSION['usuario']->getIdDepartamento();
            $departamento = $departamentoM->BuscarDepartamento($idDepartamento);
            $jsonData = $documentacionM->ListarDocumentos($idDepartamento);
            if ($jsonData != null){
                $jsonData = json_encode($jsonData);
            }
            $vista = './Vista/Dashboard/Documentacion/listado.php';
            require_once './Vista/Utilidades/sidebar.php';
        }
    }
    function VIngresar()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $documentacionM = new DocumentacionM();
            $msg = '';
            $tipos = $documentacionM->TiposDocumento();
            $vista = './Vista/Dashboard/Documentacion/nuevo.php';
            require_once './Vista/Utilidades/sidebar.php';
        }
    }
    function Ingresar()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            if (isset($_POST['descripcion'])) {
                if (isset($_FILES['flSubir']) && $_FILES['flSubir']['error'] === UPLOAD_ERR_OK) {
                    $rutaDestino = './repo/';
                    $urlArchivo = $rutaDestino . time() . basename($_FILES['flSubir']['name']);
                    if (move_uploaded_file($_FILES['flSubir']['tmp_name'], $urlArchivo)) {
                        $documentacionM = new DocumentacionM();
                        $documentacion = new Documentacion();
                        $usuario = $_SESSION['usuario'];
                        $documentacion->setDescripcion($_POST['descripcion']);
                        $documentacion->setUrlArchivo($urlArchivo);
                        $documentacion->setDepartamento($usuario->getIdDepartamento());
                        $documentacion->setUsuarioCreacion($usuario->getId());
                        $documentacion->setTipoDocumento($_POST['tipoDoc']);
                        if ($documentacionM->IngresarDocumento($documentacion)) {
                            header('location: index.php?controlador=Documentacion&metodo=Listado');
                        } else {
                            $msg = 'Ha habido un problema, verifique los datos';
                            $vista = './Vista/Dashboard/Documentacion/nuevo.php';
                            require_once './Vista/Utilidades/sidebar.php';
                        }
                    } else {
                        $msg = 'Ha habido un problema con la subida del archivo, si el problema persiste consulte a soporte';
                        $vista = './Vista/Dashboard/Documentacion/nuevo.php';
                        require_once './Vista/Utilidades/sidebar.php';
                    }
                } else {
                    $msg = 'Ha habido un problema, verifique los datos';
                    $vista = './Vista/Dashboard/Documentacion/nuevo.php';
                    require_once './Vista/Utilidades/sidebar.php';
                }
            } else {
                $msg = 'Ha habido un problema, verifique los datos';
                $vista = './Vista/Dashboard/Documentacion/nuevo.php';
                require_once './Vista/Utilidades/sidebar.php';
            }
        }
    }
    function Eliminar()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $id = $_GET['id'];
            $documentacionM = new DocumentacionM();
            $documentacionM->EliminarDocumento($id);
            $this->Listado();
        }
    }
    function CrearCategoria()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $descripcion = $_POST['descripcion'];
            $documentacionM = new DocumentacionM();
            $documentacionM->CrearCategoria($descripcion);
            $this->Categorias();
        }
    }

    function Categorias()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $documentacionM = new DocumentacionM();
            $tipos = $documentacionM->TiposDocumento();
            $vista = './Vista/Dashboard/Documentacion/categorias.php';
            require_once './Vista/Utilidades/sidebar.php';
        }
    }
    function EliminarCategoria()
    {
        $u = new Utilidades();
        if ($u->VerificarSesion()) {
            $id = $_GET['id'];
            $documentacionM = new DocumentacionM();
            if ($documentacionM->EliminarCategoria($id)) {
                $this->Categorias();
            } else {
                echo '0';
            }
        }
    }
}
