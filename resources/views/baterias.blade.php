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

<body class="bg-gray-100 text-gray-800">
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
                                    <tr class="border-t cursor-pointer hover:bg-gray-100" onclick="openDetail({{$bateria}})">
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
                            @if ($baterias->hasPages())
                            <div class="px-6 py-4 bg-white dark:bg-gray-800">
                                    {{ $baterias->links() }}
                            </div>
                            @endif
                            </tbody>
                            
                        </table>

                    
                    <!-- Modal -->
                    <div id="modal" class="fixed inset-0 z-50 overflow-y-auto hidden">
                        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <!-- Fondo oscuro -->
                            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                <div class="absolute inset-0 bg-gray-900 bg-opacity-75 dark:bg-opacity-90"></div>
                            </div>
                            
                            <!-- Contenido del modal -->
                            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                                <!-- Cabecera -->
                                <div class="bg-emerald-500 dark:bg-emerald-600 px-6 py-4 sm:px-6 sm:flex sm:items-center sm:justify-between">
                                    <h3 class="text-xl font-bold text-white">
                                        <span id="modalTitle">Crear Nueva Batería</span>
                                    </h3>
                                    <button id="closeModal" type="button" class="text-white hover:text-gray-200 focus:outline-none">
                                        <i class="fas fa-times text-xl"></i>
                                    </button>
                                </div>
                                
                                <!-- Cuerpo del formulario -->
                                <form id="bateriaForm" action="{{ route('baterias.store') }}" method="POST" enctype="multipart/form-data" class="px-6 py-4">
                                    @csrf
                                    <input type="hidden" id="formMethod" name="_method" value="POST">
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Columna Izquierda -->
                                        <div class="space-y-4">
                                            <!-- Nombre de la batería -->
                                            <div>
                                                <label for="nombre_bateria" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre de la batería</label>
                                                <input type="text" name="nombre_bateria" id="nombre_bateria" 
                                                    class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-emerald-500 focus:ring-emerald-500" 
                                                    required>
                                            </div>
                                            
                                            <!-- Capacidad -->
                                            <div>
                                                <label for="capacidad" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Capacidad (kWh)</label>
                                                <input type="number" name="capacidad" id="capacidad" 
                                                    class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-emerald-500 focus:ring-emerald-500" 
                                                    required>
                                            </div>
                                            
                                            <!-- Coste -->
                                            <div>
                                                <label for="coste" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Coste (€)</label>
                                                <input type="number" name="coste" id="coste" step="0.01"
                                                    class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-emerald-500 focus:ring-emerald-500" 
                                                    required>
                                            </div>
                                            
                                            <!-- Descripción -->
                                            <div>
                                                <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Descripción</label>
                                                <textarea name="descripcion" id="descripcion" rows="3"
                                                        class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-emerald-500 focus:ring-emerald-500"></textarea>
                                            </div>
                                        </div>
                                        
                                        <!-- Columna Derecha -->
                                        <div class="space-y-4">
                                            <!-- Fabricante -->
                                            <div>
                                                <label for="fabricante" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fabricante</label>
                                                <div class="flex gap-2">
                                                    <select name="fabricante_id" id="fabricante" 
                                                            class="flex-1 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                                        <option value="">Seleccionar fabricante</option>
                                                        @foreach ($fabricantes as $fabricante)
                                                            <option value="{{ $fabricante->id }}">{{ $fabricante->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                    <button type="button" id="openFabricanteModal" 
                                                            class="px-3 py-2 bg-emerald-500 dark:bg-emerald-600 text-white rounded-md hover:bg-emerald-600 dark:hover:bg-emerald-700 transition-colors duration-300">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            
                                            <!-- Garantías -->
                                            <div class="grid grid-cols-2 gap-4">
                                                <div>
                                                    <label for="garantia_material" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Garantía Material (años)</label>
                                                    <input type="number" name="garantia_material" id="garantia_material"
                                                        class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                                </div>
                                                <div>
                                                    <label for="garantia_fabricante" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Garantía Fabricante (años)</label>
                                                    <input type="number" name="garantia_fabricante" id="garantia_fabricante"
                                                        class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required>
                                                </div>
                                            </div>
                                            
                                            <!-- ID Referencia -->
                                            <div>
                                                <label for="id_referencia" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">ID Referencia</label>
                                                <input type="text" name="id_referencia" id="id_referencia"
                                                    class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                            </div>
                                            
                                            <!-- Imagen -->
                                            <div>
                                                <label for="imagen_bateria" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Imagen de la batería</label>
                                                <div class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 dark:border-gray-600 px-6 pt-5 pb-6">
                                                    <div class="space-y-1 text-center">
                                                        <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                                            <label for="imagen_bateria" class="relative cursor-pointer rounded-md bg-white dark:bg-gray-700 font-medium text-emerald-600 dark:text-emerald-400 hover:text-emerald-500 dark:hover:text-emerald-300 focus-within:outline-none">
                                                                <span>Subir archivo</span>
                                                                <input id="imagen_bateria" name="imagen_bateria" type="file" class="sr-only">
                                                            </label>
                                                            <p class="pl-1">o arrastrar y soltar</p>
                                                        </div>
                                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF hasta 2MB</p>
                                                    </div>
                                                </div>
                                                <img id="preview" class="mt-2 mx-auto hidden w-32 h-32 object-contain rounded-md border border-gray-200 dark:border-gray-600">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Botones de acción -->
                                    <div class="mt-6 flex justify-end space-x-3">
                                        <button type="button" id="cancelButton" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                            Cancelar
                                        </button>
                                        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-emerald-500 dark:bg-emerald-600 hover:bg-emerald-600 dark:hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                            <span id="submitButtonText">Crear Batería</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                        

                    

                    <!-- Modal de Confirmación de Eliminación -->
                    <div id="modalElim" class="fixed inset-0 z-50 overflow-y-auto hidden">
                        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <!-- Fondo oscuro -->
                            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                <div class="absolute inset-0 bg-gray-900 bg-opacity-75 dark:bg-opacity-90"></div>
                            </div>
                            
                            <!-- Contenido del modal -->
                            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full">
                                <!-- Cabecera -->
                                <div class="bg-red-500 dark:bg-red-600 px-6 py-4 sm:px-6 sm:flex sm:items-center sm:justify-between">
                                    <h3 class="text-xl font-bold text-white">
                                        Confirmar Eliminación
                                    </h3>
                                    <button onclick="closeModal()" class="text-white hover:text-gray-200 focus:outline-none">
                                        <i class="fas fa-times text-xl"></i>
                                    </button>
                                </div>
                                
                                <!-- Cuerpo -->
                                <div class="px-6 py-4">
                                    <p class="text-gray-700 dark:text-gray-300">
                                        ¿Estás seguro de que deseas eliminar la batería <strong class="text-red-600 dark:text-red-400"><span id="bateriaName"></span></strong>? Esta acción no se puede deshacer.
                                    </p>
                                    
                                    <div class="mt-4">
                                        <label for="confirmationDeleteInput" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                            Escribe el nombre de la batería para confirmar:
                                        </label>
                                        <input type="text" id="confirmationDeleteInput" 
                                            class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-red-500 focus:ring-red-500">
                                    </div>
                                </div>
                                
                                <!-- Pie -->
                                <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <form id="deletebateriaDeleteForm" action="" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-500 dark:bg-red-600 text-base font-medium text-white hover:bg-red-600 dark:hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50"
                                                disabled>
                                            Eliminar
                                        </button>
                                    </form>
                                    <button onclick="closeModal()" 
                                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-600 text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                        Cancelar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para crear fabricante -->
                    <div id="fabricanteModal" class="fixed inset-0 z-50 overflow-y-auto hidden">
                        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <!-- Fondo oscuro -->
                            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                <div class="absolute inset-0 bg-gray-900 bg-opacity-75 dark:bg-opacity-90"></div>
                            </div>
                            
                            <!-- Contenido del modal -->
                            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full">
                                <!-- Cabecera -->
                                <div class="bg-emerald-500 dark:bg-emerald-600 px-6 py-4 sm:px-6 sm:flex sm:items-center sm:justify-between">
                                    <h3 class="text-xl font-bold text-white">
                                        Crear Nuevo Fabricante
                                    </h3>
                                    <button id="closeFabricanteModal" class="text-white hover:text-gray-200 focus:outline-none">
                                        <i class="fas fa-times text-xl"></i>
                                    </button>
                                </div>
                                
                                <!-- Formulario -->
                                <form id="crearFabricanteForm" class="px-6 py-4">
                                    @csrf
                                    <div class="space-y-4">
                                        <div>
                                            <label for="nombre_fabricante" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                Nombre del Fabricante
                                            </label>
                                            <input type="text" name="nombre" id="nombre_fabricante" 
                                                class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-emerald-500 focus:ring-emerald-500" 
                                                required>
                                        </div>
                                    </div>
                                    
                                    <!-- Botones -->
                                    <div class="mt-6 flex justify-end space-x-3">
                                        <button type="button" id="closeFabricanteModalBtn" 
                                                class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                            Cancelar
                                        </button>
                                        <button type="submit" 
                                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-emerald-500 dark:bg-emerald-600 hover:bg-emerald-600 dark:hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                            Crear Fabricante
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal de Detalles de Batería -->
            <div id="detail" class="fixed inset-0 z-50 overflow-y-auto hidden">
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <!-- Fondo oscuro -->
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-900 bg-opacity-75 dark:bg-opacity-90"></div>
                    </div>
                    
                    <!-- Contenido del modal -->
                    <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <!-- Cabecera -->
                        <div class="bg-emerald-500 dark:bg-emerald-600 px-4 py-3 sm:px-6 sm:flex sm:items-center sm:justify-between">
                            <h3 class="text-lg leading-6 font-bold text-white">
                                Detalles de la batería
                            </h3>
                            <button onclick="toggleDetail()" class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-white dark:bg-gray-700 text-base font-medium text-emerald-600 dark:text-emerald-300 hover:bg-emerald-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cerrar
                            </button>
                        </div>
                        
                        <!-- Cuerpo -->
                        <div class="px-4 pt-5 pb-4 sm:p-6">
                            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                                <!-- Nombre -->
                                <div class="sm:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                                    <div class="mt-1 text-sm text-gray-900 dark:text-gray-200 font-semibold" id="bateriaDetail"></div>
                                </div>
                                
                                <!-- Coste -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Coste</label>
                                    <div class="mt-1 text-sm text-gray-900 dark:text-gray-200" id="costeDetail"></div>
                                </div>
                                
                                <!-- Capacidad -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Capacidad</label>
                                    <div class="mt-1 text-sm text-gray-900 dark:text-gray-200" id="capacidadDetail"></div>
                                </div>
                                
                                <!-- Garantía Material -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Garantía Material</label>
                                    <div class="mt-1 text-sm text-gray-900 dark:text-gray-200" id="garantiaMaterial"></div>
                                </div>
                                
                                <!-- Garantía Fabricante -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Garantía Fabricante</label>
                                    <div class="mt-1 text-sm text-gray-900 dark:text-gray-200" id="garantiaFabricante"></div>
                                </div>
                                
                                <!-- Descripción -->
                                <div class="sm:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción</label>
                                    <div class="mt-1 text-sm text-gray-900 dark:text-gray-200" id="descripcionDetail"></div>
                                </div>
                                
                                <!-- Imagen -->
                                <div class="sm:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Imagen</label>
                                    <div class="mt-2 flex justify-center rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 px-6 pt-5 pb-6">
                                        <img id="imagenPanel" src="" alt="Imagen de la batería" class="max-w-full h-auto rounded-lg shadow-md" style="display: none;">
                                        <div id="noImagePlaceholder" class="text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Imagen no disponible</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Pie -->
                        <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="button" onclick="toggleDetail()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-emerald-500 dark:bg-emerald-600 text-base font-medium text-white hover:bg-emerald-600 dark:hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Aceptar
                            </button>
                        </div>
                    </div>
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
