<?php
session_start();
include './productos/ver_producto.php';

// Variable para verificar si el usuario está logueado
$usuarioLogueado = isset($_SESSION["id_cliente"]);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $producto["nombre_producto"]; ?></title>
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
            
            <form id="formAgregarCarrito">
                <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>"> <!-- FIXED -->
                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" value="1" min="1">
                <button type="submit">Añadir al carrito</button>
        </form>


            <!-- Mensaje de éxito -->
            <p id="mensajeCarrito" style="display:none; color: green;">¡Producto añadido al carrito!</p>

        </div>
    </main>

    <?php include "includes/footer.php"; ?>

    <!-- Variable JavaScript para saber si el usuario está logueado -->
    <script>
        var usuarioLogueado = <?php echo json_encode($usuarioLogueado); ?>;
    </script>
    <script src="assets/js/producto.js"></script> 

</body>
</html>
