<?php
session_start();
require_once "../includes/conexion.php";

if (!isset($_SESSION["id_cliente"])) {
    echo json_encode(["success" => false, "error" => "No autenticado"]);
    exit();
}

$idCliente = $_SESSION["id_cliente"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idProducto = $_POST["id_producto"];
    $cantidad = $_POST["cantidad"];

    $stmt = $conexion->prepare("SELECT precio_producto FROM productos WHERE id_producto = ?");
    $stmt->bind_param("i", $idProducto);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $producto = $resultado->fetch_assoc();
    $stmt->close();

    if (!$producto) {
        echo json_encode(["success" => false, "error" => "Producto no encontrado"]);
        exit();
    }

    $precio = $producto["precio_producto"];

    $stmt = $conexion->prepare("SELECT cantidad_carrito FROM carrito WHERE idCliente_carrito = ? AND idProducto_carrito = ?");
    $stmt->bind_param("ii", $idCliente, $idProducto);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $stmt = $conexion->prepare("UPDATE carrito SET cantidad_carrito = cantidad_carrito + ?, precioUnitario_carrito = ? WHERE idCliente_carrito = ? AND idProducto_carrito = ?");
        $stmt->bind_param("diii", $cantidad, $precio, $idCliente, $idProducto);
    } else {
        $stmt = $conexion->prepare("INSERT INTO carrito (idCliente_carrito, idProducto_carrito, cantidad_carrito, precioUnitario_carrito) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $idCliente, $idProducto, $cantidad, $precio);
    }
    $stmt->execute();
    $stmt->close();

    echo json_encode(["success" => true]);
    exit();
}
?>
