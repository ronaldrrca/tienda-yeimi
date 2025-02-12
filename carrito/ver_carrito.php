<?php 
require_once "includes/conexion.php";

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["id_cliente"]) && !isset($_SESSION["id_cliente"])) {
    header("Location: login_cliente.php");
    exit();
}

$idCliente = $_SESSION["id_cliente"];

// Consultar los productos en el carrito
$query = "SELECT c.idProducto_carrito, p.nombre_producto, p.imagen_producto, c.cantidad_carrito, p.precio_producto
          FROM carrito c
          INNER JOIN productos p ON c.idProducto_carrito = p.id_producto
          WHERE c.idCliente_carrito = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $idCliente);
$stmt->execute();
$resultado = $stmt->get_result();
$productos = $resultado->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Si el carrito está vacío, mostrar mensaje
if (empty($productos)) {
    echo "<h2>Tu carrito está vacío.</h2>";
    exit();
}
?>