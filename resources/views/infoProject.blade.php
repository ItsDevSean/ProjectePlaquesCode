<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Plaques</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/welcome.js'])
    @endif
</head>
<body>
<h1>Hola</h1>
        <!-- Hero Section -->
        <section class="bg-[url('/solar-bg.jpg')] bg-cover bg-center h-screen flex items-center justify-center text-white text-center px-4">
        <div class="bg-black bg-opacity-50 p-8 rounded-xl">
            <h1 class="text-4xl md:text-6xl font-bold">Energía Solar para un Futuro Sostenible</h1>
            <p class="mt-4 text-lg md:text-xl">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <button class="mt-6 bg-yellow-500 text-black px-6 py-3 rounded-full text-lg font-semibold">Descubre Más</button>
        </div>
    </section>

    <!-- Beneficios -->
    <section class="py-20 px-6 bg-gray-100 text-center">
        <h2 class="text-3xl font-bold">Beneficios de la Energía Solar</h2>
        <div class="grid md:grid-cols-3 gap-6 mt-8">
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h3 class="text-xl font-semibold">Ahorro Energético</h3>
                <p class="mt-2 text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h3 class="text-xl font-semibold">Energía Renovable</h3>
                <p class="mt-2 text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h3 class="text-xl font-semibold">Bajo Mantenimiento</h3>
                <p class="mt-2 text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </div>
    </section>

    <!-- Productos -->
    <section class="py-20 px-6 text-center">
        <h2 class="text-3xl font-bold">Nuestros Productos</h2>
        <div class="grid md:grid-cols-3 gap-6 mt-8">
            <div class="bg-gray-100 p-6 rounded-xl shadow-md">
                <img src="/solar1.jpg" alt="Panel Solar" class="rounded-lg mb-4">
                <h3 class="text-xl font-semibold">Panel Solar 1</h3>
                <p class="mt-2 text-gray-600">Lorem ipsum dolor sit amet.</p>
            </div>
            <div class="bg-gray-100 p-6 rounded-xl shadow-md">
                <img src="/solar2.jpg" alt="Panel Solar" class="rounded-lg mb-4">
                <h3 class="text-xl font-semibold">Panel Solar 2</h3>
                <p class="mt-2 text-gray-600">Lorem ipsum dolor sit amet.</p>
            </div>
            <div class="bg-gray-100 p-6 rounded-xl shadow-md">
                <img src="/solar3.jpg" alt="Panel Solar" class="rounded-lg mb-4">
                <h3 class="text-xl font-semibold">Panel Solar 3</h3>
                <p class="mt-2 text-gray-600">Lorem ipsum dolor sit amet.</p>
            </div>
        </div>
    </section>

    <!-- Testimonios -->
    <section class="py-20 px-6 bg-gray-100 text-center">
        <h2 class="text-3xl font-bold">Lo que dicen nuestros clientes</h2>
        <div class="grid md:grid-cols-2 gap-6 mt-8">
            <div class="bg-white p-6 rounded-xl shadow-md">
                <p class="text-gray-600 italic">"Lorem ipsum dolor sit amet, consectetur adipiscing elit."</p>
                <h3 class="mt-4 text-xl font-semibold">Juan Pérez</h3>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md">
                <p class="text-gray-600 italic">"Lorem ipsum dolor sit amet, consectetur adipiscing elit."</p>
                <h3 class="mt-4 text-xl font-semibold">Ana López</h3>
            </div>
        </div>
    </section>

    <!-- Contacto -->
    <section class="py-20 px-6 text-center">
        <h2 class="text-3xl font-bold">Contáctanos</h2>
        <form class="mt-8 max-w-lg mx-auto bg-white p-6 rounded-xl shadow-md">
            <input type="text" placeholder="Nombre" class="w-full p-3 mb-4 border rounded-lg">
            <input type="email" placeholder="Correo Electrónico" class="w-full p-3 mb-4 border rounded-lg">
            <textarea placeholder="Mensaje" class="w-full p-3 mb-4 border rounded-lg" rows="4"></textarea>
            <button class="bg-yellow-500 text-black px-6 py-3 rounded-full text-lg font-semibold">Enviar</button>
        </form>
    </section>
</body>
</html>