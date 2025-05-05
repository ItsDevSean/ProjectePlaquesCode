// Función para mostrar los detalles del proyecto haciendo una petición al backend
async function showProjectDetails(projectId) {
    // 1. Mostrar el overlay inmediatamente
    document.getElementById('overlay').classList.remove('hidden');

    const sidePanel = document.getElementById('sidePanel');
    // 2. Asegurarse de que el panel está inicialmente oculto antes de cargar datos
    sidePanel.classList.add('translate-x-full'); // Lo mantiene fuera de vista
    sidePanel.classList.remove('translate-x-0'); // Asegura que no está visible

    // Opcional: Mostrar un indicador de carga dentro del panel
    // Necesitas un elemento en tu HTML con id="sidePanelLoading" dentro de #sidePanel
    let loadingIndicator = document.getElementById('sidePanelLoading');
    if (!loadingIndicator) {
        // Si no existe, lo creamos (idealmente debería estar en tu HTML)
        loadingIndicator = document.createElement('div');
        loadingIndicator.id = 'sidePanelLoading';
        loadingIndicator.className = 'text-center py-8 text-gray-600 dark:text-gray-300'; // Clases de estilo Tailwind
        loadingIndicator.textContent = 'Cargando detalles...';
        sidePanel.appendChild(loadingIndicator);
    }
    // Mostrar el indicador de carga
    loadingIndicator.classList.remove('hidden');

    // Opcional: Ocultar el contenido principal del panel mientras carga
    // Necesitas envolver el contenido principal de tu panel en un div con id="sidePanelContent"
    const sidePanelContent = document.getElementById('sidePanelContent');
    if (sidePanelContent) {
        sidePanelContent.classList.add('hidden');
    }


    try {
        // 4. Hacer la petición al backend
        const response = await fetch(`/dades_clients/${projectId}/details`);

        // 5a. Ocultar el indicador de carga después de fetch (independientemente de éxito/fallo)
        loadingIndicator.classList.add('hidden');

        if (!response.ok) {
            const errorBody = await response.text();
            let errorDetail = `Error HTTP: ${response.status}`;
             try {
                const errorJson = JSON.parse(errorBody);
                errorDetail = errorJson.message || errorJson.error || errorDetail;
            } catch (e) {
                errorDetail = errorBody || errorDetail;
            }
            throw new Error(`Error al cargar los detalles: ${errorDetail}`);
        }

        const projectData = await response.json();

        // **Llenar los datos usando los nombres de clave CORRECTOS del JSON del backend**
        // Asegúrate que estos elementos existen en tu HTML *dentro* del div sidePanelContent
        document.getElementById('projectId').textContent = projectData.id;
        document.getElementById('projectName').textContent = projectData.nombre_proyecto || 'Sin nombre';
        document.getElementById('descriptionProject').textContent = projectData.descripcion_proyecto || 'Sin descripción';
        // 'estado' ya contiene el nombre del estado del backend
        document.getElementById('projectStatus').textContent = projectData.estado || 'Sin estado';
        document.getElementById('projectCreated').textContent = projectData.created_at || 'Sin fecha';
        document.getElementById('projectUpdated').textContent = projectData.updated_at || 'Sin fecha';

        // Datos del cliente - USAR LAS CLAVES client_name, client_address, etc.
        document.getElementById('clientName').textContent = projectData.client_name || 'Sin nombre';
        document.getElementById('clientAddress').textContent = projectData.client_address || 'Sin dirección';
        document.getElementById('clientCity').textContent = projectData.client_city || 'Sin ciudad';
        document.getElementById('clientContact').textContent = projectData.client_contact || 'Sin contacto';

        // Datos del usuario - USAR LAS CLAVES user_name, user_email
        document.getElementById('userName').textContent = projectData.user_name || 'Sin nombre';
        document.getElementById('userEmail').textContent = projectData.user_email || 'Sin email';
        document.getElementById('userPhotoContainer').textContent = projectData.profile_photo_path || 'Sin foto';
        
        // Gestión de la foto de perfil
        const userPhotoContainer = document.getElementById('userPhotoContainer');
        if (projectData.user_photo_path) {
            userPhotoContainer.innerHTML = `
                <img src="${projectData.user_photo_path}" 
                     alt="${projectData.user_name || 'Usuario'}" 
                     class="h-full w-full object-cover">`;
        } else {
            // Mostrar inicial si no hay foto
            const initial = projectData.user_name ? projectData.user_name.charAt(0).toUpperCase() : '?';
            userPhotoContainer.innerHTML = `
                <span class="text-emerald-600 font-medium">${initial}</span>`;
        }
        // Configurar acciones - usar projectData.id y projectData.nombre_proyecto
        const editLink = document.getElementById('editProjectLink');
        if(editLink) { // Verificar si el elemento existe
             editLink.href = `/dades_clients/${projectData.id}/edit`;
        }


        const deleteButton = document.getElementById('deleteProjectButton');
        // Asegurarse de que el botón de eliminar existe antes de añadir el listener
        if (deleteButton) {
             deleteButton.onclick = (e) => {
                e.stopPropagation();
                openModal(projectData.nombre_proyecto, projectData.id);
            };
        }


        // 5b. Mostrar el contenido principal ahora que está lleno
        if (sidePanelContent) {
            sidePanelContent.classList.remove('hidden');
        }

        // 5c. Iniciar la transición del panel IN solo DESPUÉS de que los datos están cargados
        sidePanel.classList.remove('translate-x-full');
        sidePanel.classList.add('translate-x-0');


    } catch (error) {
        // 6. Manejar el error: ocultar indicador, mostrar mensaje y mantener panel oculto
        loadingIndicator.classList.add('hidden');

        // Asegurarse de que el contenido principal está oculto si hubo un error antes de mostrarlo
         if (sidePanelContent) {
            sidePanelContent.classList.add('hidden');
        }

        console.error('Error en showProjectDetails:', error);
        // Mostrar mensaje de error dentro del panel en lugar de un alert
        if (loadingIndicator) { // Reutilizamos el área de carga para el mensaje de error
             loadingIndicator.textContent = 'Error al cargar: ' + error.message;
             loadingIndicator.classList.remove('hidden');
             // Opcional: Añadir un botón para cerrar el panel
        } else {
             // Si no hay área de carga, usar un alert y cerrar el panel
             alert('Error al cargar los detalles: ' + error.message);
             closeSidePanel();
        }
         // NO iniciar la transición del panel si hubo un error
        // sidePanel.classList.remove('translate-x-full'); // Asegurar que se queda oculto
        // sidePanel.classList.add('translate-x-0'); // NO hacer esto
    }
}

// Función para cerrar el panel lateral
function closeSidePanel() {
    document.getElementById('overlay').classList.add('hidden');
    const sidePanel = document.getElementById('sidePanel');
    sidePanel.classList.remove('translate-x-0');
    sidePanel.classList.add('translate-x-full');

    // Opcional: Limpiar el contenido del panel al cerrarlo para la próxima vez
    // document.getElementById('projectId').textContent = '-';
    // ... limpiar todos los elementos ...
    // Ocultar contenido principal y mostrar carga de nuevo si usas esa estructura
    const sidePanelContent = document.getElementById('sidePanelContent');
    if (sidePanelContent) {
        sidePanelContent.classList.add('hidden');
    }
     const loadingIndicator = document.getElementById('sidePanelLoading');
    if (loadingIndicator) {
        loadingIndicator.classList.remove('hidden');
         loadingIndicator.textContent = 'Cargando detalles...'; // Reset text
    }
}

// Habilitar/deshabilitar botón de confirmación según coincidencia
document.getElementById('confirmationInput').addEventListener('input', function() {
    // Asegurarse de que 'projectoName' existe (está en el modal, no en el panel lateral)
    const projectNameElement = document.getElementById('projectoName');
    const projectName = projectNameElement ? projectNameElement.textContent : '';
    const confirmButton = document.getElementById('confirmDeleteButton');
    if (confirmButton) {
        confirmButton.disabled = this.value !== projectName;
    }
});

// Función para abrir el modal de confirmación
function openModal(projectName, projectId) {
    // Asegurarse de que los elementos del modal existen
    const projectoNameElement = document.getElementById('projectoName');
    const deleteProjectForm = document.getElementById('deleteProjectForm');
    const modalElement = document.getElementById('modal');
    const confirmationInput = document.getElementById('confirmationInput');
    const confirmDeleteButton = document.getElementById('confirmDeleteButton');

    if (projectoNameElement) projectoNameElement.textContent = projectName;
    if (deleteProjectForm) deleteProjectForm.action = `/dades_clients/${projectId}`;
    if (modalElement) modalElement.classList.remove('hidden');
    if (confirmationInput) confirmationInput.value = '';
    if (confirmDeleteButton) confirmDeleteButton.disabled = true;
}

// Función para cerrar el modal
function closeModal() {
    const modalElement = document.getElementById('modal');
    if (modalElement) {
        modalElement.classList.add('hidden');
    }
}

// Función para confirmar la eliminación
function confirmDeletion() {
    const deleteProjectForm = document.getElementById('deleteProjectForm');
    if (deleteProjectForm) {
        deleteProjectForm.submit();
    }
}

// Cerrar modal al hacer clic fuera
document.getElementById('modal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

// Cerrar panel lateral al hacer clic en el overlay
document.getElementById('overlay')?.addEventListener('click', closeSidePanel);

// Evitar que el clic en el panel lateral cierre el overlay
document.getElementById('sidePanel')?.addEventListener('click', function(e) {
    e.stopPropagation();
});

