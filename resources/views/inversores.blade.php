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
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Listado de Inversores') }}
            </h2>
        </x-slot>

        <!-- Botón para abrir el modal -->
        <div class="flex justify-end mb-4">
            <button id="openModal" class="px-4 py-2 bg-[#49DBA3] text-white rounded-lg shadow-lg hover:bg-[#36B89A] transition-all duration-300">
                <i class="fas fa-plus"></i> Crear Inversor
            </button>
        </div>
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
                                    <form action="{{ route('inversores.destroy', $inversor->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
                                    </form>
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
                    <h2 class="text-xl font-semibold">Crear Nuevo Inversor</h2>
                    <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form action="{{ route('inversores.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="nombre_inversor" class="block text-sm font-medium text-gray-700">Nombre del Inversor</label>
                            <input type="text" name="nombre_inversor" id="nombre_inversor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>

                        <div>
                            <label for="eficiencia" class="block text-sm font-medium text-gray-700">Eficiencia</label>
                            <input type="text" name="eficiencia" id="eficiencia" placeholder="Eficiencia del inversor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>

                        <div>
                        <select class="mt-1 block w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" id="tipo_instalacion" name="tipo_instalacion" required>
                                <option value="monofasica" {{ (old('tipo_instalacion', $proyecto->tipo_instalacion ?? '') == 'monofasica') ? 'selected' : '' }}>Monofàsica</option>
                                <option value="trifasica" {{ (old('tipo_instalacion', $proyecto->tipo_instalacion ?? '') == 'trifasica') ? 'selected' : '' }}>Trifàsica</option>
                            </select>
                        </div>

                        <div>
                            <label for="garantia_material" class="block text-sm font-medium text-gray-700">Garantía del Material (Años)</label>
                            <input type="number" name="garantia_material" id="garantia_material" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
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
                            <div>
                            <label for="fabricante" class="block text-sm font-medium text-gray-700">Fabricante</label>
                            <div class="flex items-center gap-2">
                            <select name="fabricante_id" id="fabricante" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">Seleccionar</option>
                                @foreach ($fabricantes as $fabricante)
                                    <option value="{{ $fabricante->id }}">{{ $fabricante->nombre }}</option>
                                @endforeach
                            </select>
                                <button type="button" id="openFabricanteModal" class="px-4 py-2 bg-[#49DBA3] text-white rounded-lg shadow-lg hover:bg-[#36B89A] transition-all duration-300">
                                    <i class="fas fa-plus"></i> Nuevo Fabricante
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
                            <input type="text" name="id_referencia" id="id_referencia" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label for="imagen_inversor" class="block text-sm font-medium text-gray-700">Imagen del Inversor</label>
                            <input type="text" name="imagen_inversor" id="imagen_inversor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <img id="preview" class="mt-2 hidden w-32 h-32 object-cover">
                        </div>
                    </div>
                    <div class="flex justify-end mt-6">
                <!-- Botón Cancelar -->
                        <button type="button" id="closeModal" class="mr-2 px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                            Cancelar
                        </button>
                        <!-- Botón Crear -->
                        <button type="submit" class="px-4 py-2 bg-[#49DBA3] text-white rounded-lg hover:bg-[#36B89A]">
                            Crear Inversor
                        </button>
                    </div>
                </div>
                </form>
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


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const fabricanteModal = document.getElementById("fabricanteModal");
            const openFabricanteModalBtn = document.getElementById("openFabricanteModal");
            const closeFabricanteModalBtn = document.getElementById("closeFabricanteModal");
            const closeFabricanteModalByButton = document.getElementById("closeFabricanteModalBtn");
            const crearFabricanteForm = document.getElementById("crearFabricanteForm");
            const fabricanteSelect = document.getElementById("fabricante");

            // Inyecta la URL de la ruta correctamente usando Blade
            const routeCrearFabricante = @json(route('fabricantes.store'));
            const csrfToken = "{{ csrf_token() }}";  // Esto se pasa correctamente a través de Blade

            // Abrir modal de fabricante
            openFabricanteModalBtn.addEventListener("click", () => fabricanteModal.classList.remove("hidden"));

            // Cerrar modal de fabricante
            closeFabricanteModalBtn.addEventListener("click", () => fabricanteModal.classList.add("hidden"));
            closeFabricanteModalByButton.addEventListener("click", () => fabricanteModal.classList.add("hidden"));

            // Enviar formulario de fabricante con AJAX
            crearFabricanteForm.addEventListener("submit", function(event) {
                event.preventDefault(); // Evitar el envío tradicional del formulario

                fetch(routeCrearFabricante, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken  // Usamos el csrfToken correctamente aquí
                    },
                    body: JSON.stringify({
                        nombre: document.getElementById("nombre_fabricante").value
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Cerrar el modal
                        fabricanteModal.classList.add("hidden");

                        // Limpiar el campo del formulario
                        document.getElementById("nombre_fabricante").value = "";

                        // Actualizar el select de fabricantes
                        const newOption = document.createElement("option");
                        newOption.value = data.fabricante.id;
                        newOption.text = data.fabricante.nombre;
                        fabricanteSelect.appendChild(newOption);

                        // Seleccionar el nuevo fabricante
                        fabricanteSelect.value = data.fabricante.id;
                    } else {
                        alert("Error al crear el fabricante.");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                });
            });
        });
    </script>

        <script src="build/js/modalInversores.js"></script>
    </x-app-layout>
</body>
</html>