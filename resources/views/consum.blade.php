<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consum del Client | Anàlisi d'Estalvi</title>
    <link rel="stylesheet" href="build/css/produccio.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
</head>
<body>
    <x-app-layout>
        
        <div class="progress-container mx-auto max-w-5xl px-4 mt-12" x-data="{
            currentStep: 2, // Ara estem al pas 2 (Consum)
            steps: [
                {id: 1, name: 'Dades del Client', completed: true, path: 'dades'},
                {id: 2, name: 'Consum', completed: false, path: 'consum'},
                {id: 3, name: 'Seleccionar Àrea', completed: false, path: 'mapa'},
                {id: 4, name: 'Producció', completed: false, path: 'produccio'}
            ],
            getProgressWidth() {
                // 33% perquè hem completat 1 de 3 passos (el primer)
                return 33;
            },
            navigateTo(step) {
                // Permetre navegar a qualsevol pas
                window.location.href = step.path;
            }
        }">
            <!-- Progress Track -->
            <div class="relative h-1.5 mb-24">
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
                                            'cursor-pointer': true, // Sempre clickable
                                            'border-4': step.completed || step.id === currentStep,
                                            'border-2': !step.completed && step.id !== currentStep,
                                            'rounded-full': true,
                                            'group-hover:scale-110': true // Sempre hover effect
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
                                
                                <!-- Step Label - Sempre visible -->
                                <div class="absolute top-full mt-3 left-1/2 transform -translate-x-1/2 text-center">
                                    <span class="whitespace-nowrap font-medium px-3 py-1.5 rounded-lg"
                                          :class="{
                                              'text-sm font-semibold text-gray-800 dark:text-white bg-white dark:bg-gray-800 shadow-lg': step.id === currentStep,
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

        <!-- Contingut principal mejorado -->
        <div class="max-w-6xl mx-auto px-6 py-8 mt-6 bg-white rounded-xl shadow-lg dark:bg-gray-800 transition-all duration-300 hover:shadow-xl ">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Anàlisi del teu consum</h2>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">Introdueix les teves dades de consum per calcular el teu estalvi potencial</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <button id="help-button" class="flex items-center text-emerald-600 dark:text-emerald-400 hover:text-emerald-800 dark:hover:text-emerald-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                            </svg>
                            Com funciona?
                        </button>
                    </div>
                </div>
                
                <!-- Pestañas de opciones de entrada -->
                <div class="mb-8 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px" id="inputTabs" role="tablist">
                        <li class="mr-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg active" id="manual-tab" data-tabs-target="#manual" type="button" role="tab" aria-controls="manual" aria-selected="true">Introducció Manual</button>
                        </li>
                        <li class="mr-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="upload-tab" data-tabs-target="#upload" type="button" role="tab" aria-controls="upload" aria-selected="false">Pujar Fitxer</button>
                        </li>
                        <li class="mr-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="link-tab" data-tabs-target="#link" type="button" role="tab" aria-controls="link" aria-selected="false">Enllaç amb Comercialitzadora</button>
                        </li>
                    </ul>
                </div>
                
                <!-- Contenido de las pestañas -->
                <div id="inputTabsContent">
                    <!-- Pestaña Manual -->
                    <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-700" id="manual" role="tabpanel" aria-labelledby="manual-tab">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Consum anual -->
                            <div class="space-y-2">
                                <label for="consum-anual" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Consum anual (kWh/any)
                                </label>
                                <div class="relative">
                                    <input type="number" id="consum-anual" name="consum-anual" id="consumAnual" 
                                           class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500 dark:bg-gray-600 dark:border-gray-500" 
                                           placeholder="Introdueix el teu consum anual">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <span class="text-gray-500 dark:text-gray-400">kWh</span>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Mitjana espanyola: 3.250 kWh/any</p>
                            </div>
                            
                            <!-- Factura anual -->
                            <div class="space-y-2">
                                <label for="factura-anual" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Factura anual (€)
                                </label>
                                <div class="relative">
                                    <input type="number" id="factura-anual" name="factura-anual" 
                                           class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500 dark:bg-gray-600 dark:border-gray-500" 
                                           placeholder="Introdueix la teva factura anual">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <span class="text-gray-500 dark:text-gray-400">€</span>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Mitjana espanyola: 840€/any</p>
                            </div>
                            
                            <!-- Tarifa d'accés mejorada -->
                            <div class="space-y-2">
                                <label for="tarifa-acces" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Tarifa d'accés
                                </label>
                                <select id="tarifa-acces" name="tarifa-acces" 
                                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500 dark:bg-gray-600 dark:border-gray-500">
                                    <option value="" disabled selected>Selecciona la teva tarifa</option>
                                    <option value="2.0A">2.0A - Sense discriminació horària</option>
                                    <option value="2.0DHA">2.0DHA - Discriminació horària</option>
                                    <option value="2.0DHS">2.0DHS - Discriminació horària supervall</option>
                                    <option value="2.1A">2.1A - Sense discriminació horària (major potència)</option>
                                    <option value="2.1DHA">2.1DHA - Discriminació horària (major potència)</option>
                                    <option value="2.1DHS">2.1DHS - Discriminació horària supervall (major potència)</option>
                                    <option value="3.0A">3.0A - Tres períodes</option>
                                    <option value="6.1A">6.1A - Sis períodes</option>
                                </select>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Pots trobar aquesta informació a la teva factura</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <!-- Precios por periodo (solo para tarifas con discriminación horaria) -->
                            <div id="precios-periodo-container" class="hidden space-y-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Preus per període (€/kWh)
                                </label>
                                <div class="grid grid-cols-3 gap-3">
                                    <div class="relative">
                                        <input type="number" step="0.001" id="precio-p1" name="precio-p1" 
                                               class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500 dark:bg-gray-600 dark:border-gray-500" 
                                               placeholder="P1">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                            <span class="text-xs text-gray-500 dark:text-gray-400">€</span>
                                        </div>
                                    </div>
                                    <div class="relative">
                                        <input type="number" step="0.001" id="precio-p2" name="precio-p2" 
                                               class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500 dark:bg-gray-600 dark:border-gray-500" 
                                               placeholder="P2">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                            <span class="text-xs text-gray-500 dark:text-gray-400">€</span>
                                        </div>
                                    </div>
                                    <div class="relative">
                                        <input type="number" step="0.001" id="precio-p3" name="precio-p3" 
                                               class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500 dark:bg-gray-600 dark:border-gray-500" 
                                               placeholder="P3">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                            <span class="text-xs text-gray-500 dark:text-gray-400">€</span>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Introdueix els preus de cada període segons la teva factura</p>
                            </div>
                        </div>
                        
                        <!-- Sección de Costos e Incentivos -->
                        <div class="mt-8 border-t border-gray-200 dark:border-gray-700 pt-6">
                            <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-4">Costos i incentius</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Coste total instalación -->
                                <div class="space-y-2">
                                    <label for="coste-instalacion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Cost total instal·lació
                                    </label>
                                    <div class="relative">
                                        <input type="number" id="coste-instalacion" name="coste-instalacion" 
                                               class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500 dark:bg-gray-600 dark:border-gray-500" 
                                               placeholder="Ex: 6000">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                            <span class="text-gray-500 dark:text-gray-400">€</span>
                                        </div>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Mitjana: 1.200-1.500 €/kWp</p>
                                </div>
                                
                                <!-- Subvenciones -->
                                <div class="space-y-2">
                                    <label for="subvenciones" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Subvencions o bonificacions
                                    </label>
                                    <div class="relative">
                                        <input type="number" id="subvenciones" name="subvenciones" 
                                               class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500 dark:bg-gray-600 dark:border-gray-500" 
                                               placeholder="Ex: 1200" value="0">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                            <span class="text-gray-500 dark:text-gray-400">€</span>
                                        </div>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Ajuts o deduccions aplicables</p>
                                </div>
                                
                                <!-- Precio de venta de excedentes -->
                                <div class="space-y-2">
                                    <label for="precio-excedentes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Preu de venda d'excedents
                                    </label>
                                    <div class="relative">
                                        <input type="number" step="0.001" id="precio-excedentes" name="precio-excedentes" 
                                               class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500 dark:bg-gray-600 dark:border-gray-500" 
                                               placeholder="Ex: 0.08" value="0.05">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                            <span class="text-gray-500 dark:text-gray-400">€/kWh</span>
                                        </div>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Preu per l'energia injectada a la xarxa</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Patró de consum mejorado -->
                        <div class="mt-6">
                            <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-3">Patró de consum</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">Selecciona el patró que més s'ajusti al teu consum habitual</p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <button id="button_diurn" type="button" class="consum-pattern-btn flex flex-col items-center p-4 border-2 border-gray-200 rounded-lg hover:border-emerald-400 dark:border-gray-600 dark:hover:border-emerald-400 transition-colors">
                                    <div class="w-16 h-16 mb-2">
                                        <canvas id="diurnalPatternChart"></canvas>
                                    </div>
                                    <span  id="diurn" class="font-medium text-gray-700 dark:text-gray-200">Diürn</span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">Major consum de dia</span>
                                </button>
                                
                                <button id="button_nocturn" type="button" class="consum-pattern-btn flex flex-col items-center p-4 border-2 border-gray-200 rounded-lg hover:border-emerald-400 dark:border-gray-600 dark:hover:border-emerald-400 transition-colors">
                                    <div class="w-16 h-16 mb-2">
                                        <canvas id="nocturnalPatternChart"></canvas>
                                    </div>
                                    <span id="nocturn" class="font-medium text-gray-700 dark:text-gray-200">Nocturn</span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">Major consum de nit</span>
                                </button>
                                
                                <button id="button_mixt" type="button" class="consum-pattern-btn flex flex-col items-center p-4 border-2 border-gray-200 rounded-lg hover:border-emerald-400 dark:border-gray-600 dark:hover:border-emerald-400 transition-colors">
                                    <div class="w-16 h-16 mb-2">
                                        <canvas id="mixedPatternChart"></canvas>
                                    </div>
                                    <span id="mixt" class="font-medium text-gray-700 dark:text-gray-200">Mixt</span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">Consum repartit</span>
                                </button>
                            </div>
                        </div>
                    </div>                  
                    
                    <!-- Pestaña Upload -->
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-700" id="upload" role="tabpanel" aria-labelledby="upload-tab">
                        <div class="max-w-2xl mx-auto">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-10 h-10 mb-3 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                    <span class="font-semibold">Fes clic per pujar</span> o arrossega el fitxer
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    CSV, XLSX (Màx. 10MB)
                                </p>
                            </div>
                            <input id="consumption-file" type="file" class="hidden" accept=".csv,.xlsx,.xls">
                            
                            <div class="flex justify-center mt-4">
                                <button id="upload-btn" type="button" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                                    Seleccionar Fitxer
                                </button>
                            </div>
                            
                            <div id="file-info" class="mt-4 p-4 bg-white dark:bg-gray-600 rounded-lg shadow-sm hidden">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <svg class="w-6 h-6 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span id="file-name" class="font-medium text-gray-700 dark:text-gray-200"></span>
                                    </div>
                                    <button id="remove-file" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div id="file-progress" class="mt-2 hidden">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                        <div class="bg-emerald-600 h-2.5 rounded-full" style="width: 0%"></div>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Processant fitxer...</p>
                                </div>
                            </div>
                            
                            <div class="mt-6 border-t border-gray-200 dark:border-gray-700 pt-4">
                                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Format recomanat</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">
                                    El fitxer ha d'incloure com a mínim dates i consum horari. Descarga la nostra plantilla per assegurar el format correcte.
                                </p>
                                <button type="button" class="text-xs text-emerald-600 dark:text-emerald-400 hover:underline">
                                    Descargar plantilla CSV
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pestaña Link -->
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-700" id="link" role="tabpanel" aria-labelledby="link-tab">
                        <div class="max-w-2xl mx-auto">
                            <div class="bg-emerald-50 border border-emerald-100 rounded-lg p-4 mb-6 dark:bg-gray-600 dark:border-gray-500">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-emerald-600 dark:text-emerald-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-emerald-800 dark:text-emerald-200">
                                            Accés segur
                                        </h3>
                                        <div class="mt-2 text-sm text-emerald-700 dark:text-emerald-300">
                                            <p>
                                                Connectarem de forma segura amb la teva comercialitzadora per obtenir les teves dades de consum. No emmagatzemem credencials.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="space-y-4">
                                <div>
                                    <label for="energy-provider" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Comercialitzadora
                                    </label>
                                    <select id="energy-provider" name="energy-provider" 
                                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500 dark:bg-gray-600 dark:border-gray-500">
                                        <option value="" disabled selected>Selecciona la teva comercialitzadora</option>
                                        <option value="Endesa">Endesa</option>
                                        <option value="Iberdrola">Iberdrola</option>
                                        <option value="Naturgy">Naturgy</option>
                                        <option value="Repsol">Repsol</option>
                                        <option value="EDP">EDP</option>
                                        <option value="TotalEnergies">TotalEnergies</option>
                                        <option value="Holaluz">Holaluz</option>
                                        <option value="other">Altres</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="cups-number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Número CUPS
                                    </label>
                                    <input type="text" id="cups-number" name="cups-number" 
                                           class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500 dark:bg-gray-600 dark:border-gray-500" 
                                           placeholder="ESXXXXXXX">
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Pots trobar aquest número a qualsevol factura</p>
                                </div>
                                
                                <div class="pt-2">
                                    <button type="button" class="w-full flex justify-center items-center px-4 py-3 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                        Connectar amb Comercialitzadora
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Gráfico de consumo -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">Gràfic de consum</h3>
                    <div class="mt-2 md:mt-0 flex space-x-2">
                        <select id="chart-period" class="text-sm border border-gray-300 rounded-lg px-3 py-1 focus:ring-emerald-500 focus:border-emerald-500 dark:bg-gray-700 dark:border-gray-600">
                            <option value="daily">Diari</option>
                            <option value="weekly">Setmanal</option>
                            <option value="monthly" selected>Mensual</option>
                            <option value="yearly">Anual</option>
                        </select>
                        <button id="export-chart" class="text-sm flex items-center text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Exportar
                        </button>
                    </div>
                </div>
                
                <div class="h-80">
                    <canvas id="consumptionChart"></canvas>
                </div>
                
                <div class="mt-4 flex flex-wrap justify-center gap-2">
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-emerald-500 mr-1"></div>
                        <span class="text-xs text-gray-600 dark:text-gray-300">Consum actual</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-blue-500 mr-1"></div>
                        <span class="text-xs text-gray-600 dark:text-gray-300">Mitjana sectorial</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-orange-500 mr-1"></div>
                        <span class="text-xs text-gray-600 dark:text-gray-300">Consum ideal</span>
                    </div>
                </div>
            </div>
            
            <!-- Resumen y siguiente paso -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div class="bg-blue-50 dark:bg-blue-900/30 p-4 rounded-lg flex-1">
                    <h4 class="text-sm font-medium text-blue-800 dark:text-blue-200 mb-1">Resum del teu consum</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-blue-600 dark:text-blue-300">Consum anual</p>
                            <p class="text-lg font-semibold text-blue-800 dark:text-blue-100">3,450 kWh</p>
                        </div>
                        <div>
                            <p class="text-xs text-blue-600 dark:text-blue-300">Cost anual</p>
                            <p class="text-lg font-semibold text-blue-800 dark:text-blue-100">€890</p>
                        </div>
                        <div>
                            <p class="text-xs text-blue-600 dark:text-blue-300">Patró dominant</p>
                            <p class="text-lg font-semibold text-blue-800 dark:text-blue-100">Mixt</p>
                        </div>
                        <div>
                            <p class="text-xs text-blue-600 dark:text-blue-300">Potència</p>
                            <p class="text-lg font-semibold text-blue-800 dark:text-blue-100">4.6 kW</p>
                        </div>
                    </div>
                </div>
                
                
            </div>
        </div>
            
        
        <script src="{{asset('build/js/consum.js')}}"></script>
    </x-app-layout>
</body>
</html>