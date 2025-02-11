<?php
session_start();
require_once "../includes/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Buscar al cliente por su email
    $stmt = $conexion->prepare("SELECT id_cliente, nombre_cliente, contrasena_cliente FROM clientes WHERE email_cliente = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {
        $cliente = $resultado->fetch_assoc();
        
        // Verificar si la contraseña es correcta
        if (password_verify($password, $cliente["contrasena_cliente"])) {
            $_SESSION["id_cliente"] = $cliente["id_cliente"];
            $_SESSION["nombre_cliente"] = $cliente["nombre_cliente"];
            header("Location: ../index.php");
            exit();
        }
    }

    // Si el login falla, redirigir con un mensaje de error
    header("Location: ../login.php?error=1");
    exit();
}
?>
