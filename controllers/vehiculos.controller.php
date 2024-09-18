<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

require_once('../models/vehiculos.model.php'); // Asegúrate de que la ruta sea correcta
error_reporting(0);
$vehiculos = new Vehiculos;

switch ($_GET["op"]) {
    case 'buscar': 
        if (!isset($_POST["texto"])) {
            echo json_encode(["error" => "Search text not specified."]);
            exit();
        }
        $texto = $_POST["texto"]; // No es necesario convertir a int
        $datos = $vehiculos->buscar($texto);
        $todos = [];
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'todos':
        $datos = $vehiculos->todos();
        $todos = [];
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno': // Procedimiento para obtener un registro de la base de datos
        if (!isset($_POST["vehiculo_id"])) {
            echo json_encode(["error" => "Vehicle ID not specified."]);
            exit();
        }
        $vehiculo_id = intval($_POST["vehiculo_id"]);
        $datos = $vehiculos->uno($vehiculo_id);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar': // Procedimiento para insertar un vehículo en la base de datos
        if (!isset($_POST["marca"]) || !isset($_POST["modelo"]) || !isset($_POST["año"]) || !isset($_POST["disponible"])) {
            echo json_encode(["error" => "Missing required parameters."]);
            exit();
        }

        $marca = $_POST["marca"];
        $modelo = $_POST["modelo"];
        $año = $_POST["año"];
        $disponible = $_POST["disponible"];

        $datos = $vehiculos->insertar($marca, $modelo, $año, $disponible);
        echo json_encode($datos);
        break;

    case 'actualizar': // Procedimiento para actualizar un vehículo en la base de datos
        if (!isset($_POST["vehiculo_id"]) || !isset($_POST["marca"]) || !isset($_POST["modelo"]) || !isset($_POST["año"]) || !isset($_POST["disponible"])) {
            echo json_encode(["error" => "Missing required parameters."]);
            exit();
        }

        $vehiculo_id = intval($_POST["vehiculo_id"]);
        $marca = $_POST["marca"];
        $modelo = $_POST["modelo"];
        $año = $_POST["año"];
        $disponible = $_POST["disponible"];

        $datos = $vehiculos->actualizar($vehiculo_id, $marca, $modelo, $año, $disponible);
        echo json_encode($datos);
        break;

    case 'eliminar': // Eliminar vehículo
        if (!isset($_POST["vehiculo_id"])) {
            echo json_encode(["error" => "Vehicle ID not specified."]);
            exit();
        }
        $vehiculo_id = intval($_POST["vehiculo_id"]);
        $datos = $vehiculos->eliminar($vehiculo_id);
        echo json_encode($datos);
        break;

    default:
        echo json_encode(["error" => "Ingrese el ?op=todos"]);
        break;
}
?>
