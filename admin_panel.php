<?php
session_start();
if (!isset($_SESSION["id_usuario"])) {
    header("Location: login_admin.php");
    exit();
}

require_once "./includes/conexion.php";

$rol = $_SESSION["rol"];
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
        <?php if ($rol === "admin"): ?>
            <li><a href="admin_usuarios.php">Gestionar Usuarios</a></li>
        <?php endif; ?>
        <li><a href="gestionar_productos.php">Gestionar Productos</a></li>
        <li><a href="../usuarios/logout.php">Cerrar Sesión</a></li>
    </ul>
</nav>

</header>

<h2>Panel de Administración</h2>
<p>Bienvenido, <?php echo htmlspecialchars($_SESSION["nombre_usuario"]); ?> (<?php echo $rol; ?>)</p>

<nav>
    <ul>
        <?php if ($rol === "admin"): ?>
            <li><a href="gestionar_usuarios.php">Gestionar Usuarios</a></li>
        <?php endif; ?>
        <li><a href="gestionar_productos.php">Gestionar Productos</a></li>
        <li><a href="../usuarios/logout.php">Cerrar Sesión</a></li>
    </ul>
</nav>
<?php include './includes/footer.php'; ?>
</body>
</html>
