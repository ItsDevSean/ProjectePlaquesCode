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
        <!-- Barra de progrés fora del contenidor del mapa -->
        <div class="progress-bar-container">
            <div class="progress-bar bg-white border flex justify-center items-center mx-auto shadow-teal-300 shadow-md max-w-6xl p-2 rounded-lg dark:bg-gray-700 dark:text-gray-300">
                <div class="w-full max-w-screen-2xl px-12 mx-auto">
                    <ul class="w-full flex flex-col md:flex-row justify-center items-center gap-40 mt-2 md:mt-0 md:text-base md:font-medium">
                        <li class="flex flex-col items-center">
                            <div class="w-10 h-10 flex items-center justify-center bg-white border-2 border-emerald-400 rounded-full text-emerald-400 font-bold text-lg">1</div>
                            <span class="text-gray-700 dark:text-white text-sm md:text-base">Dades del Client</span>
                        </li>
                        <li class="flex flex-col items-center">
                            <div class="w-10 h-10 flex items-center justify-center bg-emerald-400 border-2 border-emerald-400 rounded-full text-white font-bold text-lg">2</div>
                            <span class="text-gray-700 dark:text-white text-sm md:text-base">Seleccionar area</span>
                        </li>
                        <li class="flex flex-col items-center">
                            <div class="w-10 h-10 flex items-center justify-center bg-white border-2 border-emerald-400 rounded-full text-emerald-400 font-bold text-lg">3</div>
                            <span class="text-gray-700 dark:text-white text-sm md:text-base">Formulari Prova</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>        
    
        <!-- Contenedor del mapa i buscador -->
        <div class="map-container">
            <div class="map-header">
                <div class="search-container">
                    <input type="text" id="address" placeholder="Escriu la teva direcció" autocomplete="off">
                    <button id="buttonBuscar" onclick="geocodeAddress()">Buscar</button>
                </div>
            </div>
    
            <div id="map"></div>
        </div>
    
    </x-app-layout>
    
    <script src="build/js/marcadors.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9dnmay3GsjXeiIqbmYoJ3FJ95rDo6hoY&libraries=places&callback=initMap"></script>
    <script src="https://solar.googleapis.com/v1/buildingInsights:findClosest?key=AIzaSyDu3ReEUVEQANj_h1EAtfe4-zyarcb3X04"></script>
</body>

</html>