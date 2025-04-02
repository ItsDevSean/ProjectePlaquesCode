let inversorNameToDelete = '';
let inversorIdToDelete = '';

function openModalElim(nombreInversor, idInversor, event) {
    if (event) {
        event.stopPropagation();
    }
    inversorNameToDelete = nombreInversor;
    inversorIdToDelete = idInversor;
    document.getElementById('inversorName').textContent = nombreInversor;

    // Establecer correctamente la URL de eliminación
    document.getElementById('deleteInversorDeleteForm').action = "/inversores/" + idInversor;

    // Mostrar el modal
    document.getElementById('modalElim').classList.remove('hidden');

    // Desactivar el botón al abrir el modal
    document.getElementById('confirmDeleteButton').disabled = true;
}

function closeModal() {
    document.getElementById('modalElim').classList.add('hidden');
}

function validateDeletionInput() {
    const userInput = document.getElementById('confirmationInput').value;
    const confirmButton = document.getElementById('confirmDeleteButton');

    // Habilitar el botón solo si el nombre coincide
    confirmButton.disabled = userInput !== inversorNameToDelete;
}

function confirmDeletion() {
    document.getElementById('deleteInversorDeleteForm').submit();
}
