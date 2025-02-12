<?php
session_start();
if (!isset($_SESSION["id_usuario"]) || $_SESSION["rol"] !== "admin") {
    header("Content-Type: application/json");
    echo json_encode(["success" => false, "message" => "Acceso denegado"]);
    exit();
}

require_once "../includes/conexion.php";
header("Content-Type: application/json"); // Asegurar respuesta JSON


$response = ["success" => false, "message" => "Operación no válida"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["eliminar"]) && isset($_POST["id"])) {
        $id = intval($_POST["id"]);
        $stmt = $conexion->prepare("DELETE FROM productos WHERE id_producto = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            $response = ["success" => true, "message" => "Producto eliminado correctamente"];
        } else {
            $response = ["success" => false, "message" => "Error al eliminar"];
        }
        $stmt->close();
    } 
    elseif (isset($_POST["editar"])) {
        $id = intval($_POST["id"]);
        $nombre = trim($_POST["nombre"]);
        $precio = floatval($_POST["precio"]);
        $imagen = $_POST["imagen_actual"];

        if (!empty($_FILES["imagen"]["name"])) {
            $nombreImagen = basename($_FILES["imagen"]["name"]);
            $rutaDestino = "./assets/img_tienda/" . $nombreImagen;
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaDestino)) {
                $imagen = $nombreImagen;
            }
        }

        if (!empty($nombre) && $precio > 0) {
            if ($id > 0) {
                $stmt = $conexion->prepare("UPDATE productos SET nombre_producto=?, precio_producto=?, imagen_producto=? WHERE id_producto=?");
                $stmt->bind_param("sdsi", $nombre, $precio, $imagen, $id);
            } else {
                $stmt = $conexion->prepare("INSERT INTO productos (nombre_producto, precio_producto, imagen_producto) VALUES (?, ?, ?)");
                $stmt->bind_param("sds", $nombre, $precio, $imagen);
            }

            if ($stmt->execute()) {
                $response = ["success" => true, "message" => "Producto guardado correctamente"];
            } else {
                $response = ["success" => false, "message" => "Error al guardar"];
            }
            $stmt->close();
        } else {
            $response = ["success" => false, "message" => "Datos inválidos"];
        }
    }
}

echo json_encode($response);
?>
