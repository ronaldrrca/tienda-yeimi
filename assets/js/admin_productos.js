document.addEventListener("DOMContentLoaded", function () {
    const mensajeDiv = document.createElement("div");
    mensajeDiv.id = "mensaje";
    mensajeDiv.style.display = "none";
    mensajeDiv.style.padding = "10px";
    mensajeDiv.style.textAlign = "center";
    mensajeDiv.style.position = "fixed";
    mensajeDiv.style.top = "10px";
    mensajeDiv.style.left = "50%";
    mensajeDiv.style.transform = "translateX(-50%)";
    mensajeDiv.style.borderRadius = "5px";
    mensajeDiv.style.color = "white";
    mensajeDiv.style.zIndex = "1000";
    document.body.appendChild(mensajeDiv);

    function mostrarMensaje(mensaje, tipo) {
        mensajeDiv.innerText = mensaje;
        mensajeDiv.style.display = "block";
        mensajeDiv.style.backgroundColor = tipo === "success" ? "#28a745" : "#dc3545";
        setTimeout(() => {
            mensajeDiv.style.display = "none";
        }, 3000);
    }

    document.querySelectorAll(".editar").forEach(boton => {
        boton.addEventListener("click", function () {
            document.getElementById("formTitle").innerText = "Editar Producto";
            document.getElementById("id_producto").value = this.dataset.id;
            document.getElementById("nombre").value = this.dataset.nombre;
            document.getElementById("precio").value = this.dataset.precio;
            document.getElementById("imagen_actual").value = this.dataset.imagen;
            
            const cancelarEdicion = document.getElementById("cancelarEdicion");
            if (cancelarEdicion) {
                cancelarEdicion.style.display = "inline-block";
            }
        });
    });

    document.querySelectorAll(".eliminar").forEach(boton => {
        boton.addEventListener("click", function () {
            if (!confirm("¿Estás seguro de que deseas eliminar este producto?")) return;
            let formData = new FormData();
            formData.append("id", this.dataset.id);
            formData.append("eliminar", "true");

            fetch("gestionar.php", {
                method: "POST",
                body: formData,
            })
            .then(response => response.text())
            .then(text => {
                console.log("Respuesta del servidor:", text);
                try {
                    return JSON.parse(text);
                } catch (error) {
                    console.error("Error al convertir la respuesta en JSON:", error);
                    throw new Error("La respuesta del servidor no es un JSON válido");
                }
            })
            .then(data => {
                if (data.success) {
                    mostrarMensaje("✅ " + data.message, "success");
                    setTimeout(() => location.reload(), 1000);
                } else {
                    mostrarMensaje("❌ " + data.message, "error");
                }
            })
            .catch(error => {
                console.error("Error en la solicitud:", error);
                mostrarMensaje("⚠ Error en la solicitud.", "error");
            });
        });
    });

    document.getElementById("formProducto").addEventListener("submit", function (event) {
        event.preventDefault();
        let formData = new FormData(this);
        formData.append("editar", "true");
        let url = "productos/gestionar.php"; // Cambia esto por la URL correcta
        
        let options = {
            method: "POST",
            body: formData
        };

        fetch(url, options)
        .then(response => response.text())
        .then(data => {
            console.log("Respuesta del servidor:", data);
            return JSON.parse(data);
        })
        .then(json => {
            console.log("JSON recibido:", json);
        })
        .catch(error => console.error("Error al procesar JSON:", error));
    });

    const cancelarEdicion = document.getElementById("cancelarEdicion");
    if (cancelarEdicion) {
        cancelarEdicion.addEventListener("click", function () {
            document.getElementById("formProducto").reset();
            document.getElementById("id_producto").value = "";
            document.getElementById("imagen_actual").value = "";
            document.getElementById("formTitle").innerText = "Agregar Nuevo Producto";
            this.style.display = "none";
        });
    }
});
