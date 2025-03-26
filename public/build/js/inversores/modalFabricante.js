document.addEventListener("DOMContentLoaded", function() {
    const fabricanteModal = document.getElementById("fabricanteModal");
    const openFabricanteModalBtn = document.getElementById("openFabricanteModal");
    const closeFabricanteModalBtn = document.getElementById("closeFabricanteModal");
    const closeFabricanteModalByButton = document.getElementById("closeFabricanteModalBtn");
    const crearFabricanteForm = document.getElementById("crearFabricanteForm");
    const fabricanteSelect = document.getElementById("fabricante");

    // Tomamos las variables definidas en el window global
    const routeCrearFabricante = window.routeCrearFabricante;
    const csrfToken = window.csrfToken;

    openFabricanteModalBtn.addEventListener("click", () => fabricanteModal.classList.remove("hidden"));
    closeFabricanteModalBtn.addEventListener("click", () => fabricanteModal.classList.add("hidden"));
    closeFabricanteModalByButton.addEventListener("click", () => fabricanteModal.classList.add("hidden"));

    crearFabricanteForm.addEventListener("submit", function(event) {
        event.preventDefault(); 

        fetch(routeCrearFabricante, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken  
            },
            body: JSON.stringify({
                nombre: document.getElementById("nombre_fabricante").value
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                fabricanteModal.classList.add("hidden");

                document.getElementById("nombre_fabricante").value = "";

                const newOption = document.createElement("option");
                newOption.value = data.fabricante.id;
                newOption.text = data.fabricante.nombre;
                fabricanteSelect.appendChild(newOption);

                fabricanteSelect.value = data.fabricante.id;
            } else {
                alert("Error al crear el fabricante.");
            }
        })
        .catch(error => {
            console.error("Error:", error);
        });
    });
});
