<?php
require_once "includes/conexion.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Tienda</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>

    <?php include "includes/header.php"; ?>

    <main>
        <h1>Productos Destacados</h1>
        <div class="productos">
            <?php
            $query = "CALL verProductosIndex()";
            $result = $conexion->query($query);

            while ($producto = $result->fetch_assoc()):
            ?>
                <div class="producto">
                    <img class="img_producto_index" src="assets/img_tienda/<?php echo $producto['imagen_producto']; ?>" alt="<?php echo $producto['nombre_producto']; ?>">
                    
                    <h3><?php echo $producto['nombre_producto']; ?></h3>
                    <p>$<?php echo number_format($producto['precio_producto'], 2); ?></p>
                    <a href="producto.php?id_producto=<?php echo $producto['id_producto']; ?>" class="btn">Ver más</a>
                </div>
            <?php endwhile; ?>
        </div>
    </main>

    <?php include "includes/footer.php"; ?>

</body>
</html>
