<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="store-route" content="{{ route('baterias.store') }}">
    <title>Projecte Plaques</title>
    <link rel="stylesheet" href="{{ asset('build/css/styleDades.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Listado de Baterias') }}
            </h2>
        </x-slot>

        <div class="py-12 m-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <button id="openModal" class="px-4 py-2 bg-[#49DBA3] text-white rounded-lg shadow-lg hover:bg-[#36B89A] transition-all duration-300">
                            <i class="fas fa-plus"></i> Crear Bateria
                        </button>
                    </div>
                    <table class="tabla min-w-full divide-y">
                            <thead>
                                    <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Bateria</th>
                                    <th class="px-9 py-3 text-left text-xs font-medium uppercase tracking-wider">Capacidad</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Fabricante</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Coste</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Fecha de creacion</th>
                                    </tr>
                            </thead>

                            <tbody>
                                @if ($baterias->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-gray-500">
                                            No hay baterias disponibles.
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($baterias as $bateria)
                                    <tr class="border-t cursor-pointer" onclick="openDetail({{$bateria}})">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $bateria->nombre_bateria }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $bateria->capacidad }} kWh</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $bateria->fabricante->nombre }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $bateria->coste }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $bateria->created_at->format('d/m/Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                            <form action="{{ route('baterias.update', $bateria->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="button" onclick="event.stopPropagation();openEditModal({{ $bateria }})" class="text-green-600 hover:text-green-900 mr-3 no-underline">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </form>
                                            
                                            <button onclick="event.stopPropagation();openModalElim('{{ $bateria->nombre_bateria }}', '{{ $bateria->id }}')" class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                    
                    <!-- Modal -->
                    <div id="modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                        <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl p-6">
                            <div class="flex justify-between items-center border-b pb-4">
                                <h2 class="text-xl font-semibold">Crear Nueva bateria</h2>
                                <button id="closeModal" type="button" class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>

                            <form id="bateriaForm" action="{{ route('baterias.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="formMethod" name="_method" value="POST">

                                <div class="grid grid-cols-2 gap-10 mt-4">
                                    <div>
                                        <label for="nombre_bateria" class="block text-sm font-medium text-gray-700">Nombre de la bateria</label>
                                        <input type="text" name="nombre_bateria" id="nombre_bateria" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                    </div>

                                    <div>
                                        <label for="capacidad" class="block text-sm font-medium text-gray-700">Capacidad</label>
                                        <input type="text" name="capacidad" id="capacidad" placeholder="Capacidad de la bateria" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                    </div>

                                    <div>
                                        <label for="coste" class="block text-sm font-medium text-gray-700">Coste</label>
                                        <input type="text" name="coste" id="coste" placeholder="Coste de la bateria" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                    </div>

                                    <div>
                                        <label for="garantia_material" class="block text-sm font-medium text-gray-700">Garantía del Material (Años)</label>
                                        <input type="number" name="garantia_material" id="garantia_material" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    </div>

                                    <div>
                                        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                                        <textarea name="descripcion" id="descripcion" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                                    </div>

                                    <div>
                                        <label for="fabricante" class="block text-sm font-medium text-gray-700">Fabricante</label>
                                        <div class="flex items-center gap-4">
                                            <select name="fabricante_id" id="fabricante" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                                <option value="">Seleccionar</option>
                                                @foreach ($fabricantes as $fabricante)
                                                    <option value="{{ $fabricante->id }}">{{ $fabricante->nombre }}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" id="openFabricanteModal" class="px-2 py-2 bg-[#7fd3b7] text-white rounded-lg shadow-lg hover:bg-[#36B89A] transition-all duration-300 flex items-center gap-2">
                                                <i class="fas fa-plus"></i> Nuevo
                                            </button>
                                        </div>
                                    </div>

                                    <div>
                                        <label for="garantia_fabricante" class="block text-sm font-medium text-gray-700">Garantía del Fabricante (Años)</label>
                                        <input type="number" name="garantia_fabricante" id="garantia_fabricante" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                    </div>

                                    <div>
                                        <label for="id_referencia" class="block text-sm font-medium text-gray-700">ID Referencia</label>
                                        <input type="text" name="id_referencia" id="id_referencia" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    </div>
                                </div>

                                <div class="mt-6">
                                    <label for="imagen_bateria" class="block text-sm font-medium text-gray-700 text-center">Imagen de la bateria</label>
                                    <input type="text" name="imagen_bateria" id="imagen_bateria" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <img id="preview" class="mt-2 mx-auto hidden w-32 h-32 object-cover">
                                </div>

                                <div class="flex justify-end mt-6">
                                    <button type="submit" class="bg-[#49DBA3] text-white rounded-md hover:bg-[#36B89A] py-2 px-4 text-sm">
                                        Crear bateria
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                        

                    

                    <!-- Modal de Confirmación de Eliminación -->
                    <div id="modalElim" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                            <div class="flex justify-between items-center border-b pb-4">
                                <h2 class="text-xl font-semibold">Confirmar Eliminación</h2>
                                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>

                            <p class="mt-4">¿Estás seguro de que deseas eliminar el bateria <span id="bateriaName"></span>? Esta acción no se puede deshacer.</p>

                            <input type="text" id="confirmationDeleteInput" class="mt-4 p-2 border rounded-md w-full" placeholder="Escribe el nombre del bateria para confirmar">

                            <div class="flex justify-end mt-6">
                                <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                                    Cancelar
                                </button>
                                <form id="deletebateriaDeleteForm" action="" method="POST" class="ml-3 inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal para crear fabricante -->
                    <div id="fabricanteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                            <div class="flex justify-between items-center border-b pb-4">
                                <h2 class="text-xl font-semibold">Crear Nuevo Fabricante</h2>
                                <button id="closeFabricanteModal" class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>

                            <form id="crearFabricanteForm" class="mt-4">
                                @csrf
                                <div>
                                    <label for="nombre_fabricante" class="block text-sm font-medium text-gray-700">Nombre del Fabricante</label>
                                    <input type="text" name="nombre" id="nombre_fabricante" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                </div>

                                <div class="flex justify-end mt-6">
                                    <button type="button" id="closeFabricanteModalBtn" class="mr-2 px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                                        Cancelar
                                    </button>
                                    <button type="submit" class="px-4 py-2 bg-[#49DBA3] text-white rounded-lg hover:bg-[#36B89A]">
                                        Crear Fabricante
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- DETAIL-->
            <div id="detail" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
                <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                    <h2 class="text-lg font-bold mb-4">Detalles de la batería</h2>
                    <p><strong>Nombre:</strong> <span id="bateriaDetail"></span></p>
                    <p><strong>Coste:</strong> <span id="costeDetail"></span></p>
                    <p><strong>Capacidad:</strong> <span id="capacidadDetail"></span></p>
                    <p><strong>Descripción:</strong> <span id="descripcionDetail"></span></p>
                    <p><strong>Imagen:</strong> <img id="imagenPanel" src="" alt="Imagen de la bateria" class="max-w-xs h-auto mt-2 rounded border border-gray-200" style="display: none;"></p>
                    <p><strong>Garantía Material:</strong> <span id="garantiaMaterial"></span></p>
                    <p><strong>Garantía Fabricante:</strong> <span id="garantiaFabricante"></span></p>
                    <button onclick="toggleDetail()" class="mt-4 px-4 py-2 bg-red-600 text-white rounded">Cerrar</button>
                </div>
            </div>
        <script>
            window.routeCrearFabricante = "{{ route('fabricantes.store') }}";
            window.csrfToken = "{{ csrf_token() }}";
            window.bateriasStoreRoute = "{{ route('baterias.store') }}";

        </script>
        <script src="{{ asset('build/js/baterias/modalFabricante.js') }}"></script>
        <script src="build/js/baterias/modalbaterias.js"></script>
        <script src="build/js/baterias/baterias.js"></script>
        <script src="build/js/baterias/modalElimBateri.js"></script>
    </x-app-layout>
</body>
</html>