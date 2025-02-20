<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador de Direcció</title>
    <link rel="stylesheet" href="build/css/styles.css">
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Buscador de Direcció') }}
            </h2>
        </x-slot>
        <div class="container mt-4">
            <ul class="progressbar">
                <li data-url="dades">Dades Client</li>
                <li data-url="mapa" class=active>Seleccionar area</li>
                <li data-url="vista3.html">Pas 3</li>
            </ul>
        </div>      
        
        <div class="py-13">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <div id="mapHeader">
                            <!-- Formulari de búsqueda -->
                            <div>
                                <input type="text" id="address" placeholder="Escriu la teva direcció">
                                <button id="buttonBuscar" onclick="geocodeAddress()">Buscar</button>
                            </div>

                            <!-- Botons per canviar el tipus de mapa -->
                            <div class="map-buttons">
                                <button onclick="changeMapType('roadmap')">Roadmap</button>
                                <button onclick="changeMapType('satellite')">Satèl·lit</button>
                            </div>

                            <!-- Desplegable per seleccionar un edifici -->
                            <div>
                                <select id="edifici" onchange="seleccionarEdifici()">
                                    <option value="" disabled selected>Selecciona un edifici</option>
                                    <option value="edit">Editar edificis...</option>
                                </select>                                
                            </div>
                        </div>

                        <!-- Mapa on es mostrarà la localització -->
                        <div id="map"></div>

                        <!-- Formulari d'entrada de dades -->
                        <form action="" class="form-container">
                            <h3 class="form-title">Introduïu les dades de la ubicació</h3>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="latitud" class="form-label">Latitud</label>
                                    <input type="text" class="form-control" id="latitud" name="latitud" placeholder="Exemple: 41.40338">
                                </div>
                                <div class="col-md-6">
                                    <label for="longitud" class="form-label">Longitud</label>
                                    <input type="text" class="form-control" id="longitud" name="longitud" placeholder="Exemple: 2.17403">
                                </div>
                            </div>
                        
                            <h3 class="form-title2">Dades de les plaques solars</h3>
                        
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="area" class="form-label">Àrea de les plaques (m²)</label>
                                    <input type="text" class="form-control" id="area" name="area" placeholder="Exemple: 50">
                                </div>
                                <div class="col-md-4">
                                    <label for="orientacion" class="form-label">Orientació</label>
                                    <select class="form-select" id="orientacion" name="orientacion">
                                        <option value="norte">Nord</option>
                                        <option value="sur" selected>Sud</option>
                                        <option value="este">Est</option>
                                        <option value="oeste">Oest</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="inclinacion" class="form-label">Inclinació (°)</label>
                                    <input type="number" class="form-control" id="inclinacion" name="inclinacion" placeholder="Exemple: 30">
                                </div>
                            </div>
                        
                            <button type="submit" class="btn btn-success">Enviar</button>
                        </form>                      

                    </div>
                </div>
            </div>
        </div>

        <script src="build/js/marcadors.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDu3ReEUVEQANj_h1EAtfe4-zyarcb3X04&libraries=places&callback=initMap"></script>
        <script src="https://solar.googleapis.com/v1/buildingInsights:findClosest?key=AIzaSyDu3ReEUVEQANj_h1EAtfe4-zyarcb3X04"></script>
    </x-app-layout>
</body>
</html>
