<x-guest-layout>
    <form action="{{ route('guardar.informacionElectrica') }}" method="post" enctype="multipart/form-data">
        @csrf
        <h2 class="text-2xl font-bold text-gray-700 mb-8 text-center underline underline-offset-8 decoration-green-200">
            Certificaciones y Estándares
        </h2>

        <div class="mb-4">
            <x-input-label for="certificaciones" :value="__('Certificaciones')" class="mb-2" />
            <textarea id="certificaciones" rows="5" class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Lista las certificaciones separadas por comas (Ej. IEC, UL, TUV)"></textarea>
        </div>

        <div class="mb-4">
            <x-input-label for="normativas" :value="__('Cumplimiento de Normativas')" class="mb-2" />
            <select id="normativas" name="normativas" class="block w-full p-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">Seleccione una normativa</option>
                <option value="IEC 61215">IEC 61215</option>
                <option value="IEC 61730">IEC 61730</option>
                <option value="UL 1703">UL 1703</option>
                <option value="ISO 9001">ISO 9001</option>
            </select>
        </div>

        <div class="flex items-center justify-end mt-8">
            <x-primary-button class="px-6 py-3 text-lg">
                {{ __('Guardar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
