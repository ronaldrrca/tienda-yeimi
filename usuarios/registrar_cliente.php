<?php
session_start();
require_once "includes/conexion.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $email = trim($_POST["email"]);
    $telefono = trim($_POST["telefono"]);
    $direccion = trim($_POST["direccion"]);
    $contrasena = trim($_POST["contrasena"]);

    // Validar que los campos no estén vacíos
    if (empty($nombre) || empty($email) || empty($telefono) || empty($direccion) || empty($contrasena)) {
        $_SESSION["error"] = "Todos los campos son obligatorios.";
        header("Location: formulario_cliente.php");
        exit();
    }

    // Verificar si el email ya está registrado
    $stmt = $conexion->prepare("SELECT id_cliente FROM clientes WHERE email_cliente = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $_SESSION["error"] = "El correo ya está registrado.";
        header("Location: formulario_cliente.php");
        exit();
    }
    $stmt->close();

    // Hashear la contraseña antes de guardarla
    $contrasenaHasheada = password_hash($contrasena, PASSWORD_DEFAULT);

    // Insertar el cliente en la base de datos
    $stmt = $conexion->prepare("INSERT INTO clientes (nombre_cliente, email_cliente, telefono_cliente, direccion_cliente, contrasena_cliente) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nombre, $email, $telefono, $direccion, $contrasenaHasheada);

    if ($stmt->execute()) {
        $_SESSION["mensaje"] = "Cliente registrado con éxito.";
        header("Location: index.php");
    } else {
        $_SESSION["error"] = "Hubo un error al registrar el cliente.";
        header("Location: formulario_cliente.php");
    }

    $stmt->close();
    $conexion->close();
}
?>
