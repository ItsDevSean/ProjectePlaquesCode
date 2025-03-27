document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('clientForm');
    const inputs = form.querySelectorAll('input, textarea, select');

    // Obtener el ID del usuario desde la variable global
    const userId = window.userId;

    if (!userId) {
        console.error('Usuario no autenticado.');
        return;
    }
    
    const tipusInstalacion = document.getElementById('tipo_instalacion');
    tipusInstalacion.addEventListener('change', function () {
        const selectedOption = tipusInstalacion.options[tipusInstalacion.selectedIndex];
        const tipusInstalacionValue = selectedOption.textContent.trim();
        localStorage.setItem('tipusInstalacion', tipusInstalacionValue);
        console.log(localStorage)
    });

    const tipoEstacionalitat = document.getElementById('estacionalitat');
    tipoEstacionalitat.addEventListener('change', function() {
        const selectedOption = tipoEstacionalitat.options[tipoEstacionalitat.selectedIndex];
        const tipoEstacionalitatValue = selectedOption.textContent.trim();
        localStorage.setItem('tipoEstacionalitat', tipoEstacionalitatValue);
        console.log(localStorage.getItem('tipoEstacionalitat'));    
    });

    console.log(localStorage.getItem('tipoEstacionalitat'));
    // Guardar el ID del usuario en el localStorage
    localStorage.setItem('userId', userId);

    // Recuperar datos del localStorage al cargar la página
    inputs.forEach(input => {
        const savedValue = localStorage.getItem(`user_${userId}_${input.name}`);
        if (savedValue) {
            input.value = savedValue;
        }
    });

    // Guardar datos en localStorage cuando el usuario escribe
    inputs.forEach(input => {
        input.addEventListener('input', function () {
            localStorage.setItem(`user_${userId}_${input.name}`, input.value);
        });
    });

    // Limpiar localStorage al enviar el formulario
    form.addEventListener('submit', function () {
        inputs.forEach(input => {
            localStorage.removeItem(`user_${userId}_${input.name}`);
        });
    });
});