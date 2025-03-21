document.addEventListener("DOMContentLoaded", function () {
    const projectRows = document.querySelectorAll('.project-row');
    const sidePanel = document.getElementById('sidePanel');
    const overlay = document.getElementById('overlay');
    const closeButton = document.querySelector('.close-btn');

    // Elementos del side panel
    const projectIdElement = document.getElementById('projectId');
    const projectNameElement = document.getElementById('projectName');
    const descriptionProjectElement = document.getElementById('descriptionProject');
    const clientNameElement = document.getElementById('clientName');
    const clientAddressElement = document.getElementById('clientAddress');
    const clientCityElement = document.getElementById('clientCity');
    const editProjectLink = document.getElementById('editProjectLink');
    const deleteProjectButton = document.getElementById('deleteProjectButton');
    const deleteProjectForm = document.getElementById('deleteProjectForm');

    projectRows.forEach(row => {
        row.addEventListener('click', function (event) {
            // Evita abrir el side panel si se hace clic en el select, en los botones de editar/eliminar o en el formulario de edición
            if (
                event.target.closest('select.estado-select') ||
                event.target.closest('.editProjectLink') ||
                event.target.closest('button.text-red-600') ||
                event.target.closest('form')
            ) {
                return;
            }

            const projectId = row.getAttribute('data-id');

            // Carga los detalles del proyecto
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
                        // Actualiza el contenido del side panel
                        projectIdElement.textContent = data.dadesClient.id;
                        projectNameElement.textContent = data.dadesClient.nombre_proyecto;
                        descriptionProjectElement.innerHTML = data.dadesClient?.descripcion_proyecto 
                            ? `<p>${data.dadesClient.descripcion_proyecto}</p>` 
                            : '<p style="color: gray; font-style: italic;">No hay descripción disponible.</p>';
                        clientNameElement.textContent = data.dadesClient?.nombre ?? 'No disponible';
                        clientAddressElement.textContent = data.dadesClient?.direccion ?? 'No disponible';
                        clientCityElement.textContent = data.dadesClient?.ciudad ?? 'No disponible';

                        // Actualiza los enlaces de editar y eliminar
                        editProjectLink.href = `/dades_clients/${projectId}/edit`;
                        deleteProjectForm.action = `/dades_clients/${projectId}`;

                        // Actualiza el botón de eliminar
                        deleteProjectButton.setAttribute('data-project-id', projectId);
                        deleteProjectButton.setAttribute('data-project-name', data.dadesClient.nombre_proyecto);

                        // Muestra el side panel
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

    // Cierra el side panel
    closeButton.addEventListener('click', closeSidePanel);
    overlay.addEventListener('click', closeSidePanel);

    // Evita que el side panel se cierre al hacer clic dentro de él
    sidePanel.addEventListener('click', function (event) {
        event.stopPropagation();
    });

    // Función para cerrar el side panel
    function closeSidePanel() {
        sidePanel.classList.remove('show');
        overlay.style.display = 'none';
    }

    // Maneja el clic en el botón de eliminar
    deleteProjectButton.addEventListener('click', function () {
        const projectId = deleteProjectButton.getAttribute('data-project-id');
        const projectName = deleteProjectButton.getAttribute('data-project-name');
        openModal(projectName, projectId);
    });
});
