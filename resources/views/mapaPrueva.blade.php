<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador de Direcció</title>
    <link rel="stylesheet" href="build/css/styleMapa.css">
</head>

<body>
    <x-app-layout>
        
        <!-- Contenedor del mapa y barra de progreso -->
        <div class="map-container">
            <!-- Barra de progreso -->
            <div class="progressbar-container">
                <ul class="progressbar">
                    <li data-url="dades">Dades Client</li>
                    <li data-url="mapa" class="active">Seleccionar area</li>
                    <li data-url="formulari">Formulari Prova</li>
                </ul>
            </div>

            <!-- Contenedor del mapa y buscador -->
            <div class="map-header">
                <div class="search-container">
                    <input type="text" id="address" placeholder="Escriu la teva direcció">
                    <button id="buttonBuscar" onclick="geocodeAddress()">Buscar</button>
                </div>
                <div class="map-buttons">
                    <button onclick="changeMapType('roadmap')">Roadmap</button>
                    <button onclick="changeMapType('satellite')">Satèl·lit</button>
                </div>
            </div>

            <!-- Mapa -->
            <div id="map"></div>
        </div>
    </x-app-layout>
    <script src="build/js/marcadors.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDu3ReEUVEQANj_h1EAtfe4-zyarcb3X04&libraries=places&callback=initMap"></script>
    <script src="https://solar.googleapis.com/v1/buildingInsights:findClosest?key=AIzaSyDu3ReEUVEQANj_h1EAtfe4-zyarcb3X04"></script>
</body>

</html>