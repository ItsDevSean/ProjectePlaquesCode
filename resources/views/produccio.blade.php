<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producción Solar</title>
    <link rel="stylesheet" href="build/css/produccio.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <x-app-layout>
        
        <div class="progress-container mx-auto max-w-5xl px-4 mt-12" x-data="{
            currentStep: 4, // Paso actual (Producción)
            steps: [
                {id: 1, name: 'Datos del Cliente', completed: true, path: 'dades'},
                {id: 2, name: 'Consumo', completed: true, path: 'consum'},
                {id: 3, name: 'Seleccionar Área', completed: true, path: 'mapa'},
                {id: 4, name: 'Producción', completed: false, path: 'produccio'}
            ],
            getProgressWidth() {
                // Calcula el porcentaje basado en los pasos completados
                const completedSteps = this.steps.filter(step => step.completed).length;
                const totalSteps = this.steps.length - 1; 
                return (completedSteps / totalSteps) * 100;
            },
            navigateTo(step) {
                window.location.href = step.path;
            }
        }">
            <!-- Barra de progreso -->
            <div class="relative h-1.5 mb-16">
                <!-- Línea de fondo -->
                <div class="absolute inset-0 bg-gray-100 dark:bg-gray-800 rounded-full overflow-hidden">
                    <!-- Relleno de progreso - Animado -->
                    <div class="absolute inset-y-0 left-0 bg-gradient-to-r from-emerald-400 to-emerald-600 dark:from-emerald-500 dark:to-emerald-400 transition-all duration-700 ease-out" 
                         :style="`width: ${getProgressWidth()}%`"></div>
                </div>
                
                <!-- Indicadores de pasos -->
                <div class="relative flex justify-between">
                    <template x-for="step in steps" :key="step.id">
                        <div class="absolute" :style="`left: ${(step.id - 1) * (100 / (steps.length - 1))}%`">
                            <div class="relative group transform -translate-x-1/2">
                                <!-- Círculo del paso -->
                                <button @click="navigateTo(step)"
                                        class="flex items-center justify-center transition-all duration-300"
                                        :class="{
                                            'w-8 h-8 -top-3.5': step.id !== currentStep,
                                            'w-9 h-9 -top-4': step.id === currentStep,
                                            'bg-emerald-500 dark:bg-emerald-400 border-white dark:border-gray-900 shadow-lg': step.completed,
                                            'bg-white dark:bg-gray-900 border-emerald-500 dark:border-emerald-400 shadow-xl': step.id === currentStep && !step.completed,
                                            'bg-white dark:bg-gray-900 border-gray-300 dark:border-gray-600 shadow-sm': !step.completed && step.id !== currentStep,
                                            'cursor-pointer': true,
                                            'border-4': step.completed || step.id === currentStep,
                                            'border-2': !step.completed && step.id !== currentStep,
                                            'rounded-full': true,
                                            'group-hover:scale-110': true
                                        }">
                                    <!-- Contenido del paso -->
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
                                
                                <!-- Etiqueta del paso - Siempre visible -->
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
            <button id="enviarLocal" class="p-3 rounded-full bg-white dark:bg-gray-800 shadow-lg hover:shadow-xl border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300 transform hover:scale-110 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-600 dark:text-gray-300 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors duration-300" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M17 3H5a2 2 0 00-2 2v14a2 2 0 002 2h14a1 1 0 001-1V7l-3-4zM12 19a2 2 0 110-4 2 2 0 010 4zm4-10H8V5h8v4z" />
                </svg>
            </button>
        </div>
        
        
        <!-- Contenido principal -->
        <div class="container mx-auto px-4 py-8 w-full max-w-6xl" id="main-content"> 
            <!-- Mensaje de datos faltantes (inicialmente oculto) -->
            <div class="missing-data-container hidden" id="missing-data-message">
                <h2 class="missing-data-title">Faltan datos necesarios</h2>
                <p>Para mostrar la información de producción, es necesario completar los siguientes datos:</p>
                <ul class="missing-data-list" id="missing-fields-list"></ul>
                <p class="missing-data-instruction">Por favor, vuelve a los pasos anteriores y completa los datos necesarios.</p>
            </div>

            <!-- Grid 2x2 de tarjetas (inicialmente oculto) -->
            <div class="hidden" id="production-content">
                <!-- Grid 2x2 de tarjetas -->
                <div class="grid-2x2 mb-8">
                    <!-- Fila 1 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden card">
                        <div class="p-6 system-info">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Información del Sistema</h2>
                            <div class="system-info-content">
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Ubicación:</span>
                                        <span class="font-medium" id="location">Barcelona, ES</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Paneles instalados:</span>
                                        <span class="font-medium" id="panelCount">12</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Modelo paneles:</span>
                                        <span class="font-medium" id="panelModel">Trina Solar 450W</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Orientación:</span>
                                        <span class="font-medium" id="orientation">Sur</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Inclinación:</span>
                                        <span class="font-medium" id="tilt">30°</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Tarifa de acceso:</span>
                                        <span class="font-medium" id="tarifaAcces">2.0A</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Tipo de instalación:</span>
                                        <span class="font-medium" id="tipusInstalacio">Monofásica</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-md overflow-hidden card">
                        <div class="p-6 card-content">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Producción Anual</h2>
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
                                        <span class="text-gray-500">kWh/año</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 text-center text-sm text-gray-500">
                                <p>Equivalente al consumo de <span class="font-medium" id="equivalentHomes">1.2</span> hogares</p>
                            </div>
                        </div>
                    </div>

                    <!-- Fila 2 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden card">
                        <div class="p-6 card-content">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Ahorro e Impacto</h2>
                            <div class="space-y-4 flex-1">
                                <div>
                                    <h3 class="text-gray-600 mb-1">Ahorro anual:</h3>
                                    <p class="text-2xl font-bold text-emerald-600">€<span id="annualSavings">648</span></p>
                                </div>
                                <div>
                                    <h3 class="text-gray-600 mb-1">CO₂ evitados:</h3>
                                    <p class="text-2xl font-bold text-emerald-600"><span id="co2Saved">1,728</span> kg</p>
                                </div>
                                <div class="pt-2 border-t border-gray-100 mt-auto">
                                    <h3 class="text-gray-600 mb-1">Retorno de la inversión:</h3>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-emerald-600 h-2.5 rounded-full" style="width: 45%"></div>
                                    </div>
                                    <p class="text-sm text-gray-500 mt-1"><span id="roiYears">5.2</span> años</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg overflow-hidden p-8 max-w-4xl mx-auto card">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6 ">Métricas de Rendimiento</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Primer cuadro -->
                            <div class="flex flex-col items-center p-6 bg-gradient-to-br from-emerald-50 to-green-50 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 border border-emerald-100">
                                <div class="mb-3 text-center">
                                    <p class="text-lg font-medium text-gray-600">Factor de Capacidad</p>
                                </div>
                                <p class="text-4xl font-black text-emerald-600">
                                    <span id="capacityFactor">18.2</span>%
                                </p>
                            </div>
                            
                            <!-- Segundo cuadro -->
                            <div class="flex flex-col items-center p-6 bg-gradient-to-br from-emerald-50 to-green-50 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 border border-emerald-100">
                                <div class="mb-3 text-center">
                                    <p class="text-lg font-medium text-gray-600">Horas Pico Solares</p>
                                </div>
                                <p class="text-4xl font-black text-emerald-600">
                                    <span id="peakSunHours">1,598</span>
                                </p>
                            </div>
                            
                            <!-- Tercer cuadro -->
                            <div class="flex flex-col items-center p-6 bg-gradient-to-br from-emerald-50 to-green-50 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 border border-emerald-100">
                                <div class="mb-3 text-center">
                                    <p class="text-lg font-medium text-gray-600">Rendimiento del Sistema</p>
                                </div>
                                <p class="text-4xl font-black text-emerald-600">
                                    <span id="systemEfficiency">78.5</span>%
                                </p>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <!-- Gráficos y tabla -->
                <div class="space-y-6">
                    <!-- Gráfico Producción Mensual -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden card">
                        <div class="p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Producción Mensual</h2>
                            <div class="h-80">
                                <canvas id="monthlyChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Gráfico Patrón Diario -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden card">
                        <div class="p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Patrón Diario</h2>
                            <div class="h-64">
                                <canvas id="dailyPatternChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Tabla de Datos Detallados -->
                    <div hidden class="bg-white rounded-xl shadow-md overflow-hidden card cursor-pointer accordion-card">
                        <div class="p-6">
                            <div class="flex justify-between items-center accordion-toggle">
                                <h2 class="text-xl font-semibold text-gray-800 mb-4">Datos Detallados</h2>
                                <!-- Icono de flecha -->
                                <svg class="w-5 h-5 text-gray-500 transition-transform duration-300 accordion-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                            <div class="overflow-x-auto accordion-content hidden">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mes</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producción (kWh)</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rendimiento</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ahorro (€)</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CO₂ evitados (kg)</th>
                                        </tr>
                                    </thead>
                                    <tbody id="monthlyDataTable" class="bg-white divide-y divide-gray-200">
                                        <!-- Datos se cargarán aquí -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de Exportación -->
                    <div class="flex justify-end space-x-3">
                        <button id="export-pdf" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition">
                            <i class="fas fa-download mr-2"></i>Exportar PDF
                        </button>
                        <button id="enviarLocal" class="btn btn-primary">Guardar datos locales</button>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
    <script src="build/js/produccio.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const exportButton = document.getElementById('export-pdf');
            const mainContentElement = document.getElementById('main-content');

            const projectData = {
                user_photo_path: 'URL_A_TU_IMAGEN_DE_PERFIL.jpg',
                user_name: 'Nombre Usuario'
            };

            if (exportButton && mainContentElement) {
                exportButton.addEventListener('click', async function() {
                    const elementsToHide = document.querySelectorAll(
                        '.fixed.inset-y-0.left-0, .fixed.inset-y-0.right-0, .progress-container, #export-pdf'
                    );
                    let pdfHeaderElement = null;

                    try {
                        elementsToHide.forEach(el => el.style.visibility = 'hidden');

                        pdfHeaderElement = document.createElement('div');
                        pdfHeaderElement.setAttribute('id', 'pdf-temp-header');
                        const accentColor = '#10b981';
                        const headerHeight = 80;

                        Object.assign(pdfHeaderElement.style, {
                            height: `${headerHeight}px`,
                            position: 'relative',
                            marginBottom: '20px',
                            overflow: 'hidden',
                            backgroundColor: '#f8fafc',
                            borderBottom: `1px solid ${accentColor}`
                        });

                        for (let i = 0; i < 2; i++) {
                            const stripe = document.createElement('div');
                            Object.assign(stripe.style, {
                                position: 'absolute',
                                height: `${headerHeight * 2}px`,
                                width: '30px',
                                backgroundColor: accentColor,
                                opacity: '0.6',
                                transform: 'rotate(-45deg)',
                                zIndex: '1',
                                top: `-${headerHeight / 2}px`,
                                left: `${20 + i * 40}px`
                            });
                            pdfHeaderElement.appendChild(stripe);
                        }

                        const photoContainer = document.createElement('div');
                        const photoSize = 80;
                        Object.assign(photoContainer.style, {
                            position: 'absolute',
                            top: `${(headerHeight - photoSize) / 2}px`,
                            right: '30px',
                            width: `${photoSize}px`,
                            height: `${photoSize}px`,
                            borderRadius: '50%',
                            backgroundColor: '#ffffff',
                            border: `3px solid ${accentColor}`,
                            display: 'flex',
                            justifyContent: 'center',
                            alignItems: 'center',
                            overflow: 'hidden',
                            zIndex: '2',
                            boxShadow: '0 2px 10px rgba(0,0,0,0.1)'
                        });

                        const existingImg = document.getElementById("imgid");

                        if (existingImg) {
                            const imgClone = existingImg.cloneNode(true);
                            Object.assign(imgClone.style, {
                                width: '100%',
                                height: '100%',
                                objectFit: 'cover',
                                objectPosition: 'center center',
                                aspectRatio: '1/1',
                                transform: 'translateZ(0)',
                                backfaceVisibility: 'hidden',
                                position: '',
                                top: '', left: '', right: '', bottom: '',
                                margin: '', padding: ''
                            });
                            
                            setTimeout(() => {
                                photoContainer.appendChild(imgClone);
                            }, 50);
                            
                        } else {
                            console.warn("Elemento con id 'imgid' no encontrado. Usando projectData.user_photo_path o iniciales.");
                            if (projectData && projectData.user_photo_path) {
                                const img = document.createElement('img');
                                img.src = projectData.user_photo_path;
                                img.alt = projectData.user_name || 'Usuario';
                                Object.assign(img.style, {
                                    width: '100%',
                                    height: '100%',
                                    objectFit: 'cover'
                                });
                                photoContainer.appendChild(img);
                            } else {
                                const initial = (projectData && projectData.user_name) ? projectData.user_name.charAt(0).toUpperCase() : '?';
                                const initialSpan = document.createElement('span');
                                initialSpan.textContent = initial;
                                Object.assign(initialSpan.style, {
                                    color: accentColor,
                                    fontSize: `${photoSize * 0.5}px`,
                                    fontWeight: 'bold'
                                });
                                photoContainer.appendChild(initialSpan);
                            }
                        }

                        pdfHeaderElement.appendChild(photoContainer);

                        const titleElement = document.createElement('h2');
                        titleElement.textContent = 'Informe Solar';
                        Object.assign(titleElement.style, {
                            position: 'absolute',
                            left: '100px',
                            top: '50%',
                            transform: 'translateY(-50%)',
                            margin: '0',
                            color: '#334155',
                            fontSize: '24px',
                            fontWeight: '600',
                            zIndex: '2'
                        });
                        pdfHeaderElement.appendChild(titleElement);

                        mainContentElement.prepend(pdfHeaderElement);

                        await new Promise(resolve => setTimeout(resolve, 100)); 

                        const { jsPDF } = window.jspdf;
                        const doc = new jsPDF('p', 'mm', 'a4');

                        const canvas = await html2canvas(mainContentElement, {
                            scale: 2,
                            logging: false,
                            useCORS: true,
                            scrollY: -window.scrollY,
                            backgroundColor: '#ffffff' 
                        });

                        const imgData = canvas.toDataURL('image/png');
                        const pdfWidth = doc.internal.pageSize.getWidth();
                        const pdfHeight = doc.internal.pageSize.getHeight();
                        const margin = 7;

                        const usableWidth = pdfWidth - (margin * 2);
                        const usableHeight = pdfHeight - (margin * 2);

                        const imgProps = doc.getImageProperties(imgData);
                        const imgWidth = usableWidth;
                        const imgHeight = (imgProps.height * imgWidth) / imgProps.width;

                        let position = margin;
                        let heightLeft = imgHeight;

                        doc.addImage(imgData, 'PNG', margin, position, imgWidth, imgHeight);
                        heightLeft -= usableHeight;

                        doc.save('informe-solar-profesional.pdf');

                    } catch (error) {
                        console.error("Error al generar el PDF:", error);
                        alert("Hubo un error al generar el PDF. Revisa la consola para más detalles.");
                    } finally {
                        elementsToHide.forEach(el => el.style.visibility = 'visible');
                        if (pdfHeaderElement && pdfHeaderElement.parentNode) {
                            pdfHeaderElement.parentNode.removeChild(pdfHeaderElement);
                        }
                    }
                });
            } else {
                if (!exportButton) console.error("No se encontró el botón con id 'export-pdf'. Asegúrate de que el script se carga después del botón.");
                if (!mainContentElement) console.error("No se encontró el elemento con id 'main-content'. Asegúrate de que el script se carga después de este elemento.");
            }
        });
    </script>

    <script>
        window.userId = "{{ Auth::id() }}";
        window.guardarDadesURL = "{{ route('guardar.dades') }}";
        window.guardarProyectosURL = "{{ route('proyectos') }}";
    </script>
    <script src="build/js/gestionBD.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</body>
</html>