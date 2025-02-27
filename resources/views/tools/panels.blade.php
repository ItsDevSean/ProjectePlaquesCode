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
            
            <h1 class="text-2xl font-bold text-[#49DBA3] mb-4">Paneles</h1>
            
            <div class="mb-6">
                <div class="border rounded-lg p-4 flex items-center">
                    <i class="fas fa-search text-[#193849] text-2xl"></i>
                    <select class="border p-2 rounded w-full">
                        <option>Filtros</option>
                    </select>
                </div>
            </div>
            
            <h2 class="text-xl font-bold text-[#49DBA3] mb-4">Tus paneles individuales</h2>
            
            <div class="bg-white border rounded-lg shadow p-4">
                <table class="w-full text-left mb-4">
                    <thead class="text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="text-gray-800">
                            <th class="py-2">Nombre</th>
                            <th class="py-2">Potencia pico (Wp)</th>
                            <th class="py-2">Eficiencia (%)</th>
                            <th class="py-2">Dimensiones (mm)</th>
                            <th class="py-2">Fabricante</th>
                            <th class="py-2">Fecha de creación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <th class="text-gray-600 py-4">Hola</th>
                            <th class="text-gray-600 py-4">Hola</th>
                            <th class="text-gray-600 py-4">Hola</th>
                            <th class="text-gray-600 py-4">Hola</th>
                            <th class="text-gray-600 py-4">Hola</th>
                            <th class="text-gray-600 py-4">Hola</th>
                        </tr>
                    </tbody>
                </table>
                
                <div class="text-center py-8">
                    <p class="text-gray-500 mb-2">Aún no se ha creado ningún panel</p>
                    <button onclick="toggleModal()" class="bg-[#49DBA3] hover:bg-[#193849] text-white py-2 px-4 rounded-lg">Crea el primero</button>
                </div>
            </div>
            
            <div class="text-right mt-4">
                <button onclick="toggleModal()" class="bg-[#49DBA3] hover:bg-[#193849] text-white py-2 px-4 rounded-lg">+ Nuevo panel individual</button>
            </div>
        </div>

        <!-- Pop up with a form -->
        <div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex justify-center items-center">
            <div class="bg-white rounded-lg p-6 w-full max-w-2xl max-h-screen overflow-y-auto">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold">Creación de nuevo panel:</h3>
                    <button onclick="toggleModal()" class="text-gray-500">
                        <i class="fas fa-times text-gray-500 text-2xl"></i>
                    </button>
                </div>
                
                <!-- toDO: reutilzable -->
                @if ($errors->any())
                    @foreach ($errors->all() as $e)
                        <div>
                            {{ $e }}
                        </div>
                    @endforeach
                @endif

                <form action="{{ route('paneles.resultado')}}" method="POST">
                    @csrf
                    @method('POST')
                    <div>
                        <label>Nombre del Modelo <span class="text-red-500">*</span></label>
                        <input type="text" name="panel_model" class="border p-2 rounded w-full">
                    </div>
                    <div>
                        <label>Fabricante <span class="text-red-500">*</span></label>
                        <input type="text" name="manufacturer"class="border p-2 rounded w-full">
                    </div>
                
                    <div>
                        <label>Tipo de Panel <span class="text-red-500">*</span></label>
                        <input type="text" name="panel_type"class="border p-2 rounded w-full">
                    </div>
                    <div>
                    <label for="date">Fecha de Fabricación:</label>
                    <input type="date" name="date_manufacturer" class="border p-2 rounded w-full">
                    </div>
                    <div>
                        <label>Garantía del producto (años) <span class="text-red-500">*</span></label>
                        <input type="number" name="panel_warranty" class="border p-2 rounded w-full">
                    </div>
                    <div>
                        <label>Garantía de rendimiento (años)</label>
                        <input type="number" name="performance_warranty" class="border p-2 rounded w-full">
                    </div>

                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold">Características Eléctricas</h3>
                        <button onclick="toggleModal()" class="text-gray-500">✖</button>
                    </div>

                    <div>
                        <label>Potencia Máxima (Pmax) <span class="text-red-500">*</span></label>
                        <input type="number" name="maximum_power" class="border p-2 rounded w-full">
                    </div>
                    <div>
                        <label>Tensión en Punto de Máxima Potencia (Vmp) <span class="text-red-500">*</span></label>
                        <input type="number" name="voltage_maximum_power_point" class="border p-2 rounded w-full">
                    </div>
                    <div>
                        <label>Corriente en Punto de Máxima Potencia (Imp) <span class="text-red-500">*</span></label>
                        <input type="number" name="current_maximum_power_point" class="border p-2 rounded w-full">
                    </div>
                    <div>
                        <label>Tensión de Circuito Abierto (Voc) <span class="text-red-500">*</span></label>
                        <input type="number" name="open_circuit_voltage" class="border p-2 rounded w-full">
                    </div>
                    <div>
                        <label>Corriente de Cortocircuito (Isc) <span class="text-red-500">*</span></label>
                        <input type="number" name="short_circuit_current" class="border p-2 rounded w-full">
                    </div>
                    <div>
                        <label>Eficiencia del Panel</label>
                        <input type="number" name="panel_efficiency" class="border p-2 rounded w-full">
                    </div>
                
                    <div class="flex justify-end mt-4 space-x-4">
                        <button onclick="toggleModal()" class="text-gray-500 hover:bg-gray-500 hover:text-white py-2 px-4 rounded-lg">Cancelar</button>
                        <button class="bg-[#49DBA3] hover:bg-[#193849] text-white py-2 px-4 rounded-lg" type="submit">Confirmar</button>
                    </div>
                </form>
                
            </div>
        </div>
    </x-app-layout>
</body>
</html>
