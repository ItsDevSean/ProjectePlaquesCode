<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Paneles Solares</title>
    <link rel="stylesheet" href="{{ asset('build/css/styleDades.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Gestión de Paneles Solares') }}
            </h2>
        </x-slot>

        <div class="py-12 m-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mb-20">
                <!-- Tarjeta de Acciones Principales -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                        <!-- Importación de archivos -->
                        <div class="w-full md:w-1/2">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Importar paneles desde archivo</h3>
                            <form id="import_form" action="{{ route('veureImport') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                @csrf
                                <div class="flex items-center gap-4">
                                    <label class="flex flex-col items-center justify-center w-full border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-300 p-4">
                                        
                                        <div id="import_view" class="flex flex-col items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            <p id="file-name" class="text-sm text-gray-500 dark:text-gray-400">Arrastra tu archivo aquí o haz clic para seleccionar</p>
                                            <p id="file-instructions" class="text-xs text-gray-500 dark:text-gray-400 mt-1">Formatos soportados: CSV, XLSX (MAX. 5MB)</p>
                                        </div>
                                        <input id="csv_file" type="file" name="csv_file" class="hidden" accept=".csv,.xlsx,.xls">
                                    </label>
                                </div>
                                <div class="flex items-center gap-4">
                                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-lg shadow-lg hover:from-emerald-600 hover:to-teal-700 transition-all duration-300 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                        </svg>
                                        Importar Paneles
                                    </button>
                                    <a href="{{ route('file.download') }}" class="text-sm text-emerald-600 dark:text-emerald-400 hover:underline">Descargar plantilla</a>
                                </div>
                            </form>
                            
                            @if(session('error'))
                                <div class="mt-4 p-4 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-200 rounded-lg">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>

                        <!-- Separador visual -->
                        <div class="hidden md:block h-20 w-px bg-gray-200 dark:bg-gray-600 mx-4"></div>

                        <!-- Creación manual -->
                        <div class="w-full md:w-1/2">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Añadir panel manualmente</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">Completa los datos del panel solar para añadirlo al sistema.</p>
                            <button onclick="toggleModal()" class="px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-lg shadow-lg hover:from-emerald-600 hover:to-teal-700 transition-all duration-300 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Nuevo Panel Solar
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta de Listado de Paneles -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <!-- Filtros y Acciones -->
                    

                    <!-- Tabla de Paneles -->
                    <div class="overflow-x-auto ">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 ">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Modelo</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fabricante</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Potencia (Wp)</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Eficiencia</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Garantías</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @if ($panels->isEmpty())
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center text-gray-400 dark:text-gray-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                    <rect x="3" y="3" width="18" height="18" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9h18" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 15h18" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 3v18" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 3v18" />
                                                  </svg>
                                                <p class="text-lg font-medium">No hay paneles registrados</p>
                                                <p class="text-sm mt-2">Comienza importando un archivo o añadiendo un panel manualmente</p>
                                                <div class="mt-4 flex gap-3">
                                                    <button onclick="toggleModal()" class="px-4 py-2 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-lg shadow-lg hover:from-emerald-600 hover:to-teal-700 transition-all duration-300 text-sm">
                                                        Añadir Panel
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($panels as $p)
                                        <tr onclick="openDetail({{ $p }}, {{ json_encode($nameAtributes) }})" class="text-center hover:bg-[#b6b7b8]">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-emerald-100 dark:bg-emerald-900 flex items-center justify-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600 dark:text-emerald-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                        </svg>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-bold text-gray-900 dark:text-white">{{ $p->panel_model }}</div>
                                                        <div class="text-xs text-gray-500 dark:text-gray-400 capitalize">{{ $p->panel_type }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 dark:text-white">{{ $p->manufacturer }}</div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $p->date_manufacturer }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-bold text-gray-900 dark:text-white">{{ $p->potencia_maxima }} Wp</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="w-16 bg-gray-200 dark:bg-gray-600 rounded-full h-2">
                                                        <div class="bg-emerald-500 h-2 rounded-full" style="width: {{ $p->eficencia_panel }}%"></div>
                                                    </div>
                                                    <span class="ml-2 text-sm text-gray-900 dark:text-white">{{ $p->eficencia_panel }}%</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex flex-col">
                                                    <span class="text-xs text-gray-900 dark:text-white">Producto: {{ $p->panel_warranty }} años</span>
                                                    <span class="text-xs text-gray-900 dark:text-white">Rendimiento: {{ $p->performance_warranty }} años</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex items-center justify-end space-x-3">
                                                    {{-- <button onclick="openDetail({{ $p }}, {{ json_encode($nameAtributes) }})" class="text-blue-600 hover:text-blue-800 transition-colors p-1.5 rounded-full hover:bg-blue-50 dark:hover:bg-gray-700" title="Ver detalles">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    </button> --}}
                                                    <button onclick="event.stopPropagation(); openEditModal({{ json_encode($p) }})" class="text-emerald-600 hover:text-teal-700 transition-colors p-1.5 rounded-full hover:bg-emerald-50 dark:hover:bg-gray-700" title="Editar">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </button>
                                                    <button onclick="event.stopPropagation();openModalElim('{{ $p->panel_model }}', '{{ $p->id }}')" class="text-red-600 hover:text-red-900 transition-colors p-1.5 rounded-full hover:bg-red-50 dark:hover:bg-gray-700" title="Eliminar">
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
                        </table>
                    </div>

        
                </div>
            </div>

            <!-- Modal para crear/editar panel -->
            <div id="modal" class="fixed inset-0 z-50 flex pt-10 p-4 items-center justify-center bg-black bg-opacity-70 hidden backdrop-blur-sm transition-opacity duration-300">
                <div class="bg-white max-h-[80vh] mx-4 dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-4xl overflow-y-auto transform transition-all duration-300 scale-95 modal-content">
                    <!-- Encabezado con efecto gradiente -->
                    <div class="bg-gradient-to-r from-emerald-500 to-teal-600 px-6 py-4">
                        <div class="flex justify-between items-center">
                            <h2 class="text-2xl font-bold text-white" id="modalTitle">Nuevo Panel Solar</h2>
                            <button onclick="toggleModal()" type="button" class="text-white hover:text-gray-200 transition-colors duration-200 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="p-6">                   
                        <form action="{{ route('paneles.resultado') }}" method="POST" id="panelForm" class="space-y-6">
                            @csrf
                            @method('POST')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Columna Izquierda -->
                                <div class="space-y-4">
                                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 border-b border-gray-200 dark:border-gray-700 pb-2">Información Básica</h3>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre del Modelo <span class="text-red-500">*</span></label>
                                        <input type="text" id="panel_model" name="panel_model" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300" required/>
                                    </div>
                                    
                                    
                                  
                                    <!-- Fabricante -->
                                    <div>
                                        <label id="nomManudfacturer" for="fabricante_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fabricante</label>
                                        <div class="flex gap-3">
                                            <select name="fabricante_id" id="fabricante_id" class="flex-1 px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 appearance-none "required>
                                                <option value="">Seleccionar fabricante</option>
                                                @foreach ($fabricantes as $fabricante)
                                                    <option value="{{ $fabricante->id }}">{{ $fabricante->nombre }}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" id="openFabricanteModal" class="px-4 py-2.5 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-lg shadow-md hover:from-emerald-600 hover:to-teal-700 transition-all duration-300 flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                </svg>
                                                <span class="hidden sm:inline">Nuevo</span>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipo de Panel <span class="text-red-500">*</span></label>
                                        <select name="panel_type" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300">
                                            @foreach ($panelType as $pt)
                                                <option value="{{ $pt->panel_type }}">{{ $pt->panel_type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fecha de Fabricación <span class="text-red-500">*</span></label>
                                        <input type="date" id="date_manufacturer" name="date_manufacturer" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300" required />
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Garantía Producto (años)</label>
                                            <input type="number" name="panel_warranty" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Garantía Rendimiento (años)</label>
                                            <input type="number" name="performance_warranty" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300">
                                        </div>
                                    </div>
                                </div>

                                <!-- Columna Derecha -->
                                <div class="space-y-4">
                                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 border-b border-gray-200 dark:border-gray-700 pb-2">Especificaciones Técnicas</h3>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Potencia Nominal (Wp) <span class="text-red-500">*</span></label>
                                        <input id="potencia_maxima" name="potencia_maxima" type="number" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300" required />
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tensión Vmp (V)</label>
                                            <input id="tension_maxima_potencia" name="tension_maxima_potencia" type="number" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300" required />
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Corriente Imp (A)</label>
                                            <input id="corriente_punto_maxima_potencia" name="corriente_punto_maxima_potencia" type="number" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300" required />
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tensión Voc (V)</label>
                                            <input id="tension_circuito_abierto" name="tension_circuito_abierto" type="number" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300" required />
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Corriente Isc (A)</label>
                                            <input id="corriente_cortocircuito" name="corriente_cortocircuito" type="number" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300" required />
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Eficiencia (%) <span id="errorEficiencia" class="text-red-500">*</span></label>
                                        <input id="eficencia_panel" name="eficencia_panel" type="number" step="0.01" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300" required />
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Coef. Temp. Potencia (%/°C) <span class="text-red-500">*</span></label>
                                        <input id="coeficiente_temp_pmax" name="coeficiente_temp_pmax" type="number" step="0.01" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300" required />
                                    </div>
                                </div>
                            </div>

                            <!-- Sección de Dimensiones -->
                            <div class="mt-6">
                                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 border-b border-gray-200 dark:border-gray-700 pb-2">Dimensiones Físicas</h3>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Longitud (mm) <span class="text-red-500">*</span></label>
                                        <input type="number" id="longitud_v2" name="longitud_v2" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300" required />
                                        <p id="errorAltura" class="text-xs text-red-500 mt-1">Mínimo 1000 mm</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Anchura (mm) <span class="text-red-500">*</span></label>
                                        <input type="number" id="anchura" name="anchura" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300" required />
                                        <p id="errorAnchura" class="text-xs text-red-500 mt-1">Mínimo 500 mm</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Espesor (mm) <span class="text-red-500">*</span></label>
                                        <input type="number" id="espesor" name="espesor" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300" required />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Peso (kg) <span class="text-red-500">*</span></label>
                                        <input type="number" id="peso" name="peso" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300" required />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Material del Marco</label>
                                        <input type="text" name="material_marco" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Color del Panel</label>
                                        <input type="text" name="color_panel" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300">
                                    </div>
                                </div>
                            </div>

                            <!-- Sección de Información Adicional -->
                            <div class="mt-6">
                                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 border-b border-gray-200 dark:border-gray-700 pb-2">Información Adicional</h3>
                                <div class="grid grid-cols-1 gap-4 mt-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Descripción</label>
                                        <textarea name="descripcion" rows="2" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300"></textarea>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">URL del Fabricante</label>
                                        <input type="url" name="url_fabricante" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Imagen del Panel (URL)</label>
                                        <input type="url" name="imagen_panel" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300">
                                    </div>
                                </div>
                            </div>

                            <!-- Campos ocultos -->
                            <input type="hidden" id="superficie" name="superficie">

                            <!-- Botones de acción -->
                            <div class="flex justify-end mt-8 space-x-4">
                                <button type="button" onclick="toggleModal()" class="px-6 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-700 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-600 transition-all duration-300">
                                    Cancelar
                                </button>
                                <button id="submitButton" type="submit" class="px-6 py-2 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-lg shadow-lg hover:from-emerald-600 hover:to-teal-700 transition-all duration-300">
                                    Guardar Panel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal para crear fabricante -->
            <div id="fabricanteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-70 hidden backdrop-blur-sm transition-opacity duration-300">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all duration-300 scale-95 modal-content">
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

                    <form  id="crearFabricanteForm" class="p-6">
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

            <!-- Modal de Detalle -->
            <div id="detail" class="fixed pt-10 inset-0 z-50 flex items-center justify-center bg-black bg-opacity-70 hidden backdrop-blur-sm transition-opacity duration-300">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-2xl overflow-hidden transform transition-all duration-300 scale-95 modal-content">
                    <!-- Encabezado con efecto gradiente -->
                    <div class="bg-gradient-to-r from-emerald-500 to-teal-600 px-6 py-4">
                        <div class="flex justify-between items-center">
                            <h2 id="detailTitle" class="text-xl font-bold text-white"></h2>
                            <button onclick="toggleDetail()" type="button" class="text-white hover:text-gray-200 transition-colors duration-200 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Columna Izquierda -->
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-emerald-100 dark:bg-emerald-900 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600 dark:text-emerald-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Modelo</h3>
                                        <p id="detail_panel_model" class="text-lg font-semibold text-gray-900 dark:text-white"></p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 dark:text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Fabricante</h3>
                                        <p id="detail_manufacturer" class="text-lg font-semibold text-gray-900 dark:text-white"></p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-purple-100 dark:bg-purple-900 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600 dark:text-purple-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Tipo</h3>
                                        <p id="detail_panel_type" class="text-lg font-semibold text-gray-900 dark:text-white capitalize"></p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-amber-100 dark:bg-amber-900 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-600 dark:text-amber-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Fecha Fabricación</h3>
                                        <p id="detail_date_manufacturer" class="text-lg font-semibold text-gray-900 dark:text-white"></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Columna Derecha -->
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600 dark:text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Eficiencia (%)</h3>
                                        <p id="detail_eficencia_panel" class="text-lg font-semibold text-gray-900 dark:text-white"></p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-rose-100 dark:bg-rose-900 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-rose-600 dark:text-rose-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Coeficiente de Temperatura  (%/°C) </h3>
                                        <p id="detail_coeficiente_temp_pmax" class="text-lg font-semibold text-gray-900 dark:text-white"></p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Superficie (m)</h3>
                                        <p id="detail_superficie" class="text-lg font-semibold text-gray-900 dark:text-white"></p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-teal-100 dark:bg-teal-900 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-600 dark:text-teal-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Potencia Nominal (Wp)</h3>
                                        <p id="detail_potencia_maxima" class="text-lg font-semibold text-gray-900 dark:text-white"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Especificaciones técnicas -->
                        <div class="mt-6">
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Especificaciones Técnicas</h3>
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <div id="specsDetail" class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-900 dark:text-gray-200"></div>
                            </div>
                        </div>

                        <!-- Información adicional -->
                        <div class="mt-6">
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Información Adicional</h3>
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <div id="additionalInfoDetail" class="grid grid-cols-1 gap-2 text-gray-900 dark:text-gray-200"></div>
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

            <!-- Modal de confirmación eliminación -->
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
                                            Estás a punto de eliminar el panel: <strong id="panelName" class="font-semibold text-gray-900 dark:text-white"></strong>.
                                            Esta acción no puede deshacerse.
                                        </p>
                                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                            Para confirmar, escribe el nombre del panel en el campo de abajo:
                                        </p>
                                        <input type="text" id="confirmationInput" class="mt-3 w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" placeholder="Escribe el nombre del panel" oninput="validateDeletionInput()"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button onclick="confirmDeletion()" id="confirmDeleteButton" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed" disabled>
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
            <form id="deletePanelForm" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </div>
        <script>  
                  window.routeCrearFabricante = "{{ route('fabricantes.store') }}";
                  window.csrfToken = "{{ csrf_token() }}";
        </script>
        <script src="{{asset('build/js/panels/modalFabricante.js')}}"></script>
        <script src="{{asset('build/js/panels/newPanel.js')}}"></script>
        <script src="{{asset('build/js/panels/detailPanel.js')}}"></script>
        <script src="{{asset('build/js/panels/modalElimPanel.js')}}"></script>
    </x-app-layout>
</body>
</html>