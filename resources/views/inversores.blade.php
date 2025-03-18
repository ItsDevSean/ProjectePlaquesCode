<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Projecte Plaques</title>
    <link rel="stylesheet" href="{{ asset('build/css/styleDades.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="build/css/styles.css">
        <link rel="stylesheet" href="build/css/proyectosStyle.css">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listado de Inversores') }}
        </h2>
    </x-slot>
    <table class="tabla min-w-full divide-y">
        <thead>
                <tr>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Inversor</th>
                <th class="px-9 py-3 text-left text-xs font-medium uppercase tracking-wider">Capacidad</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Coste</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Fabricante</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Fecha de creacion</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Acciones</th>
                </tr>
        </thead>

        <tbody>
    @if ($inversores->isEmpty())
        <tr>
            <td colspan="6" class="text-center py-4 text-gray-500">
                No hay inversores disponibles.
            </td>
            <div class="flex justify-end mb-4">
                <button @click="open = true" class="px-4 py-2 bg-[#49DBA3] text-white rounded-lg shadow-lg hover:bg-[#36B89A] transition-all duration-300">
                    <i class="fas fa-plus"></i> Crear Inversor
                </button>
            </div>
        </tr>
    @else
        @foreach ($inversores as $inversor)
            <tr class="border-t">
                <td class="px-6 py-3">{{ $inversor->nombre_inversor }}</td>
                <td class="px-9 py-3">{{ $inversor->capacidad }} kWh</td>
                <td class="px-6 py-3">{{ number_format($inversor->coste, 2) }} €</td>
                <td class="px-6 py-3">{{ $inversor->fabricante }}</td>
                <td class="px-6 py-3">{{ $inversor->created_at->format('d/m/Y') }}</td>
                <td class="px-6 py-3">
                    <a href="{{ route('inversores.edit', $inversor->id) }}" class="text-blue-500 hover:underline">Editar</a>
                    |
                    <form action="{{ route('inversores.destroy', $inversor->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    @endif
    </>


      
    </table>
    <!-- Modal -->
    <div x-data="{ open: false }" x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" x-cloak>
        <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6">
            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b pb-4">
                <h2 class="text-xl font-semibold">Crear Nuevo Inversor</h2>
                <button @click="open = false" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <form action="{{ route('inversores.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                @csrf
                <div class="space-y-4">
                    <!-- Nombre del Inversor -->
                    <div>
                        <label for="nombre_inversor" class="block text-sm font-medium text-gray-700">Nombre del Inversor</label>
                        <input type="text" name="nombre_inversor" id="nombre_inversor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    <!-- Eficiencia -->
                    <div>
                        <label for="eficiencia" class="block text-sm font-medium text-gray-700">Eficiencia</label>
                        <input type="text" name="eficiencia" id="eficiencia" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    <!-- Tipo de Instalación -->
                    <div>
                        <label for="tipo_instalacion" class="block text-sm font-medium text-gray-700">Tipo de Instalación</label>
                        <input type="text" name="tipo_instalacion" id="tipo_instalacion" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    <!-- Garantía de Material -->
                    <div>
                        <label for="garantia_material" class="block text-sm font-medium text-gray-700">Garantía de Material (años)</label>
                        <input type="number" name="garantia_material" id="garantia_material" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <!-- Potencia Nominal -->
                    <div>
                        <label for="potencia_nominal" class="block text-sm font-medium text-gray-700">Potencia Nominal (kWh)</label>
                        <input type="number" name="potencia_nominal" id="potencia_nominal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    <!-- Descripción -->
                    <div>
                        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea name="descripcion" id="descripcion" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required></textarea>
                    </div>

                    <!-- Fabricante -->
                    <div>
                        <label for="fabricante" class="block text-sm font-medium text-gray-700">Fabricante</label>
                        <select name="fabricante" id="fabricante" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            <!-- Aquí puedes iterar sobre los fabricantes disponibles -->
                            <option value="1">Fabricante 1</option>
                            <option value="2">Fabricante 2</option>
                        </select>
                    </div>

                    <!-- Microinversor -->
                    <div>
                        <label for="microinversor" class="block text-sm font-medium text-gray-700">Microinversor</label>
                        <select name="microinversor" id="microinversor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    <!-- Garantía del Fabricante -->
                    <div>
                        <label for="garantia_fabricante" class="block text-sm font-medium text-gray-700">Garantía del Fabricante (años)</label>
                        <input type="number" name="garantia_fabricante" id="garantia_fabricante" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    <!-- Imagen del Inversor -->
                    <div>
                        <label for="imagen_inversor" class="block text-sm font-medium text-gray-700">Imagen del Inversor</label>
                        <input type="file" name="imagen_inversor" id="imagen_inversor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <!-- ID de Referencia -->
                    <div>
                        <label for="id_referencia" class="block text-sm font-medium text-gray-700">ID de Referencia</label>
                        <input type="text" name="id_referencia" id="id_referencia" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end mt-6">
                    <button type="button" @click="open = false" class="mr-2 px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 bg-[#49DBA3] text-white rounded-lg hover:bg-[#36B89A]">
                        Crear Inversor
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    </x-app-layout>
</body>

</html>