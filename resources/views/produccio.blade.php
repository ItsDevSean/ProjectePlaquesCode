<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producció Solar</title>
    <link rel="stylesheet" href="build/css/produccio.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
    <x-app-layout>
        
        <div class="progress-container mx-auto max-w-5xl px-4 mt-12" x-data="{
            currentStep: 4, // Pas actual (Producció)
            steps: [
                {id: 1, name: 'Dades del Client', completed: true, path: 'dades'},
                {id: 2, name: 'Consum', completed: true, path: 'consum'},
                {id: 3, name: 'Seleccionar Àrea', completed: true, path: 'mapa'},
                {id: 4, name: 'Producció', completed: false, path: 'produccio'}
            ],
            getProgressWidth() {
                // Calcula el percentatge basat en els passos completats
                const completedSteps = this.steps.filter(step => step.completed).length;
                const totalSteps = this.steps.length - 1; 
                return (completedSteps / totalSteps) * 100;
            },
            navigateTo(step) {
                window.location.href = step.path;
            }
        }">
            <!-- Progress Track -->
            <div class="relative h-1.5 mb-16">
                <!-- Background Line -->
                <div class="absolute inset-0 bg-gray-100 dark:bg-gray-800 rounded-full overflow-hidden">
                    <!-- Progress Fill - Animated -->
                    <div class="absolute inset-y-0 left-0 bg-gradient-to-r from-emerald-400 to-emerald-600 dark:from-emerald-500 dark:to-emerald-400 transition-all duration-700 ease-out" 
                         :style="`width: ${getProgressWidth()}%`"></div>
                </div>
                
                <!-- Steps Indicators -->
                <div class="relative flex justify-between">
                    <template x-for="step in steps" :key="step.id">
                        <div class="absolute" :style="`left: ${(step.id - 1) * (100 / (steps.length - 1))}%`">
                            <div class="relative group transform -translate-x-1/2">
                                <!-- Step Circle -->
                                <button @click="navigateTo(step)"
                                        class="flex items-center justify-center transition-all duration-300"
                                        :class="{
                                            'w-8 h-8 -top-3.5': step.id !== currentStep,
                                            'w-9 h-9 -top-4': step.id === currentStep,
                                            'bg-emerald-500 dark:bg-emerald-400 border-white dark:border-gray-900 shadow-lg': step.completed,
                                            'bg-white dark:bg-gray-900 border-emerald-500 dark:border-emerald-400 shadow-xl': step.id === currentStep && !step.completed,
                                            'bg-white dark:bg-gray-900 border-gray-300 dark:border-gray-600 shadow-sm': !step.completed && step.id !== currentStep,
                                            'cursor-pointer': true, // Sempre clickable
                                            'border-4': step.completed || step.id === currentStep,
                                            'border-2': !step.completed && step.id !== currentStep,
                                            'rounded-full': true,
                                            'group-hover:scale-110': true // Sempre hover effect
                                        }">
                                    <!-- Step Content -->
                                    <template x-if="step.completed">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </template>
                                    <template x-if="!step.completed">
                                        <span class="font-medium" 
                                              :class="{
                                                  'text-sm font-bold text-emerald-600 dark:text-emerald-300': step.id === currentStep,
                                                  'text-xs text-gray-400 dark:text-gray-400': step.id !== currentStep
                                              }" 
                                              x-text="step.id"></span>
                                    </template>
                                </button>
                                
                                <!-- Step Label - Sempre visible -->
                                <div class="absolute top-full mt-3 left-1/2 transform -translate-x-1/2 text-center">
                                    <span class="whitespace-nowrap font-medium px-3 py-1.5 rounded-lg"
                                          :class="{
                                              'text-sm font-semibold text-gray-800 dark:text-white bg-white dark:bg-gray-800 shadow-lg': step.id === currentStep,
                                              'text-xs font-medium text-gray-600 dark:text-gray-300': step.id !== currentStep && !step.completed,
                                              'text-xs font-medium text-emerald-600 dark:text-emerald-300': step.completed
                                          }" 
                                          x-text="step.name"></span>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- Botones de navegación fijos -->
        <div class="fixed inset-y-0 left-0 flex items-center justify-center w-16 z-20 pl-10">
            <button onclick="window.location.href='/mapa'" class="p-3 rounded-full bg-white dark:bg-gray-800 shadow-lg hover:shadow-xl border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300 transform hover:scale-110 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-600 dark:text-gray-300 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
        </div>

        <div class="fixed inset-y-0 right-0 flex items-center justify-center w-16 z-20 pr-10">
            <button class="p-3 rounded-full bg-white dark:bg-gray-800 shadow-lg hover:shadow-xl border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300 transform hover:scale-110 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-600 dark:text-gray-300 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors duration-300" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M17 3H5a2 2 0 00-2 2v14a2 2 0 002 2h14a1 1 0 001-1V7l-3-4zM12 19a2 2 0 110-4 2 2 0 010 4zm4-10H8V5h8v4z" />
                </svg>
            </button>
        </div>
        
        
        <!-- Contingut principal -->
        <div class="container mx-auto px-4 py-8 w-full max-w-6xl" id="main-content"> 
            <!-- Mensaje de datos faltantes (inicialmente oculto) -->
            <div class="missing-data-container hidden" id="missing-data-message">
                <h2 class="missing-data-title">Falten dades necessàries</h2>
                <p>Per mostrar la informació de producció, cal que completis les següents dades:</p>
                <ul class="missing-data-list" id="missing-fields-list"></ul>
                <p class="missing-data-instruction">Si us plau, torna als passos anteriors i completa les dades necessàries.</p>
            </div>

            <!-- Grid 2x2 de cartes (inicialmente oculto) -->
            <div class="hidden" id="production-content">
                <!-- Grid 2x2 de cartes -->
                <div class="grid-2x2 mb-8">
                    <!-- Fila 1 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden card">
                        <div class="p-6 system-info">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Informació del Sistema</h2>
                            <div class="system-info-content">
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Ubicació:</span>
                                        <span class="font-medium" id="location">Barcelona, ES</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Panells instal·lats:</span>
                                        <span class="font-medium" id="panelCount">12</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Model panells:</span>
                                        <span class="font-medium" id="panelModel">Trina Solar 450W</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Orientació:</span>
                                        <span class="font-medium" id="orientation">Sud</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Inclinació:</span>
                                        <span class="font-medium" id="tilt">30°</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Tarifa d'accés:</span>
                                        <span class="font-medium" id="tarifaAcces">2.0A</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Tipus d'instal·lació:</span>
                                        <span class="font-medium" id="tipusInstalacio">Monofàsica</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-md overflow-hidden card">
                        <div class="p-6 card-content">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Producció Anual</h2>
                            <div class="flex items-center justify-center flex-1">
                                <div class="relative w-40 h-40 mx-auto">
                                    <svg class="w-full h-full" viewBox="0 0 100 100">
                                        <circle
                                            class="text-gray-200"
                                            stroke-width="8"
                                            stroke="currentColor"
                                            fill="transparent"
                                            r="40"
                                            cx="50"
                                            cy="50"
                                        />
                                        <circle
                                            class="progress-ring__circle text-emerald-500"
                                            stroke-width="8"
                                            stroke-linecap="round"
                                            stroke="currentColor"
                                            fill="transparent"
                                            r="40"
                                            cx="50"
                                            cy="50"
                                            stroke-dasharray="251.2"
                                            stroke-dashoffset="75.36"
                                        />
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center flex-col">
                                        <span class="text-3xl font-bold text-emerald-600" id="annualProduction">4,320</span>
                                        <span class="text-gray-500">kWh/any</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 text-center text-sm text-gray-500">
                                <p>Equivalent al consum de <span class="font-medium" id="equivalentHomes">1.2</span> llars</p>
                            </div>
                        </div>
                    </div>

                    <!-- Fila 2 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden card">
                        <div class="p-6 card-content">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Estalvi i Impacte</h2>
                            <div class="space-y-4 flex-1">
                                <div>
                                    <h3 class="text-gray-600 mb-1">Estalvi anual:</h3>
                                    <p class="text-2xl font-bold text-emerald-600">€<span id="annualSavings">648</span></p>
                                </div>
                                <div>
                                    <h3 class="text-gray-600 mb-1">CO₂ evitats:</h3>
                                    <p class="text-2xl font-bold text-emerald-600"><span id="co2Saved">1,728</span> kg</p>
                                </div>
                                <div class="pt-2 border-t border-gray-100 mt-auto">
                                    <h3 class="text-gray-600 mb-1">Retorn de la inversió:</h3>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-emerald-600 h-2.5 rounded-full" style="width: 45%"></div>
                                    </div>
                                    <p class="text-sm text-gray-500 mt-1"><span id="roiYears">5.2</span> anys</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg overflow-hidden p-8 max-w-4xl mx-auto card">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6 ">Mètriques de Rendiment</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Primer cuadro -->
                            <div class="flex flex-col items-center p-6 bg-gradient-to-br from-emerald-50 to-green-50 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 border border-emerald-100">
                                <div class="mb-3 text-center">
                                    <p class="text-lg font-medium text-gray-600">Factor de Capacitat</p>
                                </div>
                                <p class="text-4xl font-black text-emerald-600">
                                    <span id="capacityFactor">18.2</span>%
                                </p>
                            </div>
                            
                            <!-- Segundo cuadro -->
                            <div class="flex flex-col items-center p-6 bg-gradient-to-br from-emerald-50 to-green-50 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 border border-emerald-100">
                                <div class="mb-3 text-center">
                                    <p class="text-lg font-medium text-gray-600">Hores Pico Solars</p>
                                </div>
                                <p class="text-4xl font-black text-emerald-600">
                                    <span id="peakSunHours">1,598</span>
                                </p>
                            </div>
                            
                            <!-- Tercer cuadro -->
                            <div class="flex flex-col items-center p-6 bg-gradient-to-br from-emerald-50 to-green-50 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 border border-emerald-100">
                                <div class="mb-3 text-center">
                                    <p class="text-lg font-medium text-gray-600">Rendiment del Sistema</p>
                                </div>
                                <p class="text-4xl font-black text-emerald-600">
                                    <span id="systemEfficiency">78.5</span>%
                                </p>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <!-- Gràfics i taula -->
                <div class="space-y-6">
                    <!-- Gràfic Producció Mensual -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden card">
                        <div class="p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Producció Mensual</h2>
                            <div class="h-80">
                                <canvas id="monthlyChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Gràfic Patró Diari -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden card">
                        <div class="p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Patró Diari</h2>
                            <div class="h-64">
                                <canvas id="dailyPatternChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Taula de Dades Detallades -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden card cursor-pointer accordion-card">
                        <div class="p-6">
                            <div class="flex justify-between items-center accordion-toggle">
                                <h2 class="text-xl font-semibold text-gray-800 mb-4">Dades Detallades</h2>
                                <!-- Icono de flecha (se puede cambiar por +/−) -->
                                <svg class="w-5 h-5 text-gray-500 transition-transform duration-300 accordion-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                            <div class="overflow-x-auto accordion-content hidden">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mes</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producció (kWh)</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rendiment</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estalvi (€)</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CO₂ evitats (kg)</th>
                                        </tr>
                                    </thead>
                                    <tbody id="monthlyDataTable" class="bg-white divide-y divide-gray-200">
                                        <!-- Dades es carregaran aquí -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Botons d'Exportació -->
                    <div class="flex justify-end space-x-3">
                        <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                            <i class="fas fa-download mr-2"></i>Exportar PDF
                        </button>
                        <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                            <i class="fas fa-file-excel mr-2"></i>Exportar Excel
                        </button>
                        <button id="enviarLocal" class="btn btn-primary">Guardar datos locales</button>

                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
    <script src="build/js/produccio.js"></script>
    <script>
        window.userId = "{{ Auth::id() }}";
        
    </script>
    <script>
    document.getElementById('enviarLocal').addEventListener('click', function() {
    const btn = this;
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Guardant...';

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
        url: "{{ route('guardar.dades') }}",
        data: data,
        csrf: document.querySelector('meta[name="csrf-token"]').content
    });

    // Enviar los datos al backend (Fetch se mantiene igual)
    fetch("{{ route('guardar.dades') }}", {
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
    .then(responseData => { // Cambié nombre de 'data' a 'responseData' para evitar confusión
        if (responseData.success) {
            alert("✅ Dades guardades correctament");
            // Limpiar localStorage después de guardar con éxito (opcional)
            // Object.keys(keyMap).forEach(localKey => localStorage.removeItem(localKey));
            window.location.href = "{{ route('proyectos') }}";
        } else {
            // Si el backend devuelve success: false, mostrar mensaje o errores
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
        btn.innerHTML = 'Guardar datos locales';
    });
});
</script>

</body>
</html>