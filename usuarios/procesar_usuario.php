<?php
session_start();
require_once "../includes/conexion.php";

// Verificar si el usuario es admin
if (!isset($_SESSION["id_usuario"]) || $_SESSION["rol"] !== "admin") {
    header("Location: ../index.php");
    exit();
}

// Manejar eliminación de usuario
if (isset($_GET["accion"]) && $_GET["accion"] == "eliminar" && isset($_GET["id"])) {
    $id = intval($_GET["id"]);
    $stmt = $conexion->prepare("DELETE FROM usuarios WHERE id_usuario = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: admin_usuarios.php");
    exit();
}

// Manejar creación y edición de usuario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST["id"]);
    $nombre = trim($_POST["nombre"]);
    $usuario = trim($_POST["usuario"]);
    $rol = $_POST["rol"];

    if ($id) {
        // Editar usuario (sin cambiar la contraseña)
        $stmt = $conexion->prepare("UPDATE usuarios SET nombre_usuario = ?, usuario_usuario = ?, rol_usuario = ? WHERE id_usuario = ?");
        $stmt->bind_param("sssi", $nombre, $usuario, $rol, $id);
    } else {
        // Crear nuevo usuario (encriptar la contraseña)
        $password = password_hash(trim($_POST["password"]), PASSWORD_BCRYPT);
        $stmt = $conexion->prepare("INSERT INTO usuarios (nombre_usuario, usuario_usuario, password_usuario, rol_usuario) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $usuario, $password, $rol);
    }

    $stmt->execute();
    header("Location: ../admin_usuarios.php");
    exit();
}
?>
