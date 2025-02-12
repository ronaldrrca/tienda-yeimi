<?php
session_start();
if (!isset($_SESSION["id_usuario"])) {
    header("Location: login_admin.php");
    exit();
}

require_once "./includes/conexion.php";

// Verificar el rol del usuario
$rol = $_SESSION["rol"] ?? "";

if ($rol !== "admin") {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="./assets/css/estilos.css">
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a href="gestionar_productos.php">Gestionar Productos</a></li>
            <li><a href="usuarios/logout.php">Cerrar Sesión</a></li>
            <?php if ($rol === "admin"): ?>
                <li><a href="gestionar_usuarios.php">Gestionar Usuarios</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<h2>Panel de Administración</h2>
<p>Bienvenido, <?php echo htmlspecialchars($_SESSION["nombre_usuario"]); ?> (<?php echo $rol; ?>)</p>

<section>
    <h3>Opciones de Administración</h3>
    <ul>
        <li><a href="gestionar_productos.php">Administrar Productos</a></li>
        <?php if ($rol === "admin"): ?>
            <li><a href="gestionar_usuarios.php">Administrar Usuarios</a></li>
        <?php endif; ?>
    </ul>
</section>

<?php include './includes/footer.php'; ?>

</body>
</html>
