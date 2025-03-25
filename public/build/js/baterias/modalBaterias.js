document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById("modal");
    const bateriaForm = document.getElementById("bateriaForm");
    
    // Abrir modal
    document.getElementById("openModal")?.addEventListener("click", function() {
        bateriaForm.reset();
        bateriaForm.action = window.bateriasStoreRoute; 
        modal.classList.remove("hidden");
    });

    // Cerrar modal
    document.getElementById("closeModal")?.addEventListener("click", function() {
        modal.classList.add("hidden");
    });

    // Envío directo del formulario
    if (bateriaForm) {
        bateriaForm.addEventListener("submit", function(event) {
            event.preventDefault();
            
            // Envía el formulario tradicionalmente (recargará la página)
            this.submit();
        });
    }
});

// Función de edición simplificada
function openEditModal(bateria, event) {
    event?.stopPropagation();
    
    const form = document.getElementById("bateriaForm");
    form.action = `/baterias/${bateria.id}`;
    form.querySelector('[name="_method"]').value = "PUT";

    // Rellena los campos directamente
    form.nombre_bateria.value = bateria.nombre_bateria;
    form.capacidad.value = bateria.capacidad;
    form.coste.value = bateria.coste;
    form.descripcion.value = bateria.descripcion;
    form.garantia_material.value = bateria.garantia_material;
    form.garantia_fabricante.value = bateria.garantia_fabricante;
    form.id_referencia.value = bateria.id_referencia;
    form.fabricante_id.value = bateria.fabricante_id;

    // Imagen
    if (bateria.imagen_bateria) {
        form.imagen_bateria.value = bateria.imagen_bateria;
        document.getElementById("preview").src = bateria.imagen_bateria;
        document.getElementById("preview").classList.remove("hidden");
    }

    document.getElementById("modal").classList.remove("hidden");
}