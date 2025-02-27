<x-guest-layout>

    <form action="{{ route('guardar.informacionElectrica') }}" method="post">
        @csrf
        
        <h2 class="text-xl font-bold text-gray-700 mb-4 text-center underline underline-offset-8 decoration-green-200">Condiciones de Operación</h2>

        <div>
            <x-input-label for="temp_max" :value="__('Temperatura de operación máxima (ºC)')" />
            <x-text-input id="temp_max" class="block mt-1 w-full focus:ring-green-500 dark:focus:ring-green-600 dark:focus:ring-offset-green-800" type="number" name="temp_max" required />
        </div>

        <div class="mt-4">
            <x-input-label for="temp_mini" :value="__('Temperatura de operación mínima (ºC)')" />
            <x-text-input id="temp_mini" class="block mt-1 w-full focus:ring-green-500 dark:focus:ring-green-600 dark:focus:ring-offset-green-800" type="number" name="temp_mini" required />
        </div>

        <div class="mt-4">
            <x-input-label for="tol_potencia" :value="__('Tolerancia de potencia (%)')" />
            <x-text-input id="tol_potencia" class="block mt-1 w-full focus:ring-green-500 dark:focus:ring-green-600 dark:focus:ring-offset-green-800" type="number" name="tol_potencia" required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Guardar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
