<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idProducto = $_POST["id_producto"];
    $cantidad = $_POST["cantidad"];

    // Verificar si el carrito ya tiene el producto
    if (isset($_SESSION["carrito"][$idProducto])) {
        $_SESSION["carrito"][$idProducto] += $cantidad;
    } else {
        $_SESSION["carrito"][$idProducto] = $cantidad;
    }
    // echo $idProducto;
    // echo $cantidad;die();
    header("Location: ../carrito.php");
    exit();
}
/*
Guarda los productos en $_SESSION["carrito"] con idProducto como clave y la cantidad como valor.
Si el producto ya está en el carrito, aumenta la cantidad en lugar de sobrescribirla.
Redirige al usuario a carrito.php después de añadir un producto.
*/
?>
