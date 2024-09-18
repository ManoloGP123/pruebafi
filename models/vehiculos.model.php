<?php
// TODO: Clase de Vehículos
require_once('../config/conexion.php');

class Vehiculos
{
    public function buscar($texto) // select * from vehiculos where marca = $texto
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `vehiculos` WHERE `marca` = '$texto'";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function todos() // select * from vehiculos
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `vehiculos`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($vehiculo_id) // select * from vehiculos where vehiculo_id = $vehiculo_id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `vehiculos` WHERE `vehiculo_id` = $vehiculo_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($marca, $modelo, $año, $disponible) // insert into vehiculos (marca, modelo, año, disponible) values ($marca, $modelo, $año, $disponible)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `vehiculos`(`marca`, `modelo`, `año`, `disponible`) 
                       VALUES ('$marca', '$modelo', '$año', '$disponible')";
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

    public function actualizar($vehiculo_id, $marca, $modelo, $año, $disponible) // update vehiculos set marca = $marca, modelo = $modelo, año = $año, disponible = $disponible where vehiculo_id = $vehiculo_id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `vehiculos` SET 
                       `marca`='$marca',
                       `modelo`='$modelo',
                       `año`='$año',
                       `disponible`='$disponible' 
                       WHERE `vehiculo_id` = $vehiculo_id";
            if (mysqli_query($con, $cadena)) {
                return $vehiculo_id; // Return the updated ID
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function eliminar($vehiculo_id) // delete from vehiculos where vehiculo_id = $vehiculo_id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `vehiculos` WHERE `vehiculo_id` = $vehiculo_id";
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
?>
