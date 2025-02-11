<?php
session_start();
require_once "../includes/conexion.php";

// Si el usuario no está autenticado, redirigir al login
if (!isset($_SESSION["id_cliente"])) {
    $returnUrl = isset($_POST["returnUrl"]) ? urlencode($_POST["returnUrl"]) : urlencode("../index.php");
    header("Location: ../login.php?returnUrl=" . $returnUrl);
    exit();
}

$idCliente = $_SESSION["id_cliente"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idProducto = $_POST["id_producto"];
    $cantidad = $_POST["cantidad"];

    $query = "SELECT precio_producto FROM productos WHERE id_producto = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $idProducto);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $producto = $resultado->fetch_assoc();
    $precio = $producto["precio_producto"];
    $stmt->close();

    $query = "SELECT cantidad_carrito FROM carrito WHERE idCliente_carrito = ? AND idProducto_carrito = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("ii", $idCliente, $idProducto);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $query = "UPDATE carrito SET cantidad_carrito = cantidad_carrito + ?, precioUnitario_carrito = ? WHERE idCliente_carrito = ? AND idProducto_carrito = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("diii", $cantidad, $precio, $idCliente, $idProducto);
    } else {
        $query = "INSERT INTO carrito (idCliente_carrito, idProducto_carrito, cantidad_carrito, precioUnitario_carrito) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("iiid", $idCliente, $idProducto, $cantidad, $precio);
    }
    $stmt->execute();
    $stmt->close();

    header("Location: ../carrito.php");
    exit();
}
?>
