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

    

    <!-- Side Panel -->
    <div id="sidePanel" class="side-panel">
        <button id="closePanelButton" class="close-panel-button">×</button>
        <div>
            <form action="" class="form-container">
                <h3 class="form-title">Introduïu les dades de la ubicació</h3>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="latitud" class="form-label">Latitud</label>
                        <input type="text" class="form-control" id="latitud" name="latitud" placeholder="Exemple: 41.40338" required>
                    </div>
                    <div class="col-md-6">
                        <label for="longitud" class="form-label">Longitud</label>
                        <input type="text" class="form-control" id="longitud" name="longitud" placeholder="Exemple: 2.17403" required>
                    </div>
                </div>
                <h3 class="form-title2">Dades de les plaques solars</h3>
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
                
            </form>
        </div>
    </div>

</x-app-layout>
    
    <script src="build/js/mapa.js"></script>
    <script src="build/js/formulariSidePanel.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9dnmay3GsjXeiIqbmYoJ3FJ95rDo6hoY&libraries=places&callback=initMap"></script>
    <script src="https://solar.googleapis.com/v1/buildingInsights:findClosest?key=AIzaSyB9dnmay3GsjXeiIqbmYoJ3FJ95rDo6hoY"></script>
</body>

</html>