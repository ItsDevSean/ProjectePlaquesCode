document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('clientForm');
    const submitButton = document.getElementById('submitButton');
    const inputs = form.querySelectorAll('input[required], select[required], textarea');

    function validateForm(event) {
        event.preventDefault(); // Evita l'enviament del formulari
        let allValid = true;

        inputs.forEach(input => {
            const errorMessage = input.nextElementSibling; // El missatge d'error és l'element següent
            errorMessage.classList.add('hidden'); // Amaga els errors inicialment

            // Validació general per camps obligatoris
            if (input.required && !input.value.trim()) {
                errorMessage.textContent = `Aquest camp és obligatori.`;
                errorMessage.classList.remove('hidden');
                allValid = false;
            }

            // Validació específica per al correu electrònic
            if (input.id === 'email' && !input.checkValidity()) {
                errorMessage.textContent = 'El correu electrònic no és vàlid (ha de contenir una @).';
                errorMessage.classList.remove('hidden');
                allValid = false;
            }

            // Validació específica per al telèfon
            if (input.id === 'telefono' && !/^\d{9}$/.test(input.value.trim())) {
                errorMessage.textContent = 'El telèfon ha de tenir 9 dígits.';
                errorMessage.classList.remove('hidden');
                allValid = false;
            }

            // Validació específica per al codi postal
            if (input.id === 'codigo_postal' && !/^\d{5}$/.test(input.value.trim())) {
                errorMessage.textContent = 'El codi postal ha de tenir 5 dígits.';
                errorMessage.classList.remove('hidden');
                allValid = false;
            }

            // Validació específica per al nom del projecte
            if (input.id === 'nombre_proyecto' && input.value.trim().length < 3) {
                errorMessage.textContent = 'El nom del projecte ha de tenir almenys 3 caràcters.';
                errorMessage.classList.remove('hidden');
                allValid = false;
            }

            // Validació específica per a la tarifa d'accés
            if (input.id === 'tarifa_acceso' && !/^\d+\.\d+[A-Za-z]?$/.test(input.value.trim())) {
                errorMessage.textContent = 'La tarifa d\'accés no és vàlida (exemple: 2.0A).';
                errorMessage.classList.remove('hidden');
                allValid = false;
            }

            // Validació específica per al tipus d'instal·lació
            if (input.id === 'tipo_instalacion' && !input.value) {
                errorMessage.textContent = 'Selecciona un tipus d\'instal·lació.';
                errorMessage.classList.remove('hidden');
                allValid = false;
            }

            // La descripció és opcional, no cal validar-la
        });

        if (allValid) {
            // Si tot està correcte, redirigeix a la vista del mapa
            window.location.href = "mapa";
        }
    }

    form.addEventListener('submit', validateForm); // Valida el formulari en intentar enviar-lo
});