
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('clientForm');
    const submitButton = document.getElementById('submitButton');
    const inputs = form.querySelectorAll('input[required]');

    function validateForm(event) {
        event.preventDefault(); // Evita l'enviament del formulari
        let allValid = true;
        inputs.forEach(input => {
            const errorMessage = input.nextElementSibling; // El missatge d'error és l'element següent
            errorMessage.classList.add('hidden'); // Amaga els errors inicialment
            if (!input.value.trim()) {
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
        });

        if (allValid) {
            // Si tot està correcte, redirigeix a la vista del mapa
            window.location.href = "mapa";
        }
    }
    form.addEventListener('submit', validateForm); // Valida el formulari en intentar enviar-lo
});
