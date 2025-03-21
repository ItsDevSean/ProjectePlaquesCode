let projectNameToDelete = '';
let projectIdToDelete = '';

        function openModal(nombreProyecto, idProyecto) {
            projectNameToDelete = nombreProyecto;
            projectIdToDelete = idProyecto;
            document.getElementById('projectoName').textContent = nombreProyecto;

            // Establecer correctamente la URL de eliminación
            document.getElementById('deleteProjectForm').action = "/dades_clients/" + idProyecto;

            // Mostrar el modal
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
        function openEditModal(inversor) {
            // Mostrar el modal
            document.getElementById("modal").classList.remove("hidden");
        
            // Cambiar el título del modal
            document.getElementById("modalTitle").textContent = "Editar Inversor";
        
            // Rellenar los campos del formulario con los datos del inversor
            document.getElementById("nombre_inversor").value = inversor.nombre_inversor;
            document.getElementById("eficiencia").value = inversor.eficiencia;
            document.getElementById("tipo_instalacion").value = inversor.tipo_instalacion;
            document.getElementById("garantia_material").value = inversor.garantia_material;
            document.getElementById("potencia_nominal").value = inversor.potencia_nominal;
            document.getElementById("descripcion").value = inversor.descripcion;
            document.getElementById("fabricante").value = inversor.fabricante_id;
            document.getElementById("microinversor").value = inversor.microinversor ? "1" : "0";
            document.getElementById("garantia_fabricante").value = inversor.garantia_fabricante;
            document.getElementById("id_referencia").value = inversor.id_referencia;
            document.getElementById("imagen_inversor").value = inversor.imagen_inversor;
        
            // Cambiar el formulario para enviar una actualización en lugar de creación
            const form = document.getElementById("modalForm");
            form.action = `/inversores/${inversor.id}`;
            form.method = "POST";
        
            // Añadir el campo _method para simular un PUT
            const methodField = document.getElementById("methodField");
            methodField.innerHTML = '<input type="hidden" name="_method" value="PUT">';
        
            // Cambiar el texto del botón de envío
            document.getElementById("submitButton").textContent = "Actualizar Inversor";
        }