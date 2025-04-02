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
        const displayText = selectedOption.textContent.trim();
        localStorage.setItem(`user_${userId}_tipo_instalacion`, displayText); 
        console.log(localStorage)
    });


    const tipoEstacionalitat = document.getElementById('estacionalitat');
    tipoEstacionalitat.addEventListener('change', function() {
        const selectedText = tipoEstacionalitat.options[tipoEstacionalitat.selectedIndex];
        const estacioValor = selectedText.textContent.trim();
        localStorage.setItem(`user_${userId}_estacionalidad`, estacioValor); 
        console.log("Guardado:", localStorage)
    });
    
    

    // Recuperar datos del localStorage al cargar la página
    // Para los campos normales
    inputs.forEach(input => {
        const savedValue = localStorage.getItem(`user_${userId}_${input.name}`);
        if (savedValue) {
            input.value = savedValue;
        }
    });

    // Para los select (tipusInstalacion y tipoEstacionalitat)
    // Al cargar la página, compara con textContent
    const savedTipoInstalacion = localStorage.getItem(`user_${userId}_tipo_instalacion`);
    if (savedTipoInstalacion) {
        Array.from(tipusInstalacion.options).forEach(option => {
            if (option.textContent.trim() === savedTipoInstalacion) {
                option.selected = true;
            }
        });
    }

    const savedText = localStorage.getItem(`user_${userId}_estacionalidad`);
    if (savedText) {
        Array.from(tipoEstacionalitat.options).forEach(option => {
            if (option.textContent.trim() === savedText) {
                option.selected = true; 
            }
        });
    }

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
        localStorage.removeItem(`user_${userId}_tipusInstalacion`);
        localStorage.removeItem(`user_${userId}_tipoEstacionalitat`);
    });
});