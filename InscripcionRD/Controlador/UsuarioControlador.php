<?php
require_once './Modelo/Conexion.php';
require_once './Modelo/Entidades/Usuario.php';
require_once './Modelo/Metodos/UsuarioM.php';
require_once './Modelo/Entidades/Lista.php';
require_once './Modelo/Metodos/ListaM.php';
require_once './Controlador/ListaControlador.php';

class UsuarioControlador
{
    private function GuardarAsistencia($id) {
        $listaM = new ListaM();
        $lista = new Lista();
        $lista->setIdEvento('1');
        $lista->setIdUsuario($id);
        $idAsistencia = $listaM->Nuevo($lista);
        if ($idAsistencia != 0){
            require_once './Vista/Lista/numTicket.php';
        }
        else {
            require_once './index.php';
        }
    }
    function RegistrarAsistencia()
    {
        $uM = new UsuarioM();
        $usuario = new Usuario();
        $usuario->setIdCedula($_POST['cedula']);
        $usuario->setNombre($_POST['nombre']);
        $usuario->setApellido1($_POST['apellido1']);
        $usuario->setApellido2($_POST['apellido2']);
        $usuario->setIdRol('2');
        $id = $uM->Nuevo($usuario);
        if ($id != 0){
            $valido = true;
            $listaM = new ListaM();
            $arrLista = $listaM->Buscar();
            if(mysqli_num_rows($arrLista)>0)
            {
                $aforo = $listaM->AforoEvento();
                $cant = 0;
                while($fila=$arrLista->fetch_assoc())
                {
                    if ($fila['ACTIVO'] == 1){
                        $cant++;
                        if ($cant > $aforo)
                        {
                            $valido = false;
                            $msg = "Tickets agotados";
                            require_once './Vista/Login/registro.php';
                            break;    
                        }
                    }
                    if ($fila['ID_CEDULA'] == $usuario->getIdCedula()){
                        $valido = false;
                        $msg = "La cédula ya está registrada. Ingrese <a href='index.php'>acá</a> para ver su ticket";
                        require_once './Vista/Login/registro.php';
                        break;
                    }
                    $nombreCompleto = $fila['NOMBRE'].$fila['APELLIDO1'].$fila['APELLIDO2'];
                    $nombreNuevoRegistro =  $usuario->getNombre().$usuario->getApellido1().$usuario->getApellido2();
                    if ($nombreCompleto == $nombreNuevoRegistro){
                        $valido = false;
                        $msg = "Su nombre ya está registrado. Ingrese <a href='index.php'>acá</a> para ver su ticket";
                        require_once './Vista/Login/registro.php';
                        break;
                    }
                }
            } else {
                $this->GuardarAsistencia($id);
            }
            if ($valido){
                $this->GuardarAsistencia($id);
            }
        } else {
            require_once './index.php';
        }
    }
    function ValidarAsistencia() {
        $listaCont = new ListaControlador();
        $listaM = new ListaM();
        $listaM->Habilitar($_GET['id']);
        $listaCont->Lista();
    }
    function RevertirTicket() {
        $listaCont = new ListaControlador();
        $listaM = new ListaM();
        $listaM->Inhabilitar($_GET['id']);
        $listaCont->Lista();
    }
    function ModificarAforo(){
        $listaCont = new ListaControlador();
        $listaM = new ListaM();
        $listaM->ModificarAforo($_POST['aforo']);
        $listaCont->Lista();
    }
}