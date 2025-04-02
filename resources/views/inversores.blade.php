<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="store-route" content="{{ route('inversores.store') }}">
    <title>Projecte Plaques</title>
    <link rel="stylesheet" href="{{ asset('build/css/styleDades.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Listado de Inversores') }}
            </h2>
        </x-slot>

        <div class="py-12 m-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <button id="openModal" class="px-4 py-2 bg-[#49DBA3] text-white rounded-lg shadow-lg hover:bg-[#36B89A] transition-all duration-300">
                            <i class="fas fa-plus"></i> Crear Inversor
                        </button>
                    </div>
                    <table class="tabla min-w-full divide-y">
                            <thead>
                                    <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Inversor</th>
                                    <th class="px-9 py-3 text-left text-xs font-medium uppercase tracking-wider">Potencia nominal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Eficencia</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Fabricante</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Tipo instalacion</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Fecha de creacion</th>
                                    </tr>
                            </thead>

                            <tbody>
                                @if ($inversores->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-gray-500">
                                            No hay inversores disponibles.
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($inversores as $inversor)
                                    <tr class="border-t cursor-pointer hover:bg-gray-100" onclick="openDetail({{$inversor}})">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $inversor->nombre_inversor }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $inversor->potencia_nominal }} kWh</td>
                                            <td class="px-6 py-4 whitespace-nowrap-3">{{ ($inversor->eficiencia) }} %</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $inversor->fabricante->nombre }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $inversor->tipo_instalacion }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $inversor->created_at->format('d/m/Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                            <form action="{{ route('inversores.update', $inversor->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="button" onclick="event.stopPropagation();openEditModal({{ $inversor }})" class="text-green-600 hover:text-green-900 mr-3 no-underline">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </form>
                                            
                                            <button onclick="event.stopPropagation();openModalElim('{{ $inversor->nombre_inversor }}', '{{ $inversor->id }}')" class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                        </tr>
                                    @endforeach
                                @endif
                                @if ($inversores->hasPages())
                            <div class="px-6 py-4 bg-white dark:bg-gray-800">
                                    {{ $inversores->links() }}
                            </div>
                            @endif
                            </tbody>
                        </table>

                    
                    <!-- Modal -->
                    <div id="modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                        <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl p-6">
                            <div class="flex justify-between items-center border-b pb-4">
                                <h2 class="text-xl font-semibold">Crear Nuevo Inversor</h2>
                                <form id="inversorForm" action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="formMethod" name="_method" value="POST">
                                <div class="flex items-center gap-8">
                                    <button type="submit" class="bg-[#49DBA3] text-white rounded-md hover:bg-[#36B89A] py-2 px-2 text-sm">
                                        Crear Inversor
                                    </button>

                                    <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                                <div class="grid grid-cols-2 gap-10">
                                    <div>
                                        <label for="nombre_inversor" class="block text-sm font-medium text-gray-700">Nombre del Inversor</label>
                                        <input type="text" name="nombre_inversor" id="nombre_inversor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                    </div>

                                    <div>
                                        <label for="eficiencia" class="block text-sm font-medium text-gray-700">Eficiencia</label>
                                        <input type="number" name="eficiencia" id="eficiencia" placeholder="Eficiencia del inversor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                    </div>

                                    <div>
                                    <label for="garantia_material" class="block text-sm font-medium text-gray-700">Tipo de instalación</label>
                                    <select class="mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" id="tipo_instalacion" name="tipo_instalacion" required>
                                            <option value="monofasica" {{ (old('tipo_instalacion', $proyecto->tipo_instalacion ?? '') == 'monofasica') ? 'selected' : '' }}>Monofàsica</option>
                                            <option value="trifasica" {{ (old('tipo_instalacion', $proyecto->tipo_instalacion ?? '') == 'trifasica') ? 'selected' : '' }}>Trifàsica</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="garantia_material" class="block text-sm font-medium text-gray-700">Garantía del Material (Años)</label>
                                        <input type="number" name="garantia_material" id="garantia_material" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                    </div>

                                    <div>
                                        <label for="potencia_nominal" class="block text-sm font-medium text-gray-700">Potencia Nominal (W)</label>
                                        <input type="number" name="potencia_nominal" id="potencia_nominal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                    </div>

                                    <div>
                                        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                                        <textarea name="descripcion" id="descripcion" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                                    </div>

                                        <div>
                                        <label for="fabricante" class="block text-sm font-medium text-gray-700">Fabricante</label>
                                        <div class="flex items-center gap-4">
                                        <select name="fabricante_id" id="fabricante" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
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
                                        <label for="microinversor" class="block text-sm font-medium text-gray-700">¿Es un Microinversor?</label>
                                        <select name="microinversor" id="microinversor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                            <option value="1">Sí</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="garantia_fabricante" class="block text-sm font-medium text-gray-700">Garantía del Fabricante (Años)</label>
                                        <input type="number" name="garantia_fabricante" id="garantia_fabricante" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                    </div>

                                    <div>
                                        <label for="id_referencia" class="block text-sm font-medium text-gray-700">ID Referencia</label>
                                        <input type="number" name="id_referencia" id="id_referencia" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                    </div>
                                </div>
                                <div>
                                        <label for="imagen_inversor" class="block text-sm font-medium text-gray-700 flex justify-center mt-5">Imagen del Inversor</label>
                                        <input type="text" name="imagen_inversor" id="imagen_inversor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                        <img id="preview" class="mt-2 hidden w-32 h-32 object-cover">
                                    </div>
                                </div>
                                
                            </div>
                            </form>
                        </div>
                        

                    

                                        <!-- Modal de confirmación -->
                    <div id="modalElim" class="fixed inset-0 z-50 hidden overflow-y-auto">
                        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                            </div>

                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="sm:flex sm:items-start">
                                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                        </div>
                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                                                Confirmar eliminación
                                            </h3>
                                            <div class="mt-2">
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    Estás a punto de eliminar el inversor: <strong id="inversorName" class="font-semibold text-gray-900 dark:text-white"></strong>.
                                                    Esta acción no puede deshacerse.
                                                </p>
                                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                                    Para confirmar, escribe el nombre del inversor en el campo de abajo:
                                                </p>
                                                <input
                                                    type="text"
                                                    id="confirmationInput"
                                                    class="mt-3 w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                                    placeholder="Escribe el nombre del inversor"
                                                    oninput="validateDeletionInput()"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button
                                        onclick="confirmDeletion()"
                                        id="confirmDeleteButton"
                                        type="button"
                                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed"
                                        disabled
                                    >
                                        Eliminar
                                    </button>
                                    <button
                                        onclick="closeModal()"
                                        type="button"
                                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-600 text-base font-medium text-gray-700 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                    >
                                        Cancelar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Formulario de eliminación -->
                    <form id="deleteInversorDeleteForm" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>

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
                    <h2 class="text-lg font-bold mb-4">Detalles del Inversor</h2>
                    <p><strong>Inversor:</strong> <span id="inversorDetail"></span></p>
                    <p><strong>Potencia Nominal:</strong> <span id="potenciaDetail"></span> kWh</p>
                    <p><strong>Eficiencia:</strong> <span id="eficienciaDetail"></span> %</p>
                    <p><strong>Descripción:</strong> <span id="descripcionDetail"></span></p>
                    <p><strong>Imagen Panel:</strong> <img id="imagenPanel" src="" alt="Imagen del inversor" class="max-w-xs h-auto mt-2 rounded border border-gray-200"></p>
                    <p><strong>Garantia Material:</strong> <span id="garantiaMaterial"></span></p>
                    <p><strong>Garantia Fabricante:</strong> <span id="garantiaFabricante"></span></p>
                    <button onclick="toggleDetail()" class="mt-4 px-4 py-2 bg-red-600 text-white rounded">Cerrar</button>
                </div>
            </div>
        </div>
        <script>
            window.routeCrearFabricante = "{{ route('fabricantes.store') }}";
            window.csrfToken = "{{ csrf_token() }}";
        </script>
        <script src="{{ asset('build/js/inversores/modalFabricante.js') }}"></script>
        <script src="build/js/inversores/modalInversores.js"></script>
        <script src="build/js/inversores/inversores.js"></script>
        <script src="build/js/inversores/modalElimInver.js"></script>
    </x-app-layout>
</body>
</html>