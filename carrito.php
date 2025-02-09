<?php
session_start();
require_once "includes/conexion.php";

$productosEnCarrito = isset($_SESSION["carrito"]) ? $_SESSION["carrito"] : [];

// Si el carrito está vacío, mostrar mensaje
if (empty($productosEnCarrito)) {
    echo "<h2>Tu carrito está vacío.</h2>";
    exit();
}

// Consultar los productos en el carrito
$productos = [];
foreach ($productosEnCarrito as $idProducto => $cantidad) {
    $query = "SELECT id_producto, nombre_producto, precio_producto, imagen_producto FROM productos WHERE id_producto = $idProducto";
    $resultado = $conexion->query($query);
    if ($resultado->num_rows > 0) {
        $producto = $resultado->fetch_assoc();
        $producto["cantidad"] = $cantidad;
        $productos[] = $producto;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>

    <?php include "includes/header.php"; ?>

    <h2>Carrito de Compras</h2>
    <table>
        <tr>
            <th>Imagen</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Total</th>
            <th>Acciones</th>
        </tr>
        <?php
        $total = 0;
        foreach ($productos as $producto):
            $subtotal = $producto["precio_producto"] * $producto["cantidad"];
            $total += $subtotal;
        ?>
        <tr>
            <td><img src="assets/img_tienda/<?php echo $producto['imagen_producto']; ?>" width="50"></td>
            <td><?php echo $producto["nombre_producto"]; ?></td>
            <td>$<?php echo number_format($producto["precio_producto"], 2); ?></td>
            <td><?php echo $producto["cantidad"]; ?></td>
            <td>$<?php echo number_format($subtotal, 2); ?></td>
            <td>
                <a href="carrito/eliminar.php?id=<?php echo $producto["id_producto"]; ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h3>Total: $<?php echo number_format($total, 2); ?></h3>

    <a href="procesarCompra.php" class="btn">Finalizar Compra</a>

    <?php include "includes/footer.php"; ?>

</body>
</html>
