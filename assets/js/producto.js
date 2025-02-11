document.addEventListener("DOMContentLoaded", function() {
    let form = document.getElementById("formAgregarCarrito");

    if (form) {
        form.addEventListener("submit", function(event) {
            event.preventDefault();

            if (!usuarioLogueado) {
                let returnUrl = encodeURIComponent(window.location.href);
                window.location.href = "login_cliente.php?returnUrl=" + returnUrl;
                return;
            }

            let formData = new FormData(form);

            fetch("productos/agregar.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json()) // Asegurar que la respuesta es JSON
            .then(data => {
                if (data.success) {
                    document.getElementById("mensajeCarrito").style.display = "block";
                } else {
                    alert("Error: " + (data.error || "No se pudo agregar al carrito."));
                }
            })
            .catch(error => console.error("Error:", error));
        });
    }
});
