<x-guest-layout>
    <form action="{{route('guardar.eco.resultado')}}" method="post">
        @csrf
        <h2 class="text-xl font-bold text-gray-700 mb-4 text-center underline underline-offset-8 decoration-green-200"> Información Económica </h2>

        <div class="mt-4">
            <x-input-label for="precio_modulo" :value="__('Precio del módulo')" />
            <x-text-input id="precio_modulo" class="block mt-1 w-full focus:ring-green-500" type="number" name="precio_modulo" required />
        </div>

        <div class="mt-4">
            <x-input-label for="descuento" :value="__('Descuento aplicable(%)')" />
            <x-text-input id="descuento" class="block mt-1 w-full focus:ring-green-500" type="number" name="descuento" required />
        </div>

        <div class="mt-4">
            <x-input-label for="precio_descuento" :value="__('Precio con descuento')" />
            <x-text-input id="precio_descuento" class="block mt-1 w-full focus:ring-green-500" type="number" name="precio_descuento" required />
        </div>

        <div class="mt-4">
            <x-input-label for="impuesto_aplicable" :value="__('Impuesto aplicable(%)')" />
            <select id="impuesto" name="descuento" class="block w-full p-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">Seleccione un impuesto</option>
                <option value="0">0% (Exento)</option>
                <option value="5">5% (GST) </option>
                <option value="10">10% (IVA Reducido) </option>
                <option value="16">16% (IVA General) </option>
                <option value="21">21% (IVA Estándard) </option>
            </select>
        </div>

        <div class="mt-4">
            <x-input-label for="precio_final" :value="__('Precio final')" />
            <x-text-input id="precio_final" class="block mt-1 w-full focus:ring-green-500" type="number" name="precio_final" required />
        </div>

        <div class="mt-4">
            <x-input-label for="moneda" :value="__('Moneda')" />
            <select id="moneda" name="moneda" class="block w-full p-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">Seleccione una moneda</option>
                <option value="USD">USD</option>
                <option value="EUR">EUR</option>
                <option value="MXN">MXN</option>
                <option value="COP">COP</option>
                <option value="ARS">ARS</option>
            </select>
        </div>

        <div class="mt-4">
            <x-input-label for="coste_envio" :value="__('Coste de envío')" />
            <x-text-input id="coste_envio" class="block mt-1 w-full focus:ring-green-500" type="number" name="coste_envio" required />
        </div>

        <div class="mt-4">
            <x-input-label for="coste_instalacion" :value="__('Coste de instalación')" />
            <x-text-input id="coste_instalacion" class="block mt-1 w-full focus:ring-green-500" type="number" name="coste_instalacion" required />
        </div>

        <div class="mt-4">
            <x-input-label for="periodo_amortizacion" :value="__('Periodo de amortización (años)')" />
            <x-text-input id="periodo_amortizacion" class="block mt-1 w-full focus:ring-green-500" type="number" name="periodo_amortizacion" required />
        </div>

        <div class="mt-4">
            <x-input-label for="rentabilidad_esperada" :value="__('Rentabilidad esperada (%)')" />
            <x-text-input id="rentabilidad_esperada" class="block mt-1 w-full focus:ring-green-500" type="number" name="rentabilidad_esperada" required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Guardar') }}
            </x-primary-button>

    </form>
</x-guest-layout>