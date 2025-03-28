<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producció Solar</title>
    <link rel="stylesheet" href="build/css/produccio.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <x-app-layout>
        
        <!-- Barra de progres -->
        <div class="progress-bar-container mt-4 px-4"> 
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
            
                        <!-- PAS 2 - CONSUM -->
                        <li class="flex flex-col items-center cursor-pointer transition-transform duration-200 ease-in-out hover:scale-95">
                            <a href="consum" class="flex flex-col items-center">
                                <div class="w-10 h-10 flex items-center justify-center bg-white border-2 border-emerald-400 rounded-full text-emerald-400 font-bold text-lg">
                                    2
                                </div>
                                <span class="text-gray-700 dark:text-white text-sm md:text-base mt-1">
                                    Consum
                                </span>
                            </a>
                        </li>
            
                        <!-- PAS 3 -->
                        <li class="flex flex-col items-center cursor-pointer transition-transform duration-200 ease-in-out hover:scale-95">
                            <a href="mapa" class="flex flex-col items-center">
                                <div class="w-10 h-10 flex items-center justify-center bg-white border-2 border-emerald-400 rounded-full text-emerald-400 font-bold text-lg">
                                    3
                                </div>
                                <span class="text-gray-700 dark:text-white text-sm md:text-base mt-1">
                                    Seleccionar Àrea
                                </span>
                            </a>
                        </li>
            
                        <!-- PAS 4 ACTIVO (PRODUCCIÓ) -->
                        <li class="flex flex-col items-center cursor-pointer transition-transform duration-200 ease-in-out hover:scale-95">
                            <a href="produccio" class="flex flex-col items-center">
                                <div class="w-10 h-10 flex items-center justify-center bg-emerald-400 border-2 border-emerald-400 rounded-full text-white font-bold text-lg">
                                    4
                                </div>
                                <span class="text-gray-700 dark:text-white text-sm md:text-base mt-1">
                                    Producció
                                </span>
                            </a>
                        </li>
            
                    </ul>
                </div>
            </div>
        </div>

        <!-- Contingut principal -->
        <div class="container mx-auto px-4 py-8 w-full max-w-6xl"> <!-- Igual amplada que progress bar -->
            <!-- Grid 2x2 de cartes -->
            <div class="grid-2x2 mb-8">
                <!-- Fila 1 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden card">
                    <div class="p-6 system-info">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Informació del Sistema</h2>
                        <div class="system-info-content">
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Ubicació:</span>
                                    <span class="font-medium" id="location">Barcelona, ES</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Panells instal·lats:</span>
                                    <span class="font-medium" id="panelCount">12</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Model panells:</span>
                                    <span class="font-medium" id="panelModel">Trina Solar 450W</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Orientació:</span>
                                    <span class="font-medium" id="orientation">Sud</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Inclinació:</span>
                                    <span class="font-medium" id="tilt">30°</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Tarifa d'accés:</span>
                                    <span class="font-medium" id="tarifaAcces">2.0A</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Tipus d'instal·lació:</span>
                                    <span class="font-medium" id="tipusInstalacio">Monofàsica</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md overflow-hidden card">
                    <div class="p-6 card-content">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Producció Anual</h2>
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
                                    <span class="text-gray-500">kWh/any</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-center text-sm text-gray-500">
                            <p>Equivalent al consum de <span class="font-medium" id="equivalentHomes">1.2</span> llars</p>
                        </div>
                    </div>
                </div>

                <!-- Fila 2 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden card">
                    <div class="p-6 card-content">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Estalvi i Impacte</h2>
                        <div class="space-y-4 flex-1">
                            <div>
                                <h3 class="text-gray-600 mb-1">Estalvi anual:</h3>
                                <p class="text-2xl font-bold text-emerald-600">€<span id="annualSavings">648</span></p>
                            </div>
                            <div>
                                <h3 class="text-gray-600 mb-1">CO₂ evitats:</h3>
                                <p class="text-2xl font-bold text-emerald-600"><span id="co2Saved">1,728</span> kg</p>
                            </div>
                            <div class="pt-2 border-t border-gray-100 mt-auto">
                                <h3 class="text-gray-600 mb-1">Retorn de la inversió:</h3>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-emerald-600 h-2.5 rounded-full" style="width: 45%"></div>
                                </div>
                                <p class="text-sm text-gray-500 mt-1"><span id="roiYears">5.2</span> anys</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg overflow-hidden p-8 max-w-4xl mx-auto card">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6 ">Mètriques de Rendiment</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Primer cuadro -->
                        <div class="flex flex-col items-center p-6 bg-gradient-to-br from-emerald-50 to-green-50 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 border border-emerald-100">
                            <div class="mb-3 text-center">
                                <p class="text-lg font-medium text-gray-600">Factor de Capacitat</p>
                            </div>
                            <p class="text-4xl font-black text-emerald-600">
                                <span id="capacityFactor">18.2</span>%
                            </p>
                        </div>
                        
                        <!-- Segundo cuadro -->
                        <div class="flex flex-col items-center p-6 bg-gradient-to-br from-emerald-50 to-green-50 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 border border-emerald-100">
                            <div class="mb-3 text-center">
                                <p class="text-lg font-medium text-gray-600">Hores Pico Solars</p>
                            </div>
                            <p class="text-4xl font-black text-emerald-600">
                                <span id="peakSunHours">1,598</span>
                            </p>
                        </div>
                        
                        <!-- Tercer cuadro -->
                        <div class="flex flex-col items-center p-6 bg-gradient-to-br from-emerald-50 to-green-50 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 border border-emerald-100">
                            <div class="mb-3 text-center">
                                <p class="text-lg font-medium text-gray-600">Rendiment del Sistema</p>
                            </div>
                            <p class="text-4xl font-black text-emerald-600">
                                <span id="systemEfficiency">78.5</span>%
                            </p>
                        </div>
                    </div>
                </div>
                
            </div>

            <!-- Gràfics i taula -->
            <div class="space-y-6">
                <!-- Gràfic Producció Mensual -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden card">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Producció Mensual</h2>
                        <div class="h-80">
                            <canvas id="monthlyChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Gràfic Patró Diari -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden card">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Patró Diari</h2>
                        <div class="h-64">
                            <canvas id="dailyPatternChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Taula de Dades Detallades -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden card cursor-pointer accordion-card">
                    <div class="p-6">
                        <div class="flex justify-between items-center accordion-toggle">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Dades Detallades</h2>
                            <!-- Icono de flecha (se puede cambiar por +/−) -->
                            <svg class="w-5 h-5 text-gray-500 transition-transform duration-300 accordion-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                        <div class="overflow-x-auto accordion-content hidden">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mes</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producció (kWh)</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rendiment</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estalvi (€)</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CO₂ evitats (kg)</th>
                                    </tr>
                                </thead>
                                <tbody id="monthlyDataTable" class="bg-white divide-y divide-gray-200">
                                    <!-- Dades es carregaran aquí -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Botons d'Exportació -->
                <div class="flex justify-end space-x-3">
                    <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        <i class="fas fa-download mr-2"></i>Exportar PDF
                    </button>
                    <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        <i class="fas fa-file-excel mr-2"></i>Exportar Excel
                    </button>
                </div>
            </div>
        </div>
    </x-app-layout>
    <script src="build/js/produccio.js"></script>
</body>
</html>