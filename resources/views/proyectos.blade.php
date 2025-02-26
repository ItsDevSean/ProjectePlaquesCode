<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="build/css/styles.css">
        <script src="public\build\js\marcadors.js"></script>
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
                    
                    <a href="{{ route('proyectos.create') }}" class="button button-primary mb-4 inline-block text-emerald-600 hover:text-emerald-900 mr-3">Crear Proyecto</a>

                    <table class="tabla min-w-full divide-y">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Usuario</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nombre Proyecto</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($proyectos as $proyecto)
                                <tr class="project-row" data-id="{{ $proyecto->id }}">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $proyecto->user?->name ?? 'Usuario no disponible' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $proyecto->nombre }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('proyectos.edit', $proyecto->id) }}" class="text-green-600 hover:text-green-900 mr-3">Editar</a>
                                        <form action="{{ route('proyectos.destroy', $proyecto->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="mt-6">
                        {{ $proyectos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="sidePanel" class="side-panel">
        <div class="side-panel-content">
            <!-- Contenedor para el mapa de Google -->
            <div id="map" style="width: 100%; height: 100%;"></div>
            <button class="close-btn" onclick="closeSidePanel()">X</button>
        </div>
    </div>

    </div>
    <script>

document.addEventListener("DOMContentLoaded", function() {
    const projectRows = document.querySelectorAll('.project-row');
    const sidePanel = document.getElementById('sidePanel');
    const closeButton = document.querySelector('.close-btn');

    // Manejador de clic para cada proyecto
    projectRows.forEach(row => {
        row.addEventListener('click', function() {
            const projectId = row.getAttribute('data-id');

            // Aquí deberías cargar los detalles del proyecto de forma dinámica
            // por ejemplo, utilizando Ajax o mediante el uso de rutas en Laravel.

            // Mostrar los detalles (esto es solo un ejemplo simple)
            const projectDetailsContent = `
                <h3>Detalles del Proyecto</h3>
                <p>ID del Proyecto: ${projectId}</p>
                <p>Más información aquí...</p>
    
            `;

            // Mostrar los detalles en el sidePanel
            sidePanel.querySelector('.side-panel-content').innerHTML = projectDetailsContent + `
                <div id="map" style="width: 100%; height: 100%;"></div>
            `;

            // Abrir el panel
            sidePanel.classList.add('show');
        });
    });

    // Cerrar el panel cuando se haga clic en el botón de cerrar
    closeButton.addEventListener('click', function() {
        sidePanel.classList.remove('show');
    });

    // Cerrar el panel cuando se haga clic fuera del panel
    document.addEventListener('click', function(event) {
        // Si el clic es fuera del panel y no es el botón de cerrar ni el panel mismo
        if (!sidePanel.contains(event.target) && !event.target.closest('.project-row')) {
            sidePanel.classList.remove('show');
        }
    });

    // Evitar que el clic en el panel lo cierre
    sidePanel.addEventListener('click', function(event) {
        event.stopPropagation(); // Esto evita que el panel cierre cuando se hace clic dentro de él
    });
});


    </script>    
</x-app-layout>
