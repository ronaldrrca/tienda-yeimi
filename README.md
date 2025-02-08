# Tienda-Yeimi

## Estructura de archivos
/tienda-yeimi/
│── /assets/
│   ├── /css/
│   │   ├── estilos.css
│   ├── /js/
│   │   ├── carrito.js
│   │   ├── /img_sitio/    
|           ├── logo.png
|       ├── /img_tienda/│   
|
│── /includes/
│   ├── conexion.php
│   ├── header.php
│   ├── footer.php
│   ├── funciones.php
│
│── /productos/
│   ├── agregar.php
│   ├── editar.php
│   ├── eliminar.php
│
│── /carrito/
│   ├── agregar.php
│   ├── ver.php
│   ├── eliminar.php
│   ├── procesar_compra.php
│
│── /usuarios/
│   ├── registro.php
│   ├── login.php
│   ├── logout.php
│
│── index.php
│── tienda.php
│── producto.php
│── checkout.php
│── gracias.php
│── .htaccess
│── config.php
│── README.md


## Explicación de los archivos
### Carpeta / Archivo           Descripción
/assets/	                    Contiene los recursos como CSS, JavaScript e imágenes.
/assets/css/estilos.css	        Archivo principal de estilos.
/assets/js/carrito.js	        JavaScript para la funcionalidad del carrito.
/assets/img_sitio/              logotipos, etc.
/assets/img_tienda/	            Carpeta de imágenes de productos. 
/includes/	                    Contiene archivos reutilizables como conexión y funciones.
/includes/conexion.php	        Conexión a la base de datos MySQL.
/includes/header.php	        Encabezado con menú de navegación.
/includes/footer.php	        Pie de página.
/includes/funciones.php	        Funciones reutilizables (agregar productos, formatear precios, etc.).
/productos/	                    CRUD de productos (agregar, editar, eliminar).
/carrito/	                    Funciones del carrito de compras.
/carrito/agregar.php	        Agregar productos al carrito.
/carrito/ver.php	            Ver productos en el carrito.
/carrito/eliminar.php	        Eliminar productos del carrito.
/carrito/procesar_compra.php	Procesar la compra y crear la orden.
/usuarios/	                    Manejo de usuarios.
/usuarios/registro.php	        Registro de usuarios.
/usuarios/login.php	            Inicio de sesión.
/usuarios/logout.php	        Cerrar sesión.
### Páginas principales	
index.php	                    Página de inicio.
tienda.php	                    Página donde se listan los productos.
producto.php	                Página individual del producto.
checkout.php	                Resumen del pedido antes de pagar.
gracias.php	                    Página de agradecimiento después de la compra.
### Otros	
                                .htaccess	Configuración de URLs amigables (opcional).
                                config.php	Configuración global (ruta de imágenes, moneda, etc.).
                                README.md	Explicación del proyecto.
