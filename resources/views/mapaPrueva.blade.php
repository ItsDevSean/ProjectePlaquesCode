<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador de Direcció</title>
    <link rel="stylesheet" href="build/css/styleMapa.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <x-app-layout>

        <!-- Barra de progrés responsive -->
        <div class="progress-bar-container mt-4 px-4"> <!-- Ajustado el margen superior -->
            <div class="progress-bar bg-white border flex justify-center items-center mx-auto shadow-teal-300 shadow-md max-w-6xl p-2 rounded-lg dark:bg-gray-700 dark:text-gray-300">
                <div class="w-full max-w-screen-2xl px-4 md:px-12 mx-auto overflow-x-auto overflow-y-hidden scrollbar-hide">
                    <ul class="w-full flex flex-nowrap justify-start md:justify-center items-center gap-6 sm:gap-10 md:gap-20 mt-2 md:mt-0 text-center whitespace-nowrap overflow-visible min-h-[4rem]">
                        
                        <!-- PAS 1 -->
                        <li class="flex flex-col items-center cursor-pointer transition-transform duration-200 ease-in-out hover:scale-95">
                            <a href="dades" class="flex flex-col items-center">
                                <div class="w-10 h-10 flex items-center justify-center bg-white border-2 border-emerald-400 rounded-full text-emerald-400 font-bold text-lg">
                                    1
                                </div>
                                <span class="text-gray-700 dark:text-white text-sm md:text-base mt-1">
                                    Dades del Client
                                </span>
                            </a>
                        </li>
            
                        <!-- PAS 2 -->
                        <li class="flex flex-col items-center cursor-pointer transition-transform duration-200 ease-in-out hover:scale-95">
                            <a href="mapa" class="flex flex-col items-center">
                                <div class="w-10 h-10 flex items-center justify-center bg-emerald-400 border-2 border-emerald-400 rounded-full text-white font-bold text-lg">
                                    2
                                </div>
                                <span class="text-gray-700 dark:text-white text-sm md:text-base mt-1">
                                    Seleccionar Àrea
                                </span>
                            </a>
                        </li>
            
                        <!-- PAS 3 -->
                        <li class="flex flex-col items-center cursor-pointer transition-transform duration-200 ease-in-out hover:scale-95">
                            <a href="formulari" class="flex flex-col items-center">
                                <div class="w-10 h-10 flex items-center justify-center bg-white border-2 border-emerald-400 rounded-full text-emerald-400 font-bold text-lg">
                                    3
                                </div>
                                <span class="text-gray-700 dark:text-white text-sm md:text-base mt-1">
                                    Formulari Prova
                                </span>
                            </a>
                        </li>
            
                    </ul>
                </div>
            </div>
        </div>

    <!-- Contenidor del mapa -->
    <div class="map-container">
        <div class="map-header">
            <div class="search-container">
                <input type="text" id="address" placeholder="Escriu la teva direcció" autocomplete="off">
                <button id="buttonBuscar">Buscar</button>
                <button id="startSelection">Seleccionar area</button>
                <span id="areaResult" style="display: none;"></span>
                <button id="saveAreaButton" style="display: none;">Guardar Área</button>
            </div>
        </div>
        <div id="map">
        </div>
    </div>

    

    <div id="sidePanel" class="side-panel">
        <button id="closePanelButton" class="close-panel-button">×</button>
        <div>
            <form action="" class="form-container">
                <div class = "row">
                    <div class="title-container">
                        <img src="/img/panelSolar2.png" alt="vf" class="panel-img" width="30" height="auto">
                        <h3 class="form-title2">Dades de les plaques solars</h3>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="area" class="form-label">Àrea de les plaques (m²)</label>
                        <input type="text" class="form-control" id="area" name="area" placeholder="Exemple: 50" required>
                    </div>
                    <div class="col-md-4">
                        <label for="orientacion" class="form-label">Orientació</label>
                        <select class="form-select" id="orientacion" name="orientacion" required>
                            <option value="norte">Nord</option>
                            <option value="sur" selected>Sud</option>
                            <option value="este">Est</option>
                            <option value="oeste">Oest</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="inclinacion" class="form-label">Inclinació (°)</label>
                        <input type="number" class="form-control" id="inclinacion" name="inclinacion" placeholder="Exemple: 30" required>
                    </div>
                </div>
                <!-- Agregar el slider aquí -->
               

                <!-- Nueva Sección: Selecciona Panel -->
            </form>
            <form form action="" class="form-container">
            <div class = "row">
                    <div class="title-container">
                        <img src="/img/panelSolar2.png" alt="vf" class="panel-img" width="30" height="auto">
                        <h3 class="form-title2">Selecció de plaques</h3>
                    </div>
                </div>
            <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="panel_model" class="form-label">Selecciona Panel</label>
                        <select class="form-select" id="panel_model" name="panel_model" required>
                            <option value="">-- Selecciona un modelo --</option>
                            @foreach($panels as $panel)
                                <option value="{{ $panel->id }}">{{ $panel->panel_model }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="row mb-3">
                        <div class="slider-container">
                            <label for="placaSlider" class="form-label">Nombre de plaques:</label>
                            <input type="range" class="form-range custom-slider" id="placaSlider" min="0" max="1" step="1">
                            <input type="number" id="placaCount" class="form-control" min="0" max="1" value="0">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

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