function openDetail(bateria,event) {
    toggleDetail();

    if (event && (
        event.target.closest('button.text-green-600') || // Botón editar
        event.target.closest('button.text-red-600') ||   // Botón eliminar
        event.target.closest('form')                     // Formularios
    )) {
        return; // Salir de la función sin mostrar detalles
    }
    
    // Llenar los datos
    document.getElementById('bateriaDetail').textContent = bateria.nombre_bateria || 'N/A';
    document.getElementById('costeDetail').textContent = bateria.coste || 'N/A';
    document.getElementById('capacidadDetail').textContent = bateria.capacidad || 'N/A';
    document.getElementById('descripcionDetail').textContent = bateria.descripcion || 'Sin descripción';
    
    const imgElement = document.getElementById('imagenPanel');
    if (bateria.imagen_bateria) {
        imgElement.src = bateria.imagen_bateria; 
        imgElement.style.display = 'block'; 
    } else {
        imgElement.style.display = 'none'; 
    }
    
    document.getElementById('garantiaMaterial').textContent = bateria.garantia_material || 'N/A';
    document.getElementById('garantiaFabricante').textContent = bateria.garantia_fabricante || 'N/A';
}

function toggleDetail() {
    document.getElementById('detail').classList.toggle('hidden');
}
