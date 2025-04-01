 // Añade animación al mostrar/ocultar
 function toggleDetailInversores() {
    const detail = document.getElementById('detailInversores');
    const container = document.getElementById('detailContainerInversores');
    
    if (detail.classList.contains('hiddenInversores')) {
        detail.classList.remove('hiddenInversores');
        setTimeout(() => {
            detail.classList.remove('opacity-0');
            container.classList.remove('scale-95', 'opacity-0');
            container.classList.add('scale-100', 'opacity-100');
        }, 10);
    } else {
        container.classList.remove('scale-100', 'opacity-100');
        container.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            detail.classList.add('hiddenInversores');
        }, 300);
    }
}