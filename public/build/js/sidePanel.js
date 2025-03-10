document.addEventListener("DOMContentLoaded", function() {
    const projectRows = document.querySelectorAll('.project-row');
    const sidePanel = document.getElementById('sidePanel');
    const overlay = document.getElementById('overlay');
    const closeButton = document.querySelector('.close-btn');

    projectRows.forEach(row => {
        row.addEventListener('click', function(event) {
           
            if (event.target.closest('select.estado-select')) {
                return;
            }

            // Evita que el sidePanel se abra cuando se hace clic en el botón de eliminar
            if (event.target.closest('.fas.fa-trash-alt')) {
                return; // No hace nada si el clic es en el icono de eliminar
            }

            const projectId = row.getAttribute('data-id'); 

            fetch(`/dades_clients/${projectId}/details`) 
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la solicitud');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        sidePanel.querySelector('.side-panel-content').innerHTML = `<p>${data.error}</p>`;
                    } else {
                        const projectDetailsContent = `
                            <h3>Detalles del Proyecto</h3>
                            <p>ID del Proyecto: ${data.dadesClient.id}</p>
                            <p>Nombre del Proyecto: ${data.dadesClient.nombre_proyecto}</p>
                            <hr>
                            <h4>Datos del Cliente</h4>
                            <p>Nombre: ${data.dadesClient?.nombre ?? 'No disponible'}</p>
                            <p>Dirección: ${data.dadesClient?.direccion ?? 'No disponible'}</p>
                            <p>Ciudad: ${data.dadesClient?.ciudad ?? 'No disponible'}</p>
                            
                            <!-- Contenedor de los botones -->
                            <div class="buttons">
                                <a href="{{ route('dades_clients.edit', $proyecto->id) }}" class="text-green-600 hover:text-green-900 mr-3">
                                    <i class="fas fa-edit"></i> 
                                </a>
                                
                                <!-- Formulario de eliminación con icono -->
                                <form action="{{ route('dades_clients.destroy', $proyecto->id) }}" method="POST" class="inline-block mt-2" onsubmit="event.stopPropagation();">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash-alt"></i> 
                                    </button>
                                </form>
                            </div>
                        `;

                        sidePanel.querySelector('.side-panel-content').innerHTML = projectDetailsContent;
                        sidePanel.classList.add('show');
                        overlay.style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Error:', error); 
                    sidePanel.querySelector('.side-panel-content').innerHTML = `<p>Error al cargar los detalles del proyecto.</p>`;
                    sidePanel.classList.add('show');
                    overlay.style.display = 'block';
                });
        });
    });

    closeButton.addEventListener('click', function() {
        sidePanel.classList.remove('show');
        overlay.style.display = 'none';
    });

    overlay.addEventListener('click', function() {
        sidePanel.classList.remove('show');
        overlay.style.display = 'none';
    });

    document.addEventListener('click', function(event) {
        if (!sidePanel.contains(event.target) && !event.target.closest('.project-row') && !event.target.closest('#overlay')) {
            sidePanel.classList.remove('show');
            overlay.style.display = 'none';
        }
    });

    sidePanel.addEventListener('click', function(event) {
        event.stopPropagation();
    });
});