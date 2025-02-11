<?php
session_start();
require_once "includes/conexion.php";

// Verificar si el usuario es admin
if (!isset($_SESSION["id_usuario"]) || $_SESSION["rol"] !== "admin") {
    header("Location: ../index.php");
    exit();
}

$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;
$nombre = $usuario = $rol = "";

if ($id) {
    $stmt = $conexion->prepare("SELECT nombre_usuario, usuario_usuario, rol_usuario FROM usuarios WHERE id_usuario = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($resultado->num_rows == 1) {
        $usuario_data = $resultado->fetch_assoc();
        $nombre = $usuario_data["nombre_usuario"];
        $usuario = $usuario_data["usuario_usuario"];
        $rol = $usuario_data["rol_usuario"];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $id ? "Editar Usuario" : "Agregar Usuario"; ?></title>
</head>
<body>
    <h2><?php echo $id ? "Editar Usuario" : "Agregar Usuario"; ?></h2>
    <form action="./usuarios/procesar_usuario.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required><br>
        <label>Usuario:</label>
        <input type="text" name="usuario" value="<?php echo htmlspecialchars($usuario); ?>" required><br>
        <label>Rol:</label>
        <select name="rol" required>
            <option value="admin" <?php echo $rol == "admin" ? "selected" : ""; ?>>Admin</option>
            <option value="vendedor" <?php echo $rol == "vendedor" ? "selected" : ""; ?>>Vendedor</option>
        </select><br>
        <?php if (!$id): ?>
            <label>Contraseña:</label>
            <input type="password" name="password" required><br>
        <?php endif; ?>
        <button type="submit"><?php echo $id ? "Actualizar" : "Crear"; ?></button>
        <a href="admin_usuarios.php">Cancelar</a>
    </form>
</body>
</html>
