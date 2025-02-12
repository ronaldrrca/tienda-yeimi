<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Cliente</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>

    <?php include "includes/header.php"; ?>

    <h2>Registrar Cliente</h2>

    <?php
    session_start();
    if (isset($_SESSION["error"])) {
        echo "<p style='color:red'>" . $_SESSION["error"] . "</p>";
        unset($_SESSION["error"]);
    }
    ?>

<form action="./includes/registrar_cliente.php" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" required>

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" required>

    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" required>

    <label for="contrasena">Contraseña:</label>
    <input type="password" name="contrasena" required>

    <button type="submit">Registrar</button>
</form>


    <?php include "includes/footer.php"; ?>

</body>
</html>
