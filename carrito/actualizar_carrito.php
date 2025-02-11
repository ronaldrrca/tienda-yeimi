<?php
session_start();
require_once "../includes/conexion.php";

if (!isset($_SESSION["id_cliente"]) || !isset($_POST["id"]) || !isset($_POST["accion"])) {
    echo json_encode(["error" => "Datos inválidos"]);
    exit();
}

$idCliente = $_SESSION["id_cliente"];
$idProducto = intval($_POST["id"]);
$accion = $_POST["accion"];

// Obtener la cantidad actual
$query = "SELECT cantidad_carrito, precio_producto FROM carrito 
          INNER JOIN productos ON carrito.idProducto_carrito = productos.id_producto 
          WHERE idCliente_carrito = ? AND idProducto_carrito = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("ii", $idCliente, $idProducto);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo json_encode(["error" => "Producto no encontrado"]);
    exit();
}

$row = $result->fetch_assoc();
$cantidad = $row["cantidad_carrito"];
$precio = $row["precio_producto"];

// Aumentar o disminuir la cantidad
if ($accion === "aumentar") {
    $cantidad++;
} elseif ($accion === "disminuir" && $cantidad > 1) {
    $cantidad--;
}

// Actualizar en la base de datos
$updateQuery = "UPDATE carrito SET cantidad_carrito = ? WHERE idCliente_carrito = ? AND idProducto_carrito = ?";
$updateStmt = $conexion->prepare($updateQuery);
$updateStmt->bind_param("iii", $cantidad, $idCliente, $idProducto);
$updateStmt->execute();

// Calcular nuevo subtotal
$subtotal = $cantidad * $precio;

echo json_encode([
    "success" => true,
    "cantidad" => $cantidad,
    "subtotal" => number_format($subtotal, 2)
]);
?>
