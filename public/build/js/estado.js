document.addEventListener("DOMContentLoaded", function () {
    // Aplicar el color inicial a todos los select
    document.querySelectorAll(".estado-select").forEach(select => {
        setColor(select);

        // Agregar el event listener para actualizar en la BD
        select.addEventListener("change", function () {
            let proyectoId = this.getAttribute("data-id");
            let estadoId = this.value;

            fetch(`/proyectos/estado/${proyectoId}`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify({ estado_id: estadoId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    setColor(this); 
                } else {
                    alert("Error al actualizar el estado.");
                }
            })
            .catch(error => console.error("Error:", error));
        });
    });
});

// Función para aplicar colores
function setColor(select) {
    const selectedOption = select.options[select.selectedIndex];
    const color = selectedOption.dataset.color || "black"; 

    // Aplicar color al texto del select
    select.style.color = getColor(color);

    // Aplicar color a las opciones
    Array.from(select.options).forEach(option => {
        const optionColor = option.dataset.color || "black";
        option.style.color = getColor(optionColor);
    });
}

// Función auxiliar para obtener colores
function getColor(nombre) {
    switch (nombre.toLowerCase()) {
        case "completado":
            return "red";
        case "iniciado":
            return "green";
        default:
            return "orange"; // Sin color (mantiene el estilo original)
    }
}