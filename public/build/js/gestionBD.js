document.getElementById('enviarLocal').addEventListener('click', function() {
    const btn = this;
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin" style="font-size: 1.3em; color: #059669;"></i>';

    // *** CORREGIDO: keyMap usa las claves REALES de localStorage ***
    const keyMap = {
        'user_1_nombre': 'nombre',
        'user_1_email': 'email',
        'user_1_telefono': 'telefono',
        'user_1_direccion': 'direccion',
        'user_1_ciudad': 'ciudad',
        'user_1_codigo_postal': 'codigo_postal',
        'user_1_nombre_proyecto': 'nombre_proyecto',
        'user_1_descripcion_proyecto': 'descripcion_proyecto',
        'user_1_estacionalidad': 'estacionalidad', // Esta clave ya estaba bien
        'user_1_tipo_instalacion': 'tipo_instalacion',
        'user_1_consumAnual': 'consum_anual',         // Corregido (era _consum_anual)
        'user_1_facturaAnual': 'factura_anual',       // Corregido (era _factura_anual)
        'user_1_tarifaAcces': 'tarifa_acces',         // Corregido (era _tarifa_acces)
        'user_1_costeInstalacion': 'coste_instalacion', // Corregido (era _coste_instalacion)
        'user_1_subvenciones': 'subvenciones',       // Corregido (era _subvenciones)
        'user_1_precioExcedentes': 'precio_excedentes',  // Corregido (era _precio_excedentes)
        'user_1_consumPattern': 'patro_consum',       // Corregido (era _patro_consum y nombre diferente)
        'user_1_inclinacion': 'inclinacion',
        'user_1_orientacion': 'orientacion',
        'user_1_radiacion': 'radiacion_anual',         // Corregido (era _radiacion_anual y nombre diferente)
        'user_1_maxPlacas': 'max_placas',           // Corregido (era _max_placas)
        'user_1_placaCount': 'placa_count',         // Corregido (era _placa_count)
        'user_1_panel_pot': 'panel_potencia',        // Corregido (era _panel_potencia y nombre diferente)
        'user_1_panel_model': 'panel_modelo',        // Corregido (era _panel_modelo y nombre diferente)
        'user_1_superficie': 'superficie',
        'user_1_novaArea': 'nova_area',           // Corregido (era _nova_area)
        'user_1_monthlyRadiation': 'monthly_radiation', // Corregido (era _monthly_radiation)
        'user_1_produccionMensual': 'produccion_mensual',// Corregido (era _produccion_mensual)
        'user_1_edificiData': 'edifici_data',        // Corregido (era _edifici_data)
        'user_1_obstacles': 'obstacles',
        'user_1_polygon': 'polygon',
        'user_1_radiationCoords': 'radiation_coords'   // Corregido (era _radiation_coords)
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