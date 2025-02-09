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


## Explicación del Carrito de Compras:
✅ Cada cliente tiene su propio carrito: Se asocia con id_cliente.
✅ Los productos en el carrito incluyen: ID del producto, cantidad, precio y subtotal.
✅ Cuando el cliente finaliza la compra: Los datos se transfieren de Carrito a Ventas y Detalle_Ventas, y luego se eliminan del carrito.

## Proceso del Carrito de Compras:
1️⃣ El cliente agrega productos al carrito.
2️⃣ Puede modificar cantidades o eliminar productos.
3️⃣ Cuando confirma la compra, se crea un registro en Ventas y los productos pasan a Detalle_Ventas.
4️⃣ Se descuenta el stock en Productos y el carrito se vacía.

## Flujo del carrito de compras:
1️⃣ Desde producto.php, el usuario hace clic en "Añadir al carrito".
2️⃣ Se envía un formulario a carrito/agregar.php, que almacena el producto en la sesión.
3️⃣ Desde carrito.php, el usuario puede ver los productos añadidos y modificar cantidades.
4️⃣ Desde procesarCompra.php, se finaliza la compra y se guardan los datos en la base de datos.


agregar.php     
✅ Guarda los productos en $_SESSION["carrito"] con idProducto como clave y la cantidad como valor.
✅ Si el producto ya está en el carrito, aumenta la cantidad en lugar de sobrescribirla.
✅ Redirige al usuario a carrito.php después de añadir un producto.

carrito.php
✅ Recupera los productos guardados en $_SESSION["carrito"].
✅ Consulta la base de datos para obtener detalles como nombre, precio e imagen.
✅ Muestra una tabla con los productos en el carrito.
✅ Calcula el total y permite eliminar productos o finalizar la compra.

eliminar.php
✅ Elimina un producto del carrito con unset($_SESSION["carrito"][$idProducto]).
✅ Redirige nuevamente a carrito.php para actualizar la vista.