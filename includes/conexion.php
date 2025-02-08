<?php
// Datos de conexión a MySQL
$servidor = "localhost"; // O "127.0.0.1"
$usuario = "root";       // Usuario de MySQL
$clave = "";             // Contraseña (vacía si no has configurado una)
$base_datos = "tienda";  // Nombre de la base de datos

// Crear conexión
$conexion = new mysqli($servidor, $usuario, $clave, $base_datos);

// Verificar si hay errores en la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
// Establecer codificación de caracteres
$conexion->set_charset("utf8");

?>
