document.getElementById('enviarLocal').addEventListener('click', function() {
    const btn = this;
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin" style="font-size: 1.3em; color: #059669;"></i>';

        // *** MODIFICADO: Las claves de localStorage ahora son dinámicas ***
        const localStoragePrefix = `user_${userId}_`;
        const keyMap = {
            [`${localStoragePrefix}nombre`]: 'nombre',
            [`${localStoragePrefix}email`]: 'email',
            [`${localStoragePrefix}telefono`]: 'telefono',
            [`${localStoragePrefix}direccion`]: 'direccion',
            [`${localStoragePrefix}ciudad`]: 'ciudad',
            [`${localStoragePrefix}codigo_postal`]: 'codigo_postal',
            [`${localStoragePrefix}nombre_proyecto`]: 'nombre_proyecto',
            [`${localStoragePrefix}descripcion_proyecto`]: 'descripcion_proyecto',
            [`${localStoragePrefix}estacionalidad`]: 'estacionalidad',
            [`${localStoragePrefix}tipo_instalacion`]: 'tipo_instalacion',
            [`${localStoragePrefix}consumAnual`]: 'consum_anual',
            [`${localStoragePrefix}facturaAnual`]: 'factura_anual',
            [`${localStoragePrefix}tarifaAcces`]: 'tarifa_acces',
            [`${localStoragePrefix}costeInstalacion`]: 'coste_instalacion',
            [`${localStoragePrefix}subvenciones`]: 'subvenciones',
            [`${localStoragePrefix}precioExcedentes`]: 'precio_excedentes',
            [`${localStoragePrefix}consumPattern`]: 'patro_consum',
            [`${localStoragePrefix}inclinacion`]: 'inclinacion',
            [`${localStoragePrefix}orientacion`]: 'orientacion',
            [`${localStoragePrefix}radiacion`]: 'radiacion_anual',
            [`${localStoragePrefix}maxPlacas`]: 'max_placas',
            [`${localStoragePrefix}placaCount`]: 'placa_count',
            [`${localStoragePrefix}panel_pot`]: 'panel_potencia',
            [`${localStoragePrefix}panel_model`]: 'panel_modelo',
            [`${localStoragePrefix}superficie`]: 'superficie',
            [`${localStoragePrefix}novaArea`]: 'nova_area',
            [`${localStoragePrefix}monthlyRadiation`]: 'monthly_radiation',
            [`${localStoragePrefix}produccionMensual`]: 'produccion_mensual',
            [`${localStoragePrefix}edificiData`]: 'edifici_data',
            [`${localStoragePrefix}obstacles`]: 'obstacles',
            [`${localStoragePrefix}polygon`]: 'polygon',
            [`${localStoragePrefix}radiationCoords`]: 'radiation_coords'
        };

    // Identificar qué claves son JSON
    const jsonKeys = [
        'user_1_monthlyRadiation', 'user_1_produccionMensual', 'user_1_edificiData',
        'user_1_obstacles', 'user_1_polygon', 'user_1_radiationCoords'
    ];

    // Identificar qué claves son numéricas (opcional, pero bueno para asegurar tipo)
    const numericKeys = [
        'user_1_telefono', 'user_1_codigo_postal', 'user_1_consumAnual', 'user_1_facturaAnual',
        'user_1_costeInstalacion', 'user_1_subvenciones', 'user_1_precioExcedentes',
        'user_1_consumPattern', 'user_1_inclinacion', 'user_1_radiacion', 'user_1_maxPlacas',
        'user_1_placaCount', 'user_1_panel_pot', 'user_1_superficie', 'user_1_novaArea'
    ];


    const data = { user_id: window.userId, estado_id: 1 };

    // Recopilando y mapeando los datos
    Object.keys(keyMap).forEach(localKey => {
        const backendKey = keyMap[localKey];
        let value = localStorage.getItem(localKey); // Obtener el valor (puede ser null si no existe)

        if (value === null) {
            // Si no existe en localStorage, asignar null al backendKey
            data[backendKey] = null;
        } else if (jsonKeys.includes(localKey)) {
            // Si es una clave JSON, intentar parsear
            try {
                data[backendKey] = JSON.parse(value);
            } catch (e) {
                console.warn(`Error parseando JSON para ${localKey}:`, value, e);
                data[backendKey] = null; // O manejar el error como prefieras
            }
        } else if (numericKeys.includes(localKey)) {
             // Si es una clave numérica, intentar convertir a número
             const num = parseFloat(value);
             // Asignar el número si es válido, sino null (o mantener string si prefieres)
             data[backendKey] = isNaN(num) ? null : num;
        } else {
            // Si no es JSON ni numérico, es un string normal
            data[backendKey] = value;
        }
    });

    console.log("Enviando datos (Corregido):", {
        url: window.guardarDadesURL,
        data: data,
        csrf: document.querySelector('meta[name="csrf-token"]').content
    });

    // Enviar los datos al backend (Fetch se mantiene igual)
    fetch(window.guardarDadesURL, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, // Mejor forma de obtener CSRF
            'Accept': 'application/json'
        },
        body: JSON.stringify(data) // 'data' ya tiene los tipos correctos
    })
    .then(async response => {
        const contentType = response.headers.get('content-type');
        if (!response.ok) { // Capturar errores HTTP (4xx, 5xx)
             const errorData = (contentType && contentType.includes('application/json'))
                ? await response.json()
                : await response.text();
             // Lanzar un error que incluya detalles si están disponibles
             throw new Error(`Error HTTP ${response.status}: ${JSON.stringify(errorData) || response.statusText}`);
        }
         if (!contentType || !contentType.includes('application/json')) {
             const text = await response.text();
             throw new Error(`Respuesta no JSON: ${text.substring(0, 100)}...`);
         }
         return response.json();
    })
    .then(responseData => {
        if (responseData.success) {
            alert("✅ Dades guardades correctament");
            localStorage.clear()
            // Object.keys(keyMap).forEach(localKey => localStorage.removeItem(localKey));
            window.location.href = window.guardarProyectosURL;
        } else {
             let errorMessage = responseData.message || 'Error desconegut al servidor.';
             if (responseData.errors) {
                 errorMessage += "\nDetalls:\n";
                 for (const field in responseData.errors) {
                     errorMessage += `- ${field}: ${responseData.errors[field].join(', ')}\n`;
                 }
             }
            throw new Error(errorMessage);
        }
    })
    .catch(error => {
    console.error("Error en fetch:", error);
    alert("Error al guardar: " + error.message);
    btn.disabled = true; // Deshabilitas el botón para indicar el error
    btn.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-600 dark:text-gray-300 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors duration-300" viewBox="0 0 24 24" fill="currentColor">
            <path d="M17 3H5a2 2 0 00-2 2v14a2 2 0 002 2h14a1 1 0 001-1V7l-3-4zM12 19a2 2 0 110-4 2 2 0 010 4zm4-10H8V5h8v4z" />
        </svg>
        `;
    })
    .finally(() => {
        btn.disabled = false;
    });
});