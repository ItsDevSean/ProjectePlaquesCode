<x-guest-layout>
    <form action="{{route('guardar.informacionElectrica')}}" method="post">
        @csrf
        <h2 class="text-xl font-bold text-gray-700 mb-4 text-center underline underline-offset-8 decoration-green-200"> Información adicional </h2>

        <div class="mt-4">
            <x-input-label for="descripcion" :value="__('Descripción')" />
            <textarea id="descripcion" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Describe aquí la información detallada del panel"></textarea>
        </div>

        <div class="mt-4">
            <x-input-label for="url" :value="__('URL del fabricante')" />
            <x-text-input id="url" class="block mt-1 w-full focus:ring-green-500" type="text" name="tipo" required />
        </div>

        <div class="mt-4">
            <x-input-label for="imagen" :value="__('Imagen del panel')" />
            <input type="file" name="imagen" id="imagen" class="block mt-1 w-full focus:ring-green-500" required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Guardar') }}
            </x-primary-button>

    </form>
</x-guest-layout>