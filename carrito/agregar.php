<?php
session_start();
require_once "../includes/conexion.php";

// Verificar si el usuario ha iniciado sesión (suponiendo que tienes autenticación de clientes)
if (!isset($_SESSION["id_cliente"])) {
    header("Location: ../login.php");
    exit();
}

$idCliente = $_SESSION["id_cliente"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idProducto = $_POST["id_producto"];
    $cantidad = $_POST["cantidad"];

    // Obtener el precio del producto
    $query = "SELECT precio_producto FROM productos WHERE id_producto = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $idProducto);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $producto = $resultado->fetch_assoc();
    $precio = $producto["precio_producto"];
    $stmt->close();

    // Verificar si el producto ya está en el carrito del cliente
    $query = "SELECT cantidad_carrito FROM carrito WHERE idCliente_carrito = ? AND idProducto_carrito = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("ii", $idCliente, $idProducto);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        // Si ya existe, actualizar la cantidad
        $query = "UPDATE carrito SET cantidad_carrito = cantidad_carrito + ?, precioUnitario_carrito = ? WHERE idCliente_carrito = ? AND idProducto_carrito = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("diii", $cantidad, $precio, $idCliente, $idProducto);
    } else {
        // Si no existe, agregar el producto
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

