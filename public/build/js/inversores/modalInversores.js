document.addEventListener("DOMContentLoaded", function() {
    // Configuración del modal
    const modal = document.getElementById("modal");
    const modalContent = modal.querySelector('.modal-content');
    const inversorForm = document.getElementById("inversorForm");
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
        if (!inversorForm) return;

        inversorForm.addEventListener("submit", async function(e) {
            e.preventDefault();
            
            try {
                // Validación adicional podría ir aquí
                if (!this.checkValidity()) {
                    this.reportValidity();
                    return;
                }

                const submitBtn = this.querySelector('button[type="submit"]');
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
        const imagenInput = document.getElementById('imagen_inversor');
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
        document.querySelectorAll('[data-edit-inversor]').forEach(btn => {
            btn.addEventListener('click', function() {
                const inversorData = JSON.parse(this.dataset.inversor || '{}');
                const inversorId = this.dataset.inversorId;
                prepareEditForm(inversorData, inversorId);
                openModal();
            });
        });
    }


    function resetForm() {
        inversorForm.reset();
        inversorForm.action = inversoresStoreRoute;
        inversorForm.querySelector('[name="_method"]').value = "POST";
        submitButtonText.textContent = "Crear Inversor";
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

    // Función global para edición
    window.openEditModal = function(inversor, event) {
        if (event) event.stopPropagation();
        
        // Configurar el formulario para edición
        inversorForm.action = `/inversores/${inversor.id}`;
        inversorForm.querySelector('[name="_method"]').value = "PUT";
        submitButtonText.textContent = "Actualizar Inversor";
    
        // Rellenar campos del formulario
        const fieldsToFill = [
            'nombre_inversor', 
            'potencia_nominal', 
            'eficiencia', 
            'tipo_instalacion',
            'garantia_material', 
            'garantia_fabricante', 
            'id_referencia', 
            'fabricante_id',
            'microinversor',
            'descripcion'
        ];
    
        fieldsToFill.forEach(field => {
            const input = inversorForm.querySelector(`[name="${field}"]`);
            if (input && inversor[field] !== undefined) {
                input.value = inversor[field];
            }
        });
    
        // Select de fabricante
        if (inversor.fabricante_id) {
            const fabricanteSelect = document.getElementById('fabricante');
            if (fabricanteSelect) {
                fabricanteSelect.value = inversor.fabricante_id;
            }
        }
    
        // Imagen existente
        if (inversor.imagen_inversor) {
            preview.src = inversor.imagen_inversor;
            preview.classList.remove('hidden');
        } else {
            preview.src = '';
            preview.classList.add('hidden');
        }
    
        // Abrir el modal
        modal.classList.remove("hidden");
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    };
});