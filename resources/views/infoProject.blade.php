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

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <!-- Nav -->
    @if (Route::has('login'))
        <nav
        class="auth-buttons bg-slate-50 p-4 flex items-center shadow-lg sticky top-0 left-0 w-full z-50"
        >
            <div class="flex items-center space-x-2">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-12 w-12">
            </div>
            <div class="container mx-auto flex justify-end items-center">
                
                <a href="/" class="rounded-md px-3 py-2 text-white bg-[#4adba4] ring-1 ring-[#4adba4] transition hover:bg-transparent hover:text-black focus:outline-none focus-visible:ring-[#4adba4] mr-2">Pàgina principal</a>
                @auth
                <a href="{{ url('/proyectos') }}"
                class="rounded-md px-3 py-2 text-white bg-[#4adba4] ring-1 ring-[#4adba4] transition hover:bg-transparent hover:text-black focus:outline-none focus-visible:ring-[#4adba4] mr-2">
                    Començar
                </a>
                @else
                <a href="{{ route('login') }}"
                    class="rounded-md px-3 py-2 text-white bg-[#4adba4] ring-1 ring-[#4adba4] transition hover:bg-transparent hover:text-black focus:outline-none focus-visible:ring-[#4adba4] mr-2">
                    Log in
                </a>

                @if (Route::has('register'))
                <a href="{{ route('register') }}"
                    class="rounded-md px-3 py-2 text-white bg-[#4adba4] ring-1 ring-[#4adba4] transition hover:bg-transparent hover:text-black focus:outline-none focus-visible:ring-[#4adba4] mr-2">
                    Register
                </a>
                @endif
                @endauth 
            </div>
        </nav>
     @endif
        

    <!-- Beneficios -->
    <section class="py-20 px-6 bg-gray-100 text-center"
    >
        <h2 class="text-3xl font-bold">Beneficios de la Energía Solar</h2>
        <div class="grid md:grid-cols-3 gap-6 mt-8">
            <div class="bg-white p-6 rounded-xl shadow-md"
            style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url('{{ asset('img/registroFrom.jpg') }} '); background-size: cover; background-position: center;">
                <h3 class="text-xl text-white font-semibold">Ahorro Energético</h3>
                <p class="mt-2 text-gray-200">Reduce significativamente tu factura eléctrica al generar tu propia energía.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md"
            style="background-image:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('img/registroCalle.jpg') }} '); background-size: cover; background-position: center;">
                <h3 class="text-xl text-white font-semibold">Energía Renovable</h3>
                <p class="mt-2 text-gray-200">Aprovecha una fuente inagotable y sostenible que ayuda a cuidar el planeta.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md"
            style="background-image:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('img/placas-fotovoltaicas.png') }} '); background-size: cover; background-position: center;">
                <h3 class="text-xl text-white font-semibold">Bajo Mantenimiento</h3>
                <p class="mt-2 text-gray-200">Los paneles solares requieren poca intervención y ofrecen gran durabilidad.</p>
            </div>
        </div>
    </section>


    <!-- Aspecto legal -->
    <section class="bg-gray-100 py-10 px-5">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Antes de instalar tus placas solares</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-700">Licencias y permisos</h3>
                <p class="text-gray-600 mt-2">Antes de comenzar, revisa qué licencias y permisos son necesarios para la instalación.</p>
                <a href="https://icaen.gencat.cat/es/energia/autoconsum/preguntes-frequeents/" target="_blank" class="mt-3 inline-block bg-[#4adba4] text-white px-4 py-2 rounded-md">Más información</a>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-700">Permiso de conexión a la red</h3>
                <p class="text-gray-600 mt-2">Si tu instalación está conectada a la red eléctrica, revisa los permisos requeridos.</p>
                <a href="https://www.efcsolar.com/blog/guia-completa-sobre-impuestos-para-instalar-placas-solares-en-cataluna/" target="_blank" class="mt-3 inline-block bg-[#4adba4] text-white px-4 py-2 rounded-md">Más información</a>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-700">Registro de instalaciones</h3>
                <p class="text-gray-600 mt-2">Consulta los requisitos para registrar tu instalación en los organismos oficiales.</p>
                <a href="https://mediambient.gencat.cat/es/05_ambits_dactuacio/energia/installacions-domestiques/autoconsum/registre-autoconsum-catalunya/" target="_blank" class="mt-3 inline-block bg-[#4adba4] text-white px-4 py-2 rounded-md">Más información</a>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-700">Gestión de residuos</h3>
                <p class="text-gray-600 mt-2">Es importante cumplir con la normativa de residuos tras la instalación.</p>
                <a href="https://www.boe.es/buscar/doc.php?id=BOE-A-2022-5809" target="_blank" class="mt-3 inline-block bg-[#4adba4] text-white px-4 py-2 rounded-md">Más información</a>
            </div>
        </div>
    </div>
</section>

<!-- slides: [
                { img: 'img/registroCalle.jpg', title: 'Regístrate', subtitle: 'Inicia sesión con nosotros.' },
                { img: 'img/CapturaMapa.png', title: 'Selecciona el área', subtitle: 'Selecciona el área del mapa donde instalarás las placas' },
                { img: 'img/registroCalle.jpg', title: 'Rellena nuestros formularios', subtitle: 'Rellena los diferentes formularios para obtener toda la información' }
            ], -->


    <!-- Carousel -->
     <div class="bg-gray-100 flex items-center flex-col justify-center py-10">
     <h2 class="text-3xl font-bold">¿Cómo funciona nuestra aplicación?</h2>


     <div x-data="{ 
            activeSlide: 0, 
            slides: [
                { img: 'img/registroCalle.jpg', title: 'Regístrate', subtitle: 'Inicia sesión con nosotros.' },
                { img: 'img/CapturaMapa.png', title: 'Selecciona el área', subtitle: 'Selecciona el área del mapa donde instalarás las placas' },
                { img: 'img/registroCalle.jpg', title: 'Rellena nuestros formularios', subtitle: 'Rellena los diferentes formularios para obtener toda la información' }
            ]
        }" 
        class="relative w-full max-w-sm md:max-w-lg lg:max-w-6xl">

        <!-- Contenedor de la tarjeta -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden relative">

            <!-- Contenedor de imágenes -->
            <div class="flex transition-transform duration-500 ease-out" 
                :style="'transform: translateX(-' + (activeSlide * 100) + '%)'">
                
                <template x-for="(slide, index) in slides" :key="index">
                    <div class="relative w-full flex-shrink-0">
                        <img :src="slide.img" class="w-full h-[250px] md:h-[400px] lg:h-[500px] object-cover rounded-t-lg">
                    </div>
                </template>
            </div>

            <!-- Contenedor de Título y Subtítulo -->
            <div class="p-4 text-center">
                <h2 class="text-lg md:text-2xl lg:text-3xl font-bold text-gray-800" x-text="slides[activeSlide].title"></h2>
                <p class="text-sm md:text-lg lg:text-xl text-gray-600 mt-2" x-text="slides[activeSlide].subtitle"></p>
            </div>

            <!-- Botón Izquierda -->
            <button @click="activeSlide = activeSlide > 0 ? activeSlide - 1 : slides.length - 1"
                class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full">
                &#10094;
            </button>

            <!-- Botón Derecha -->
            <button @click="activeSlide = activeSlide < slides.length - 1 ? activeSlide + 1 : 0"
                class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full">
                &#10095;
            </button>

        </div>

        <!-- Indicadores (Ahora debajo de la tarjeta) -->
        <div class="flex justify-center space-x-2 mt-4">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="activeSlide = index"
                    class="w-3 h-3 rounded-full transition-all"
                    :class="activeSlide === index ? 'bg-gray-800 w-4 h-4' : 'bg-gray-400'"></button>
            </template>
        </div>

    </div>


</div>


    <!-- Contacto -->
    <section class="py-20 px-6 text-center  bg-gray-100 ">
        <h2 class="text-3xl font-bold">Contáctanos</h2>
        <form class="mt-8 max-w-lg mx-auto bg-white p-6 rounded-xl shadow-md">
            <input type="text" placeholder="Nombre" class="w-full p-3 mb-4 border rounded-lg">
            <input type="email" placeholder="Correo Electrónico" class="w-full p-3 mb-4 border rounded-lg">
            <textarea placeholder="Mensaje" class="w-full p-3 mb-4 border rounded-lg" rows="4"></textarea>
            <button class="bg-[#4adba4] text-black px-6 py-3 rounded-full text-lg font-semibold">Enviar</button>
        </form>
    </section>
</body>
</html>