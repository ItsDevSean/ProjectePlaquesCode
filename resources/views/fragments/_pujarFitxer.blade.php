<form id="electricBillForm" action=" {{ route('consumption') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-700" id="upload" role="tabpanel" aria-labelledby="upload-tab">
        <div class="max-w-2xl mx-auto">
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <svg class="w-10 h-10 mb-3 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                </svg>
                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                    <span class="font-semibold">Fes clic per pujar</span> o arrossega el fitxer
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    CSV, XLSX (Màx. 10MB)
                </p>
            </div>
            <input id="consumption-file" type="file" class="hidden" accept=".csv,.xlsx,.xls" name="csv_file">
            
            <div class="flex justify-center mt-4">
                <button id="upload-btn" type="button" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                    Seleccionar Fitxer
                </button>
            </div>
            
            <div id="file-info" class="mt-4 p-4 bg-white dark:bg-gray-600 rounded-lg shadow-sm hidden">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span id="file-name" class="font-medium text-gray-700 dark:text-gray-200"></span>
                    </div>
                    <button id="remove-file" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div id="file-progress" class="mt-2 hidden">
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div class="bg-emerald-600 h-2.5 rounded-full" style="width: 0%"></div>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Processant fitxer...</p>
                </div>
            </div>
            
            <div class="mt-6 border-t border-gray-200 dark:border-gray-700 pt-4">
                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Format recomanat</h4>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">
                    El fitxer ha d'incloure com a mínim dates i consum horari. Descarga la nostra plantilla per assegurar el format correcte.
                </p>
                <button type="button" class="text-xs text-emerald-600 dark:text-emerald-400 hover:underline">
                    Descargar plantilla CSV
                </button>
            </div>
            <button onclick="showCSV({{ json_encode($electicConsumption) }})" type="button" class="text-xs text-emerald-600 dark:text-emerald-400 hover:underline">
                Process csv
            </button>
            <div id="importedData" style="display: none;">
                {{ json_encode($electicConsumption) }}
            </div>
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>    
</form>