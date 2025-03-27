document.addEventListener("DOMContentLoaded", function() {
    // Selecciona todos los elementos necesarios
    const modal = document.getElementById("modal");
    const openModalBtn = document.getElementById("openModal");
    const closeModalBtn = document.getElementById("closeModal");
    const closeModalByButton = document.getElementById("closeModalBtn");
    const imagenInput = document.getElementById("imagen_inversor");
    const previewImg = document.getElementById("preview");
    const inversorForm = document.getElementById("inversorForm");
    const formMethod = document.getElementById("formMethod");
    
    // Solo añade event listeners si los elementos existen
    if (openModalBtn) {
        openModalBtn.addEventListener("click", () => {
            inversorForm.reset();
            inversorForm.action = document.querySelector('meta[name="store-route"]').content;
            formMethod.value = "POST";
            modal.classList.remove("hidden");
        });
    }

    if (closeModalBtn) closeModalBtn.addEventListener("click", () => modal.classList.add("hidden"));
    if (closeModalByButton) closeModalByButton.addEventListener("click", () => modal.classList.add("hidden"));

    if (imagenInput && previewImg) {
        imagenInput.addEventListener("change", function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    previewImg.src = event.target.result;
                    previewImg.classList.remove("hidden");
                };
                reader.readAsDataURL(file);
            }
        });
    }
});
function openEditModal(inversor, event) {
    if (event) {
        event.stopPropagation();
    }
    
    // Cambiar el action del formulario para la actualización
    const form = document.getElementById("inversorForm");
    form.action = `/inversores/${inversor.id}`; // Ajusta la ruta según tu configuración de Laravel
    document.getElementById("formMethod").value = "PUT"; // Cambia el método a PUT

    // Llenar los campos del modal con los datos del inversor
    document.getElementById("nombre_inversor").value = inversor.nombre_inversor;
    document.getElementById("eficiencia").value = inversor.eficiencia;
    document.getElementById("potencia_nominal").value = inversor.potencia_nominal;
    document.getElementById("descripcion").value = inversor.descripcion;
    document.getElementById("garantia_material").value = inversor.garantia_material;
    document.getElementById("garantia_fabricante").value = inversor.garantia_fabricante;
    document.getElementById("id_referencia").value = inversor.id_referencia;

    // Seleccionar el fabricante
    document.getElementById("fabricante").value = inversor.fabricante_id;

    // Seleccionar el tipo de instalación
    document.getElementById("tipo_instalacion").value = inversor.tipo_instalacion;

    // Seleccionar si es microinversor
    document.getElementById("microinversor").value = inversor.microinversor ? "1" : "0";

    // Imagen (si hay una imagen cargada)
    if (inversor.imagen_inversor) {
        document.getElementById("imagen_inversor").value = inversor.imagen_inversor;
        document.getElementById("preview").src = inversor.imagen_inversor;
        document.getElementById("preview").classList.remove("hidden");
    }

    // Mostrar el modal
    document.getElementById("modal").classList.remove("hidden");
}

// Para abrir el modal de creación sin datos
document.getElementById("openModal").addEventListener("click", function() {
    document.getElementById("inversorForm").reset();
    document.getElementById("inversorForm").action = "{{ route('inversores.store') }}";
    document.getElementById("formMethod").value = "POST";
    document.getElementById("modal").classList.remove("hidden");
});
document.getElementById("closeModal").addEventListener("click", function() {
    document.getElementById("modal").classList.add("hidden");
});    


