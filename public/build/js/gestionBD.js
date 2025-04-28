document.addEventListener('DOMContentLoaded', function () {
    const enviarLocalBtn = document.getElementById('enviarLocal');
    const userId = window.userId; // Asegúrate de que 'window.userId' esté definido en tu vista con el ID del usuario autenticado

    if (!userId) {
        console.error('Usuario no autenticado. Asegúrate de que window.userId esté definido.');
        return;
    }

    enviarLocalBtn.addEventListener('click', function() {
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
            [`${localStoragePrefix}radiationCoords`]: 'radiation_coords',
            [`${localStoragePrefix}prodAnual`]: 'prodAnual'
        };

        const jsonKeys = Object.keys(keyMap).filter(key => key.endsWith('monthlyRadiation') || key.endsWith('produccionMensual') || key.endsWith('edificiData') || key.endsWith('obstacles') || key.endsWith('polygon') || key.endsWith('radiationCoords'));
        const numericKeys = Object.keys(keyMap).filter(key => key.endsWith('telefono') || key.endsWith('codigo_postal') || key.endsWith('consumAnual') || key.endsWith('facturaAnual') || key.endsWith('costeInstalacion') || key.endsWith('subvenciones') || key.endsWith('precioExcedentes') || key.endsWith('consumPattern') || key.endsWith('inclinacion') || key.endsWith('radiacion') || key.endsWith('maxPlacas') || key.endsWith('placaCount') || key.endsWith('panel_pot') || key.endsWith('superficie') || key.endsWith('novaArea'));

        const data = { user_id: userId, estado_id: 1 };

        Object.keys(keyMap).forEach(localKeyWithPrefix => {
            const backendKey = keyMap[localKeyWithPrefix];
            let value = localStorage.getItem(localKeyWithPrefix);

            if (value === null) {
                data[backendKey] = null;
            } else if (jsonKeys.includes(localKeyWithPrefix)) {
                try {
                    data[backendKey] = JSON.parse(value);
                } catch (e) {
                    console.warn(`Error parseando JSON para ${localKeyWithPrefix}:`, value, e);
                    data[backendKey] = null;
                }
            } else if (numericKeys.includes(localKeyWithPrefix)) {
                const num = parseFloat(value);
                data[backendKey] = isNaN(num) ? null : num;
            } else {
                data[backendKey] = value;
            }
        });

        console.log("Enviando datos (con userId):", {
            url: guardarDadesURL,
            data: data,
            csrf: document.querySelector('meta[name="csrf-token"]').content
        });

        fetch(guardarDadesURL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(async response => {
            const contentType = response.headers.get('content-type');
            if (!response.ok) {
                const errorData = (contentType && contentType.includes('application/json'))
                    ? await response.json()
                    : await response.text();
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
                // *** MODIFICADO: Limpiar solo las claves del usuario actual ***
                Object.keys(localStorage).forEach(key => {
                    if (key.startsWith(localStoragePrefix)) {
                        localStorage.removeItem(key);
                    }
                });
                window.location.href = window.guardarProyectosURL
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
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerHTML = 'Enviar'; // Restaurar el texto del botón
        });
    });
});
