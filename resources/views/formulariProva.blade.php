<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulari</title>
    <link rel="stylesheet" href="build/css/styles.css">
</head>
<body>
    <x-app-layout>
        <div>
            <!-- barra de progres -->
            <div class="progress-bar-container mt-5">
                <div class="progress-bar bg-white border flex justify-center items-center mx-auto shadow-teal-300 shadow-md max-w-6xl p-2 rounded-lg dark:bg-gray-700 dark:text-gray-300">
                    <div class="w-full max-w-screen-2xl px-12 mx-auto">
                        <ul class="w-full flex flex-col md:flex-row justify-center items-center gap-40 mt-2 md:mt-0 md:text-base md:font-medium">
                            <li class="flex flex-col items-center cursor-pointer transition-transform duration-200 ease-in-out hover:scale-110">
                                <a href="dades" class="flex flex-col items-center">
                                    <div class="w-10 h-10 flex items-center justify-center bg-white border-2 border-emerald-400 rounded-full text-emerald-400 font-bold text-lg">1</div>
                                    <span class="text-gray-700 dark:text-white text-sm md:text-base mt-1">Dades del Client</span>
                                </a>
                            </li>
                            <li class="flex flex-col items-center cursor-pointer transition-transform duration-200 ease-in-out hover:scale-110">
                                <a href="mapa" class="flex flex-col items-center">
                                    <div class="w-10 h-10 flex items-center justify-center bg-white border-2 border-emerald-400 rounded-full text-emerald-400 font-bold text-lg">2</div>
                                    <span class="text-gray-700 dark:text-white text-sm md:text-base mt-1">Seleccionar area</span>
                                </a>
                            </li>
                            <li class="flex flex-col items-center cursor-pointer transition-transform duration-200 ease-in-out hover:scale-110">
                                <a href="formulari" class="flex flex-col items-center">
                                    <div class="w-10 h-10 flex items-center justify-center bg-emerald-400 border-2 border-emerald-400 rounded-full text-white font-bold text-lg">3</div>
                                    <span class="text-gray-700 dark:text-white text-sm md:text-base mt-1">Formulari Prova</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div>
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
    </x-app-layout>
    <script src="build/js/generalScript.js"></script>
    <script src="build/js/formulari.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDu3ReEUVEQANj_h1EAtfe4-zyarcb3X04&libraries=places&callback=initMap"></script>
    <script src="https://solar.googleapis.com/v1/buildingInsights:findClosest?key=AIzaSyDu3ReEUVEQANj_h1EAtfe4-zyarcb3X04"></script>
</body>
</html>