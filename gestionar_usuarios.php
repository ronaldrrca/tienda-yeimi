<?php
session_start();
require_once "includes/conexion.php";

// Verificar si el usuario es admin
if (!isset($_SESSION["id_usuario"]) || $_SESSION["rol"] !== "admin") {
    header("Location: index.php");
    exit();
}

// Obtener lista de usuarios
$resultado = $conexion->query("SELECT * FROM usuarios ORDER BY id_usuario ASC");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>
<?php include "includes/header.php"; ?>
    <h2>Gestión de Usuarios</h2>
    <a href="form_usuario.php">Agregar Usuario</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
        <?php while ($usuario = $resultado->fetch_assoc()): ?>
        <tr>
            <td><?php echo $usuario["id_usuario"]; ?></td>
            <td><?php echo $usuario["nombre_usuario"]; ?></td>
            <td><?php echo $usuario["usuario_usuario"]; ?></td>
            <td><?php echo $usuario["rol_usuario"]; ?></td>
            <td>
                <a href="form_usuario.php?id=<?php echo $usuario['id_usuario']; ?>">Editar</a>
                <a href="procesar_usuario.php?id=<?php echo $usuario['id_usuario']; ?>&accion=eliminar" onclick="return confirm('¿Seguro que deseas eliminar este usuario?');">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <?php include "includes/footer.php"; ?>
</body>
</html>
