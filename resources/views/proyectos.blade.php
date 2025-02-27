<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="build/css/styles.css">
        <script src="build/js/generalScript.js"></script>
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
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Estado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nombre Proyecto</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($proyectos as $proyecto)
                                <tr class="project-row" data-id="{{ $proyecto->id }}">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $proyecto->user?->name ?? 'Usuario no disponible' }}</td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <select name="estado_id" class="estado-select" data-id="{{ $proyecto->id }}">
                                            @foreach(App\Models\Estado::all() as $estado)
                                                <option value="{{ $estado->id }}" {{ $proyecto->estado_id == $estado->id ? 'selected' : '' }}>
                                                    {{ ucfirst($estado->nombre) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>

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
 
    <div id="overlay" class="overlay"></div>

    <div id="sidePanel" class="side-panel">
        <div class="side-panel-content">
            <!-- Contenedor para el mapa de Google -->
            <div id="map" style="width: 100%; height: 100%;"></div>
            <button class="close-btn" onclick="closeSidePanel()">X</button>
        </div>
    </div>

    <script>
document.addEventListener("DOMContentLoaded", function() {
    const projectRows = document.querySelectorAll('.project-row');
    const sidePanel = document.getElementById('sidePanel');
    const overlay = document.getElementById('overlay');
    const closeButton = document.querySelector('.close-btn');

    projectRows.forEach(row => {
    row.addEventListener('click', function(event) {
        // Evitar que el clic en el select dispare el evento
        if (event.target.closest('select.estado-select')) {
            return;
        }

        const projectId = row.getAttribute('data-id');

        fetch(`/proyectos/${projectId}/details`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la solicitud');
                }
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    sidePanel.querySelector('.side-panel-content').innerHTML = `<p>${data.error}</p>`;
                } else {
                    const projectDetailsContent = `
                        <h3>Detalles del Proyecto</h3>
                        <p>ID del Proyecto: ${data.proyecto.id}</p>
                        <p>Nombre del Proyecto: ${data.proyecto.nombre}</p>
                        <h4>Datos del Cliente</h4>
                        <p>Nombre: ${data.dadesClient?.nombre ?? 'No disponible'}</p>
                        <p>Email: ${data.dadesClient?.email ?? 'No disponible'}</p>
                        <p>Teléfono: ${data.dadesClient?.telefono ?? 'No disponible'}</p>
                        <p>Dirección: ${data.dadesClient?.direccion ?? 'No disponible'}</p>
                        <p>Ciudad: ${data.dadesClient?.ciudad ?? 'No disponible'}</p>
                        <p>Código Postal: ${data.dadesClient?.codigo_postal ?? 'No disponible'}</p>
                    `;

                    sidePanel.querySelector('.side-panel-content').innerHTML = projectDetailsContent;
                    sidePanel.classList.add('show');
                    overlay.style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                sidePanel.querySelector('.side-panel-content').innerHTML = `<p>Error al cargar los detalles del proyecto.</p>`;
                sidePanel.classList.add('show');
                overlay.style.display = 'block';
            });
    });
});

    closeButton.addEventListener('click', function() {
        sidePanel.classList.remove('show');
        overlay.style.display = 'none';
    });

    overlay.addEventListener('click', function() {
        sidePanel.classList.remove('show');
        overlay.style.display = 'none';
    });

    document.addEventListener('click', function(event) {
        if (!sidePanel.contains(event.target) && !event.target.closest('.project-row') && !event.target.closest('#overlay')) {
            sidePanel.classList.remove('show');
            overlay.style.display = 'none';
        }
    });

    sidePanel.addEventListener('click', function(event) {
        event.stopPropagation();
    });
});

    </script>    

</x-app-layout>
