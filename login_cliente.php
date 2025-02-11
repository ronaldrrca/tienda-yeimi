<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>
<?php include './includes/header.php' ?>

<h2>Iniciar Sesión</h2>

<?php if (isset($_GET["error"])): ?>
    <p style="color: red;">Usuario o contraseña incorrectos.</p>
<?php endif; ?>

<form action="./usuarios/procesar_cliente_login.php" method="POST">
    <label for="email">Correo Electrónico:</label>
    <input type="email" name="email" required>

    <label for="password">Contraseña:</label>
    <input type="password" name="password" required>

    <button type="submit">Ingresar</button>
</form>

<?php include './includes/footer.php'  ?>
</body>
</html>
