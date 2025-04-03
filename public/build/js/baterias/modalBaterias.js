// Define la función en el ámbito global
window.openEditModal = function(bateria, event) {
    if (event) event.stopPropagation();
    
    const modal = document.getElementById("modal");
    const modalContent = modal.querySelector('.modal-content');
    const bateriaForm = document.getElementById("bateriaForm");
    const preview = document.getElementById("preview");
    const submitButtonText = document.getElementById("submitButtonText");

    if (!bateria || !bateria.id) {
        console.error("Datos de batería no válidos:", bateria);
        return;
    }

    bateriaForm.action = `${window.bateriasStoreRoute}/${bateria.id}`;
    bateriaForm.querySelector('[name="_method"]').value = "PUT";
    submitButtonText.textContent = "Actualizar Batería";

    // Campos a rellenar
    const fields = {
        'nombre_bateria': bateria.nombre_bateria,
        'capacidad': bateria.capacidad,
        'coste': bateria.coste,
        'descripcion': bateria.descripcion,
        'garantia_material': bateria.garantia_material,
        'garantia_fabricante': bateria.garantia_fabricante,
        'id_referencia': bateria.id_referencia,
        'fabricante_id': bateria.fabricante_id
    };

    Object.entries(fields).forEach(([name, value]) => {
        const input = bateriaForm.querySelector(`[name="${name}"]`);
        if (input && value !== undefined) input.value = value;
    });

    // Imagen existente
    if (bateria.imagen_bateria) {
        preview.src = bateria.imagen_bateria;
        preview.classList.remove('hidden');
    } else {
        preview.src = '';
        preview.classList.add('hidden');
    }

    // Abrir modal
    modal.classList.remove("hidden");
    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
};
document.addEventListener("DOMContentLoaded", function() {
    // Configuración del modal
    const modal = document.getElementById("modal");
    const modalContent = modal.querySelector('.modal-content');
    const bateriaForm = document.getElementById("bateriaForm");
    const preview = document.getElementById("preview");
    const submitButtonText = document.getElementById("submitButtonText");
    
    // Elementos para abrir/cerrar el modal
    const openModalButtons = [
        document.getElementById("openModal"),
        ...document.querySelectorAll('[data-modal-toggle]')
    ].filter(Boolean);
    
    const closeModalButtons = [
        document.getElementById("closeModal"),
        document.getElementById("cancelButton")
    ].filter(Boolean);

    // Inicialización
    setupModal();
    setupForm();
    setupImagePreview();
    setupEditButtons();

    function setupModal() {
        // Abrir modal
        openModalButtons.forEach(button => {
            button.addEventListener('click', openModal);
        });

        // Cerrar modal
        closeModalButtons.forEach(button => {
            button.addEventListener('click', closeModal);
        });

        // Cerrar al hacer clic fuera del contenido
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeModal();
        });

        // Cerrar con Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });
    }

    function setupForm() {
        if (!bateriaForm) return;

        bateriaForm.addEventListener("submit", async function(e) {
            e.preventDefault();
            
            try {
                if (!this.checkValidity()) {
                    this.reportValidity();
                    return;
                }

                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    ${submitButtonText.textContent}...
                `;
                submitBtn.disabled = true;

                this.submit();
            } catch (error) {
                console.error("Error:", error);
                alert("Ocurrió un error al enviar el formulario. Por favor, inténtalo de nuevo.");
            }
        });
    }

    function setupImagePreview() {
        const imagenInput = document.getElementById('imagen_bateria');
        if (!imagenInput) return;

        imagenInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(this.files[0]);
            } else {
                preview.src = '';
                preview.classList.add('hidden');
            }
        });
    }

    function setupEditButtons() {
        document.querySelectorAll('[data-edit-bateria]').forEach(btn => {
            btn.addEventListener('click', function() {
                const bateriaData = JSON.parse(this.dataset.bateria || '{}');
                openEditModal(bateriaData);
            });
        });
    }


    function resetForm() {
        bateriaForm.reset();
        bateriaForm.action = window.bateriasStoreRoute;
        bateriaForm.querySelector('[name="_method"]').value = "POST";
        submitButtonText.textContent = "Crear Batería";
        preview.src = '';
        preview.classList.add('hidden');
    }

    function openModal() {
        resetForm();
        modal.classList.remove("hidden");
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeModal() {
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add("hidden");
        }, 300);
    }
});