<x-guest-layout>
    <form action="{{ route('guardar.informacionFisica') }}" method="post">
        @csrf

        <h2 class="text-xl font-bold text-gray-700 mb-4 text-center underline underline-offset-8 decoration-green-200">
            Información Básica del Panel
        </h2>

        <div class="mt-4">
            <x-input-label for="modelo" :value="__('Nombre del modelo')" />
            <x-text-input id="modelo" class="block mt-1 w-full focus:ring-green-500" type="text" name="modelo" required />
        </div>

        <div class="mt-4">
            <x-input-label for="marca" :value="__('Fabricante (marca)')" />
            <x-text-input id="marca" class="block mt-1 w-full focus:ring-green-500" type="text" name="marca"  />
        </div>

        <div class="mt-4">
            <x-input-label for="tipo" :value="__('Tipo de panel')" />
            <x-text-input id="tipo" class="block mt-1 w-full focus:ring-green-500" type="text" name="tipo" required />
        </div>

        <div class="mt-4">
            <x-input-label for="fecha" :value="__('Fecha de fabricación')" />
            <x-text-input id="fecha" class="block mt-1 w-full focus:ring-green-500" type="date" name="fecha" required />
        </div>

        <div class="mt-4">
            <x-input-label for="gproducto" :value="__('Garantía del producto(años)')" />
            <x-text-input id="gproducto" class="block mt-1 w-full focus:ring-green-500" type="number" name="gproducto" required />
        </div>

        <div class="mt-4">
            <x-input-label for="grendimiento" :value="__('Garantía de rendimiento(años)')" />
            <x-text-input id="grendimiento" class="block mt-1 w-full focus:ring-green-500" type="number" name="grendimiento" required />
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Guardar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
