<?php
// TODO: Clase de Clientes Tienda Cel@g
require_once('../config/conexion.php');

class Clientes
{
    public function buscar($texto) // select * from clientes where nombre = $texto
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `clientes` WHERE `nombre` = '$texto'";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function todos() // select * from clientes
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `clientes`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($cliente_id) // select * from clientes where cliente_id = $cliente_id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `clientes` WHERE `cliente_id` = $cliente_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($nombre, $apellido, $licencia, $telefono) // insert into clientes (nombre, apellido, licencia, telefono) values ($nombre, $apellido, $licencia, $telefono)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `clientes`(`nombre`, `apellido`, `licencia`, `telefono`) 
                       VALUES ('$nombre', '$apellido', '$licencia', '$telefono')";
            if (mysqli_query($con, $cadena)) {
                return $con->insert_id; // Return the inserted ID
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function actualizar($cliente_id, $nombre, $apellido, $licencia, $telefono) // update clientes set nombre = $nombre, apellido = $apellido, licencia = $licencia, telefono = $telefono where cliente_id = $cliente_id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `clientes` SET 
                       `nombre`='$nombre',
                       `apellido`='$apellido',
                       `licencia`='$licencia',
                       `telefono`='$telefono' 
                       WHERE `cliente_id` = $cliente_id";
            if (mysqli_query($con, $cadena)) {
                return $cliente_id; // Return the updated ID
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function eliminar($cliente_id) // delete from clientes where cliente_id = $cliente_id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `clientes` WHERE `cliente_id` = $cliente_id";
            if (mysqli_query($con, $cadena)) {
                return 1; // Success
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
}
