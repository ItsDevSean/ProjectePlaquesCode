// Habilitar/deshabilitar botón de confirmación según coincidencia
document.getElementById('confirmationInput').addEventListener('input', function() {
    const projectName = document.getElementById('projectoName').textContent;
    const confirmButton = document.getElementById('confirmDeleteButton');
    confirmButton.disabled = this.value !== projectName;
});

function closeSidePanel() {
    document.getElementById('overlay').classList.add('hidden');
    document.getElementById('sidePanel').classList.remove('translate-x-0');
    document.getElementById('sidePanel').classList.add('translate-x-full');
}


function openModal(projectName, projectId) {
    document.getElementById('projectoName').textContent = projectName;
    document.getElementById('deleteProjectForm').action = `/dades_clients/${projectId}`;
    document.getElementById('modal').classList.remove('hidden');
    document.getElementById('confirmationInput').value = '';
    document.getElementById('confirmDeleteButton').disabled = true;
}



function closeModal() {
    document.getElementById('modal').classList.add('hidden');
}

function confirmDeletion() {
    document.getElementById('deleteProjectForm').submit();
}

