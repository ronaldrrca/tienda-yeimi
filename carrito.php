<?php
session_start(); 
require './carrito/ver_carrito.php'
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
            $subtotal = $producto["precio_producto"] * $producto["cantidad_carrito"];
            $total += $subtotal;
        ?>
        <tr>
    <td><img src="assets/img_tienda/<?php echo $producto['imagen_producto']; ?>" width="50"></td>
    <td><?php echo $producto["nombre_producto"]; ?></td>
    <td>$<?php echo number_format($producto["precio_producto"], 2); ?></td>
    <td>
        <button type="button" class="btn-menos" data-id="<?php echo $producto['idProducto_carrito']; ?>">-</button>
        <span id="cantidad-<?php echo $producto['idProducto_carrito']; ?>">
            <?php echo $producto["cantidad_carrito"]; ?>
        </span>
        <button type="button" class="btn-mas" data-id="<?php echo $producto['idProducto_carrito']; ?>">+</button>
    </td>
    <td id="subtotal-<?php echo $producto['idProducto_carrito']; ?>">
        $<?php echo number_format($subtotal, 2); ?>
    </td>
    <td>
        <a href="carrito/eliminar.php?id=<?php echo $producto["idProducto_carrito"]; ?>">Eliminar</a>
    </td>
</tr>

        <?php endforeach; ?>
    </table>

    <h3>Total: $<?php echo number_format($total, 2); ?></h3>

    <a href="procesar_compra.php" class="btn">Finalizar Compra</a>

    <?php include "includes/footer.php"; ?>
    <script src="./assets/js/carrito.js"></script>
</body>
</html>
