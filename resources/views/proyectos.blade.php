<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
        <link rel="stylesheet" href="build/css/proyectosStyle.css">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            {{ __('Listado de Proyectos') }}
        </h2>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header con estadísticas y buscador -->
            <div class="mb-8 grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-md p-6 text-white">
                    <h3 class="text-sm font-medium mb-1">Total Proyectos</h3>
                    <p id="total-counter" class="text-3xl font-bold">{{ $clientes->total() }}</p>
                </div>
                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl shadow-md p-6 text-white">
                    <h3 class="text-sm font-medium mb-1">Activos</h3>
                    <p id="active-counter" class="text-3xl font-bold">{{ $clientes->where('estado_id', 1)->count() }}</p>
                </div>
                <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-xl shadow-md p-6 text-white">
                    <h3 class="text-sm font-medium mb-1">En Progreso</h3>
                    <p id="progress-counter" class="text-3xl font-bold">{{ $clientes->where('estado_id', 2)->count() }}</p>
                </div>
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl shadow-md p-6 text-white">
                    <h3 class="text-sm font-medium mb-1">Completados</h3>
                    <p id="completed-counter" class="text-3xl font-bold">{{ $clientes->where('estado_id', 3)->count() }}</p>
                </div>
            </div>

            <!-- Barra de acciones -->
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                <div class="relative w-full sm:w-64">
                    <input type="text" placeholder="Buscar proyectos..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-2.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <div class="flex gap-3 w-full sm:w-auto">
                    <!-- Reemplaza el botón de filtros actual con este código -->
                    <div class="relative">
                        <button id="filterButton" class="flex items-center gap-2 px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 rounded-lg transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filtros
                            @if(request('estado'))
                                <span class="ml-1 inline-flex items-center justify-center h-5 w-5 rounded-full bg-blue-500 text-white text-xs">
                                    1
                                </span>
                            @endif
                        </button>
                        
                        <!-- Menú desplegable de filtros -->
                        <div id="filterDropdown" class="hidden absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-md shadow-lg z-10 border border-gray-200 dark:border-gray-700">
                            <div class="p-4">
                                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Filtrar por estado</h4>
                                <div class="space-y-2">
                                    @foreach(App\Models\Estado::all() as $estado)
                                    <label class="flex items-center space-x-3">
                                        <input type="checkbox" name="estado[]" value="{{ $estado->id }}" 
                                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700"
                                            @if(in_array($estado->id, (array)request('estado', []))) checked @endif>
                                        <span class="text-sm text-gray-700 dark:text-gray-300">{{ $estado->nombre }}</span>
                                    </label>
                                    @endforeach
                                </div>
                                <div class="mt-4 flex justify-between">
                                    <button id="applyFilters" class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-md transition-colors">
                                        Aplicar
                                    </button>
                                    @if(request('estado'))
                                    <a href="{{ route('dades_clients.index') }}" class="px-3 py-1.5 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 text-sm rounded-md transition-colors">
                                        Limpiar
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla de proyectos -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl">
                <div class="p-6">
                    @if (session('status'))
                        <div class="p-4 mb-6 text-sm text-green-800 bg-green-50 rounded-lg animate__animated animate__fadeIn">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                {{ session('status') }}
                            </div>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Usuario</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Estado</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Cliente</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Proyecto</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Estacionalidad</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Creado</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @if ($clientes->isEmpty())
                                    <tr>
                                        <td colspan="7" class="px-6 py-8 text-center">
                                            <div class="flex flex-col items-center justify-center text-gray-400 dark:text-gray-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <p class="text-lg font-medium">No hay proyectos disponibles</p>
                                                <p class="text-sm mt-1">Crea tu primer proyecto para comenzar</p>
                                                <a href="{{ asset('dades') }}" class="mt-4 px-4 py-2 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-lg hover:from-emerald-600 hover:to-teal-700 transition-colors inline-block">
                                                    Crear Proyecto
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($clientes as $proyecto)
                                        <tr class="project-row hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150" data-id="{{ $proyecto->id }}" onclick="showProjectDetails({{ $proyecto->id }})">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    @if($proyecto->user?->profile_photo_path)
                                                        <img src="{{ asset($proyecto->user->profile_photo_path) }}" 
                                                            alt="{{ $proyecto->user->name }}" 
                                                            class="h-10 w-10 rounded-full object-cover border-2 border-emerald-400">
                                                    @else
                                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-emerald-100 flex items-center justify-center">
                                                            <span class="text-teal-600 font-medium">{{ substr($proyecto->user?->name ?? 'U', 0, 1) }}</span>
                                                        </div>
                                                    @endif
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $proyecto->user?->name ?? 'Usuario no disponible' }}</div>
                                                        <div class="text-sm text-gray-500">{{ $proyecto->user?->email ?? '' }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $estadoActual = App\Models\Estado::find($proyecto->estado_id);
                                                $colorClasses = [
                                                    'pendiente' => 'text-yellow-800',
                                                    'en progreso' => 'text-blue-800',
                                                    'completado' => 'text-green-800',
                                                    'cancelado' => 'text-red-800',
                                                ];
                                                $currentColor = $colorClasses[strtolower($estadoActual->nombre)] ?? 'bg-white-100 text-gray-800';
                                            @endphp
                                            
                                            <div class="relative inline-block">
                                                <!-- Flecha a la izquierda -->
                                                <select name="estado_id"  class="estado-select py-1 text-[13px] font-semibold {{ $currentColor }} bg-transparent cursor-pointer transition-colors border-0 outline-none focus:outline-none focus:ring-0 focus:border-transparent appearance-none" data-id="{{ $proyecto->id }}" onclick="event.stopPropagation();"data-current-color="{{ strtolower($estadoActual->nombre) }}">
                                                    @foreach(App\Models\Estado::all() as $estado)
                                                        @php
                                                            $optionColor = $colorClasses[strtolower($estado->nombre)] ?? 'bg-gray-100 text-gray-800';
                                                        @endphp
                                                        <option value="{{ $estado->id }}" 
                                                                data-color="{{ strtolower($estado->nombre) }}"
                                                                class="{{ $optionColor }}"
                                                                {{ $proyecto->estado_id == $estado->id ? 'selected' : '' }}>
                                                            {{ ucfirst($estado->nombre) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $proyecto->nombre }}</div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ $proyecto->nombre_proyecto }}</div>
                                                <div class="text-sm text-gray-500 truncate max-w-xs">{{ Str::limit($proyecto->descripcion_proyecto ?? 'Sin descripción', 50) }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-4 py-1 text-s rounded-full {{ $proyecto->estacionalidad === 'Alta' ? 'bg-green-100 text-green-800' : ($proyecto->estacionalidad === 'Media' ? 'bg-yellow-100 text-yellow-800' : 'bg-emerald-100 text-teal-600') }}">
                                                    {{ $proyecto->estacionalidad }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 dark:text-white">{{ $proyecto->created_at->format('d/m/Y') }}</div>
                                                <div class="text-xs text-gray-500">{{ $proyecto->created_at->diffForHumans() }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex items-center justify-end space-x-3">
                                                <a href="{{ route('proyecto.edit.dadesclient', $proyecto->id) }}"  
                                                onclick="event.stopPropagation();" 
                                                class="text-emerald-600 hover:text-teal-700 transition-colors" 
                                                title="Editar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                                    <button onclick="event.stopPropagation(); openModal('{{ $proyecto->nombre_proyecto }}', '{{ $proyecto->id }}')" class="text-red-600 hover:text-red-900 transition-colors" title="Eliminar">
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

                    <!-- Paginación -->
                    @if($clientes->hasPages())
                        <div class="mt-6 px-4 py-3 flex items-center justify-between border-t border-gray-200 dark:border-gray-700 sm:px-6">
                            <div class="flex-1 flex justify-between sm:hidden">
                                @if($clientes->onFirstPage())
                                    <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-300 bg-white dark:bg-gray-800 cursor-not-allowed">
                                        Anterior
                                    </span>
                                @else
                                    <a href="{{ $clientes->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                                        Anterior
                                    </a>
                                @endif

                                @if($clientes->hasMorePages())
                                    <a href="{{ $clientes->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                                        Siguiente
                                    </a>
                                @else
                                    <span class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-300 bg-white dark:bg-gray-800 cursor-not-allowed">
                                        Siguiente
                                    </span>
                                @endif
                            </div>
                            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-sm text-gray-700 dark:text-gray-300">
                                        Mostrando
                                        <span class="font-medium">{{ $clientes->firstItem() }}</span>
                                        a
                                        <span class="font-medium">{{ $clientes->lastItem() }}</span>
                                        de
                                        <span class="font-medium">{{ $clientes->total() }}</span>
                                        resultados
                                    </p>
                                </div>
                                <div>
                                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                        <!-- Previous Page Link -->
                                        @if($clientes->onFirstPage())
                                            <span class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white dark:bg-gray-800 text-sm font-medium text-gray-300 cursor-not-allowed">
                                                <span class="sr-only">Anterior</span>
                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        @else
                                            <a href="{{ $clientes->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 hover:bg-gray-50 dark:hover:bg-gray-700">
                                                <span class="sr-only">Anterior</span>
                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        @endif

                                        <!-- Pagination Elements -->
                                        @foreach($clientes->getUrlRange(1, $clientes->lastPage()) as $page => $url)
                                            @if($page == $clientes->currentPage())
                                                <span aria-current="page" class="z-10 bg-blue-50 border-blue-500 text-blue-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                                    {{ $page }}
                                                </span>
                                            @else
                                                <a href="{{ $url }}" class="bg-white dark:bg-gray-800 border-gray-300 text-gray-500 hover:bg-gray-50 dark:hover:bg-gray-700 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                                    {{ $page }}
                                                </a>
                                            @endif
                                        @endforeach

                                        <!-- Next Page Link -->
                                        @if($clientes->hasMorePages())
                                            <a href="{{ $clientes->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 hover:bg-gray-50 dark:hover:bg-gray-700">
                                                <span class="sr-only">Siguiente</span>
                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        @else
                                            <span class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white dark:bg-gray-800 text-sm font-medium text-gray-300 cursor-not-allowed">
                                                <span class="sr-only">Siguiente</span>
                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        @endif
                                    </nav>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Panel lateral de detalles -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden transition-opacity duration-300"></div>
    
    <div id="sidePanel" class="fixed top-0 right-0 w-full sm:w-96 h-full bg-white dark:bg-gray-800 shadow-xl z-50 transform translate-x-full transition-transform duration-300 ease-in-out overflow-y-auto">

    <div id="sidePanelLoading" class="text-center py-8 text-gray-600 dark:text-gray-300 hidden">Cargando detalles...</div>

    <div id="sidePanelContent" class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Detalles del Proyecto</h3>
            <button onclick="closeSidePanel()" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="space-y-6">
            <div>
                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Información básica</h4>
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">ID</p>
                            <p id="projectId" class="text-sm font-medium text-gray-900 dark:text-white">-</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Estado</p>
                            <p id="projectStatus" class="text-sm font-medium text-gray-900 dark:text-white">-</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Creado</p>
                            <p id="projectCreated" class="text-sm font-medium text-gray-900 dark:text-white">-</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Actualizado</p>
                            <p id="projectUpdated" class="text-sm font-medium text-gray-900 dark:text-white">-</p>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Proyecto</h4>
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 space-y-3">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nombre</p>
                        <p id="projectName" class="text-base font-medium text-gray-900 dark:text-white">-</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Descripción</p>
                        <p id="descriptionProject" class="text-sm text-gray-900 dark:text-white">-</p>
                    </div>
                </div>
            </div>

            <div>
                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Cliente</h4>
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 space-y-3">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nombre</p>
                        <p id="clientName" class="text-base font-medium text-gray-900 dark:text-white">-</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Dirección</p>
                            <p id="clientAddress" class="text-sm text-gray-900 dark:text-white">-</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Ciudad</p>
                            <p id="clientCity" class="text-sm text-gray-900 dark:text-white">-</p>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Contacto</p>
                        <p id="clientContact" class="text-sm text-gray-900 dark:text-white">-</p>
                    </div>
                </div>
            </div>

            <div>
                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Responsable</h4>
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <div class="flex items-center space-x-3">
                        
                        <div id="userPhotoContainer" class="flex-shrink-0 h-10 w-10 rounded-full border-2 border-emerald-400 flex items-center justify-center overflow-hidden">
                        </div>
                        <div>
                            <p id="userName" class="text-sm font-medium text-gray-900 dark:text-white">-</p>
                            <p id="userEmail" class="text-sm text-gray-500 dark:text-gray-400">-</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                <div class="flex justify-between space-x-3">
                    <a id="editProjectLink" href="#" class="flex-1 flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white dark:bg-gray-700 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Editar
                    </a>
                    <button id="deleteProjectButton" class="flex-1 flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Modal de confirmación -->
    <div id="modal" class="fixed inset-0 z-50 hidden overflow-y-auto">
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
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white" id="modal-title">
                                Confirmar eliminación
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Estás a punto de eliminar el proyecto: <strong id="projectoName" class="font-semibold text-gray-900 dark:text-white"></strong>.
                                    Esta acción no puede deshacerse.
                                </p>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                    Para confirmar, escribe el nombre del proyecto en el campo de abajo:
                                </p>
                                <input type="text" id="confirmationInput" class="mt-3 w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" placeholder="Escribe el nombre del proyecto"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button onclick="confirmDeletion()" id="confirmDeleteButton" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed"disabled>
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
    <form id="deleteProjectForm" action="" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form> 
    
    <script src="build/js/estado.js"></script>
    <script src="build/js/proyectos.js"></script>
    
</x-app-layout>