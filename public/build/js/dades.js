document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('clientForm');
    const inputs = form.querySelectorAll('input, textarea, select');

    // Recuperar datos del localStorage al cargar la página
    inputs.forEach(input => {
        const savedValue = localStorage.getItem(input.name);
        if (savedValue) {
            input.value = savedValue;
        }
    });

    // Guardar datos en localStorage cuando el usuario escribe
    inputs.forEach(input => {
        input.addEventListener('input', function () {
            localStorage.setItem(input.name, input.value);
        });
    });

    // Limpiar localStorage al enviar el formulario
    form.addEventListener('submit', function () {
        localStorage.clear();
    });
});