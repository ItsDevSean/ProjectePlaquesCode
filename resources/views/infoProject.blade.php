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
<body class="bg-gray-50">
    <!-- Nav -->
    @if (Route::has('login'))
    <nav x-data="{ open: false }" class="auth-buttons bg-white p-4 flex items-center shadow-lg sticky top-0 left-0 w-full z-50">
        <div class="flex items-center justify-between w-full">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-12 w-12">
            </div>
            <!-- Botón burger -->
            <button @click="open = !open" class="md:hidden text-[#4adba4] focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7"/>
                </svg>
            </button>
            <!-- Menú de navegación -->
            <div class="hidden md:flex items-center space-x-4">
                <a href="/" class="rounded-md px-4 py-2 text-white bg-[#4adba4] transition hover:bg-transparent hover:text-[#4adba4] border border-[#4adba4]">Página principal</a>
                @auth
                    <a href="{{ url('/proyectos') }}" class="rounded-md px-4 py-2 text-white bg-[#4adba4] transition hover:bg-transparent hover:text-[#4adba4] border border-[#4adba4]">Comenzar</a>
                @else
                    <a href="{{ route('login') }}" class="rounded-md px-4 py-2 text-white bg-[#4adba4] transition hover:bg-transparent hover:text-[#4adba4] border border-[#4adba4]">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="rounded-md px-4 py-2 text-white bg-[#4adba4] transition hover:bg-transparent hover:text-[#4adba4] border border-[#4adba4]">Register</a>
                    @endif
                @endauth
            </div>
        </div>
        <!-- Menú desplegable en móviles -->
        <div x-show="open" class="md:hidden flex flex-col items-center w-full bg-white shadow-md py-4 space-y-2">
            <a href="/" class="block px-4 py-2 text-[#4adba4] hover:bg-[#4adba4] hover:text-white rounded-md">Página principal</a>
            @auth
                <a href="{{ url('/proyectos') }}" class="block px-4 py-2 text-[#4adba4] hover:bg-[#4adba4] hover:text-white rounded-md">Comenzar</a>
            @else
                <a href="{{ route('login') }}" class="block px-4 py-2 text-[#4adba4] hover:bg-[#4adba4] hover:text-white rounded-md">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="block px-4 py-2 text-[#4adba4] hover:bg-[#4adba4] hover:text-white rounded-md">Register</a>
                @endif
            @endauth
        </div>
    </nav>
@endif


    <!-- Beneficios -->
    <section class="py-20 px-6 bg-gray-100 text-center">
        <h2 class="text-3xl font-bold text-gray-800">Beneficios de la Energía Solar</h2>
        <div class="grid md:grid-cols-3 gap-8 mt-10">
            @foreach ([
                ['title' => 'Ahorro Energético', 'desc' => 'Reduce significativamente tu factura eléctrica al generar tu propia energía.', 'img' => 'img/registroFrom.jpg'],
                ['title' => 'Energía Renovable', 'desc' => 'Aprovecha una fuente inagotable y sostenible que ayuda a cuidar el planeta.', 'img' => 'img/registroCalle.jpg'],
                ['title' => 'Bajo Mantenimiento', 'desc' => 'Los paneles solares requieren poca intervención y ofrecen gran durabilidad.', 'img' => 'img/placas-fotovoltaicas.png']
            ] as $benefit)
                <div class="relative bg-white p-8 rounded-xl shadow-md min-h-[300px] flex flex-col justify-center items-center text-white"
                    style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset($benefit['img']) }}'); background-size: cover; background-position: center;">
                    <h3 class="text-2xl font-semibold">{{ $benefit['title'] }}</h3>
                    <p class="mt-3 text-gray-200">{{ $benefit['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Aspecto legal -->
    <!-- TODO: Revisar aspectos legales -->
        <div class="max-w-5xl mx-auto">
            <h2 class="text-3xl font-bold text-center text-gray-800 py-10">Antes de instalar tus placas solares</h2>
            <div class="grid md:grid-cols-2 gap-8">
                @foreach ([
                    ['title' => 'Licencias y permisos', 'desc' => 'Antes de comenzar, revisa qué licencias y permisos son necesarios.', 'link' => 'https://icaen.gencat.cat/es/energia/autoconsum/preguntes-frequeents/'],
                    ['title' => 'Permiso de conexión a la red', 'desc' => 'Si tu instalación está conectada a la red eléctrica, revisa los permisos requeridos.', 'link' => 'https://www.efcsolar.com/blog/'],
                    ['title' => 'Registro de instalaciones', 'desc' => 'Consulta los requisitos para registrar tu instalación.', 'link' => 'https://mediambient.gencat.cat/es/'],
                    ['title' => 'Gestión de residuos', 'desc' => 'Es importante cumplir con la normativa de residuos.', 'link' => 'https://www.boe.es/buscar/doc.php?id=BOE-A-2022-5809']
                ] as $legal)
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold text-gray-700">{{ $legal['title'] }}</h3>
                        <p class="text-gray-600 mt-3">{{ $legal['desc'] }}</p>
                        <a href="{{ $legal['link'] }}" target="_blank" class="mt-4 inline-block bg-[#4adba4] text-white px-4 py-2 rounded-md">Más información</a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Carousel -->
    <!-- TODO: Actualizar imágenes -->
    <div class="bg-gray-100 flex items-center flex-col justify-center py-10">
     <h2 class="text-3xl font-bold text-center text-gray-800 py-10">¿Cómo funciona nuestra aplicación?</h2>


     <div x-data="{ 
            activeSlide: 0, 
            slides: [
                { img: 'img/registroFrom.jpg', title: 'Regístrate', subtitle: 'Inicia sesión con nosotros.' },
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
    <section class="py-20 px-6 text-center bg-gray-100">
        <h2 class="text-3xl font-bold">Contáctanos</h2>
        <form class="mt-10 max-w-lg mx-auto bg-white p-8 rounded-xl shadow-md">
            <input type="text" placeholder="Nombre" class="w-full p-3 mb-4 border border-gray-300 rounded-lg">
            <input type="email" placeholder="Correo Electrónico" class="w-full p-3 mb-4 border border-gray-300 rounded-lg">
            <textarea placeholder="Mensaje" class="w-full p-3 mb-4 border border-gray-300 rounded-lg" rows="4"></textarea>
            <button class="bg-[#4adba4] text-white px-6 py-3 rounded-full text-lg font-semibold transition hover:bg-[#3bc38d]">Enviar</button>
        </form>
    </section>

    <!-- TODO: Añadir footer -->
</body>

</html>