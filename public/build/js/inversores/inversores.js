// Configuración del modal de detalle
function setupDetailModal() {
    const detailModal = document.getElementById('detail');

    const closeDetailButtons = [
        ...document.querySelectorAll('[onclick="toggleDetail()"]'),
    ].filter(Boolean);

    closeDetailButtons.forEach(button => {
        button.addEventListener('click', closeDetail);
    });

    detailModal.addEventListener('click', (e) => {
        if (e.target === detailModal) {
            closeDetail();
        }
    });
}

function closeDetail() {
    const modal = document.getElementById('detail');
    const modalContent = modal.querySelector('.modal-content');
    
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

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

function openDetail(inversor) {
    const fields = {
        'inversorDetail': inversor.nombre_inversor,
        'potenciaDetail': `${inversor.potencia_nominal} W`,
        'eficienciaDetail': `${inversor.eficiencia}%`,
        'fabricanteDetail': inversor.fabricante ? inversor.fabricante.nombre : 
                          (inversor.fabricante_id ? 'Fabricante no disponible' : 'N/A'),
        'tipoInstalacionDetail': inversor.tipo_instalacion || 'N/A',
        'garantiaMaterial': `${inversor.garantia_material} años`,
        'garantiaFabricante': `${inversor.garantia_fabricante} años`,
        'fechaCreacionDetail': new Date(inversor.created_at).toLocaleDateString(),
        'descripcionDetail': inversor.descripcion || 'No hay descripción disponible'
    };

    Object.entries(fields).forEach(([id, value]) => {
        const element = document.getElementById(id);
        if (element) element.textContent = value;
    });

    const imagenPanel = document.getElementById('imagenPanel');
    if (inversor.imagen_inversor) {
        imagenPanel.src = inversor.imagen_inversor;
        imagenPanel.classList.remove('hidden');
    } else {
        imagenPanel.src = '';
        imagenPanel.classList.add('hidden');
    }

    toggleDetail();
}

document.addEventListener('DOMContentLoaded', function() {
    setupDetailModal();
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !document.getElementById('detail').classList.contains('hidden')) {
            closeDetail();
        }
    });
});