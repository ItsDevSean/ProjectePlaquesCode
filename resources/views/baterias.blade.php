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

        <div id="batteryListContainer" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-70 hidden backdrop-blur-sm transition-opacity duration-300 p-4">
            <div class="bg-white mt-20 dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-2xl overflow-hidden transform transition-all duration-300 scale-95 opacity-0 modal-content max-h-[80vh] overflow-y-auto border border-gray-200 dark:border-gray-700">
                <div class="bg-gradient-to-r from-emerald-600 to-teal-700 px-6 py-4 sticky top-0 z-10 border-b border-teal-800 dark:border-teal-600">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold text-white">Selecciona una Batería Común</h2>
                        <button type="button" id="closeMostUsedModal" class="text-white hover:text-gray-200 transition-colors duration-200 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
        
                <div class="p-6 space-y-6 mt-4">
                    <p class="text-sm text-gray-700 dark:text-gray-300 mb-4">Haz clic para seleccionar una batería común y pre-rellenar el formulario:</p>
        
                    <div class="battery-item grid grid-cols-1 md:grid-cols-3 gap-4 p-3 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors items-center"
                         data-battery-type="LiFePO4"
                         data-battery-name="Example LiFePO4 5kWh"
                         data-battery-capacity="5.0"
                         data-battery-cost="1500"
                         data-battery-manufacturer-id="1"
                         data-battery-manufacturer-name="Fabricante Popular Litio"
                         data-battery-material-warranty="10"
                         data-battery-fabricante-warranty="10"
                         data-battery-description="Batería LiFePO4 muy segura y con larga vida útil. Ideal para autoconsumo residencial."
                         data-battery-image-url="https://via.placeholder.com/100x100?text=LiFePO4">
                        <div class="col-span-1 flex justify-center">
                             <img src="build/img/bateriaLitio.png" alt="Imatge Bateria LiFePO4" class="w-24 h-24 object-contain rounded">
                        </div>
                        <div class="col-span-2">
                            <h5 class="text-lg font-bold text-emerald-600 dark:text-teal-500">Litio Ferrofosfato (LiFePO4)</h5>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Fabricante Popular Litio</p>
                            <p class="text-sm text-gray-700 dark:text-gray-300 mt-1">Batería LiFePO4 muy segura y con larga vida útil. Ideal para autoconsumo residencial.</p>
                            <div class="grid grid-cols-2 gap-x-4 gap-y-1 text-xs text-gray-500 dark:text-gray-400 mt-3">
                                <span><span class="font-semibold">Capacidad:</span> 5.0 kWh</span>
                                <span><span class="font-semibold">Coste Estimado:</span> 1500 €</span>
                                <span><span class="font-semibold">Garantía Material:</span> 10 años</span>
                                <span><span class="font-semibold">Garantía Fabricante:</span> 10 años</span>
                            </div>
                        </div>
                    </div>
        
                    <div class="battery-item grid grid-cols-1 md:grid-cols-3 gap-4 p-4 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors items-center"
                         data-battery-type="Li-ion (NMC)"
                         data-battery-name="Example Li-ion NMC 10kWh"
                         data-battery-capacity="10.0"
                         data-battery-cost="3000"
                         data-battery-manufacturer-id="2"
                         data-battery-manufacturer-name="Fabricante Innovador"
                         data-battery-material-warranty="10"
                         data-battery-fabricante-warranty="10"
                         data-battery-description="Batería de Ion de Litio con alta densidad energética. Diseño compacto y moderno."
                         data-battery-image-url="https://via.placeholder.com/100x100?text=Li-ion+NMC">
                         <div class="col-span-1 flex justify-center">
                            <img src="build/img/bateriaIon.png" alt="Imatge Bateria Li-ion NMC" class="w-24 h-24 object-contain rounded">
                         </div>
                         <div class="col-span-2">
                            <h5 class="text-lg font-bold text-emerald-600 dark:text-teal-500">Ion de Litio (otras químicas como NMC)</h5>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Fabricante Innovador</p>
                            <p class="text-sm text-gray-700 dark:text-gray-300 mt-1">Batería de Ion de Litio con alta densidad energética. Diseño compacto y moderno.</p>
                            <div class="grid grid-cols-2 gap-x-4 gap-y-1 text-xs text-gray-500 dark:text-gray-400 mt-3">
                                <span><span class="font-semibold">Capacidad:</span> 10.0 kWh</span>
                                <span><span class="font-semibold">Coste Estimado:</span> 3000 €</span>
                                <span><span class="font-semibold">Garantía Material:</span> 10 años</span>
                                <span><span class="font-semibold">Garantía Fabricante:</span> 10 años</span>
                            </div>
                         </div>
                    </div>
        
                    <div class="battery-item grid grid-cols-1 md:grid-cols-3 gap-4 p-4 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors items-center"
                         data-battery-type="Plom-Àcid"
                         data-battery-name="Example Plom-Àcid 20kWh"
                         data-battery-capacity="20.0"
                         data-battery-cost="2500"
                         data-battery-manufacturer-id="3"
                         data-battery-manufacturer-name="Fabricante Tradicional"
                         data-battery-material-warranty="5"
                         data-battery-fabricante-warranty="2"
                         data-battery-description="Tecnología fiable y de menor coste inicial. Requiere ventilación y mantenimiento."
                         data-battery-image-url="https://via.placeholder.com/100x100?text=Plom-Acid">
                         <div class="col-span-1 flex justify-center">
                            <img src="build/img/bateriaAmg.png" alt="Imatge Bateria Plom-Àcid" class="w-24 h-24 object-contain rounded">
                         </div>
                         <div class="col-span-2">
                            <h5 class="text-lg font-bold text-emerald-600 dark:text-teal-500">Plomo-Ácido (GEL/AGM)</h5>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Fabricante Tradicional</p>
                            <p class="text-sm text-gray-700 dark:text-gray-300 mt-1">Tecnología fiable y de menor coste inicial. Requiere ventilación y mantenimiento.</p>
                            <div class="grid grid-cols-2 gap-x-4 gap-y-1 text-xs text-gray-500 dark:text-gray-400 mt-3">
                                <span><span class="font-semibold">Capacidad:</span> 20.0 kWh</span>
                                <span><span class="font-semibold">Coste Estimado:</span> 2500 €</span>
                                <span><span class="font-semibold">Garantía Material:</span> 5 años</span>
                                <span><span class="font-semibold">Garantía Fabricante:</span> 2 años</span>
                            </div>
                         </div>
                    </div>
        
                    <div class="battery-item grid grid-cols-1 md:grid-cols-3 gap-4 p-4 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors items-center"
                        data-battery-type="LiFePO4 Residencial"
                        data-battery-name="Bateria Litio Residencial 5kWh"
                        data-battery-capacity="5.0"
                        data-battery-cost="3000" {{-- Coste típico estimado para 5kWh LiFePO4 --}}
                        data-battery-manufacturer-id="5" {{-- Nuevo ID genérico --}}
                        data-battery-manufacturer-name="Fabricante de Baterías Residenciales"
                        data-battery-material-warranty="10" {{-- Garantía típica para Litio residencial --}}
                        data-battery-fabricante-warranty="10" {{-- Garantía típica para Litio residencial --}}
                        data-battery-description="Batería de Litio (LiFePO4) compacta y segura, ideal para sistemas de autoconsumo en tejados. Larga vida útil."
                        data-battery-image-url="https://solarbex.com/wp-content/uploads/2022/07/BATERIA-LITIO-5KW-VOLTEM-PARED-scaled.jpg"> {{-- Mantengo la imagen residencial --}}
                        <div class="col-span-1 flex justify-center">
                            <img src="build/img/bateria4.png" alt="Imagen Batería Litio Residencial" class="w-24 h-24 object-contain rounded"> {{-- Mantengo la imagen residencial --}}
                        </div>
                        <div class="col-span-2">
                            <h5 class="text-lg font-bold text-emerald-600 dark:text-teal-500">Litio (LiFePO4) Residencial</h5>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Fabricante de Baterías Residenciales</p>
                            <p class="text-sm text-gray-700 dark:text-gray-300 mt-1">Batería de Litio (LiFePO4) compacta y segura, ideal para sistemas de autoconsumo en tejados. Larga vida útil.</p>
                            <div class="grid grid-cols-2 gap-x-4 gap-y-1 text-xs text-gray-500 dark:text-gray-400 mt-3">
                                <span><span class="font-semibold">Capacidad:</span> 5.0 kWh</span>
                                <span><span class="font-semibold">Coste Estimado:</span> 3000 €</span>
                                <span><span class="font-semibold">Garantía Material:</span> 10 años</span>
                                <span><span class="font-semibold">Garantía Fabricante:</span> 10 años</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12 m-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-between">
                        <button id="openModal" class="px-4 py-2 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-lg shadow-lg hover:bg-[#36B89A] transition-all duration-300">
                            <i class="fas fa-plus"></i> Crear Bateria
                        </button>
                        <button id="loadBatteriesButton" class="px-4 py-2 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-lg shadow-lg hover:bg-[#36B89A] transition-all duration-300">
                            <i class="fas fa-cloud"></i> Cargar Baterias
                        </button>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Bateria</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Capacidad</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fabricante</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Coste</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fecha de creación</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @if ($baterias->isEmpty())
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-400 dark:text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <rect x="5" y="7" width="14" height="12" rx="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 4h6" /> <path stroke-linecap="round" stroke-linejoin="round" d="M9 4v3"/>  
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 4v3"/> 
                                        </svg>
                                        <p class="text-lg font-medium">No hay baterías disponibles</p>
                                        <p class="text-sm mt-1">Añade tu primera batería para comenzar</p>
                                    </div>
                                </td>
                            </tr>
                        @else
                            @foreach ($baterias as $bateria)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150" onclick="openDetail({{$bateria}})">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $bateria->nombre_bateria }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-white">{{ $bateria->capacidad }} kWh</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-white">{{ $bateria->fabricante->nombre }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ $bateria->coste }} €</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-white">{{ $bateria->created_at->format('d/m/Y') }}</div>
                                        <div class="text-xs text-gray-500">{{ $bateria->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end space-x-3">
                                            <button onclick="event.stopPropagation(); openEditModal({{ json_encode($bateria) }})" class="text-emerald-600 hover:text-teal-700 transition-colors" title="Editar">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <button onclick="event.stopPropagation();openModalElim('{{ $bateria->nombre_bateria }}', '{{ $bateria->id }}')" class="text-red-600 hover:text-red-900 transition-colors" title="Eliminar">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    @if ($baterias->hasPages())
                    <tfoot>
                        <tr>
                            <td colspan="6" class="px-6 py-4 bg-white dark:bg-gray-800">
                                {{ $baterias->links() }}
                            </td>
                        </tr>
                    </tfoot>
                    @endif
                </table>

                    
                <!-- Modal Baterias -->
                <div id="modal" class="fixed inset-0 z-50 flex items-center justify-center pt-10 bg-black bg-opacity-70 hidden backdrop-blur-sm transition-opacity duration-300 p-4">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-4xl transform transition-all duration-300 scale-95 opacity-0 modal-content max-h-[80vh] overflow-y-auto">
                        <!-- Encabezado con efecto gradiente -->
                        <div class="bg-gradient-to-r from-emerald-500 to-teal-600 px-6 py-4">
                            <div class="flex justify-between items-center">
                                <h2 class="text-2xl font-bold text-white">Gestión de Baterías</h2>
                                <button id="closeModal" type="button" class="text-white hover:text-gray-200 transition-colors duration-200 focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <form id="bateriaForm" action="{{ route('baterias.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                            @csrf
                            <input type="hidden" id="formMethod" name="_method" value="POST">

                            <!-- Grid de 2 columnas con espaciado mejorado -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <!-- Columna Izquierda -->
                                <div class="space-y-6">
                                    <!-- Nombre -->
                                    <div class="relative">
                                        <label for="nombre_bateria" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nombre de la Batería</label>
                                        <div class="relative">
                                            <input type="text" name="nombre_bateria" id="nombre_bateria" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 placeholder-gray-400 dark:placeholder-gray-400 pl-10" required>
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Capacidad -->
                                    <div class="relative">
                                        <label for="capacidad" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Capacidad (kWh)</label>
                                        <div class="relative">
                                            <input type="number" name="capacidad" id="capacidad" placeholder="Ej: 5.2" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 placeholder-gray-400 dark:placeholder-gray-400 pl-10" required step="0.1">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Coste -->
                                    <div class="relative">
                                        <label for="coste" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Coste (€)</label>
                                        <div class="relative">
                                            <input type="number" name="coste" id="coste" placeholder="Ej: 1200" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 placeholder-gray-400 dark:placeholder-gray-400 pl-10" required min="0" step="0.01">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ID Referencia -->
                                    <div class="relative">
                                        <label for="id_referencia" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">ID Referencia</label>
                                        <div class="relative">
                                            <input type="text" name="id_referencia" id="id_referencia" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 placeholder-gray-400 dark:placeholder-gray-400 pl-10" required>
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Columna Derecha -->
                                <div class="space-y-6">
                                    <!-- Fabricante -->
                                    <div>
                                        <label for="fabricante" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Fabricante</label>
                                        <div class="flex gap-4">
                                            <select name="fabricante_id" id="fabricante" class="flex-1 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 appearance-none" required>
                                                <option value="">Seleccionar fabricante</option>
                                                @foreach ($fabricantes as $fabricante)
                                                    <option value="{{ $fabricante->id }}">{{ $fabricante->nombre }}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" id="openFabricanteModal" class="px-4 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-lg shadow-md hover:from-emerald-600 hover:to-teal-700 transition-all duration-300 flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                </svg>
                                                <span class="hidden sm:inline">Nuevo</span>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Garantías -->
                                    <div class="grid grid-cols-2 gap-5">
                                        <div>
                                            <label for="garantia_material" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Garantía Material (años)</label>
                                            <input type="number" name="garantia_material" id="garantia_material" min="1" max="30" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300" required>
                                        </div>
                                        <div>
                                            <label for="garantia_fabricante" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Garantía Fabricante (años)</label>
                                            <input type="number" name="garantia_fabricante" id="garantia_fabricante" min="1" max="30" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300" required>
                                        </div>
                                    </div>

                                    <!-- Descripción -->
                                    <div>
                                        <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Descripción</label>
                                        <textarea name="descripcion" id="descripcion" rows="4" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300"></textarea>
                                    </div>

                                    <!-- Imagen -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Imagen de la Batería</label>
                                        <div class="flex items-center justify-center w-full">
                                            <label for="imagen_bateria" class="flex flex-col items-center justify-center w-full h-36 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-300">
                                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">PNG, JPG o JPEG (MAX. 5MB)</p>
                                                </div>
                                                <input id="imagen_bateria" name="imagen_bateria" type="file" class="hidden" accept="image/*">
                                            </label>
                                        </div>
                                        <div class="mt-3 flex justify-center">
                                            <img id="preview" class="hidden w-40 h-40 object-contain rounded-lg border border-gray-200 dark:border-gray-600">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Botones de acción -->
                            <div class="mt-10 flex justify-end space-x-4">
                                <button type="button" id="cancelButton" class="px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-300">
                                    Cancelar
                                </button>
                                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-lg shadow-md hover:from-emerald-600 hover:to-teal-700 transition-all duration-300 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span id="submitButtonText">Crear Batería</span>
                                </button>
                            </div>
                        </form>
                    </div>
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
                                                    Estás a punto de eliminar la batería: <strong id="bateriaName" class="font-semibold text-gray-900 dark:text-white"></strong>.
                                                    Esta acción no puede deshacerse.
                                                </p>
                                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                                    Para confirmar, escribe el nombre de la batería en el campo de abajo:
                                                </p>
                                                <input type="text" id="confirmationDeleteInput" class="mt-3 w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" placeholder="Escribe el nombre de la batería"oninput="validateDeletionInput()"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button onclick="confirmDeletion()"id="confirmDeleteButton"type="button"class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed"disabled>
                                        Eliminar
                                    </button>
                                    <button onclick="closeModal()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-600 text-base font-medium text-gray-700 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                        Cancelar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Formulario de eliminación -->
                    <form id="deletebateriaDeleteForm" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    <!-- Modal para crear fabricante -->
                    <div id="fabricanteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-70 hidden backdrop-blur-sm transition-opacity duration-300">
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all duration-300 scale-95 opacity-0 modal-content">
                            <!-- Encabezado con efecto gradiente -->
                            <div class="bg-gradient-to-r from-emerald-500 to-teal-600 px-6 py-4">
                                <div class="flex justify-between items-center">
                                    <h2 class="text-xl font-bold text-white">Crear Nuevo Fabricante</h2>
                                    <button id="closeFabricanteModal" type="button" class="text-white hover:text-gray-200 transition-colors duration-200 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <form id="crearFabricanteForm" class="p-6">
                                @csrf
                                <div class="space-y-5">
                                    <!-- Nombre del Fabricante -->
                                    <div class="relative">
                                        <label for="nombre_fabricante" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre del Fabricante</label>
                                        <div class="relative">
                                            <input type="text" name="nombre" id="nombre_fabricante" class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 placeholder-gray-400 dark:placeholder-gray-400 pl-10"required>
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Botones de acción -->
                                <div class="mt-8 flex justify-end space-x-3">
                                    <button type="button" id="closeFabricanteModalBtn" class="px-6 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-300">
                                        Cancelar
                                    </button>
                                    <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-lg shadow-md hover:from-emerald-600 hover:to-teal-700 transition-all duration-300 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>Crear Fabricante</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="detail" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-70 pt-16 hidden backdrop-blur-sm transition-opacity duration-300 px-4">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-3xl overflow-hidden transform transition-all duration-300 scale-95 opacity-0 modal-content max-h-[85vh] overflow-y-auto">
                    <!-- Encabezado con efecto gradiente -->
                    <div class="bg-gradient-to-r from-emerald-500 to-teal-600 px-6 py-4">
                        <div class="flex justify-between items-center">
                            <h2 class="text-xl font-bold text-white">Detalles de la Batería</h2>
                            <button onclick="toggleDetail()" type="button" class="text-white hover:text-gray-200 transition-colors duration-200 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
            
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">  <!-- Aumenté el gap a 8 -->
                            <!-- Columna Izquierda -->
                            <div class="space-y-5">  <!-- Aumenté el espacio vertical -->
                                <!-- Nombre -->
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-emerald-100 dark:bg-emerald-900 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600 dark:text-emerald-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Nombre</h3>
                                        <p id="bateriaDetail" class="text-lg font-semibold text-gray-900 dark:text-white"></p>
                                    </div>
                                </div>
            
                                <!-- Capacidad -->
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 dark:text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Capacidad</h3>
                                        <p id="capacidadDetail" class="text-lg font-semibold text-gray-900 dark:text-white"></p>
                                    </div>
                                </div>
            
                                <!-- Coste -->
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-purple-100 dark:bg-purple-900 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600 dark:text-purple-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Coste</h3>
                                        <p id="costeDetail" class="text-lg font-semibold text-gray-900 dark:text-white"></p>
                                    </div>
                                </div>
                            </div>
            
                            <!-- Columna Derecha -->
                            <div class="space-y-5">  <!-- Aumenté el espacio vertical -->
                                <!-- Garantía Material -->
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-amber-100 dark:bg-amber-900 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-600 dark:text-amber-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Garantía Material</h3>
                                        <p id="garantiaMaterial" class="text-lg font-semibold text-gray-900 dark:text-white"></p>
                                    </div>
                                </div>
            
                                <!-- Garantía Fabricante -->
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-amber-100 dark:bg-amber-900 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-600 dark:text-amber-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Garantía Fabricante</h3>
                                        <p id="garantiaFabricante" class="text-lg font-semibold text-gray-900 dark:text-white"></p>
                                    </div>
                                </div>
            
                                <!-- ID Referencia -->
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600 dark:text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">ID Referencia</h3>
                                        <p id="idReferencia" class="text-lg font-semibold text-gray-900 dark:text-white"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        <!-- Descripción -->
                        <div class="mt-8">  <!-- Aumenté el margen superior -->
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-3">Descripción</h3>  <!-- Aumenté el margen inferior -->
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <p id="descripcionDetail" class="text-gray-900 dark:text-gray-200"></p>
                            </div>
                        </div>
            
                        <!-- Imagen -->
                        <div class="mt-8">  <!-- Aumenté el margen superior -->
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-3">Imagen de la Batería</h3>  <!-- Aumenté el margen inferior -->
                            <div class="flex justify-center">
                                <img id="imagenPanel" src="" alt="Imagen de la batería" class="max-w-full h-72 object-contain rounded-lg border border-gray-200 dark:border-gray-600">  <!-- Aumenté la altura de la imagen -->
                            </div>
                        </div>
                    </div>
            
                    <!-- Pie del modal -->
                    <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 flex justify-end">
                        <button onclick="toggleDetail()" class="px-6 py-2 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-lg shadow-md hover:from-emerald-600 hover:to-teal-700 transition-all duration-300">
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        <script>
            window.routeCrearFabricante = "{{ route('fabricantes.store') }}";
            window.csrfToken = "{{ csrf_token() }}";
            window.bateriasStoreRoute = "{{ route('baterias.store') }}";
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                // Obtenim referències als elements
                const loadButton = document.getElementById('loadBatteriesButton');
                const batteryListContainer = document.getElementById('batteryListContainer');
                const closeMostUsedModal = document.getElementById('closeMostUsedModal');
                const batteryItems = document.querySelectorAll('.battery-item');
                
                // Funció per mostrar el modal
                function showBatteryList() {
                    batteryListContainer.classList.remove('hidden');
                    
                    // Forcem un repintat per assegurar que les transicions funcionin
                    void batteryListContainer.offsetWidth;
                    
                    // Seleccionem el contingut del modal
                    const modalContent = batteryListContainer.querySelector('.modal-content');
                    
                    // Eliminem les classes d'animació inicial
                    modalContent.classList.remove('scale-95', 'opacity-0');
                    modalContent.classList.add('scale-100', 'opacity-100');
                }
                
                // Funció per amagar el modal
                function hideBatteryList() {
                    const modalContent = batteryListContainer.querySelector('.modal-content');
                    
                    // Afegim les classes d'animació per sortida
                    modalContent.classList.remove('scale-100', 'opacity-100');
                    modalContent.classList.add('scale-95', 'opacity-0');
                    
                    // Esperem que acabi la transició abans d'afegir hidden
                    setTimeout(() => {
                        batteryListContainer.classList.add('hidden');
                    }, 300); // Ajusta aquest temps segons la durada de la teva transició
                }
                
                // Event listener per al botó d'obrir
                if (loadButton) {
                    loadButton.addEventListener('click', showBatteryList);
                }
                
                // Event listener per al botó de tancar
                if (closeMostUsedModal) {
                    closeMostUsedModal.addEventListener('click', hideBatteryList);
                }
                
                // Event listener per tancar fent clic fora del contingut
                if (batteryListContainer) {
                    batteryListContainer.addEventListener('click', (e) => {
                        if (e.target === batteryListContainer) {
                            hideBatteryList();
                        }
                    });
                }
                
                // Event listeners per als items de bateria
                batteryItems.forEach(item => {
                    item.addEventListener('click', () => {
                        // Aquí pots afegir la lògica per omplir el formulari amb les dades de la bateria seleccionada
                        hideBatteryList();
                    });
                });
            });
        </script>
        <script src="{{ asset('build/js/baterias/modalFabricante.js') }}"></script>
        <script src="build/js/baterias/modalbaterias.js"></script>
        <script src="build/js/baterias/baterias.js"></script>
        <script src="build/js/baterias/modalElimBateri.js"></script>
    </x-app-layout>
</body>

</html>
