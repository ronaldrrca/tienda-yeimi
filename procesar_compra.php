<?php session_start();  ?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $producto["nombre"]; ?></title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>
    <?php include './includes/header.php' ?>
    <h1>Procesar comppra</h1>
    <?php include './includes/footer.php' ?>  
</body>
</html>