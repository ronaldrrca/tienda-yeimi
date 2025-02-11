<?php
// session_start();
?>

<!-- <?php session_start(); ?> -->
<header>
    <h1>Mi Tienda</h1>
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="tienda.php">Tienda</a></li>
            <li><a href="carrito.php">Carrito</a></li>

            <?php if (!isset($_SESSION["id_cliente"]) && !isset($_SESSION["id_usuario"])): ?>
                <li><a href="formulario_cliente.php">Registrar</a></li>
            <?php endif; ?>
        </ul>

        <div>
            <?php if (isset($_SESSION["id_cliente"])): ?>
                <span>Bienvenido, <?php echo htmlspecialchars($_SESSION["nombre_cliente"]); ?></span>
                <a href="./usuarios/logout.php">Cerrar Sesión</a>

            <?php elseif (isset($_SESSION["id_usuario"])): ?>
                <span>Bienvenido, <?php echo htmlspecialchars($_SESSION["nombre_usuario"]); ?> (<?php echo $_SESSION["rol"]; ?>)</span>
                <a href="usuarios/logout.php">Cerrar Sesión</a>
                <a href="admin_panel.php">Panel de Administración</a>

            <?php else: ?>
                <a href="login_cliente.php">Iniciar Sesión Cliente</a>
                <a href="login_admin.php">Iniciar Sesión Admin</a>
            <?php endif; ?>
        </div>
    </nav>
</header>

