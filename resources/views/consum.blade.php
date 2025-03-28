<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consum del Client</title>
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
            
                        <!-- PAS 2 -->
                        <li class="flex flex-col items-center cursor-pointer transition-transform duration-200 ease-in-out hover:scale-95">
                            <a href="consum" class="flex flex-col items-center">
                                <div class="w-10 h-10 flex items-center justify-center bg-emerald-400 border-2 border-emerald-400 rounded-full text-white font-bold text-lg">
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
            
                        <!-- PAS 4 -->
                        <li class="flex flex-col items-center cursor-pointer transition-transform duration-200 ease-in-out hover:scale-95">
                            <a href="produccio" class="flex flex-col items-center">
                                <div class="w-10 h-10 flex items-center justify-center bg-white border-2 border-emerald-400 rounded-full text-emerald-400 font-bold text-lg">
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
        <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Anàlisi del teu consum</h2>
                
                <!-- Formulari de consum -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Consum mensual -->
                    <div class="space-y-2">
                        <label for="consum-mensual" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Consum mensual (kWh/mes)
                        </label>
                        <div class="relative">
                            <input type="number" id="consum-mensual" name="consum-mensual" 
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-emerald-400 focus:border-emerald-400" 
                                   placeholder="Introdueix el teu consum mensual">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <span class="text-gray-500">kWh</span>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Mitjana espanyola: 270 kWh/mes</p>
                    </div>
                    
                    <!-- Factura mensual -->
                    <div class="space-y-2">
                        <label for="factura-mensual" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Factura mensual (€)
                        </label>
                        <div class="relative">
                            <input type="number" id="factura-mensual" name="factura-mensual" 
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-emerald-400 focus:border-emerald-400" 
                                   placeholder="Introdueix la teva factura mensual">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <span class="text-gray-500">€</span>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Mitjana espanyola: 70€/mes</p>
                    </div>
                    
                    <!-- Tarifa d'accés -->
                    <div class="space-y-2">
                        <label for="tarifa-acces" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Tarifa d'accés
                        </label>
                        <select id="tarifa-acces" name="tarifa-acces" 
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-emerald-400 focus:border-emerald-400">
                            <option value="" disabled selected>Selecciona la teva tarifa</option>
                            <option value="2.0A">2.0A - Sin discriminación horaria</option>
                            <option value="2.0DHA">2.0DHA - Discriminación horaria</option>
                            <option value="2.0DHS">2.0DHS - Discriminación horaria supervalle</option>
                            <option value="2.1A">2.1A - Sin discriminación horaria (mayor potencia)</option>
                            <option value="2.1DHA">2.1DHA - Discriminación horaria (mayor potencia)</option>
                            <option value="2.1DHS">2.1DHS - Discriminación horaria supervalle (mayor potencia)</option>
                            <option value="3.0A">3.0A - Tres periodos</option>
                            <option value="6.1A">6.1A - Seis periodos</option>
                        </select>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Pots trobar aquesta informació a la teva factura</p>
                    </div>
                    
                    <!-- Patró de consum -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Patró de consum
                        </label>
                        <div class="grid grid-cols-3 gap-4">
                            <button type="button" class="consum-pattern-btn py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-400">
                                Diürn
                            </button>
                            <button type="button" class="consum-pattern-btn py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-400">
                                Nocturn
                            </button>
                            <button type="button" class="consum-pattern-btn py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-400">
                                Mixt
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
        <script>
            // Interactivitat dels botons de patró de consum
            const patternBtns = document.querySelectorAll('.consum-pattern-btn');
            patternBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    patternBtns.forEach(b => b.classList.remove('bg-emerald-100', 'border-emerald-400', 'text-emerald-700'));
                    this.classList.add('bg-emerald-100', 'border-emerald-400', 'text-emerald-700');
                    
                    // Actualitzar el gràfic segons el patró seleccionat
                    // (Aquesta part es podria implementar amb dades reals)
                });
            });
        </script>
    </x-app-layout>
</body>
</html>