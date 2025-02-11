<?php
include './productos/ver_producto.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $producto["nombre"]; ?></title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>

    <?php include "includes/header.php"; ?>

    <main class="producto-detalle">
        
        <div class="producto-detalle_informacion">
            <img class="img_producto_producto" src="assets/img_tienda/<?php echo $producto['imagen_producto']; ?>" alt="<?php echo $producto['nombre_producto']; ?>">
            <h1><?php echo $producto["nombre_producto"]; ?></h1>
            <p>Precio: $<?php echo number_format($producto["precio_producto"], 2); ?></p>
            <p><?php echo $producto["descripcion_producto"]; ?></p>
            
            <form id="form_producto" action="carrito/agregar.php" method="POST">
                <input type="hidden" name="id_producto" value="<?php echo $producto["id_producto"]; ?>">
                <div id="form_producto_cantidad">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" name="cantidad" id="cantidad" value="1" min="1" required>
                </div>
                <button type="submit" class="btn">Añadir al carrito</button>
            </form>
        </div>
    </main>

    <?php include "includes/footer.php"; ?>

</body>
</html>
