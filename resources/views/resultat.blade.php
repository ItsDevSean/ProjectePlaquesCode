<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultats d'Estalvi | Anàlisi Fotovoltaic</title>
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
                        
                        <li class="flex flex-col items-center">
                            <a href="dades" class="flex flex-col items-center">
                                <div class="w-10 h-10 flex items-center justify-center bg-white border-2 border-gray-300 rounded-full text-gray-400 font-bold text-lg">
                                    1
                                </div>
                                <span class="text-gray-500 dark:text-gray-400 text-sm md:text-base mt-1">
                                    Dades del Client
                                </span>
                            </a>
                        </li>
            
                        <li class="flex flex-col items-center">
                            <a href="consum" class="flex flex-col items-center">
                                <div class="w-10 h-10 flex items-center justify-center bg-white border-2 border-gray-300 rounded-full text-gray-400 font-bold text-lg">
                                    2
                                </div>
                                <span class="text-gray-500 dark:text-gray-400 text-sm md:text-base mt-1">
                                    Consum
                                </span>
                            </a>
                        </li>
            
                        <li class="flex flex-col items-center">
                            <a href="mapa" class="flex flex-col items-center">
                                <div class="w-10 h-10 flex items-center justify-center bg-white border-2 border-gray-300 rounded-full text-gray-400 font-bold text-lg">
                                    3
                                </div>
                                <span class="text-gray-500 dark:text-gray-400 text-sm md:text-base mt-1">
                                    Seleccionar Àrea
                                </span>
                            </a>
                        </li>
            
                        <li class="flex flex-col items-center">
                            <div class="flex flex-col items-center">
                                <div class="w-10 h-10 flex items-center justify-center bg-emerald-600 border-2 border-emerald-600 rounded-full text-white font-bold text-lg">
                                    4
                                </div>
                                <span class="text-gray-700 dark:text-white text-sm md:text-base mt-1 font-semibold">
                                    Resultats
                                </span>
                            </div>
                        </li>
            
                    </ul>
                </div>
            </div>
        </div>

        <!-- Contingut principal -->
        <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
            <!-- Capçalera -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Resultats de la teva instal·lació fotovoltaica</h1>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">Anàlisi complet del teu estalvi i amortització</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <button class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Exportar informe
                    </button>
                </div>
            </div>

            <!-- Resum dels resultats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Estalvi anual -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-emerald-100 dark:border-emerald-900">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-white">Estalvi anual</h3>
                        <div class="p-2 rounded-full bg-emerald-100 dark:bg-emerald-900/50">
                            <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-emerald-600 dark:text-emerald-400 mt-4">1.250€</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">70% del teu consum elèctric</p>
                </div>
                
                <!-- Inversió inicial -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-blue-100 dark:border-blue-900">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-white">Inversió inicial</h3>
                        <div class="p-2 rounded-full bg-blue-100 dark:bg-blue-900/50">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-blue-600 dark:text-blue-400 mt-4">6.450€</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">IVA i instal·lació inclosos</p>
                </div>
                
                <!-- Temps d'amortització -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-orange-100 dark:border-orange-900">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-white">Amortització</h3>
                        <div class="p-2 rounded-full bg-orange-100 dark:bg-orange-900/50">
                            <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-orange-600 dark:text-orange-400 mt-4">5,2 anys</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Retorn de la inversió</p>
                </div>
            </div>

            <!-- Gràfic d'estalvi acumulat -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">Estalvi acumulat</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Projecció dels teus estalvis en els pròxims 25 anys</p>
                    </div>
                    <div class="mt-2 md:mt-0 flex items-center space-x-2">
                        <button id="toggle-legend" class="text-sm flex items-center text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            Llegenda
                        </button>
                        <button id="export-savings-chart" class="text-sm flex items-center text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Exportar
                        </button>
                    </div>
                </div>
                
                <div class="h-96">
                    <canvas id="savingsChart"></canvas>
                </div>
                
                <div id="chart-legend" class="mt-4 flex flex-wrap justify-center gap-4 hidden">
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-emerald-500 mr-2"></div>
                        <span class="text-xs text-gray-600 dark:text-gray-300">Estalvi acumulat</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-blue-500 mr-2"></div>
                        <span class="text-xs text-gray-600 dark:text-gray-300">Inversió inicial</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-orange-500 mr-2"></div>
                        <span class="text-xs text-gray-600 dark:text-gray-300">Punt d'amortització</span>
                    </div>
                </div>
            </div>

            <!-- Detalls de la instal·lació -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <!-- Configuració del sistema -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Configuració del teu sistema</h3>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between items-center pb-4 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <span class="text-gray-700 dark:text-gray-300">Panells solars</span>
                            </div>
                            <span class="font-medium">8 unitats</span>
                        </div>
                        
                        <div class="flex justify-between items-center pb-4 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                <span class="text-gray-700 dark:text-gray-300">Potència total</span>
                            </div>
                            <span class="font-medium">4.2 kWp</span>
                        </div>
                        
                        <div class="flex justify-between items-center pb-4 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                                <span class="text-gray-700 dark:text-gray-300">Producció anual</span>
                            </div>
                            <span class="font-medium">5,800 kWh</span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-gray-700 dark:text-gray-300">Vida útil estimada</span>
                            </div>
                            <span class="font-medium">25+ anys</span>
                        </div>
                    </div>
                </div>
                
                <!-- Impacte ambiental -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Impacte ambiental</h3>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between items-center pb-4 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                </svg>
                                <span class="text-gray-700 dark:text-gray-300">Reducció CO₂</span>
                            </div>
                            <span class="font-medium">1.8 tones/any</span>
                        </div>
                        
                        <div class="flex justify-between items-center pb-4 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                <span class="text-gray-700 dark:text-gray-300">Equivalent en arbres</span>
                            </div>
                            <span class="font-medium">85 arbres/any</span>
                        </div>
                        
                        <div class="flex justify-between items-center pb-4 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                                </svg>
                                <span class="text-gray-700 dark:text-gray-300">Aigua neta</span>
                            </div>
                            <span class="font-medium">3,700 litres/any</span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                                <span class="text-gray-700 dark:text-gray-300">Energia neta</span>
                            </div>
                            <span class="font-medium">100% renovable</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resum econòmic -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-8">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-6">Resum econòmic</h3>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Any</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Estalvi anual</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Estalvi acumulat</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ROI</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">1</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">1.250€</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">1.250€</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">-19%</td>
                            </tr>
                            <tr class="bg-gray-50 dark:bg-gray-700">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">2</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">1.280€</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">2.530€</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">-39%</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">3</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">1.310€</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">3.840€</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">-59%</td>
                            </tr>
                            <tr class="bg-gray-50 dark:bg-gray-700">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">4</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">1.340€</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">5.180€</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">-80%</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">5</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">1.370€</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">6.550€</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-emerald-600 dark:text-emerald-400 font-medium">+2%</td>
                            </tr>
                            <tr class="bg-emerald-50 dark:bg-emerald-900/10">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">10</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">1.490€</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">12.350€</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-emerald-600 dark:text-emerald-400 font-medium">+91%</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">15</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">1.620€</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">19.100€</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-emerald-600 dark:text-emerald-400 font-medium">+196%</td>
                            </tr>
                            <tr class="bg-gray-50 dark:bg-gray-700">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">20</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">1.760€</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">26.850€</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-emerald-600 dark:text-emerald-400 font-medium">+316%</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">25</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">1.920€</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">35.750€</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-emerald-600 dark:text-emerald-400 font-medium">+454%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- CTA Final -->
            <div class="bg-gradient-to-r from-emerald-500 to-teal-600 rounded-lg p-8 text-center">
                <h3 class="text-2xl font-bold text-white mb-2">Vols començar a estalviar?</h3>
                <p class="text-emerald-100 mb-6">Contacta amb els nostres experts per a una avaluació personalitzada</p>
                <button class="px-6 py-3 bg-white text-emerald-600 font-medium rounded-lg shadow-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-emerald-500 transition-colors">
                    Contactar ara
                </button>
            </div>
        </div>

        <script>
            // Gràfic d'estalvi acumulat
            const savingsCtx = document.getElementById('savingsChart').getContext('2d');
            const savingsChart = new Chart(savingsCtx, {
                type: 'line',
                data: {
                    labels: Array.from({length: 25}, (_, i) => i + 1),
                    datasets: [
                        {
                            label: 'Estalvi acumulat',
                            data: Array.from({length: 25}, (_, i) => 1250 * (i+1) * 1.02**i),
                            borderColor: '#10B981',
                            backgroundColor: 'rgba(16, 185, 129, 0.05)',
                            borderWidth: 3,
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'Inversió inicial',
                            data: Array(25).fill(6450),
                            borderColor: '#3B82F6',
                            borderWidth: 2,
                            borderDash: [5, 5],
                            pointRadius: 0
                        },
                        {
                            label: 'Punt amortització',
                            data: Array(5).fill(null).concat(Array(20).fill(6450)),
                            borderColor: '#F59E0B',
                            borderWidth: 2,
                            pointRadius: 0
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': ' + context.raw.toLocaleString() + '€';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Anys'
                            },
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Euros (€)'
                            },
                            beginAtZero: true
                        }
                    }
                }
            });

            // Mostrar/ocultar llegenda
            document.getElementById('toggle-legend').addEventListener('click', function() {
                const legend = document.getElementById('chart-legend');
                legend.classList.toggle('hidden');
            });

            // Exportar gràfic
            document.getElementById('export-savings-chart').addEventListener('click', function() {
                const link = document.createElement('a');
                link.download = 'estalvi-acumulat.png';
                link.href = document.getElementById('savingsChart').toDataURL('image/png');
                link.click();
            });
        </script>
    </x-app-layout>
</body>
</html>