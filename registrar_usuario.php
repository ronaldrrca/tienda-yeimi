<?php
session_start();
require_once "includes/conexion.php";

// Verificar si el usuario es admin
if (!isset($_SESSION["id_usuario"]) || $_SESSION["rol"] !== "admin") {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $usuario = trim($_POST["usuario"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $rol = $_POST["rol"]; // admin o vendedor

    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre_usuario, usuario_usuario, password_usuario, rol_usuario) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre, $usuario, $password, $rol);
    
    if ($stmt->execute()) {
        echo "Usuario registrado correctamente.";
    } else {
        echo "Error al registrar usuario.";
    }
    
    $stmt->close();
}
?>

<form action="" method="POST">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="text" name="usuario" placeholder="Usuario" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <select name="rol">
        <option value="admin">Administrador</option>
        <option value="vendedor">Vendedor</option>
    </select>
    <button type="submit">Registrar</button>
</form>
