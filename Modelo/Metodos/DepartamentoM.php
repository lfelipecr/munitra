<?php
require_once './Modelo/Entidades/Departamento.php';
require_once './Modelo/Conexion.php';

class DepartamentoM
{
    function BuscarTiposSolicitud()
    {
        $conexion = new Conexion();
        $sql = 'SELECT * FROM TIPO_SOLICITUD';
        $resultado = $conexion->Ejecutar($sql);
        if (mysqli_num_rows($resultado) > 0) {
            $registro = json_encode($resultado->fetch_all());
        } else
            $registro = null;
        $conexion->Cerrar();
        return $registro;
    }
    function BuscarDepartamentosUsuario()
    {
        $registro = '';
        $conexion = new Conexion();
        $sql = "CALL UsuariosDepartamento()";
        $resultado = $conexion->Ejecutar($sql);
        if (mysqli_num_rows($resultado) > 0) {
            $registro = json_encode($resultado->fetch_all());
        } else
            $registro = null;
        $conexion->Cerrar();
        return $registro;
    }
    function BuscarDepartamento($id)
    {
        $departamentos = $this->BuscarDepartamentos();
        for ($i = 0; $i < count($departamentos); $i++) {
            if ($departamentos[$i]->getId() == $id) {
                return $departamentos[$i];
            }
        }
        return null;
    }
    function BuscarDepartamentos()
    {
        $registro = array();
        $conexion = new Conexion();
        $sql = "SELECT * FROM DEPARTAMENTO;";
        $resultado = $conexion->Ejecutar($sql);
        if (mysqli_num_rows($resultado) > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $departamento = new Departamento();
                $departamento->setId($fila["ID"]);
                $departamento->setDescripcion($fila["DESCRIPCION"]);
                $departamento->setJefe($fila['JEFE']);
                $registro[] = $departamento;
            }
        } else
            $registro = null;
        $conexion->Cerrar();
        return $registro;
    }
}
