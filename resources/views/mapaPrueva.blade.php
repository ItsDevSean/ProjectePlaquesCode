<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador de Direcció</title>
    <link rel="stylesheet" href="build/css/styleMapa.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <x-app-layout>

        <!-- Barra de progres -->
        <div class="progress-bar-container mt-4 px-4 bg-white rounded-xl pr-6 pb-1 pl-11 bg-opacity-80" x-data="{
            currentStep: 3, // Pas actual (Seleccionar Àrea)
            steps: [
                {id: 1, name: 'Dades del Client', completed: true, path: '{{ route('dades') }}'},
                {id: 2, name: 'Consum', completed: true, path: '{{ route('consum') }}'},
                {id: 3, name: 'Seleccionar Àrea', completed: false, path: '{{ route('map') }}'}, 
                {id: 4, name: 'Producció', completed: false, path: '{{ route('produccio') }}'}
            ],
            getProgressWidth() {
                const completedSteps = this.steps.filter(step => step.completed).length;
                const totalSteps = this.steps.length - 1; 
                return (completedSteps / totalSteps) * 100;
            },
            navigateTo(step) {
                window.location.href = step.path;
            }
        }">
            <div class="mx-auto max-w-6xl p-2">
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
                                                'cursor-pointer': true,
                                                'cursor-default': false,
                                                'border-4': step.completed || step.id === currentStep,
                                                'border-2': !step.completed && step.id !== currentStep,
                                                'rounded-full': true,
                                                'group-hover:scale-110': step.completed || step.id === currentStep
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
                                    
                                    <!-- Step Label -->
                                    <div class="absolute top-full mt-3 left-1/2 transform -translate-x-1/2 text-center">
                                        <span class="whitespace-nowrap font-medium px-3 py-1.5 rounded-lg"
                                        :class="{
                                            'text-sm font-semibold text-gray-800 dark:text-white bg-white bg-opacity-55 dark:bg-gray-800 shadow-lg': step.id === currentStep,
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
        </div>

    <!-- Contenidor del mapa -->
    <div class="map-container">
        <div class="map-header">
            <div class="search-container">
                <input type="text" id="address" placeholder="Escriu la teva direcció" autocomplete="off">
                <button id="buttonBuscar">Buscar</button>              
                <button id="startSelection" disabled class="hidden">Seleccionar area</button>
                <span id="areaResult" style="display: none;"></span>
                <button id="saveAreaButton" style="display: none;">Guardar Área</button>
            </div>
        </div>
        <div id="mapOverlay" class="map-overlay"></div>
        <div id="map"></div>
        
        <!-- Botó "Tancar polígon" -->
        <button id="tancarPoligonButton" class="tancar-poligon-button">
            Tancar polígon
        </button>
    </div>

    

    <div id="sidePanel" class="side-panel bg-white shadow-lg rounded-lg overflow-hidden">
        <button id="closePanelButton" class="close-panel-button bg-emerald-500 hover:bg-emerald-600 text-white">×</button>
        <div class="space-y-2 divide-y divide-gray-200">
            <!-- Sección 1: Dades de la superficie -->
            <div class="accordion-section border border-gray-200 rounded-lg overflow-hidden">
                <button class="accordion-button flex items-center gap-2 w-full text-left p-4 bg-gradient-to-r from-emerald-50 to-white hover:from-emerald-100 transition-all duration-200">
                    <div class="flex-shrink-0 flex items-center justify-center w-10 h-10 rounded-full bg-emerald-100 text-emerald-600">
                        <img src="/img/iconSup3.png" alt="Superficie" class="w-6 h-6">
                    </div>
                
                    <h3 class="text-lg font-semibold text-gray-800 flex-shrink-0">
                        Dades de la superficie
                    </h3>
                
                    <div class="flex items-center gap-0.5 ml-auto pr-3"> 
                        <input
                            disabled
                            type="text"
                            class="bg-transparent border-transparent py-1 px-0 rounded-md focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition font-bold w-auto text-right tabular-nums" id="area"
                            name="area"
                            placeholder="Ex: 50" required
                            size="5" aria-label="Àrea en metres quadrats">
                        <span class="font-bold text-sm text-gray-500">m²</span>
                    </div>
                
                    <span class="accordion-icon transform transition-transform duration-300 text-emerald-500 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </button>
                
                <div class="accordion-content bg-white">
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Selector de Orientación Visual - Modificado el contenedor -->
                            <div class="flex flex-col items-center p-4 bg-white rounded-xl shadow-sm border border-gray-100">
                                <label class="block text-sm font-medium text-gray-700 mb-3">Orientació</label>
                                <div class="orientation-dial w-44 h-44 cursor-grab active:cursor-grabbing relative mx-auto">
                                    <!-- SVG original sin cambios -->
                                    <svg class="orientation-svg w-full h-full select-none touch-none" viewBox="0 0 200 200">
                                        <circle cx="100" cy="100" r="90" fill="#f8fafc" stroke="#e2e8f0" stroke-width="2"/>
                                        
                                        <text x="100" y="28" text-anchor="middle" alignment-baseline="middle" fill="#64748b" font-size="13" font-weight="medium">N</text>
                                        <text x="172" y="100" text-anchor="middle" alignment-baseline="middle" fill="#64748b" font-size="13" font-weight="medium">E</text>
                                        <text x="100" y="172" text-anchor="middle" alignment-baseline="middle" fill="#64748b" font-size="13" font-weight="medium">S</text>
                                        <text x="28" y="100" text-anchor="middle" alignment-baseline="middle" fill="#64748b" font-size="13" font-weight="medium">O</text>
                                        
                                        <line x1="100" y1="35" x2="100" y2="15" stroke="#d1d5db" stroke-width="1.5"/>
                                        <line x1="165" y1="100" x2="185" y2="100" stroke="#d1d5db" stroke-width="1.5"/>
                                        <line x1="100" y1="165" x2="100" y2="185" stroke="#d1d5db" stroke-width="1.5"/>
                                        <line x1="35" y1="100" x2="15" y2="100" stroke="#d1d5db" stroke-width="1.5"/>
    
                                        <line id="dial-line" x1="100" y1="100" x2="100" y2="30" stroke="#059669" stroke-width="3" stroke-linecap="round"/> 
                                        <circle id="dial-handle" cx="100" cy="30" r="8" fill="#10b981" stroke="#047857" stroke-width="2.5" style="cursor: inherit;"/> 
                                    </svg>
                                </div>
                                <div class="orientation-info text-center mt-3">
                                    <span id="orientation-degree" class="block text-xl font-semibold text-emerald-700">180°</span>
                                    <span id="orientation-cardinal" class="block text-sm text-gray-600 capitalize">Sud</span>
                                    <input type="hidden" id="orientacion" name="orientacion" value="sur">
                                </div>
                            </div>
                            
                            <!-- Selector de Inclinación Visual - Modificado el contenedor -->
                            <div class="flex flex-col items-center p-4 bg-white rounded-xl shadow-sm border border-gray-100">
                                <label class="block text-sm font-medium text-gray-700 mb-3">Inclinació</label>
                                <div class="inclination-selector-container ml-10 mt-6 w-full max-w-[160px] h-[120px] relative mx-auto">
                                    <!-- SVG original sin cambios -->
                                    <svg class="inclination-svg w-full h-full overflow-visible select-none touch-none cursor-grab active:cursor-grabbing" viewBox="0 0 160 90">
                                        <circle cx="80" cy="80" r="3" fill="#cbd5e1"/> 
                                        
                                        <line x1="10" y1="80" x2="78" y2="80" stroke="#e2e8f0" stroke-width="2"/>
                                        
                                        <path id="inclination-arc" d="M 10 80 A 70 70 0 0 1 80 10" stroke="#e2e8f0" stroke-width="2" fill="none"/> 
                                        
                                        <line id="inclination-line" x1="80" y1="80" x2="10" y2="80" stroke="#059669" stroke-width="2.5" stroke-linecap="round"/> 
                                        
                                        <circle id="inclination-handle" cx="10" cy="80" r="4" fill="#10b981" stroke="#047857" stroke-width="1.5" style="cursor: inherit;"/>
                            
                                        <text x="10" y="92" text-anchor="middle" font-size="10" fill="#64748b">0°</text>
                                        <text x="80" y="4" text-anchor="middle" font-size="10" fill="#64748b">90°</text>
                                    </svg>
                                </div>
                                <div class="inclination-info text-center mt-3">
                                    <span id="inclination-degree" class="block text-xl font-semibold text-emerald-700">0°</span>
                                    <input type="hidden" id="inclinacion" name="inclinacion" value="0" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Sección 2: Selecció de plaques -->
            <div class="accordion-section rounded-lg overflow-hidden border border-gray-200">
                <button class="accordion-button flex items-center gap-3 w-full text-left p-4 bg-gradient-to-r from-emerald-50 to-white hover:from-emerald-100 transition-all duration-200">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-emerald-100 text-emerald-600">
                        <img src="/img/panelSolar2.png" alt="Plaques" class="w-6 h-6">
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 flex-1">Selecció de plaques</h3>
                    <span class="accordion-icon transform transition-transform duration-300 text-emerald-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </button>
                <div class="accordion-content bg-white">
                    <form action="" class="form-container p-4 space-y-4">
                        <div>
                            <label for="panel_model" class="block text-sm font-medium text-gray-700 mb-1">Selecciona Panel</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" id="panel_model" name="panel_model" required>
                                <option value="">-- Selecciona un modelo --</option>
                                @foreach($panels as $panel)
                                    <option value="{{ $panel->id }}" data-surface="{{ $panel->superficie }}" data-potencia-maxima="{{ $panel->potencia_maxima }}">{{ $panel->panel_model }}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="text-center">
                            <a href="{{ route('panels') }}" class="inline-flex items-center text-emerald-600 hover:text-emerald-800 font-medium transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                Nuevo panel
                            </a>
                        </div>
    
                        <div>
                            <label for="placaSlider" class="block text-sm font-medium text-gray-700 mb-2">Nombre de plaques:</label>
                            <div class="flex items-center gap-4">
                                <input type="range" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-emerald-500" id="placaSlider" min="0" max="1" step="1">
                                <input type="number" id="placaCount" class="w-20 px-3 py-2 text-center border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    
            <!-- Sección 3: Selecció de obstacles -->
            <div class="accordion-section rounded-lg overflow-hidden border border-gray-200">
                <button class="accordion-button flex items-center gap-3 w-full text-left p-4 bg-gradient-to-r from-emerald-50 to-white hover:from-emerald-100 transition-all duration-200">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-emerald-100 text-emerald-600">
                        <img src="/img/iconObstaculo.png" alt="Obstacles" class="w-6 h-6">
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 flex-1">Selecció de obstacles</h3>
                    <span class="accordion-icon transform transition-transform duration-300 text-emerald-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </button>
                <div class="accordion-content bg-white">
                    <div class="form-container p-4 space-y-4">
                        <div id="obstaclesList" class="space-y-3">
                            <!-- Aquí se mostrarán los obstáculos creados -->
                        </div>
    
                        <button id="nouObstacleButton" class="w-full flex items-center justify-center gap-2 bg-white border-2 border-emerald-400 text-emerald-600 font-semibold py-2 px-4 rounded-lg transition duration-300 hover:bg-emerald-50 hover:border-emerald-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Nou obstacle
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>
    /* Estilos para los selectores visuales */
    .orientation-dial {
        width: 150px;
        height: 150px;
        cursor: grab;
        touch-action: none;
    }

    .orientation-svg {
        width: 100%;
        height: 100%;
        user-select: none;
    }

    .orientation-info {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    #orientation-degree {
        font-size: 1.25rem;
        font-weight: bold;
        color: #065f46;
    }

    #orientation-cardinal {
        font-size: 0.875rem;
        color: #64748b;
    }

    .inclination-selector-container {
        width: 160px;
        height: 120px;
    }

    .inclination-svg {
        width: 100%;
        height: 100%;
        transform: scale(1.5);
        user-select: none;
    }

    #inclination-degree {
        font-size: 1.25rem;
        font-weight: bold;
        color: #065f46;
    }

    /* Ajustes responsivos */
    @media (max-width: 767px) {
        .orientation-dial {
            width: 130px;
            height: 130px;
        }
        
        .inclination-selector-container {
            width: 140px;
            height: 100px;
        }
    }

        .accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    
        .accordion-section.active .accordion-content {
            max-height: 1000px;
            transition: max-height 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
    
        .accordion-section.active .accordion-icon {
            transform: rotate(180deg);
        }
    
        .close-panel-button {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: all 0.2s ease;
        }
    
        input:focus, select:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(73, 219, 163, 0.3);
        }
    </style>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Funcionalidad del acordeón (existente)
            const accordionButtons = document.querySelectorAll('.accordion-button');
            
            accordionButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const section = this.parentElement;
                    section.classList.toggle('active');
                    
                    if (section.classList.contains('active')) {
                        document.querySelectorAll('.accordion-section').forEach(s => {
                            if (s !== section && s.classList.contains('active')) {
                                s.classList.remove('active');
                            }
                        });
                    }
                });
            });
    
            // Abrir la primera sección por defecto
            document.querySelector('.accordion-section').classList.add('active');
    
            // Selector de Inclinación
            const inclinationSVG = document.querySelector('.inclination-svg');
            const inclinationHandle = document.getElementById('inclination-handle');
            const inclinationLine = document.getElementById('inclination-line');
            const inclinationDegreeDisplay = document.getElementById('inclination-degree');
            const inclinationInput = document.getElementById('inclinacion');
    
            if (inclinationSVG && inclinationHandle && inclinationLine && inclinationDegreeDisplay && inclinationInput) {
                const center = { x: 80, y: 80 };
                const radius = 70;
                const minInclination = 0;
                const maxInclination = 90;
                
                let isDraggingInclination = false;
    
                // Event Listeners
                inclinationHandle.addEventListener('mousedown', startInclinationDrag);
                inclinationSVG.addEventListener('mousemove', dragInclination);
                document.addEventListener('mouseup', endInclinationDrag);
    
                // Soporte táctil
                inclinationHandle.addEventListener('touchstart', startInclinationDrag, { passive: false });
                inclinationSVG.addEventListener('touchmove', dragInclination, { passive: false });
                document.addEventListener('touchend', endInclinationDrag);
    
                function startInclinationDrag(e) {
                    e.preventDefault();
                    isDraggingInclination = true;
                    inclinationSVG.style.cursor = 'grabbing';
                }
    
                function dragInclination(e) {
                    if (!isDraggingInclination) return;
                    e.preventDefault();
    
                    const coords = getSVGCoordinates(e, inclinationSVG);
                    
                    // Calcular ángulo
                    const dx = coords.x - center.x;
                    const dy = coords.y - center.y;
                    let svgAngleRad = Math.atan2(dy, dx);
                    let svgAngleDeg = svgAngleRad * (180 / Math.PI);
    
                    // Convertir ángulo SVG a inclinación (0-90)
                    let inclination = 0;
                    let normalizedSvgAngleDeg = ((svgAngleDeg % 360) + 360) % 360;
                    
                    if (normalizedSvgAngleDeg >= 90 && normalizedSvgAngleDeg <= 180) {
                        inclination = 0;
                    } else if (normalizedSvgAngleDeg > 180 && normalizedSvgAngleDeg <= 270) {
                        inclination = normalizedSvgAngleDeg - 180;
                    } else {
                        inclination = 90;
                    }
    
                    // Limitar y redondear
                    inclination = Math.max(minInclination, Math.min(maxInclination, inclination));
                    updateInclinationVisuals(Math.round(inclination));
                }
    
                function endInclinationDrag() {
                    if (isDraggingInclination) {
                        isDraggingInclination = false;
                        inclinationSVG.style.cursor = 'grab';
                        saveInclinationToLocalStorage(Math.round(parseFloat(inclinationInput.value)));
                    }
                }
    
                function getSVGCoordinates(e, svgElement) {
                    const pt = svgElement.createSVGPoint();
                    if (e.type.includes('touch')) {
                        pt.x = e.touches[0].clientX;
                        pt.y = e.touches[0].clientY;
                    } else {
                        pt.x = e.clientX;
                        pt.y = e.clientY;
                    }
                    const svgPoint = pt.matrixTransform(svgElement.getScreenCTM().inverse());
                    return { x: svgPoint.x, y: svgPoint.y };
                }
    
                function updateInclinationVisuals(inclination) {
                    inclination = Math.max(minInclination, Math.min(maxInclination, inclination));
                    
                    // Convertir inclinación a ángulo SVG
                    const svgAngleDeg = inclination + 180;
                    const svgAngleRad = svgAngleDeg * (Math.PI / 180);
    
                    // Calcular nueva posición del handle
                    const hx = center.x + radius * Math.cos(svgAngleRad);
                    const hy = center.y + radius * Math.sin(svgAngleRad);
    
                    // Actualizar posición visual
                    inclinationHandle.setAttribute('cx', hx);
                    inclinationHandle.setAttribute('cy', hy);
                    inclinationLine.setAttribute('x2', hx);
                    inclinationLine.setAttribute('y2', hy);
    
                    // Actualizar texto
                    inclinationDegreeDisplay.textContent = inclination + '°';
    
                    // Actualizar input
                    inclinationInput.value = inclination;
                }
    
                function saveInclinationToLocalStorage(value) {
                    if (typeof userId !== 'undefined') {
                        localStorage.setItem(`user_${userId}_inclinacion`, value);
                    }
                }
    
                // Inicialización
                let initialInclination = 0;
                if (typeof userId !== 'undefined') {
                    const savedInclination = localStorage.getItem(`user_${userId}_inclinacion`);
                    if (savedInclination !== null && !isNaN(savedInclination)) {
                        initialInclination = parseFloat(savedInclination);
                    } else if (inclinationInput.value !== "" && !isNaN(inclinationInput.value)) {
                        initialInclination = parseFloat(inclinationInput.value);
                    }
                } else if (inclinationInput.value !== "" && !isNaN(inclinationInput.value)) {
                    initialInclination = parseFloat(inclinationInput.value);
                }
    
                updateInclinationVisuals(Math.round(initialInclination));
            }
    
            // Selector de Orientación
            const orientationSVG = document.querySelector('.orientation-svg');
            const orientationHandle = document.getElementById('dial-handle');
            const orientationLine = document.getElementById('dial-line');
            const orientationDegreeDisplay = document.getElementById('orientation-degree');
            const orientationCardinalDisplay = document.getElementById('orientation-cardinal');
            const orientationHiddenInput = document.getElementById('orientacion');
            
            if (orientationSVG && orientationHandle && orientationLine && orientationDegreeDisplay && orientationCardinalDisplay && orientationHiddenInput) {
                const center = {x: 100, y: 100};
                const radius = 70;
                
                // Mapeo de ángulos a direcciones cardinales
                const angleToCardinal = {
                    'norte': { min: 315, max: 45, value: 0, label: 'Nord' },
                    'este': { min: 45, max: 135, value: 90, label: 'Est' },
                    'sur': { min: 135, max: 225, value: 180, label: 'Sud' },
                    'oeste': { min: 225, max: 315, value: 270, label: 'Oest' }
                };
                
                // Inicializar posición (apuntando al Sur por defecto)
                updateDial(180);
                
                // Manejadores de eventos
                let isDragging = false;
                
                orientationHandle.addEventListener('mousedown', startDrag);
                orientationSVG.addEventListener('mousemove', drag);
                document.addEventListener('mouseup', endDrag);
                
                // Soporte táctil
                orientationHandle.addEventListener('touchstart', startDrag);
                orientationSVG.addEventListener('touchmove', drag);
                document.addEventListener('touchend', endDrag);
                
                function startDrag(e) {
                    e.preventDefault();
                    isDragging = true;
                }
                
                function drag(e) {
                    if (!isDragging) return;
                    e.preventDefault();
                    
                    // Obtener posición del cursor/touch relativa al SVG
                    const coords = getSVGCoordinates(e, orientationSVG);
                    
                    // Calcular ángulo
                    const dx = coords.x - center.x;
                    const dy = coords.y - center.y;
                    let angle = Math.atan2(dy, dx) * (180 / Math.PI) + 90;
                    if (angle < 0) angle += 360;
                    
                    updateDial(angle);
                }
                
                function endDrag() {
                    isDragging = false;
                }
                
                function updateDial(angle) {
                    // Convertir ángulo a radianes (con 0° en la parte superior)
                    const radians = (angle - 90) * (Math.PI / 180);
                    
                    // Calcular nueva posición del handle
                    const x = center.x + radius * Math.cos(radians);
                    const y = center.y + radius * Math.sin(radians);
                    
                    // Actualizar posición visual
                    orientationHandle.setAttribute('cx', x);
                    orientationHandle.setAttribute('cy', y);
                    orientationLine.setAttribute('x2', x);
                    orientationLine.setAttribute('y2', y);
                    
                    // Redondear ángulo a múltiplo de 5 para mejor usabilidad
                    const roundedAngle = Math.round(angle / 5) * 5;
                    orientationDegreeDisplay.textContent = roundedAngle + '°';
                    
                    // Determinar dirección cardinal
                    let cardinalKey = 'sur'; // Valor por defecto
                    for (const [key, range] of Object.entries(angleToCardinal)) {
                        if ((angle >= range.min || angle < (range.min === 315 ? 45 : range.max)) && 
                            (angle < range.max || range.max === 45)) {
                            cardinalKey = key;
                            break;
                        }
                    }
                    
                    const cardinal = angleToCardinal[cardinalKey].label;
                    orientationCardinalDisplay.textContent = cardinal;
                    
                    // Actualizar campo oculto
                    orientationHiddenInput.value = cardinalKey;
                    
                    // Guardar en localStorage
                    if (typeof userId !== 'undefined') {
                        localStorage.setItem(`user_${userId}_orientacion`, cardinalKey);
                    }
                }
                
                // Cargar valor guardado al iniciar
                if (typeof userId !== 'undefined') {
                    const savedOrientation = localStorage.getItem(`user_${userId}_orientacion`);
                    if (savedOrientation && angleToCardinal[savedOrientation]) {
                        updateDial(angleToCardinal[savedOrientation].value);
                    }
                }
                
                function getSVGCoordinates(e, svgElement) {
                    const pt = svgElement.createSVGPoint();
                    if (e.type.includes('touch')) {
                        const touch = e.touches[0];
                        pt.x = touch.clientX;
                        pt.y = touch.clientY;
                    } else {
                        pt.x = e.clientX;
                        pt.y = e.clientY;
                    }
                    return pt.matrixTransform(svgElement.getScreenCTM().inverse());
                }
            }
        });
    </script>

 
</x-app-layout>
    
    <script>
    window.userId = "{{ Auth::id() }}";
    </script>
    
    <script src="build/js/mapa.js"></script>
    <script src="build/js/formulariSidePanel.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9dnmay3GsjXeiIqbmYoJ3FJ95rDo6hoY&libraries=places&callback=initMap"></script>
    <script src="https://solar.googleapis.com/v1/buildingInsights:findClosest?key=AIzaSyB9dnmay3GsjXeiIqbmYoJ3FJ95rDo6hoY"></script>
</body>

</html>