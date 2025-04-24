document.addEventListener("DOMContentLoaded", function() {
    const fabricanteModal = document.getElementById("fabricanteModal");
    const modalContent = fabricanteModal.querySelector('.modal-content');
    const crearFabricanteForm = document.getElementById("crearFabricanteForm");
    const fabricanteSelect = document.getElementById("fabricante_id");
    
    // Elementos para abrir/cerrar el modal
    const openFabricanteModalBtn = document.getElementById("openFabricanteModal");
    const closeFabricanteModalBtns = [
        document.getElementById("closeFabricanteModal"),
        document.getElementById("closeFabricanteModalBtn")
    ].filter(Boolean);

    // Tomamos las variables definidas en el window global
    const routeCrearFabricante = window.routeCrearFabricante;
    const csrfToken = window.csrfToken;

    // Inicialización
    setupModal();
    setupForm();

    function setupModal() {
        // Abrir modal
        console.log("si si claro, exacto " + openFabricanteModalBtn)
        if (openFabricanteModalBtn) {
            console.log("hi esto, eres invecil")

            openFabricanteModalBtn.addEventListener('click', () => {
                openModal();
            });
        }

        // Cerrar modal
        closeFabricanteModalBtns.forEach(button => {
            button.addEventListener('click', closeModal);
        });

        // Cerrar al hacer clic fuera del contenido
        console.log("va marc q tienes faenas con la bd " + fabricanteModal);
        fabricanteModal.addEventListener('click', (e) => {
            if (e.target === fabricanteModal) closeModal();
        });

        // Cerrar con Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !fabricanteModal.classList.contains('hidden')) {
                closeModal();
            }
        });
    }

    function setupForm() {
        if (!crearFabricanteForm) return;

        crearFabricanteForm.addEventListener("submit", function(event) {
            event.preventDefault();
            
            // Mostrar estado de carga
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Creando...
            `;
            submitBtn.disabled = true;

            fetch(routeCrearFabricante, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                    "Accept": "application/json"
                },
                body: JSON.stringify({
                    nombre: document.getElementById("nombre_fabricante").value
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    closeModal();
                    document.getElementById("nombre_fabricante").value = "";

                    // Agregar el nuevo fabricante al select
                    const newOption = document.createElement("option");
                    newOption.value = data.fabricante.id;
                    newOption.textContent = data.fabricante.nombre;
                    fabricanteSelect.appendChild(newOption);
                    fabricanteSelect.value = data.fabricante.id;

                    // Mostrar notificación de éxito
                    showNotification('Fabricante creado con éxito', 'success');
                } else {
                    throw new Error(data.message || 'Error al crear el fabricante');
                }
            })
            .catch(error => {
                console.error("Error:", error);
                showNotification(error.message || 'Error al crear el fabricante', 'error');
            })
            .finally(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        });
    }

    function openModal() {
        document.getElementById("nomManudfacturer").value = "";
        fabricanteModal.classList.remove("hidden");
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeModal() {
        console.log("me la pela chaval no me vas a contestar ")
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            fabricanteModal.classList.add("hidden");
        }, 300);
    }

});