let projectNameToDelete = '';
let projectIdToDelete = '';
        const modalOverlay = document.getElementById('modal');

       
        function openModal(nombreProyecto, idProyecto) {
            projectNameToDelete = nombreProyecto;
            projectIdToDelete = idProyecto;
            document.getElementById('projectoName').textContent = nombreProyecto;

            const deleteForm = document.getElementById('deleteProjectForm');
            const baseRoute = deleteForm.getAttribute('data-route');
            deleteForm.action = `${baseRoute}/${idProyecto}`;

           
            modalOverlay.classList.remove('hidden');
        }

        
        function closeModal() {
            modalOverlay.classList.add('hidden');
        }

       
        modalOverlay.addEventListener('click', function (event) {
            if (event.target === modalOverlay) {
                closeModal();
            }
        });

        // Función para confirmar la eliminación
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