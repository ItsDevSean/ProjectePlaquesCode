<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Planes de Precios</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900">
    <x-app-layout>
        <x-slot name="header">
            <link rel="stylesheet" href="build/css/styles.css">
            
        </x-slot>

        <section class="py-12">
            <div class="container mx-auto max-w-7xl px-6 text-center">
                <h2 class="text-4xl font-extrabold text-gray-900">¡Elige tu plan y comienza hoy mismo!</h2>
                <p class="mt-4 text-lg text-gray-600">Selecciona el plan que mejor se adapte a tus necesidades.</p>

                <!-- Grid de Precios -->
                <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Plan Básico -->
                    <div class="relative flex flex-col p-8 bg-white border border-gray-300 rounded-xl shadow-lg transition transform hover:scale-105 h-full">
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-gray-900">Básico</h3>
                            <div class="mt-4 text-gray-900">
                                <span class="text-5xl font-extrabold">$1</span>
                                <span class="text-xl font-medium text-gray-500">/ mes</span>
                            </div>
                            <ul class="mt-6 space-y-2 text-gray-700">
                                <li>✔ 1 Sitio Web</li>
                                <li>✔ SSL (HTTPS)</li>
                                <li>✔ Dominio SiteFast</li>
                            </ul>
                        </div>
                        <button class="px-4 py-2 bg-[#49DBA3] text-white rounded-lg shadow-lg hover:bg-[#36B89A] transition-all duration-300">¡Suscríbete ya!</button>
                    </div>

                    <!-- Plan Estándar (Destacado) -->
                    <div class="relative flex flex-col p-8 bg-white border border-gray-300 rounded-xl shadow-lg transition transform hover:scale-105 h-full">
                        <div class="flex-1">
                            <h3 class="text-3xl font-bold">Estándar</h3>
                            <div class="mt-4">
                                <span class="text-6xl font-extrabold">$29</span>
                                <span class="text-xl font-medium">/ mes</span>
                            </div>
                            <ul class="mt-6 space-y-2">
                                <li>✔ 15 Sitios Web</li>
                                <li>✔ SSL (HTTPS)</li>
                                <li>✔ Dominio Personalizado</li>
                                <li>✔ Eliminación de Marca SiteFast</li>
                            </ul>
                        </div>
                        <button class="px-4 py-2 bg-[#49DBA3] text-white rounded-lg shadow-lg hover:bg-[#36B89A] transition-all duration-300">¡Suscríbete ya!</button>
                    </div>

                    <!-- Plan Premium -->
                    <div class="relative flex flex-col p-8 bg-white border border-gray-300 rounded-xl shadow-lg transition transform hover:scale-105 h-full">
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-gray-900">Premium</h3>
                            <div class="mt-4 text-gray-900">
                                <span class="text-5xl font-extrabold">$49</span>
                                <span class="text-xl font-medium text-gray-500">/ mes</span>
                            </div>
                            <ul class="mt-6 space-y-2 text-gray-700">
                                <li>✔ 50 Sitios Web</li>
                                <li>✔ SSL (HTTPS)</li>
                                <li>✔ Dominio Personalizado</li>
                                <li>✔ Eliminación de Marca SiteFast</li>
                                <li>✔ Google Analytics</li>
                                <li>✔ Integración con Email</li>
                            </ul>
                        </div>
                        <button class="px-4 py-2 bg-[#49DBA3] text-white rounded-lg shadow-lg hover:bg-[#36B89A] transition-all duration-300">¡Suscríbete ya!</button>
                    </div>
                </div>
            </div>
        </section>
    </x-app-layout>
</body>
</html>