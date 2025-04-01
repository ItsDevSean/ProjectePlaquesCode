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

    

    <div id="sidePanel" class="side-panel bg-white shadow-lg">
        <button id="closePanelButton" class="close-panel-button bg-emerald-500 hover:bg-emerald-600 text-white">×</button>
        <div class="space-y-2 p-2">
            <!-- Sección 1: Dades de la superficie -->
            <div class="accordion-section rounded-lg overflow-hidden border border-gray-200">
                <button class="accordion-button flex items-center gap-3 w-full text-left p-4 bg-gradient-to-r from-emerald-50 to-white hover:from-emerald-100 transition-all duration-200">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-emerald-100 text-emerald-600">
                        <img src="/img/iconSup3.png" alt="Superficie" class="w-6 h-6">
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 flex-1">Dades de la superficie</h3>
                    <span class="accordion-icon transform transition-transform duration-300 text-emerald-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </button>
                <div class="accordion-content bg-white">
                    <form action="" class="form-container p-4 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="area" class="block text-sm font-medium text-gray-700 mb-1">Àrea (m²)</label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" id="area" name="area" placeholder="Exemple: 50" required>
                            </div>
                            <div>
                                <label for="orientacion" class="block text-sm font-medium text-gray-700 mb-1">Orientació</label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" id="orientacion" name="orientacion" required>
                                    <option value="norte">Nord</option>
                                    <option value="sur" selected>Sud</option>
                                    <option value="este">Est</option>
                                    <option value="oeste">Oest</option>
                                </select>
                            </div>
                            <div>
                                <label for="inclinacion" class="block text-sm font-medium text-gray-700 mb-1">Inclinació (°)</label>
                                <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" id="inclinacion" name="inclinacion" placeholder="Exemple: 30" required>
                            </div>
                        </div>
                    </form>
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
            const accordionButtons = document.querySelectorAll('.accordion-button');
            
            accordionButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const section = this.parentElement;
                    section.classList.toggle('active');
                    
                    // Cerrar otras secciones al abrir una (opcional)
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
        });
    </script>

 
</x-app-layout>
    
    <script>
    const slider = document.getElementById("placaSlider");
    const placaCount = document.getElementById("placaCount");
    let value = 0
    // Funció per actualitzar el fons del slider
    function actualitzarFonsSlider() {
        if (value === 0) {  
            slider.style.background = '#e0e0e0';   
        } else {
            slider.style.background = `linear-gradient(to right, #49DBA3 ${value}%, #e0e0e0 ${value}%)`;
        }
        value = ((slider.value - slider.min) / (slider.max - slider.min)) * 100;
    }

    // Inicialitza el fons del slider al carregar la pàgina
    window.addEventListener("load", function () {
        placaCount.innerText = slider.value;  
        actualitzarFonsSlider();  
    });

    // Actualitza el fons i el comptador quan es mou el slider
    slider.addEventListener("input", function () {
        actualitzarFonsSlider();  
        placaCount.innerText = this.value;
    });

    </script>
    
    <script src="build/js/mapa.js"></script>
    <script src="build/js/formulariSidePanel.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9dnmay3GsjXeiIqbmYoJ3FJ95rDo6hoY&libraries=places&callback=initMap"></script>
    <script src="https://solar.googleapis.com/v1/buildingInsights:findClosest?key=AIzaSyB9dnmay3GsjXeiIqbmYoJ3FJ95rDo6hoY"></script>
</body>

</html>