<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="build/css/styles.css">
        <link rel="stylesheet" href="build/css/proyectosStyle.css">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listado de Proyectos') }}
        </h2>
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('status'))
                        <div class="p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg">
                            {{ session('status') }}
                        </div>
                    @endif
                

                    <table class="tabla min-w-full divide-y">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Usuario</th>
                                <th class="px-9 py-3 text-left text-xs font-medium uppercase tracking-wider">Estado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">N.Cliente</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nombre Proyecto</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Tarifa</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Creado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($clientes as $proyecto)
                                <tr class="project-row" data-id="{{ $proyecto->id }}">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $proyecto->user?->name ?? 'Usuario no disponible' }}</td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap">
                                    <select name="estado_id" class="estado-select focus:outline-none focus:ring-0 text-sm font-semibold appearance-none bg-transparent cursor-pointer border-none transition-colors duration-300 ease-in-out" data-id="{{ $proyecto->id }}">
                                        @foreach(App\Models\Estado::all() as $estado)
                                            <option 
                                                value="{{ $estado->id }}" 
                                                data-color="{{ $estado->nombre }}" 
                                                {{ $proyecto->estado_id == $estado->id ? 'selected' : '' }}>
                                                {{ ucfirst($estado->nombre) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                    
                                    
                                    
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $proyecto->nombre }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $proyecto->nombre_proyecto }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $proyecto->tarifa }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $proyecto->created_at->format('d/m/Y') }}</div> 
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
    
                                    <form action="{{ route('dades_clients.update', $proyecto->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-green-600 hover:text-green-900 mr-3 no-underline">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </form>
                                    
                                 
                                    <form action="{{ route('dades_clients.destroy', $proyecto->id) }}" method="POST" class="inline-block mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash-alt"></i> 
                                        </button>
                                    </form>
                                </td>



                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                
                    <div class="mt-6">
                        {{ $clientes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Overlay y Side Panel -->
    <div id="overlay" class="overlay"></div>
    <div id="sidePanel" class="side-panel">
        <div class="side-panel-content">
            <div id="map" style="width: 100%; height: 100%;"></div>
            <button class="close-btn" onclick="closeSidePanel()">X</button>
        </div>
    </div>

<script src="build/js/sidePanel.js"></script>
<script src="build/js/estado.js"></script>
    
</x-app-layout>