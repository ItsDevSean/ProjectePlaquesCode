<style>
    /* A parte de trabajar con Tailwind CSS */
    .tabla {
        border: 3px solid #4adba4;
    }

    .tabla th,
    .tabla td {
        border: 2px solid #4adba4;
    }

    .tabla thead {
        background-color: #4adba4;
        color: white;
    }

    .tabla tbody tr:hover {
        background-color: rgba(74, 219, 164, 0.1);
    }
</style>

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
                    <div class="overflow-x-auto">
                        <table class="tabla min-w-full divide-y">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nombre</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Latitud</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Longitud</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider hidden sm:table-cell">Descripción</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">CIPFP Mislata</td>
                                    <td class="px-6 py-4 whitespace-nowrap">39.4759</td>
                                    <td class="px-6 py-4 whitespace-nowrap">-0.4174</td>
                                    <td class="px-6 py-4 whitespace-nowrap hidden sm:table-cell">Centro de formación profesional</td>
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
                                    <td class="px-6 py-4 whitespace-nowrap hidden sm:table-cell">Parque público de Valencia</td>
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
                                    <td class="px-6 py-4 whitespace-nowrap hidden sm:table-cell">Complejo arquitectónico cultural y de entretenimiento</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3">Ver en mapa</a>
                                        <button class="text-red-600 hover:text-red-900">Eliminar</button>
                                        <button class="text-green-600 hover:text-red-900">Editar</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">Mercado Central</td>
                                    <td class="px-6 py-4 whitespace-nowrap">39.4736</td>
                                    <td class="px-6 py-4 whitespace-nowrap">-0.3783</td>
                                    <td class="px-6 py-4 whitespace-nowrap hidden sm:table-cell">Mercado histórico de Valencia</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3">Ver en mapa</a>
                                        <button class="text-red-600 hover:text-red-900">Eliminar</button>
                                        <button class="text-green-600 hover:text-red-900">Editar</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">Bioparc Valencia</td>
                                    <td class="px-6 py-4 whitespace-nowrap">39.4789</td>
                                    <td class="px-6 py-4 whitespace-nowrap">-0.4062</td>
                                    <td class="px-6 py-4 whitespace-nowrap hidden sm:table-cell">Parque zoológico de Valencia</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3">Ver en mapa</a>
                                        <button class="text-red-600 hover:text-red-900">Eliminar</button>
                                        <button class="text-green-600 hover:text-red-900">Editar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> <!-- Fin del contenedor con scroll horizontal -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
