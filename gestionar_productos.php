<?php
session_start();
if (!isset($_SESSION["id_usuario"]) || $_SESSION["rol"] !== "admin") {
    header("Location: login_admin.php");
    exit();
}

require_once "./includes/conexion.php";

// Obtener la lista de productos
$sql = "SELECT id_producto, nombre_producto, descripcion_producto, precio_producto, imagen_producto FROM productos";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Productos</title>
    <link rel="stylesheet" href="./assets/css/estilos.css">
    <script defer src="./assets/js/admin_productos.js"></script>
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a href="admin_panel.php">Panel de Administración</a></li>
            <li><a href="usuarios/logout.php">Cerrar Sesión</a></li>
        </ul>
    </nav>
</header>

<h2>Gestión de Productos</h2>

<!-- Tabla de productos -->
<table>
    <tr>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Imagen</th>
        <th>Acciones</th>
    </tr>
    <?php while ($row = $resultado->fetch_assoc()) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row["nombre_producto"]); ?></td>
            <td>$<?php echo number_format($row["precio_producto"], 2); ?></td>
            <td><img src='assets/img_tienda/<?php echo htmlspecialchars($row["imagen_producto"]); ?>' width='50'></td>
            <td>
                <button class='editar' data-id='<?php echo $row["id_producto"]; ?>' 
                        data-nombre='<?php echo htmlspecialchars($row["nombre_producto"]); ?>' 
                        data-precio='<?php echo $row["precio_producto"]; ?>' 
                        data-imagen='<?php echo htmlspecialchars($row["imagen_producto"]); ?>'>Editar</button>
                <button class='eliminar' data-id='<?php echo $row["id_producto"]; ?>'>Eliminar</button>
            </td>
        </tr>
    <?php } ?>
</table>

<!-- Formulario para agregar/editar un producto -->
<h3 id="formTitle">Agregar Nuevo Producto</h3>
<form id="formProducto" enctype="multipart/form-data">
    <input type="hidden" name="id" id="id_producto">
    <input type="text" name="nombre" id="nombre" placeholder="Nombre del producto" required>
    <input type="number" name="precio" id="precio" placeholder="Precio" required>
    <input type="file" name="imagen" id="productoImagen" accept="image/*">
    <input type="hidden" name="imagen_actual" id="imagen_actual">
    <button type="submit">Guardar Producto</button>
</form>

<?php include './includes/footer.php'; ?>

</body>
</html>
