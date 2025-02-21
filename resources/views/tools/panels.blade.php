<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paneles Solares</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Aplicar el css de nuestra aplicación-->

    <link rel="stylesheet" href="build/css/styles.css"> 
    <script>
        function toggleModal() {
            document.getElementById('modal').classList.toggle('hidden');
        }
    </script>
</head>
<body class="bg-gray-50 p-6">

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Buscador de Direcció') }}
            </h2>
        </x-slot>
        <div class="max-w-4xl mx-auto">
            
            <h1 class="text-2xl font-bold text-yellow-500 mb-4">Paneles</h1>
            
            <div class="mb-6">
                <div class="border rounded-lg p-4 flex items-center">
                    <span class="text-red-500 mr-2">🔍</span>
                    <select class="border p-2 rounded w-full">
                        <option>Filtros</option>
                    </select>
                </div>
            </div>
            
            <h2 class="text-xl font-bold text-pink-500 mb-4">Tus paneles individuales</h2>
            
            <div class="bg-white border rounded-lg shadow p-4">
                <table class="w-full text-left mb-4">
                    <thead>
                        <tr class="text-gray-600">
                            <th class="py-2">Nombre</th>
                            <th class="py-2">Potencia pico (Wp)</th>
                            <th class="py-2">Eficiencia (%)</th>
                            <th class="py-2">Dimensiones (mm)</th>
                            <th class="py-2">Fabricante</th>
                            <th class="py-2">Fecha de creación</th>
                        </tr>
                    </thead>
                </table>
                
                <div class="text-center py-8">
                    <p class="text-gray-500 mb-2">Aún no se ha creado ningún panel</p>
                    <button onclick="toggleModal()" class="bg-yellow-500 text-white py-2 px-4 rounded-lg">Crea el primero</button>
                </div>
            </div>
            
            <div class="text-right mt-4">
                <button onclick="toggleModal()" class="bg-yellow-500 text-white py-2 px-4 rounded-lg">+ Nuevo panel individual</button>
            </div>
        </div>

        <!-- Modal -->
        <div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex justify-center items-center">
            <div class="bg-white rounded-lg p-6 w-full max-w-2xl">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold">Creación de nuevo panel:</h3>
                    <button onclick="toggleModal()" class="text-gray-500">✖</button>
                </div>

                <form class="grid grid-cols-2 gap-4">
                    <div>
                        <label>Nombre del Modelo*</label>
                        <input type="text" class="border p-2 rounded w-full">
                    </div>
                    <div>
                        <label>Fabricante*</label>
                        <input type="text" class="border p-2 rounded w-full">
                    </div>
                    <div>
                        <label>Tipo de Panel*</label><br>
                        <select id="options" name="options">
                            <option value="Monocristalino">Monocristalino</option>
                            <option value="Policristalino">Policristalino</option>
                            <option value="Thin-Film">Thin-Film</option>
                        </select>
                    </div>
                    <div>
                    <label for="date">Fecha de Fabricación:</label>
                    <input type="date" class="border p-2 rounded w-full">
                    </div>
                    <div>
                        <label>Garantía del producto (años)*:</label>
                        <input type="number" class="border p-2 rounded w-full">
                    </div>
                    <div>
                        <label>Garantía de rendimiento (años):</label>
                        <input type="number" class="border p-2 rounded w-full">
                    </div>
                </form>

                <form action="grid grid-cols-2 gap-4">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold">Características Eléctricas:</h3>
                        <button onclick="toggleModal()" class="text-gray-500">✖</button>
                    </div>

                    <div>
                        <label>Potencia Máxima (Pmax):*</label>
                        <input type="number" class="border p-2 rounded w-full">
                    </div>
                    <div>
                        <label>Tensión en Punto de Máxima Potencia (Vmp):*</label>
                        <input type="number" class="border p-2 rounded w-full">
                    </div>
                    <div>
                        <label>Corriente en Punto de Máxima Potencia (Imp):*</label>
                        <input type="number" class="border p-2 rounded w-full">
                    </div>
                    <div>
                        <label>Tensión de Circuito Abierto (Voc):*</label>
                        <input type="number" class="border p-2 rounded w-full">
                    </div>
                    <div>
                        <label>Corriente de Cortocircuito (Isc):*</label>
                        <input type="number" class="border p-2 rounded w-full">
                    </div>
                    <div>
                        <label>Eficiencia del Panel:</label>
                        <input type="number" class="border p-2 rounded w-full">
                    </div>
                </form>

                <div class="flex justify-end mt-4 space-x-4">
                    <button onclick="toggleModal()" class="text-gray-500">Cancelar</button>
                    <button class="bg-green-500 text-white py-2 px-4 rounded-lg">Confirmar</button>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>
</html>
