let inversorNameToDelete = '';
let inversorIdToDelete = '';

function openModalElim(nombreInversor, idInversor,event) {
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
}

function closeModal() {
    document.getElementById('modalElim').classList.add('hidden');
}

function confirmDeletion() {
    const userInput = document.getElementById('confirmationDeleteInput').value;

    if (userInput === inversorNameToDelete) {
        document.getElementById('deleteInversorDeleteForm').submit();
    } else {
        alert('El nombre del inversor no coincide. Eliminación cancelada.');
    }
}


