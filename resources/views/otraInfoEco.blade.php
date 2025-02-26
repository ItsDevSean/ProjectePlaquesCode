<x-guest-layout>
    <form action="{{route('guardar.informacionElectrica')}}" method="post">
        @csrf
        <h2 class="text-xl font-bold text-gray-700 mb-4 text-center underline underline-offset-8 decoration-green-200"> Otra información económica</h2>

        <div class="mt-4">
            <x-input-label :value="__('Financiación disponible')" />
            <div class="flex items-center space-x-4 mt-2">
                <label class="flex items-center mr-4">
                    <input type="radio" name="financiacion_disp" value="si" class="mr-2 focus:ring-green-500">
                    Sí
                </label>
                <label class="flex items-center mr-4">
                    <input type="radio" name="financiacion_disp" value="no" class="mr-2 focus:ring-green-500">
                    No
                </label>
            </div>
        </div>

        <div class="mt-4">
            <x-input-label for="condiciones_financiacion" :value="__('Condiciones de financiación')" />
            <textarea id="condiciones_financiacion" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Escribe aquí las condiciones de financiación"></textarea>
        </div>

        <div class="mt-4">
            <x-input-label for="sub_ayudas" :value="__('Subvenciones o ayudas')" />
            <textarea id="sub_ayudas" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Escribe aquí si dispones de subvenciones o ayudas"></textarea>
        </div>

        <div class="mt-4">
            <x-input-label for="proveedor" :value="__('Proveedor')" />
            <x-text-input id="proveedor" class="block mt-1 w-full focus:ring-green-500" type="text" name="tipo" required />
        </div>

        <div class="mt-4">
            <h2 class="text-xl font-bold text-gray-700 mb-4 text-center underline underline-offset-8 decoration-green-200"> Contacto del proveedor</h2>
            <x-input-label for="telf_proveedor" :value="__('Teléfono')" />
            <x-text-input id="telf_proveedor" class="block mt-1 w-full focus:ring-green-500" type="text" name="telf_proveedor" required />
            <x-input-label for="email_proveedor" :value="__('Email')" />
            <x-text-input id="email_proveedor" class="block mt-1 w-full focus:ring-green-500" type="text" name="email_proveedor" required />
        </div>

    </form>
</x-guest-layout>