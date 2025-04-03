// Configuración del modal de detalle
function setupDetailModal() {
    const detailModal = document.getElementById('detail');
    const detailModalContent = detailModal.querySelector('.modal-content');
    const closeDetailButtons = [
        detailModal.querySelector('[onclick="toggleDetail()"]'),
        // Agrega otros botones de cierre si los tienes
    ].filter(Boolean);

    // Asignar eventos a los botones de cierre
    closeDetailButtons.forEach(button => {
        button.addEventListener('click', closeDetail);
    });

    // Cerrar al hacer clic fuera del contenido
    detailModal.addEventListener('click', (e) => {
        if (e.target === detailModal) {
            closeDetail();
        }
    });
}

// Función para cerrar el detalle
function closeDetail() {
    const modal = document.getElementById('detail');
    const modalContent = modal.querySelector('.modal-content');
    
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

// Función para mostrar/ocultar el detalle
function toggleDetail() {
    const modal = document.getElementById('detail');
    
    if (modal.classList.contains('hidden')) {
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.querySelector('.modal-content').classList.remove('scale-95', 'opacity-0');
            modal.querySelector('.modal-content').classList.add('scale-100', 'opacity-100');
        }, 10);
    } else {
        closeDetail();
    }
}

// Función para abrir el detalle con datos
function openDetail(bateria, event) {
    if (event && (
        event.target.closest('button.text-green-600') || // Botón editar
        event.target.closest('button.text-red-600') ||   // Botón eliminar
        event.target.closest('form')                     // Formularios
    )) {
        return; // Salir de la función sin mostrar detalles
    }

    // Asignar valores a los campos
    const fields = {
        'bateriaDetail': bateria.nombre_bateria,
        'capacidadDetail': `${bateria.capacidad} kWh`,
        'costeDetail': `${bateria.coste} €`,
        'garantiaMaterial': `${bateria.garantia_material} años`,
        'garantiaFabricante': `${bateria.garantia_fabricante} años`,
        'idReferencia': bateria.id_referencia || 'N/A',
        'descripcionDetail': bateria.descripcion || 'No hay descripción disponible'
    };

    Object.entries(fields).forEach(([id, value]) => {
        const element = document.getElementById(id);
        if (element) element.textContent = value;
    });

    // Manejar la imagen
    const imgElement = document.getElementById('imagenPanel');
    if (imgElement) {
        if (bateria.imagen_bateria) {
            imgElement.src = bateria.imagen_bateria;
            imgElement.classList.remove('hidden');
        } else {
            imgElement.src = '';
            imgElement.classList.add('hidden');
        }
    }

    // Mostrar el modal
    toggleDetail();
}

// Inicialización cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    setupDetailModal();
    
    // Cerrar con tecla Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !document.getElementById('detail').classList.contains('hidden')) {
            closeDetail();
        }
    });
});