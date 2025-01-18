<?php
require_once './Modelo/Conexion.php';
require_once './Modelo/Entidades/Usuario.php';
require_once './Modelo/Metodos/UsuarioM.php';
require_once './Modelo/Metodos/ListaM.php';
require_once 'ListaControlador.php';

class LoginControlador
{
    function Login()
    {
        $listControlador = new ListaControlador();
        $uM= new UsuarioM();
        $validacion = true; 
        $registro = $uM->Buscar();
        $id = $_POST['cedula'];
        for ($i =  0; $i < count($registro); $i++){
            if ($id == $registro[$i]->getIdCedula()){
                $validacion = false;
                $listM = new ListaM();
                if ($registro[$i]->getIdRol() == 1){
                    $listControlador->Lista();
                    break;
                }
                else{
                    $listControlador->Ticket($registro[$i]->getId());
                    break;
                }   
            }
        }
        if ($validacion){
            $listControlador->Error();
        }
    }
    function Registro(){
        $msg = '';
        require_once './Vista/Login/registro.php';
    }
}