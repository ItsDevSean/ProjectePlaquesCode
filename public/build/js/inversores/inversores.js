function openDetail(inversor,event) {
    toggleDetail();

    if (event && (
        event.target.closest('button.text-green-600') || // Botón editar
        event.target.closest('button.text-red-600') ||   // Botón eliminar
        event.target.closest('form')                     // Formularios
    )) {
        return; // Salir de la función sin mostrar detalles
    }
    
    // Llenar los datos
    document.getElementById('inversorDetail').textContent = inversor.nombre_inversor || 'N/A';
    document.getElementById('potenciaDetail').textContent = inversor.potencia_nominal || 'N/A';
    document.getElementById('eficienciaDetail').textContent = inversor.eficiencia || 'N/A';
    document.getElementById('descripcionDetail').textContent = inversor.descripcion || 'Sin descripción';
    
    const imgElement = document.getElementById('imagenPanel');
    if (inversor.imagen_inversor) {
        imgElement.src = inversor.imagen_inversor; 
        imgElement.style.display = 'block'; 
    } else {
        imgElement.style.display = 'none'; 
    }
    
    document.getElementById('garantiaMaterial').textContent = inversor.garantia_material || 'N/A';
    document.getElementById('garantiaFabricante').textContent = inversor.garantia_fabricante || 'N/A';
}

function toggleDetail() {
    document.getElementById('detail').classList.toggle('hidden');
}
