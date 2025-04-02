let bateriaNameToDelete = '';
let bateriaIdToDelete = '';

// Función para abrir el modal de eliminación
function openModalElim(nombreBateria, idBateria, event) {
    if (event) {
        event.stopPropagation();
        event.preventDefault();
    }
    
    bateriaNameToDelete = nombreBateria;
    bateriaIdToDelete = idBateria;
    
    // Actualizar el nombre en el modal
    document.getElementById('bateriaName').textContent = nombreBateria;
    
    // Resetear el campo de confirmación
    document.getElementById('confirmationDeleteInput').value = '';
    
    // Actualizar la acción del formulario
    const deleteForm = document.getElementById('deletebateriaDeleteForm');
    deleteForm.action = `/baterias/${idBateria}`;
    
    // Deshabilitar el botón de eliminar inicialmente
    document.getElementById('confirmDeleteButton').disabled = true;
    
    // Mostrar el modal
    document.getElementById('modalElim').classList.remove('hidden');
    
    // Enfocar el campo de confirmación
    document.getElementById('confirmationDeleteInput').focus();
}

// Función para cerrar el modal
function closeModal() {
    document.getElementById('modalElim').classList.add('hidden');
}

// Función para validar el input de confirmación
function validateDeletionInput() {
    const userInput = document.getElementById('confirmationDeleteInput').value;
    const confirmButton = document.getElementById('confirmDeleteButton');
    
    confirmButton.disabled = userInput !== bateriaNameToDelete;
}

// Función para confirmar la eliminación
function confirmDeletion() {
    const userInput = document.getElementById('confirmationDeleteInput').value;
    
    if (userInput === bateriaNameToDelete) {
        // Enviar el formulario de eliminación
        document.getElementById('deletebateriaDeleteForm').submit();
    } else {
        // Mostrar error (puedes mejorar esto con un mensaje más elegante)
        alert('El nombre de la batería no coincide. Por favor, verifica.');
        document.getElementById('confirmationDeleteInput').focus();
    }
}

// Cerrar modal al hacer clic fuera del contenido
document.getElementById('modalElim').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

// Cerrar modal con ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && !document.getElementById('modalElim').classList.contains('hidden')) {
        closeModal();
    }
});