<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Búsqueda de Paneles</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">
    <x-app-layout>
        <div x-data="{ showModal: false, bateria: {} }" class="p-6">

            <div class="max-w-4xl mx-auto p-6">
                <h1 class="text-2xl font-bold text-[#49DBA3] mb-4 text-center">Baterías</h1>

                <!-- Filtros de búsqueda -->
                <div class="mt-4 bg-white shadow-lg rounded-xl p-6">
                    <div class="bg-white border border-gray-200 shadow-lg rounded-xl p-5 mb-8">
                        <div class="flex items-center text font-semibold mb-4">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M3 6h18M3 12h18M3 18h18" />
                            </svg>
                            Filtros
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <input type="text" placeholder="🔍 Identificador"
                                class="border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400 w-full">
                            <input type="number" placeholder="⚡ Capacidad (kWh)"
                                class="border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400 w-full">
                            <select
                                class="border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400 w-full">
                                <option value="">🏭 Seleccionar fabricante</option>
                                <option value="GROWATT">GROWATT</option>
                                <option value="Pylontech">Pylontech</option>
                                <option value="SAJ">SAJ</option>
                                <option value="BYD">BYD</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Tabla de baterías -->
                <div class="mt-4 overflow-x-auto bg-white shadow-lg rounded-xl">
                    <table class="min-w-full text-sm text-left">
                        <thead class="bg-gray-100 text-gray-700 uppercase tracking-wide text-xs">
                            <tr>
                                <th class="px-6 py-4">Identificador</th>
                                <th class="px-6 py-4">Capacidad (kWh)</th>
                                <th class="px-6 py-4">Coste (€)</th>
                                <th class="px-6 py-4">Fabricante</th>
                                <th class="px-6 py-4">Fecha de creación</th>
                                <th class="px-6 py-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-gray-800">
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-medium">BATERIA-001</td>
                                <td class="px-6 py-4">10</td>
                                <td class="px-6 py-4">5000</td>
                                <td class="px-6 py-4">GROWATT</td>
                                <td class="px-6 py-4">2021-10-01 12:00:00</td>
                                <td class="px-6 py-4 space-x-2">
                                    <button
                                        @click="showModal = true; bateria = { identificador: 'BATERIA-001', capacidad: 10, coste: 5000, fabricante: 'GROWATT' }"
                                        class="inline-flex items-center px-4 py-2 bg-white bg-opacity-90 border-2 border-[#49DBA3] text-black rounded-md font-semibold text-xs uppercase tracking-widest cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#49DBA3] hover:text-white focus:bg-[#49DBA3] focus:text-white active:bg-[#49DBA3] active:text-white focus:outline-none focus:ring-2 focus:ring-[#49DBA3] focus:ring-offset-2 dark:focus:ring-offset-green-800">Editar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal de edición -->
            <div x-show="showModal" x-transition
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div @click.away="showModal = false" class="bg-white rounded-2xl shadow-xl p-8 w-full max-w-2xl">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Editar batería</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Identificador</label>
                            <input x-model="bateria.identificador" class="w-full px-4 py-2 border rounded-xl" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Capacidad (kWh)</label>
                            <input x-model="bateria.capacidad" type="number"
                                class="w-full px-4 py-2 border rounded-xl" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Coste (€)</label>
                            <input x-model="bateria.coste" type="number" class="w-full px-4 py-2 border rounded-xl" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Fabricante</label>
                            <select x-model="bateria.fabricante" class="w-full px-4 py-2 border rounded-xl">
                                <option>GROWATT</option>
                                <option>Pylontech</option>
                                <option>SAJ</option>
                                <option>BYD</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-4">
                        <button @click="showModal = false"
                            class="px-4 py-2 bg-gray-200 rounded-xl hover:bg-gray-300">Cerrar</button>
                        <button class="inline-flex items-center px-4 py-2 bg-white bg-opacity-90 border-2 border-[#49DBA3] text-black rounded-md font-semibold text-xs uppercase tracking-widest cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#49DBA3] hover:text-white focus:bg-[#49DBA3] focus:text-white active:bg-[#49DBA3] active:text-white focus:outline-none focus:ring-2 focus:ring-[#49DBA3] focus:ring-offset-2 dark:focus:ring-offset-green-800">Guardar
                            cambios</button>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>

</html>
