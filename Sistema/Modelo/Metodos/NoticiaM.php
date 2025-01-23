<?php
require_once './Modelo/Conexion.php';
require_once './Modelo/Entidades/Persona.php';
require_once './Modelo/Entidades/Usuario.php';
require_once './Modelo/Entidades/Noticia.php';
class NoticiaM {
    function BuscarNoticias(){
        $registro=array();
        $conexion= new Conexion();
        $sql="CALL SpBuscarNoticias();";
        $resultado=$conexion->Ejecutar($sql);
        if(mysqli_num_rows($resultado)>0)
        {
            while($fila=$resultado->fetch_assoc())
            {
                //Arreglo que contiene los datos de las 3 tablas
                $arr = array();
                $noticia = new Noticia();
                $usuario = new Usuario();
                $persona = new Persona();
                $noticia->setId($fila["NOTICIA_ID"]);
                $noticia->setTitulo($fila["NOTICIA_TITULO"]);
                $noticia->setDescripcionLarga($fila["NOTICIA_DESCRIPCION"]);
                $noticia->setUrlImagen($fila["NOTICIA_URL_IMAGEN"]);
                $usuario->setId($fila["USUARIO_ID"]);
                $usuario->setNombreUsuario($fila["USUARIO_NOMBRE"]);
                $usuario->setCorreo($fila["USUARIO_CORREO"]);
                $persona->setId($fila["PERSONA_ID"]);
                $persona->setNombre($fila["PERSONA_NOMBRE"]);
                $persona->setPrimerApellido($fila["PERSONA_PRIMER_APELLIDO"]);
                $persona->setSegundoApellido($fila["PERSONA_SEGUNDO_APELLIDO"]);
                //0
                $arr[] = $noticia;
                //1
                $arr[] = $usuario;
                //2
                $arr[] = $persona;
                $registro[] = $arr;
            }
        }
        else
            $registro=null;
        $conexion->Cerrar();
        return $registro;
    }
}