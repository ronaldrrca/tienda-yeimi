document.addEventListener("DOMContentLoaded", function() {
    function actualizarCantidad(idProducto, accion) {
        fetch("carrito/actualizar_carrito.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `id=${idProducto}&accion=${accion}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById(`cantidad-${idProducto}`).textContent = data.cantidad;
                document.getElementById(`subtotal-${idProducto}`).textContent = `$${data.subtotal}`;
            } else {
                alert(data.error);
            }
        })
        .catch(error => console.error("Error:", error));
    }

    document.querySelectorAll(".btn-mas").forEach(button => {
        button.addEventListener("click", function() {
            let idProducto = this.getAttribute("data-id");
            actualizarCantidad(idProducto, "aumentar");
        });
    });

    document.querySelectorAll(".btn-menos").forEach(button => {
        button.addEventListener("click", function() {
            let idProducto = this.getAttribute("data-id");
            actualizarCantidad(idProducto, "disminuir");
        });
    });
});

