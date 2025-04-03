function openDetail(bateria,event) {
    toggleDetail();

    if (event && (
        event.target.closest('button.text-green-600') || // Botón editar
        event.target.closest('button.text-red-600') ||   // Botón eliminar
        event.target.closest('form')                     // Formularios
    )) {
        return; // Salir de la función sin mostrar detalles
    }
    
    function setDetailValue(elementId, value, defaultValue = 'N/A') {
        const element = document.getElementById(elementId);
        if (element) element.textContent = value || defaultValue;
    }

    // Asignar todos los valores
    setDetailValue('bateriaDetail', bateria.nombre_bateria);
    setDetailValue('costeDetail', bateria.coste);
    setDetailValue('capacidadDetail', bateria.capacidad);
    setDetailValue('descripcionDetail', bateria.descripcion, 'Sin descripción');
    setDetailValue('garantiaMaterial', bateria.garantia_material);
    setDetailValue('garantiaFabricante', bateria.garantia_fabricante);
    setDetailValue('idReferencia', bateria.id_referencia);

    const imgElement = document.getElementById('imagenPanel');
    if (imgElement) {
        if (bateria.imagen_bateria) {
            imgElement.src = bateria.imagen_bateria;
            imgElement.style.display = 'block';
        } else {
            imgElement.style.display = 'none';
        }
    }
}

function toggleDetail() {
    document.getElementById('detail').classList.toggle('hidden');
}
