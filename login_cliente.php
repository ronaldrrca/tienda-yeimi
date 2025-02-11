<?php
session_start();
require_once "includes/conexion.php";


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>
    <?php include './includes/header.php' ?>
    <form action="usuarios/procesar_cliente_login.php" method="POST">
    <input type="email" name="email" required>
    <input type="password" name="password" required>
    
    <!-- Guardar la URL previa -->
    <input type="hidden" name="returnUrl" value="<?php echo isset($_GET['returnUrl']) ? htmlspecialchars($_GET['returnUrl']) : ''; ?>">
    
    <button type="submit">Iniciar sesión</button>
</form>


    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <?php include './includes/footer.php' ?>
</body>
</html>
