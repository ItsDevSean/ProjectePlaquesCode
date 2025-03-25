let bateriaNameToDelete = '';
let bateriaIdToDelete = '';

function openModalElim(nombrebateria, idbateria,event) {
    if (event) {
        event.stopPropagation();
    }
    bateriaNameToDelete = nombrebateria;
    bateriaIdToDelete = idbateria;
    document.getElementById('bateriaName').textContent = nombrebateria;

    // Establecer correctamente la URL de eliminación
    document.getElementById('deletebateriaDeleteForm').action = "/baterias/" + idbateria;

    // Mostrar el modal
    document.getElementById('modalElim').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('modalElim').classList.add('hidden');
}

function confirmDeletion() {
    const userInput = document.getElementById('confirmationDeleteInput').value;

    if (userInput === bateriaNameToDelete) {
        document.getElementById('deletebateriaDeleteForm').submit();
    } else {
        alert('El nombre del bateria no coincide. Eliminación cancelada.');
    }
}


