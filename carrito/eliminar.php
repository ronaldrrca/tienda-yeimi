<?php
session_start();

if (isset($_GET["id"])) {
    $idProducto = $_GET["id"];
    unset($_SESSION["carrito"][$idProducto]);
}

header("Location: ../carrito.php");
exit();
?>
