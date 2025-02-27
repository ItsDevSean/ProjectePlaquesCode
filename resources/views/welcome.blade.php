<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Plaques</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else

    @endif
</head>

<body class="font-sans antialiased">
    <style>
    #background {
        position: relative;
        width: 100%;
        height: 50vh;
        object-fit: cover;
        opacity: 0.6;
    }

    .video-container {
        position: relative;
        width: 100%;
        height: 50vh;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .video-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.3);
        z-index: 1;
    }

    .content-section {
        padding: 2rem;
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
    }

    .content-section2 {
        padding: 2rem;
        width: 100%;
        margin: 0 auto;
        min-height: 300px;
        display: flex;
        align-items: center;
    }

    /* Estilos para los botones de autenticación */
    .auth-buttons {
        position: absolute;
        top: 1rem;
        right: 1rem;
        z-index: 10;
    }

    .content-section3 {
        margin-top: 2rem;
        margin-bottom: 2rem;
    }

    .content-section4 {
        padding: 2rem;
        width: 100%;
        margin: 0 auto;
        min-height: 300px;
        display: flex;
        align-items: center;
    }
    </style>

    <div class="bg-transparent">
        <div class="video-container">
            <!-- Botones de autenticación -->
            @if (Route::has('login'))
            <nav class="auth-buttons">
                @auth
                <a href="{{ url('/dashboard') }}"
                class="rounded-md px-3 py-2 text-white bg-[#4adba4] ring-1 ring-[#4adba4] transition hover:bg-transparent hover:text-white focus:outline-none focus-visible:ring-[#4adba4] mr-2">
                    Dashboard
                </a>
                @else
                <a href="{{ route('login') }}"
                    class="rounded-md px-3 py-2 text-white bg-[#4adba4] ring-1 ring-[#4adba4] transition hover:bg-transparent hover:text-white focus:outline-none focus-visible:ring-[#4adba4] mr-2">
                    Log in
                </a>

                @if (Route::has('register'))
                <a href="{{ route('register') }}"
                    class="rounded-md px-3 py-2 text-white bg-[#4adba4] ring-1 ring-[#4adba4] transition hover:bg-transparent hover:text-white focus:outline-none focus-visible:ring-[#4adba4] mr-2">
                    Register
                </a>
                @endif
                @endauth
            </nav>
            @endif

            <div class="video-overlay"></div>
            <video id="background" autoplay muted loop playsinline>
                <source src="{{ asset('build/img/video.mp4.mp4') }}" type="video/mp4">
            </video>

            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10 text-center">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-20 w-auto mx-auto mb-4">
                <h1 class="text-4xl font-bold text-white mb-2">LO HACEMOS REALIDAD</h1>
                <h4 class="text-white text-xl">Ayudándole a desarrollar proyectos de energía renovable</h4>
            </div>
        </div>

        <div class="content-section">
            <h2 class="text-3xl font-bold text-center mb-8 text-[#4adba4]">LENIO</h2>

            <div class="max-w-4xl mx-auto space-y-6 text-gray-700">
                <p class="text-lg text-center">
                    Con una cartera de más de 200 proyectos completados y una potencia total acumulada de más de 30 MW,
                    el grupo empresarial LENIUM es una empresa líder en gestión de proyectos en el sector de las
                    energías
                    renovables y en I+D (Investigación y Desarrollo).
                </p>

                <p class="text-lg text-center">
                    Gestionamos y ejecutamos nuestros proyectos de energía renovable en su totalidad, desde su
                    concepción
                    hasta su finalización, pasando por el desarrollo técnico, la obtención de permisos y licencias,
                    ejecución llave en mano, O&M (operación y mantenimiento) y financiación.
                </p>

                <p class="text-lg font-medium text-center">
                    Nuestro objetivo es hacer posibles proyectos internacionales de energía renovable.
                </p>
            </div>
        </div>

        <div class="content-section2 bg-[#4adba4]">
            <div class="max-w-5xl mx-auto flex items-center justify-between gap-8">
                <div class="w-2/3 text-white">
                    <h2 class="text-3xl font-bold mb-6 text-center">ENERGÍAS RENOVABLES</h2>
                    <p class="text-lg text-center">
                        Nuestro profundo conocimiento del sector de las ER a nivel internacional así como la amplia
                        trayectoria de nuestros socios con más de 25 años de experiencia, nos permite ofrecer
                        soluciones totalmente integrales para la implementación exitosa de proyectos de energías
                        renovables para autoconsumo, autoproducción, venta en red o venta a industriales.
                    </p>
                </div>

                <div class="w-1/3 flex justify-center">
                    <img src="{{ asset('build/img/icono1.png') }}" class="w-28 h-28 object-contain">
                </div>
            </div>
        </div>

        <div class="content-section3">
            <div class="max-w-5xl mx-auto flex items-center justify-between gap-8">
                <div class="w-1/3 flex justify-center">
                    <img src="{{ asset('build/img/icono2.png') }}" class="w-28 h-28 object-contain">
                </div>

                <div class="w-2/3 text-black">
                    <h2 class="text-3xl font-bold mb-6 text-center">FINANCIACIÓN</h2>
                    <p class="text-lg text-center">
                        Nuestro modelo de negocio se centra en maximizar la rentabilidad para nuestros clientes e
                        inversores,
                        asegurando un retorno en el corto y medio plazo. Nos centramos en proyectos de generación de
                        energía
                        renovable y en aquellos que hacen un uso más eficiente de la energía. Además, se centra en
                        proyectos
                        de mejora del ciclo del agua y proyectos de reutilización de residuos.
                    </p>
                </div>
            </div>
        </div>

        <div class="content-section4 bg-[#4adba4]">
            <div class="max-w-5xl mx-auto flex items-center justify-between gap-8">
                <div class="w-2/3 text-white">
                    <h2 class="text-3xl font-bold mb-6 text-center">Investigación y desarrollo</h2>

                    <p class="text-lg text-center">
                        Nuestra inversión en investigación y desarrollo a lo largo de los años nos ha permitido adquirir
                        patentes relevantes así como importantes avances y mejoras tanto en aspectos técnicos como en
                        términos de competitividad.
                    </p>
                    <br>
                    <p class="text-lg text-center">
                        En LENIUM llevamos a cabo programas de I+D en colaboración con instituciones públicas (centros
                        de investigación, laboratorios y universidades) en España e internacionalmente, especialmente en
                        África y la región MENA.
                    </p>

                </div>

                <div class="w-1/3 flex justify-center">
                    <img src="{{ asset('build/img/icon3.png') }}" class="w-28 h-28 object-contain">
                </div>
            </div>
        </div>

        <!-- Incluiremos una foto con un efecto parallax -->
        <div class="relative h-[80vh] w-full overflow-hidden">
            <div class="absolute inset-0" style="height: 200%;">
                <img src="{{ asset('build/img/pexels-pixabay-371917.jpg') }}" 
                     class="w-full h-full object-cover"
                     style="transform: translateY(var(--parallax-offset, 0)); will-change: transform;"
                     id="parallaxImage"
                     alt="Parallax background">
            </div>
            <div class="absolute inset-0 bg-black/30 z-10"></div>
        </div>

        <!-- Codigo js para el efecto parallax -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const parallaxImage = document.getElementById('parallaxImage');
                const parallaxContainer = parallaxImage.parentElement;
                
                window.addEventListener('scroll', function() {
                    const rect = parallaxContainer.parentElement.getBoundingClientRect();
                    
                    if (rect.top < window.innerHeight && rect.bottom > 0) {
                        const scrolled = window.pageYOffset;
                        const speed = 0.8;
                        const yPos = -(rect.top * speed);
                        parallaxImage.style.transform = `translateY(${yPos}px)`;
                    }
                });
            });
        </script>


        <h1 class="text-5xl font-bold text-center mb-8 text-[#4adba4] mt-20">Nuestros proyectos</h1>
        <div class="w-full grid grid-cols-5 gap-0">
            <div class="relative group">
                <img src="{{ asset('build/img/proyecto1.jpg') }}" alt="Proyecto 1" class="w-full h-80 object-cover">
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <h3 class="text-white text-xl font-bold">Proyecto 1</h3>
                </div>
            </div>

            <div class="relative group">
                <img src="{{ asset('build/img/proyecto2.jpg') }}" alt="Proyecto 2" class="w-full h-80 object-cover">
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <h3 class="text-white text-xl font-bold">Proyecto 2</h3>
                </div>
            </div>

            <div class="relative group">
                <img src="{{ asset('build/img/proyecto3.jpg') }}" alt="Proyecto 3" class="w-full h-80 object-cover">
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <h3 class="text-white text-xl font-bold">Proyecto 3</h3>
                </div>
            </div>

            <div class="relative group">
                <img src="{{ asset('build/img/proyecto4.jpg') }}" alt="Proyecto 4" class="w-full h-80 object-cover">
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <h3 class="text-white text-xl font-bold">Proyecto 4</h3>
                </div>
            </div>

            <div class="relative group">
                <img src="{{ asset('build/img/proyecto5.jpg') }}" alt="Proyecto 5" class="w-full h-80 object-cover">
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <h3 class="text-white text-xl font-bold">Proyecto 5</h3>
                </div>
            </div>

        </div>

    </div>
</body>

</html>