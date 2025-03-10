<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dades del Client</title>
    <link rel="stylesheet" href="build/css/styleDades.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <x-app-layout>
        
        <!-- Barra de progrés responsive -->
        <div class="progress-bar-container mt-5 px-4">
            <div class="progress-bar bg-white border flex justify-center items-center mx-auto shadow-teal-300 shadow-md max-w-6xl p-2 rounded-lg dark:bg-gray-700 dark:text-gray-300">
                <div class="w-full max-w-screen-2xl px-4 md:px-12 mx-auto overflow-x-auto overflow-y-hidden scrollbar-hide">
                    <ul class="w-full flex flex-nowrap justify-start md:justify-center items-center gap-6 sm:gap-10 md:gap-20 mt-2 md:mt-0 text-center whitespace-nowrap overflow-visible min-h-[4rem]">
                        
                        <!-- PAS 1 -->
                        <li class="flex flex-col items-center cursor-pointer transition-transform duration-200 ease-in-out hover:scale-95">
                            <a href="dades" class="flex flex-col items-center">
                                <div class="w-10 h-10 flex items-center justify-center bg-emerald-400 border-2 border-emerald-400 rounded-full text-white font-bold text-lg">
                                    1
                                </div>
                                <span class="text-gray-700 dark:text-white text-sm md:text-base mt-1">
                                    Dades del Client
                                </span>
                            </a>
                        </li>
        
                        <!-- PAS 2 -->
                        <li class="flex flex-col items-center cursor-pointer transition-transform duration-200 ease-in-out hover:scale-95">
                            <a href="mapa" class="flex flex-col items-center">
                                <div class="w-10 h-10 flex items-center justify-center bg-white border-2 border-emerald-400 rounded-full text-emerald-400 font-bold text-lg">
                                    2
                                </div>
                                <span class="text-gray-700 dark:text-white text-sm md:text-base mt-1">
                                    Seleccionar Àrea
                                </span>
                            </a>
                        </li>
        
                        <!-- PAS 3 -->
                        <li class="flex flex-col items-center cursor-pointer transition-transform duration-200 ease-in-out hover:scale-95">
                            <a href="formulari" class="flex flex-col items-center">
                                <div class="w-10 h-10 flex items-center justify-center bg-white border-2 border-emerald-400 rounded-full text-emerald-400 font-bold text-lg">
                                    3
                                </div>
                                <span class="text-gray-700 dark:text-white text-sm md:text-base mt-1">
                                    Formulari Prova
                                </span>
                            </a>
                        </li>
        
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Formulari del client -->
        <div class="max-w-6xl mx-auto p-4 mt-6 bg-white shadow-md rounded-lg dark:bg-gray-800">
            <h2 class="text-xl font-semibold text-center mb-4 dark:text-white">Dades del Client</h2>
            <form action="{{ isset($proyecto) ? route('dades_clients.update', $proyecto->id) : route('guardar.dades') }}" method="POST" id="clientForm">
                @csrf
                @if(isset($proyecto)) 
                    @method('PUT') <!-- Método PUT para actualización -->
                @endif

                <!-- Secció Dades del Client -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-white mb-2">Dades del Client</h3>
                    <div class="border-b-2 border-emerald-400 mb-4"></div> <!-- Línia divisòria -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="mb-4">
                            <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom Complet</label>
                            <input type="text" class="mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" id="nombre" name="nombre" placeholder="Exemple: Juan Pérez" value="{{ old('nombre', $proyecto->nombre ?? '') }}" required>
                            <span class="error-message text-red-500 text-sm hidden">El nom és obligatori.</span>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Correu Electrònic</label>
                            <input type="email" class="mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" id="email" name="email" placeholder="Exemple: juan@gmail.com" value="{{ old('email', $proyecto->email ?? '') }}" required>
                            <span class="error-message text-red-500 text-sm hidden">El correu electrònic no és vàlid (ha de contenir una @).</span>
                        </div>

                        <div class="mb-4">
                            <label for="telefono" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Telèfon</label>
                            <input type="tel" class="mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" id="telefono" name="telefono" placeholder="Exemple: 600123456" value="{{ old('telefono', $proyecto->telefono ?? '') }}" required>
                            <span class="error-message text-red-500 text-sm hidden">El telèfon ha de tenir 9 dígits.</span>
                        </div>

                        <div class="mb-4">
                            <label for="direccion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Direcció</label>
                            <input type="text" class="mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" id="direccion" name="direccion" placeholder="Exemple: Carrer Major, 12" value="{{ old('direccion', $proyecto->direccion ?? '') }}" required>
                            <span class="error-message text-red-500 text-sm hidden">La direcció és obligatòria.</span>
                        </div>

                        <div class="mb-4">
                            <label for="ciudad" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ciutat</label>
                            <input type="text" class="mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" id="ciudad" name="ciudad" placeholder="Exemple: Barcelona" value="{{ old('ciudad', $proyecto->ciudad ?? '') }}" required>
                            <span class="error-message text-red-500 text-sm hidden">La ciutat és obligatòria.</span>
                        </div>

                        <div class="mb-4">
                            <label for="codigo_postal" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Codi Postal</label>
                            <input type="text" class="mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" id="codigo_postal" name="codigo_postal" placeholder="Exemple: 08001" value="{{ old('codigo_postal', $proyecto->codigo_postal ?? '') }}" required>
                            <span class="error-message text-red-500 text-sm hidden">El codi postal ha de tenir 5 dígits.</span>
                        </div>
                    </div>
                </div>

                <!-- Secció Dades del Projecte -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-white mb-2">Dades del Projecte</h3>
                    <div class="border-b-2 border-emerald-400 mb-4"></div> <!-- Línia divisòria -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label for="nombre_proyecto" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom del Projecte</label>
                            <input type="text" class="mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" id="nombre_proyecto" name="nombre_proyecto" placeholder="Exemple: Instal·lació Solar" value="{{ old('nombre_proyecto', $proyecto->nombre_proyecto ?? '') }}" required>
                            <span class="error-message text-red-500 text-sm hidden">El nom del projecte és obligatori.</span>
                        </div>

                        <div class="mb-4">
                            <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Descripció del Projecte
                            </label>
                            <textarea class="mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                id="descripcion" name="descripcion_proyecto" rows="3" placeholder="Descripció del projecte...">{{ old('descripcion_proyecto', $proyecto->descripcion_proyecto ?? '') }}</textarea>
                            <small class="text-gray-500 dark:text-gray-400">Aquest camp és opcional.</small>
                        </div>
                    </div>
                </div>

                <!-- Secció Dades de la Instal·lació -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-white mb-2">Dades de la Instal·lació</h3>
                    <div class="border-b-2 border-emerald-400 mb-4"></div> 
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label for="tarifa_acceso" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tarifa d'Accés</label>
                            <input type="text" class="mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" id="tarifa_acceso" name="tarifa" placeholder="Exemple: 2.0A" value="{{ old('tarifa', $proyecto->tarifa ?? '') }}" required>
                            <span class="error-message text-red-500 text-sm hidden">La tarifa d'accés és obligatòria.</span>
                        </div>

                        <div class="mb-4">
                            <label for="tipo_instalacion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipus d'Instal·lació</label>
                            <select class="mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" id="tipo_instalacion" name="tipo_instalacion" required>
                                <option value="monofasica" {{ (old('tipo_instalacion', $proyecto->tipo_instalacion ?? '') == 'monofasica') ? 'selected' : '' }}>Monofàsica</option>
                                <option value="trifasica" {{ (old('tipo_instalacion', $proyecto->tipo_instalacion ?? '') == 'trifasica') ? 'selected' : '' }}>Trifàsica</option>
                            </select>
                            <span class="error-message text-red-500 text-sm hidden">Selecciona un tipus d'instal·lació.</span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-white border-2 border-emerald-400 text-emerald-500 font-semibold py-2 px-4 rounded-lg transition duration-300 hover:bg-emerald-400 hover:text-white">
                    {{ isset($cliente) ? 'Actualizar' : 'Seguent' }}
                </button>
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