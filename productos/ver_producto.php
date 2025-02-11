<?php
require_once "includes/conexion.php";

$id = intval($_GET["id_producto"]); // Asegurar que es un número entero

// echo $id; die();

if (!$id) {
    die("Producto no válido.");
}

// Usar una consulta preparada para evitar errores
$stmt = $conexion->prepare("CALL obtenerProductoPorID(?)");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Producto no encontrado.");
}

$producto = $result->fetch_assoc();
$stmt->close();
?>
