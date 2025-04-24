// Habilitar/deshabilitar botón de confirmación según coincidencia
// Función para mostrar los detalles del proyecto
function showProjectDetails(projectId) {
    // Encontrar la fila de la tabla que corresponde al proyecto clickeado
    const projectRow = document.querySelector(`.project-row[data-id="${projectId}"]`);
    
    if (!projectRow) {
        console.error("No se encontró el proyecto con ID:", projectId);
        return;
    }

    // Extraer los datos de las celdas de la fila
    const cells = projectRow.querySelectorAll('td');
    
    // Llenar el panel con los datos extraídos
    document.getElementById('projectId').textContent = projectId;
    document.getElementById('projectName').textContent = cells[3].querySelector('div:first-child').textContent;
    document.getElementById('descriptionProject').textContent = cells[3].querySelector('div:last-child').textContent;
    document.getElementById('projectStatus').textContent = cells[1].querySelector('select').value;
    document.getElementById('projectCreated').textContent = cells[5].querySelector('div:first-child').textContent;
    document.getElementById('projectUpdated').textContent = cells[5].querySelector('div:first-child').textContent; // Puedes ajustar esto si tienes updated_at
    
    // Datos del cliente
    document.getElementById('clientName').textContent = cells[2].textContent;
    document.getElementById('clientAddress').textContent = 'Sin dirección'; // Ajusta según tus datos
    document.getElementById('clientCity').textContent = 'Sin ciudad'; // Ajusta según tus datos
    document.getElementById('clientContact').textContent = 'Sin contacto'; // Ajusta según tus datos
    
    // Datos del usuario
    document.getElementById('userName').textContent = cells[0].querySelector('div:first-child').textContent;
    document.getElementById('userEmail').textContent = cells[0].querySelector('div:last-child').textContent;
    document.getElementById('userInitial').textContent = cells[0].querySelector('div:first-child').textContent.charAt(0);

    // Configurar enlaces de acción
    const editLink = document.getElementById('editProjectLink');
    editLink.href = `/dades_clients/${projectId}/edit`;

    // Configurar botón de eliminar
    const deleteButton = document.getElementById('deleteProjectButton');
    deleteButton.onclick = function(e) {
        e.stopPropagation();
        openModal(cells[3].querySelector('div:first-child').textContent, projectId);
    };

    // Mostrar panel
    document.getElementById('overlay').classList.remove('hidden');
    document.getElementById('sidePanel').classList.remove('translate-x-full');
    document.getElementById('sidePanel').classList.add('translate-x-0');
}

// Función para cerrar el panel lateral
function closeSidePanel() {
    document.getElementById('overlay').classList.add('hidden');
    document.getElementById('sidePanel').classList.remove('translate-x-0');
    document.getElementById('sidePanel').classList.add('translate-x-full');
}

// Habilitar/deshabilitar botón de confirmación según coincidencia
document.getElementById('confirmationInput').addEventListener('input', function() {
    const projectName = document.getElementById('projectoName').textContent;
    const confirmButton = document.getElementById('confirmDeleteButton');
    confirmButton.disabled = this.value !== projectName;
});

// Función para abrir el modal de confirmación
function openModal(projectName, projectId) {
    document.getElementById('projectoName').textContent = projectName;
    document.getElementById('deleteProjectForm').action = `/dades_clients/${projectId}`;
    document.getElementById('modal').classList.remove('hidden');
    document.getElementById('confirmationInput').value = '';
    document.getElementById('confirmDeleteButton').disabled = true;
}

// Función para cerrar el modal
function closeModal() {
    document.getElementById('modal').classList.add('hidden');
}

// Función para confirmar la eliminación
function confirmDeletion() {
    document.getElementById('deleteProjectForm').submit();
}

// Cerrar modal al hacer clic fuera
document.getElementById('modal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

// Cerrar panel lateral al hacer clic en el overlay
document.getElementById('overlay').addEventListener('click', closeSidePanel);

// Evitar que el clic en el panel lateral cierre el overlay
document.getElementById('sidePanel').addEventListener('click', function(e) {
    e.stopPropagation();
});
