document.addEventListener('DOMContentLoaded', function () {
    // Elementos del DOM
    const form = document.getElementById('clientForm');
    const userId = window.userId;

    if (!userId) {
        console.error('Usuario no autenticado.');
        return;
    }

    // Verificar si debemos mostrar el modal (solo si venimos del botón)
    const shouldCheck = localStorage.getItem('shouldCheckForProject') === 'true';
    
    if (shouldCheck) {
        localStorage.removeItem('shouldCheckForProject'); // Limpiar el flag
        checkAndShowModal();
    }

    // Función para verificar y mostrar el modal
    function checkAndShowModal() {
        const hasSavedData = checkForSavedData();
        if (hasSavedData) {
            createModal();
        }
    }

    // Función para comprobar datos guardados
    function checkForSavedData() {
        return localStorage.getItem(`user_${userId}_polygon`) || 
               localStorage.getItem(`user_${userId}_edificiData`) || 
               localStorage.getItem(`user_${userId}_tipo_instalacion`) ||
               localStorage.getItem(`user_${userId}_estacionalidad`) ||
               localStorage.getItem(`user_${userId}_nombre`) ||
               localStorage.getItem(`user_${userId}_email`) ||
               localStorage.getItem(`user_${userId}_telefono`) ||
               localStorage.getItem(`user_${userId}_direccion`) ||
               localStorage.getItem(`user_${userId}_ciudad`) ||
               localStorage.getItem(`user_${userId}_codigo_postal`) ||
               localStorage.getItem(`user_${userId}_nombre_proyecto`) ||
               localStorage.getItem(`user_${userId}_descripcion_proyecto`);
    }

    // Función para crear el modal
    function createModal() {
        const modalHTML = `
            <div id="projectModal" style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.7);display:flex;justify-content:center;align-items:center;z-index:1000;backdrop-filter:blur(4px);">
                <div style="background:white;padding:0;border-radius:12px;max-width:500px;width:90%;overflow:hidden;box-shadow:0 10px 25px rgba(0,0,0,0.2);">
                    <div style="background:linear-gradient(to right, #10b981, #0d9488);padding:16px 20px;">
                        <h3 style="color:white;margin:0;font-size:1.25rem;font-weight:bold;">Projecte actiu detectat</h3>
                    </div>
                    <div style="padding:20px;">
                        <p style="color:#333;margin-bottom:20px;line-height:1.5;">
                            S'ha detectat un projecte en curs.<br><br>
                            Selecciona una de les següents opcions:<br>
                            - Continuar treballant amb el projecte existent<br>
                            - Iniciar un nou projecte (es perdran les dades no guardades)
                        </p>
                        <div style="display:flex;justify-content:space-between;gap:12px;">
                            <button id="continueProject" style="padding:10px 20px;background:linear-gradient(to right, #10b981, #0d9488);color:white;border:none;border-radius:6px;cursor:pointer;flex:1;transition:all 0.3s ease;">
                                Continuar projecte
                            </button>
                            <button id="newProject" style="padding:10px 20px;background:linear-gradient(to right, #ef4444, #dc2626);color:white;border:none;border-radius:6px;cursor:pointer;flex:1;transition:all 0.3s ease;">
                                Nou projecte
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', modalHTML);
        setupModalEvents();
    }

    // Función para configurar eventos del modal
    function setupModalEvents() {
        document.getElementById('continueProject').addEventListener('click', function() {
            closeModal();
        });

        document.getElementById('newProject').addEventListener('click', function() {
            clearUserData();
            closeModal();
        });

        // Cerrar al hacer clic fuera del modal
        document.getElementById('projectModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    }

    // Función para limpiar datos
    function clearUserData() {
        Object.keys(localStorage).forEach(key => {
            if (key.startsWith(`user_${userId}_`)) {
                localStorage.removeItem(key);
            }
        });
        localStorage.clear();
        location.reload();
    }

    // Función para cerrar el modal
    function closeModal() {
        const modal = document.getElementById('projectModal');
        if (modal) modal.remove();
    }

    // Solo ejecutar el resto si estamos en la página de dades (con el formulario)
    if (form) {
        const inputs = form.querySelectorAll('input, textarea, select');
        
        // Configurar eventos para los selects
        const tipusInstalacion = document.getElementById('tipo_instalacion');
        if (tipusInstalacion) {
            tipusInstalacion.addEventListener('change', function() {
                const selectedOption = tipusInstalacion.options[tipusInstalacion.selectedIndex];
                const displayText = selectedOption.textContent.trim();
                localStorage.setItem(`user_${userId}_tipo_instalacion`, displayText);
            });
        }

        const tipoEstacionalitat = document.getElementById('estacionalitat');
        if (tipoEstacionalitat) {
            tipoEstacionalitat.addEventListener('change', function() {
                const selectedText = tipoEstacionalitat.options[tipoEstacionalitat.selectedIndex];
                const estacioValor = selectedText.textContent.trim();
                localStorage.setItem(`user_${userId}_estacionalidad`, estacioValor);
            });
        }

        // Cargar valores guardados
        inputs.forEach(input => {
            const savedValue = localStorage.getItem(`user_${userId}_${input.name}`);
            if (savedValue) {
                input.value = savedValue;
            }
        });

        // Cargar selects
        const savedTipoInstalacion = localStorage.getItem(`user_${userId}_tipo_instalacion`);
        if (savedTipoInstalacion && tipusInstalacion) {
            Array.from(tipusInstalacion.options).forEach(option => {
                if (option.textContent.trim() === savedTipoInstalacion) {
                    option.selected = true;
                }
            });
        }

        const savedText = localStorage.getItem(`user_${userId}_estacionalidad`);
        if (savedText && tipoEstacionalitat) {
            Array.from(tipoEstacionalitat.options).forEach(option => {
                if (option.textContent.trim() === savedText) {
                    option.selected = true;
                }
            });
        }

        // Guardar datos en tiempo real
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                localStorage.setItem(`user_${userId}_${input.name}`, input.value);
            });
        });

        // Limpiar al enviar el formulario
        form.addEventListener('submit', function() {
            inputs.forEach(input => {
                localStorage.removeItem(`user_${userId}_${input.name}`);
            });
            localStorage.removeItem(`user_${userId}_tipo_instalacion`);
            localStorage.removeItem(`user_${userId}_estacionalidad`);
        });
    }
});