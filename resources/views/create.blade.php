<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Proyecto') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-12">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h2 class="text-2xl font-bold mb-6">Crear Proyecto</h2>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('proyectos.store') }}" method="POST">
                @csrf <!-- Token CSRF necesario -->
                    <div class="mb-4">
                        <label for="nombre" class="block font-medium">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="w-full p-2 border rounded" required>
                    </div>

                    <div class="mb-4">
                        <label for="latitud" class="block font-medium">Latitud:</label>
                        <input type="text" name="latitud" id="latitud" class="w-full p-2 border rounded" required>
                    </div>

                    <div class="mb-4">
                        <label for="longitud" class="block font-medium">Longitud:</label>
                        <input type="text" name="longitud" id="longitud" class="w-full p-2 border rounded" required>
                    </div>

                    <div class="mb-4">
                        <label for="descripcion" class="block font-medium">Descripción:</label>
                        <textarea name="descripcion" id="descripcion" class="w-full p-2 border rounded"></textarea>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('proyectos.index') }}" class="mr-4 px-4 py-2 bg-gray-500 text-white rounded">Cancelar</a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
