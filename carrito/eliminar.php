<?php
session_start();
require_once "../includes/conexion.php";

if (!isset($_SESSION["id_cliente"])) {
    header("Location: ../login.php");
    exit();
}

$idCliente = $_SESSION["id_cliente"];
$idProducto = $_GET["id"];  

// Eliminar el producto del carrito
$query = "DELETE FROM carrito WHERE idCliente_carrito = ? AND idProducto_carrito = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("ii", $idCliente, $idProducto);
$stmt->execute();
$stmt->close();

header("Location: ../carrito.php");
exit();
?>
