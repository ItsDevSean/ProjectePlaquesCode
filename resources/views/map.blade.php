<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador de Dirección</title>
    <link rel="stylesheet" href="build/css/styles.css">
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Buscador de Dirección') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div id="mapHeader">
                            <!-- Formulario de búsqueda -->
                            <div>
                                <input type="text" id="address" placeholder="Escribe tu ciudad, calle y número">
                                <button id="buttonBuscar" onclick="geocodeAddress()">Buscar</button>
                            </div>

                            <!-- Botones para cambiar el tipo de mapa -->
                            <div class="map-buttons">
                                <button onclick="changeMapType('roadmap')">Roadmap</button>
                                <button onclick="changeMapType('satellite')">Satelite</button>
                            </div>

                            <!-- Desplegable per seleccionar un edifici -->
                            <div>
                                <select id="edifici" onchange="seleccionarEdifici()">
                                    <option value="">Selecciona un edifici</option>
                                </select>
                            </div>
                        </div>

                        <!-- Mapa on es mostrarà la localització -->
                        <div id="map"></div>                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Cargar el script de Google Maps -->
        <script src="build/js/marcadors.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDu3ReEUVEQANj_h1EAtfe4-zyarcb3X04&libraries=places&callback=initMap"></script>
        <script src="https://solar.googleapis.com/v1/buildingInsights:findClosest?key=AIzaSyDu3ReEUVEQANj_h1EAtfe4-zyarcb3X04"></script>
    </x-app-layout>
</body>

</html>
