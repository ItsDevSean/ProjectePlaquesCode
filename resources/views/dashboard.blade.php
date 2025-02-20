<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="build/css/styles.css">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ubicaciones guardadas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nombre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Latitud</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Longitud</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Descripción</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">CIPFP Mislata</td>
                                <td class="px-6 py-4 whitespace-nowrap">39.4759</td>
                                <td class="px-6 py-4 whitespace-nowrap">-0.4174</td>
                                <td class="px-6 py-4 whitespace-nowrap">Centro de formación profesional</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3">Ver en mapa</a>
                                    <button class="text-red-600 hover:text-red-900">Eliminar</button>
                                    <button class="text-green-600 hover:text-red-900">Editar</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Parque de Cabecera</td>
                                <td class="px-6 py-4 whitespace-nowrap">39.4851</td>
                                <td class="px-6 py-4 whitespace-nowrap">-0.4074</td>
                                <td class="px-6 py-4 whitespace-nowrap">Parque público de Valencia</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3">Ver en mapa</a>
                                    <button class="text-red-600 hover:text-red-900">Eliminar</button>
                                    <button class="text-green-600 hover:text-red-900">Editar</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Ciudad de las Artes</td>
                                <td class="px-6 py-4 whitespace-nowrap">39.4543</td>
                                <td class="px-6 py-4 whitespace-nowrap">-0.3555</td>
                                <td class="px-6 py-4 whitespace-nowrap">Complejo arquitectónico cultural y de entretenimiento</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3">Ver en mapa</a>
                                    <button class="text-red-600 hover:text-red-900">Eliminar</button>
                                    <button class="text-green-600 hover:text-red-900">Editar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
