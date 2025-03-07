<x-guest-layout>
    <form action="{{ route('guardar.informacionFisica') }}" method="post">
        @csrf

        <h2 class="text-xl font-bold text-gray-700 mb-4 text-center underline underline-offset-8 decoration-green-200">
            Datos Físicos del Panel
        </h2>

        <div>
            <x-input-label for="longitud" :value="__('Longitud (mm)')" />
            <x-text-input id="longitud" class="block mt-1 w-full focus:ring-green-500" type="number" name="longitud" required />
        </div>

        <div class="mt-4">
            <x-input-label for="anchura" :value="__('Anchura (mm)')" />
            <x-text-input id="anchura" class="block mt-1 w-full focus:ring-green-500" type="number" name="anchura" required />
        </div>

        <div class="mt-4">
            <x-input-label for="espesor" :value="__('Espesor (mm)')" />
            <x-text-input id="espesor" class="block mt-1 w-full focus:ring-green-500" type="number" name="espesor" required />
        </div>

        <div class="mt-4">
            <x-input-label for="peso" :value="__('Peso (kg)')" />
            <x-text-input id="peso" class="block mt-1 w-full focus:ring-green-500" type="number" name="peso" required />
        </div>

        <div class="mt-4">
            <x-input-label for="superficie" :value="__('Superficie (m²)')" />
            <x-text-input id="superficie" class="block mt-1 w-full focus:ring-green-500" type="number" name="superficie" required />
        </div>

        <div class="mt-4">
            <x-input-label for="descripcion" :value="__('Descripción')" />
            <x-text-input id="descripcion" class="block mt-1 w-full focus:ring-green-500" type="text" name="descripcion" required />
        </div>

        <div class="mt-4">
            <x-input-label for="url_fabricante" :value="__('URL del Fabricante')" />
            <x-text-input id="url_fabricante" class="block mt-1 w-full focus:ring-green-500" type="text" name="url_fabricante" required />
        </div>

        <div class="mt-4">
            <x-input-label for="imagen_panel" :value="__('Imagen del Panel')" />
            <x-text-input id="imagen_panel" class="block mt-1 w-full focus:ring-green-500" type="text" name="imagen_panel" required />
        </div>

        <div class="mt-4">
            <x-input-label for="material_marco" :value="__('Material del Marco')" />
            <x-text-input id="material_marco" class="block mt-1 w-full focus:ring-green-500" type="text" name="material_marco" required />
        </div>

        <div class="mt-4">
            <x-input-label for="color_panel" :value="__('Color del Panel (Opcional)')" />
            <x-text-input id="color_panel" class="block mt-1 w-full focus:ring-green-500" type="text" name="color_panel" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Guardar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
