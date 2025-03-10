document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('clientForm');
    const inputs = form.querySelectorAll('input, textarea, select');

    // Obtener el ID del usuario desde la variable global
    const userId = window.userId;

    if (!userId) {
        console.error('Usuario no autenticado.');
        return;
    }

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