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
<body class="bg-gray-50">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
                {{ __('Buscador de Direcció') }}
            </h2>
        </x-slot>
        <div class="max-w-4xl mx-auto px-4 md:px-6 lg:px-8 w-full">
            <h1 class="text-2xl font-bold text-[#49DBA3] mb-4 text-center">Paneles</h1>
            
            <div class="mb-6">
                <div class="border rounded-lg p-4 flex items-center w-full">
                    <select class="border p-2 rounded w-full">
                        <option>Filtros</option>
                    </select>
                </div>
            </div>
            
            <h2 class="text-xl font-bold text-[#49DBA3] mb-4 text-center">Tus paneles individuales</h2>
            
            <div class="bg-white border rounded-lg shadow p-4">
                <table class="w-full text-left mb-4">
                    <thead>
                        <tr class="text-gray-600">
                            <th class="py-2">Modelo</th>
                            <th class="py-2">Fabricante</th>
                            <th class="py-2">Tipo</th>
                            <th class="py-2">Fecha de Fabricación</th>
                            <th class="py-2">Garantía Producto (años)</th>
                            <th class="py-2">Garantía Rendimiento (años)</th>
                            <th class="py-2">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($panels as $p)
                        <tr class="text-center">
                            <td class="border p-2">{{ $p->panel_model }}</td>
                            <td class="border p-2">{{ $p->manufacturer }}</td>
                            <td class="border p-2">{{ $p->panel_type }}</td>
                            <td class="border p-2">{{ $p->date_manufacturer }}</td>
                            <td class="border p-2">{{ $p->panel_warranty }}</td>
                            <td class="border p-2">{{ $p->performance_warranty }}</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                @if ($panels->isEmpty())
                <div class="text-center py-8">
                    <p class="text-gray-500 mb-2">Aún no se ha creado ningún panel</p>
                    <button onclick="toggleModal()" class="bg-[#49DBA3] hover:bg-[#193849] text-white py-2 px-4 rounded-lg">Crea el primero</button>
                </div>
                @endif
                
            </div>
            
            <div class="w-full flex justify-center md:justify-end mt-4">
                <button onclick="toggleModal()" class="bg-[#49DBA3] hover:bg-[#193849] text-white py-2 px-4 rounded-lg flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    Nuevo panel individual
                </button>
            </div>
        </div>

        <!-- Pop up with a form -->
        <div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex justify-center items-center">
            <div class="bg-white rounded-lg p-6 w-full max-w-2xl max-h-screen overflow-y-auto">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold">Creación de nuevo panel:</h3>
                     <!-- toDO: reutilzable -->
                        @if ($errors->any())
                            @foreach ($errors->all() as $e)
                                <div>
                                    {{ $e }}
                                </div>
                            @endforeach
                        @endif
                    <button onclick="toggleModal()" class="text-gray-500">
                        <i class="fas fa-times text-gray-500 text-2xl"></i>
                    </button>
                </div>

                @include('fragments._errors-form')

                <form action="{{ route('paneles.resultado')}}" method="POST">
                    
                    @csrf

                    @method('POST')

                    <div>
                        <label>Nombre del Modelo <span class="text-red-500">*</span></label>
                        <input type="text" name="panel_model" class="border p-2 rounded w-full">
                    </div>
                    <div>
                        <label>Fabricante*</label>
                        <input type="text" name="manufacturer"class="border p-2 rounded w-full">
                    </div>
                
                   
                    <label>Tipo de Panel*</label>
                    <select name="panel_type"class="border p-2 rounded w-full">
                        @foreach ($panelType as $pt)
                            <option value="{{ $pt->panel_type }}">{{ $pt->panel_type }}</option>
                        @endforeach
                        
                    </select> 
                   
                    <div>
                        <label>Tipo de Panel <span class="text-red-500">*</span></label>
                        <input type="text" name="panel_type" class="border p-2 rounded w-full">
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
                        <label>Garantía de rendimiento (años):</label>
                        <input type="number" name="performance_warranty" class="border p-2 rounded w-full">
                    </div>

                    <div class="flex justify-end space-x-2 mt-4">
                        <button type="reset" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Enviar</button>
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
