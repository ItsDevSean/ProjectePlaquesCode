<x-guest-layout>

    <form action="{{ route('guardar.informacionElectrica') }}" method="post">
        @csrf
        
        <h2 class="text-xl font-bold text-gray-700 mb-4 text-center underline underline-offset-8 decoration-green-200">Datos del Panel Solar</h2>

        <div>
            <x-input-label for="potencia_maxima" :value="__('Potencia Máxima (Pmax)')" />
            <x-text-input id="potencia_maxima" class="block mt-1 w-full focus:ring-green-500 dark:focus:ring-green-600 dark:focus:ring-offset-green-800" type="text" name="potencia_maxima" required />
        </div>

        <div class="mt-4">
            <x-input-label for="tension_maxima_potencia" :value="__('Tensión en Punto de Máxima Potencia (Vmp)')" />
            <x-text-input id="tension_maxima_potencia" class="block mt-1 w-full focus:ring-green-500 dark:focus:ring-green-600 dark:focus:ring-offset-green-800" type="text" name="tension_maxima_potencia" required />
        </div>

        <div class="mt-4">
            <x-input-label for="corriente_punto_maxima_potencia" :value="__('Corriente en Punto de Máxima Potencia (Imp)')" />
            <x-text-input id="corriente_punto_maxima_potencia" class="block mt-1 w-full focus:ring-green-500 dark:focus:ring-green-600 dark:focus:ring-offset-green-800" type="text" name="corriente_punto_maxima_potencia" required />
        </div>

        <div class="mt-4">
            <x-input-label for="tension_circuito_abierto" :value="__('Tensión de Circuito Abierto (Voc)')" />
            <x-text-input id="tension_circuito_abierto" class="block mt-1 w-full focus:ring-green-500 dark:focus:ring-green-600 dark:focus:ring-offset-green-800" type="text" name="tension_circuito_abierto" required />
        </div>

        <div class="mt-4">
            <x-input-label for="corriente_cortocircuito" :value="__('Corriente de Cortocircuito (Isc)')" />
            <x-text-input id="corriente_cortocircuito" class="block mt-1 w-full focus:ring-green-500 dark:focus:ring-green-600 dark:focus:ring-offset-green-800" type="text" name="corriente_cortocircuito" required />
        </div>

        <div class="mt-4">
            <x-input-label for="eficencia_panel" :value="__('Eficiencia del Panel (%)')" />
            <x-text-input id="eficencia_panel" class="block mt-1 w-full focus:ring-green-500 dark:focus:ring-green-600 dark:focus:ring-offset-green-800" type="text" name="eficencia_panel" required />
        </div>

        <div class="mt-4">
            <x-input-label for="coeficiente_temp_pmax" :value="__('Coeficiente de Temperatura de Pmax (%/°C)')" />
            <x-text-input id="coeficiente_temp_pmax" class="block mt-1 w-full focus:ring-green-500 dark:focus:ring-green-600 dark:focus:ring-offset-green-800" type="text" name="coeficiente_temp_pmax" required />
        </div>

        <div class="mt-4">
            <x-input-label for="coeficiente_temp_voc" :value="__('Coeficiente de Temperatura de Voc (%/°C)')" />
            <x-text-input id="coeficiente_temp_voc" class="block mt-1 w-full focus:ring-green-500 dark:focus:ring-green-600 dark:focus:ring-offset-green-800" type="text" name="coeficiente_temp_voc" required />
        </div>

        <div class="mt-4">
            <x-input-label for="coeficiente_temp_isc" :value="__('Coeficiente de Temperatura de Isc (%/°C)')" />
            <x-text-input id="coeficiente_temp_isc" class="block mt-1 w-full focus:ring-green-500 dark:focus:ring-green-600 dark:focus:ring-offset-green-800" type="text" name="coeficiente_temp_isc" required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Guardar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
