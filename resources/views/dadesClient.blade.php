<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dades del Client</title>
    <link rel="stylesheet" href="{{ asset('build/css/styleDades.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <x-app-layout>
        
        <!-- Progress Bar (sense canvis) -->
        <div class="progress-container mx-auto max-w-5xl px-4 mt-12" x-data="{
            currentStep: 1, // Estem al pas 1 (Dades Client)
            steps: [
                {id: 1, name: 'Dades del Client', current: true, path: 'dades'},
                {id: 2, name: 'Consum', current: false, path: 'consum'},
                {id: 3, name: 'Seleccionar Àrea', current: false, path: 'mapa'},
                {id: 4, name: 'Producció', current: false, path: 'produccio'}
            ],
            getProgressWidth() {
                // 0% perquè encara no hem completat cap pas
                return 0;
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
                                            'bg-white dark:bg-gray-900 border-emerald-500 dark:border-emerald-400 shadow-xl': step.id === currentStep,
                                            'bg-white dark:bg-gray-900 border-gray-300 dark:border-gray-600 shadow-sm': step.id > currentStep,
                                            'cursor-pointer': true, // Sempre clickable
                                            'border-4': step.id === currentStep,
                                            'border-2': step.id !== currentStep,
                                            'rounded-full': true,
                                            'group-hover:scale-110': true // Sempre hover effect
                                        }">
                                    <!-- Step Content -->
                                    <span class="font-medium" 
                                          :class="{
                                              'text-sm font-bold text-emerald-600 dark:text-emerald-300': step.id === currentStep,
                                              'text-xs text-gray-400 dark:text-gray-400': step.id !== currentStep
                                          }" 
                                          x-text="step.id"></span>
                                </button>
                                
                                <!-- Step Label - Sempre visible -->
                                <div class="absolute top-full mt-3 left-1/2 transform -translate-x-1/2 text-center">
                                    <span class="whitespace-nowrap font-medium px-3 py-1.5 rounded-lg"
                                          :class="{
                                              'text-sm font-semibold text-gray-800 dark:text-white bg-white dark:bg-gray-800 shadow-lg': step.id === currentStep,
                                              'text-xs font-medium text-gray-600 dark:text-gray-300': step.id !== currentStep
                                          }" 
                                          x-text="step.name"></span>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
        
        <!-- Botones de navegación fijos -->        
        <div class="fixed inset-y-0 right-0 flex items-center justify-center w-16 z-20 pr-10">
            <button onclick="window.location.href='/consum'" class="p-3 rounded-full bg-white dark:bg-gray-800 shadow-lg hover:shadow-xl border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300 transform hover:scale-110 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-600 dark:text-gray-300 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <!-- Formulari del client millorat -->
        <div class="max-w-6xl mx-auto px-6 py-8 mt-6 bg-white rounded-xl shadow-lg dark:bg-gray-800 transition-all duration-300 hover:shadow-xl">
            <!-- Capçalera del formulari -->
            <div class="mb-8 text-center">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Dades del Client</h2>
                <p class="text-gray-600 dark:text-gray-300">Omple les dades bàsiques per començar el teu projecte solar</p>
            </div>
            
            <form action="{{ isset($proyecto) ? route('proyecto.update.dadesclient', $proyecto->id) : route('guardar.dades') }}" method="POST" id="clientForm">
                @csrf
                @if(isset($proyecto))
                    @method('PUT')
                @endif

                <!-- Secció Dades del Client -->
                <div class="mb-10 p-6 bg-gray-50 dark:bg-gray-700 rounded-lg transition-all duration-300 hover:bg-gray-100 dark:hover:bg-gray-600">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-emerald-100 dark:bg-emerald-900 flex items-center justify-center mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600 dark:text-emerald-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Dades del Client</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Nom Complet -->
                        <div class="space-y-1">
                            <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors duration-300">Nom Complet</label>
                            <div class="relative">
                                <input type="text" class="mt-1 block w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 placeholder-gray-400 dark:placeholder-gray-400" 
                                       id="nombre" name="nombre" placeholder="Exemple: Juan Pérez" value="{{ old('nombre', $proyecto->nombre ?? '') }}" required>
                                <span class="error-message absolute left-0 -bottom-5 text-red-500 text-xs hidden">El nom és obligatori.</span>
                            </div>
                        </div>

                        <!-- Correu Electrònic -->
                        <div class="space-y-1">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Correu Electrònic</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input type="email" class="mt-1 block w-full pl-10 pr-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 placeholder-gray-400 dark:placeholder-gray-400" 
                                       id="email" name="email" placeholder="Exemple: juan@gmail.com" value="{{ old('email', $proyecto->email ?? '') }}" required>
                                <span class="error-message absolute left-0 -bottom-5 text-red-500 text-xs hidden">El correu electrònic no és vàlid.</span>
                            </div>
                        </div>

                        <!-- Telèfon -->
                        <div class="space-y-1">
                            <label for="telefono" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Telèfon</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <input type="tel" class="mt-1 block w-full pl-10 pr-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 placeholder-gray-400 dark:placeholder-gray-400" 
                                       id="telefono" name="telefono" placeholder="Exemple: 600123456" value="{{ old('telefono', $proyecto->telefono ?? '') }}" required>
                                <span class="error-message absolute left-0 -bottom-5 text-red-500 text-xs hidden">El telèfon ha de tenir 9 dígits.</span>
                            </div>
                        </div>

                        <!-- Direcció -->
                        <div class="space-y-1">
                            <label for="direccion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Direcció</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <input disabled type="text" class="mt-1 block w-full pl-10 pr-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 placeholder-gray-400 dark:placeholder-gray-400" 
                                       id="direccion" name="direccion" placeholder="Exemple: Carrer Major, 12" value="{{ old('direccion', $proyecto->direccion ?? '') }}" required>
                                <span class="error-message absolute left-0 -bottom-5 text-red-500 text-xs hidden">La direcció és obligatòria.</span>
                            </div>
                        </div>

                        <!-- Ciutat -->
                        <div class="space-y-1">
                            <label for="ciudad" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ciutat</label>
                            <div class="relative">
                                <input type="text" class="mt-1 block w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 placeholder-gray-400 dark:placeholder-gray-400" 
                                       id="ciudad" name="ciudad" placeholder="Exemple: Barcelona" value="{{ old('ciudad', $proyecto->ciudad ?? '') }}" required>
                                <span class="error-message absolute left-0 -bottom-5 text-red-500 text-xs hidden">La ciutat és obligatòria.</span>
                            </div>
                        </div>

                        <!-- Codi Postal -->
                        <div class="space-y-1">
                            <label for="codigo_postal" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Codi Postal</label>
                            <div class="relative">
                                <input type="text" class="mt-1 block w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 placeholder-gray-400 dark:placeholder-gray-400" 
                                       id="codigo_postal" name="codigo_postal" placeholder="Exemple: 08001" value="{{ old('codigo_postal', $proyecto->codigo_postal ?? '') }}" required>
                                <span class="error-message absolute left-0 -bottom-5 text-red-500 text-xs hidden">El codi postal ha de tenir 5 dígits.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Secció Dades del Projecte -->
                <div class="mb-10 p-6 bg-gray-50 dark:bg-gray-700 rounded-lg transition-all duration-300 hover:bg-gray-100 dark:hover:bg-gray-600">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-emerald-100 dark:bg-emerald-900 flex items-center justify-center mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600 dark:text-emerald-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Dades del Projecte</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nom del Projecte -->
                        <div class="space-y-1">
                            <label for="nombre_proyecto" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom del Projecte</label>
                            <div class="relative">
                                <input type="text" class="mt-1 block w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 placeholder-gray-400 dark:placeholder-gray-400" 
                                       id="nombre_proyecto" name="nombre_proyecto" placeholder="Exemple: Instal·lació Solar" value="{{ old('nombre_proyecto', $proyecto->nombre_proyecto ?? '') }}" required>
                                <span class="error-message absolute left-0 -bottom-5 text-red-500 text-xs hidden">El nom del projecte és obligatori.</span>
                            </div>
                        </div>

                        <!-- Descripció del Projecte -->
                        <div class="space-y-1">
                            <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripció del Projecte</label>
                            <textarea class="mt-1 block w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 placeholder-gray-400 dark:placeholder-gray-400 min-h-[100px]" 
                                      id="descripcion" name="descripcion_proyecto" placeholder="Descripció del projecte...">{{ old('descripcion_proyecto', $proyecto->descripcion_proyecto ?? '') }}</textarea>
                            <small class="text-gray-500 dark:text-gray-400 text-xs">Aquest camp és opcional.</small>
                        </div>
                    </div>
                </div>

                <!-- Secció Dades de la Instal·lació -->
                <div class="mb-10 p-6 bg-gray-50 dark:bg-gray-700 rounded-lg transition-all duration-300 hover:bg-gray-100 dark:hover:bg-gray-600">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-emerald-100 dark:bg-emerald-900 flex items-center justify-center mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600 dark:text-emerald-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Dades de la Instal·lació</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cls-2 gap-6">
                        <!-- Ús de l'instal·lació -->
                        <div class="space-y-1">
                            <label for="tarifa_acceso" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ús de l'instal·lació</label>
                            <select class="mt-1 block w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 appearance-none" 
                                    id="estacionalitat" name="estacionalitat" required>
                                <option value="" disabled selected>-- Tria una opció --</option>
                                <option value="any" {{ (old('estacionalitat', $proyecto->estacionalitat ?? '') == 'any') ? 'selected' : '' }}>Anual</option>
                                <option value="estiu" {{ (old('estacionalitat', $proyecto->estacionalitat ?? '') == 'estiu') ? 'selected' : '' }}>Estiu</option>
                                <option value="hivern" {{ (old('estacionalitat', $proyecto->estacionalitat ?? '') == 'hivern') ? 'selected' : '' }}>Hivern</option>
                            </select>
                        </div>

                        <!-- Tipus d'Instal·lació -->
                        <div class="space-y-1">
                            <label for="tipo_instalacion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipus d'Instal·lació</label>
                            <select class="mt-1 block w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 appearance-none" 
                                    id="tipo_instalacion" name="tipo_instalacion" required>
                                <option value="" disabled selected>-- Tria una opció --</option>
                                <option value="monofasica" {{ (old('tipo_instalacion', $proyecto->tipo_instalacion ?? '') == 'monofasica') ? 'selected' : '' }}>Monofàsica</option>
                                <option value="trifasica" {{ (old('tipo_instalacion', $proyecto->tipo_instalacion ?? '') == 'trifasica') ? 'selected' : '' }}>Trifàsica</option>
                            </select>
                            <span class="error-message absolute left-0 -bottom-5 text-red-500 text-xs hidden">Selecciona un tipus d'instal·lació.</span>
                        </div>

                        <!-- Tipus de teulada -->
                        <div class="space-y-1">
                            <label for="tipo_teulada" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Teulada inclinada?</label>
                            <select class="mt-1 block w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 appearance-none" 
                                    id="tipo_teulada" name="tipo_teulada" required>
                                <option value="" disabled selected>-- Tria una opció --</option>
                                <option value="si">Si</option>
                                <option value="no">No</option>
                            </select>
                            <span class="error-message absolute left-0 -bottom-5 text-red-500 text-xs hidden">Selecciona un tipus d'instal·lació.</span>
                        </div>

                        <!-- Inclinació teulada -->
                         <div id="div_inclinacio" class="space-y-1 hidden">
                            <label for="inclinaci_teulada" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Inclinació Teulada (º)</label>
                            <div class="relative">
                                <input type="number" class="mt-1 block w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 placeholder-gray-400 dark:placeholder-gray-400" 
                                       id="inclinaci_teulada" name="inclinaci_teulada" placeholder="Exemple: 30"  required>
                            </div>
                        </div>
                    </div>
                </div>            
            </form>
        </div>

        <script>
            window.userId = "{{ Auth::id() }}";
        </script>
        <script src="build/js/dades.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDu3ReEUVEQANj_h1EAtfe4-zyarcb3X04&libraries=places&callback=initMap"></script>
        <script src="https://solar.googleapis.com/v1/buildingInsights:findClosest?key=AIzaSyDu3ReEUVEQANj_h1EAtfe4-zyarcb3X04"></script>
    </x-app-layout>
</body>
</html>