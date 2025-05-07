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
            <div id="projectModal" style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.8);display:none;justify-content:center;align-items:center;z-index:10000;backdrop-filter:blur(6px);opacity:0;transition:opacity 0.3s ease-out;">
                <div style="background:#ffffff;padding:0;border-radius:16px;max-width:560px;width:90%;overflow:hidden;box-shadow:0 12px 32px rgba(0,0,0,0.25);transform:translateY(20px);transition:transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
                    <div style="background:linear-gradient(135deg, #0d9488 0%, #047857 100%);padding:24px 32px;position:relative;">
                        <div style="position:absolute;top:0;left:0;width:100%;height:100%;background:linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(0,0,0,0.05) 100%);"></div>
                        <h3 style="color:white;margin:0;font-size:1.375rem;font-weight:600;font-family:'Segoe UI', Roboto, -apple-system, sans-serif;position:relative;">Proyecto activo detectado</h3>
                        
                    </div>
                    <div style="padding:32px;">
                        <div style="margin-bottom:24px;">
                            <p style="color:#4b5563;margin-bottom:16px;line-height:1.6;font-size:1rem;font-family:'Segoe UI', Roboto, -apple-system, sans-serif;">
                                Se ha detectado un proyecto en curso. Selecciona una de las siguientes opciones:
                            </p>
                            <ul style="color:#4b5563;margin-bottom:24px;padding-left:20px;line-height:1.8;font-size:0.95rem;font-family:'Segoe UI', Roboto, -apple-system, sans-serif;">
                                <li>- Continuar trabajando con el proyecto existente</li>
                                <li>- Iniciar un nuevo proyecto (se perderán los datos no guardados)</li>
                            </ul>
                        </div>
                        <div style="display:flex;justify-content:space-between;gap:16px;">
                            <button id="continueProject" style="padding:12px 24px;background:linear-gradient(135deg, #0d9488 0%, #047857 100%);color:white;border:none;border-radius:8px;cursor:pointer;flex:1;transition:all 0.3s ease;font-weight:500;font-family:'Segoe UI', Roboto, -apple-system, sans-serif;box-shadow:0 4px 6px rgba(5, 122, 103, 0.2);position:relative;overflow:hidden;">
                                <span style="position:relative;z-index:1;">Continuar proyecto</span>
                                <div style="position:absolute;top:0;left:0;width:100%;height:100%;background:linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(0,0,0,0.05) 100%);"></div>
                            </button>
                            <button id="newProject" style="padding:12px 24px;background:linear-gradient(135deg, #ef4444 0%, #dc2626 100%);color:white;border:none;border-radius:8px;cursor:pointer;flex:1;transition:all 0.3s ease;font-weight:500;font-family:'Segoe UI', Roboto, -apple-system, sans-serif;box-shadow:0 4px 6px rgba(220, 38, 38, 0.2);position:relative;overflow:hidden;">
                                <span style="position:relative;z-index:1;">Nuevo proyecto</span>
                                <div style="position:absolute;top:0;left:0;width:100%;height:100%;background:linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(0,0,0,0.05) 100%);"></div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
    
        document.body.insertAdjacentHTML('beforeend', modalHTML);
        
        // Mostrar con animación
        const modal = document.getElementById('projectModal');
        setTimeout(() => {
            modal.style.display = 'flex';
            setTimeout(() => {
                modal.style.opacity = '1';
                modal.querySelector('div > div').style.transform = 'translateY(0)';
            }, 10);
        }, 10);
        
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

        // Inclinció teulada
        const estaInclinat = document.getElementById("tipo_teulada");
        if (estaInclinat.value == "si") {
            document.getElementById("div_inclinacio").classList.remove('hidden');
        }
        estaInclinat.addEventListener('change', function() {
            if (estaInclinat.value == "si") {
                document.getElementById("div_inclinacio").classList.remove('hidden');
            } else {
                document.getElementById("div_inclinacio").classList.add('hidden');
            }
        })
    }    

});