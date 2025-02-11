<?php
session_start();
require_once "../includes/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Definir returnUrl con un valor por defecto (index.php)
    $returnUrl = "/tienda-yeimi/index.php";  

    // Verificar si hay una URL de retorno válida
    if (!empty($_POST["returnUrl"])) {
        $returnUrl = urldecode($_POST["returnUrl"]);

        // Asegurar que la URL pertenece al mismo sitio (evita ataques de redirección)
        if (strpos($returnUrl, "/tienda-yeimi/") !== 0) {
            $returnUrl = "/tienda-yeimi/index.php"; 
        }
    }

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

            // Redirigir a la página deseada después de iniciar sesión
            header("Location: " . $returnUrl);
            exit();
        }
    }

    // Si el login falla, redirigir al login con error
    header("Location: ../login_cliente.php?error=1");
    exit();
}
?>
