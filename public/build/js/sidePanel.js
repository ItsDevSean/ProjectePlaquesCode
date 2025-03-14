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
    const deleteProjectForm = document.getElementById('deleteProjectForm');
    const deleteProjectButton = document.getElementById('deleteProjectButton');

    // Función para actualizar el side panel con datos de la fila
    function updateSidePanelFromRow(row) {
        const projectId = row.getAttribute('data-id');
        const projectName = row.querySelector('td:nth-child(4)').textContent; // Nombre del proyecto
        const clientName = row.querySelector('td:nth-child(3)').textContent; // Nombre del cliente
        const description = row.getAttribute('data-description'); // Descripción del proyecto
        const clientAddress = row.getAttribute('data-address'); // Dirección del cliente
        const clientCity = row.getAttribute('data-city'); // Ciudad del cliente

        // Actualiza el contenido del side panel
        projectIdElement.textContent = projectId;
        projectNameElement.textContent = projectName;
        clientNameElement.textContent = clientName || 'No disponible';
        descriptionProjectElement.innerHTML = description 
            ? `<p>${description}</p>` 
            : '<p style="color: gray; font-style: italic;">No hay descripción disponible.</p>';
        clientAddressElement.textContent = clientAddress || 'No disponible';
        clientCityElement.textContent = clientCity || 'No disponible';

        // Actualiza los enlaces de editar y eliminar
        editProjectLink.href = `/dades_clients/${projectId}/edit`;
        deleteProjectForm.action = `/dades_clients/${projectId}`;
        deleteProjectButton.setAttribute('onclick', `openModal('${projectName}', '${projectId}')`);
        deleteProjectButton.classList.remove('hidden');

        // Muestra el side panel
        sidePanel.classList.add('show');
        overlay.style.display = 'block';
    }

    // Función para cargar los detalles del proyecto desde el servidor
    function loadProjectDetails(projectId) {
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
                    deleteProjectButton.setAttribute('onclick', `openModal('${data.dadesClient.nombre_proyecto}', '${projectId}')`);
                    deleteProjectButton.classList.remove('hidden');

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
    }

    // Evento para abrir el side panel al hacer clic en una fila
    projectRows.forEach(row => {
        row.addEventListener('click', function (event) {
            // Evita abrir el side panel si se hace clic en un select o en los botones de editar/eliminar
            if (
                event.target.closest('select.estado-select') ||
                event.target.closest('.fas.fa-edit') ||
                event.target.closest('.fas.fa-trash-alt')
            ) {
                return;
            }

            const projectId = row.getAttribute('data-id');

            // Intenta actualizar el side panel desde los datos de la fila
            if (row.hasAttribute('data-description') && row.hasAttribute('data-address') && row.hasAttribute('data-city')) {
                updateSidePanelFromRow(row);
            } else {
                // Si no hay datos en la fila, carga los detalles desde el servidor
                loadProjectDetails(projectId);
            }
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
});