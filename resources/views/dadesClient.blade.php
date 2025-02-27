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
        <div class="client-form-container max-w-lg mx-auto p-4 mt-6 bg-white shadow-md rounded-lg dark:bg-gray-800">
            <h2 class="client-form-title text-xl font-semibold text-center mb-4 dark:text-white">Dades del Client</h2>
            <form action="{{ route('guardar.dades') }}" method="post">
                @csrf
                <div class="mb-4">
                    <label for="nombre" class="client-form-label block text-sm font-medium text-gray-700 dark:text-gray-300">Nom Complet</label>
                    <input type="text" class="client-form-input mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" id="nombre" name="nombre" placeholder="Exemple: Juan Pérez" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="client-form-label block text-sm font-medium text-gray-700 dark:text-gray-300">Correu Electrònic</label>
                    <input type="email" class="client-form-input mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" id="email" name="email" placeholder="Exemple: juan@gmail.com" required>
                </div>

                <div class="mb-4">
                    <label for="telefono" class="client-form-label block text-sm font-medium text-gray-700 dark:text-gray-300">Telèfon</label>
                    <input type="tel" class="client-form-input mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" id="telefono" name="telefono" placeholder="Exemple: 600123456" required>
                </div>

                <div class="mb-4">
                    <label for="direccion" class="client-form-label block text-sm font-medium text-gray-700 dark:text-gray-300">Direcció</label>
                    <input type="text" class="client-form-input mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" id="direccion" name="direccion" placeholder="Exemple: Carrer Major, 12" required>
                </div>

                <div class="mb-4">
                    <label for="ciudad" class="client-form-label block text-sm font-medium text-gray-700 dark:text-gray-300">Ciutat</label>
                    <input type="text" class="client-form-input mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" id="ciudad" name="ciudad" placeholder="Exemple: Barcelona" required>
                </div>

                <div class="mb-4">
                    <label for="codigo_postal" class="client-form-label block text-sm font-medium text-gray-700 dark:text-gray-300">Codi Postal</label>
                    <input type="text" class="client-form-input mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" id="codigo_postal" name="codigo_postal" placeholder="Exemple: 08001" required>
                </div>

                <button type="submit" class="client-form-submit w-full bg-white border-2 border-emerald-400 text-emerald-500 font-semibold py-2 px-4 rounded-lg transition duration-300 hover:bg-emerald-400 hover:text-white">
                    Seguent
                  </button>
            </form>
        </div>

        <!-- Scripts -->
        <script src="build/js/generalScript.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDu3ReEUVEQANj_h1EAtfe4-zyarcb3X04&libraries=places&callback=initMap"></script>
        <script src="https://solar.googleapis.com/v1/buildingInsights:findClosest?key=AIzaSyDu3ReEUVEQANj_h1EAtfe4-zyarcb3X04"></script>
    </x-app-layout>
</body>
</html>
