let projectNameToDelete = '';
let projectIdToDelete = '';

        function openModal(nombreProyecto, idProyecto) {
            projectNameToDelete = nombreProyecto;
            projectIdToDelete = idProyecto;
            document.getElementById('projectoName').textContent = nombreProyecto;
            document.getElementById('deleteProjectForm').action = `{{ route('dades_clients.destroy', '') }}/${idProyecto}`;
            document.getElementById('modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }

        function confirmDeletion() {
            const userInput = document.getElementById('confirmationInput').value;

            if (userInput === projectNameToDelete) {
                document.getElementById('deleteProjectForm').submit();
            } else {
                alert('El nombre del proyecto no coincide. Eliminación cancelada.');
            }
        }

      
        function openSidePanel(projectId) {

            document.getElementById('overlay').classList.remove('hidden');
            document.getElementById('sidePanel').classList.remove('hidden');
        }

        function closeSidePanel() {
            
            document.getElementById('overlay').classList.add('hidden');
            document.getElementById('sidePanel').classList.add('hidden');
        }
