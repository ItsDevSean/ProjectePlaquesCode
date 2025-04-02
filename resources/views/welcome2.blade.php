<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SolarPV Pro | Solución Profesional para Diseño Fotovoltaico</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Tailwind CSS -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        :root {
            --emerald-500: #10b981;
            --teal-600: #0d9488;
            --emerald-700: #047857;
            --teal-500: #14b8a6;
        }
        
        html {
            scroll-behavior: smooth;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, rgba(16,185,129,0.95) 0%, rgba(13,148,136,0.95) 100%);
        }
        
        .feature-card {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            border-left: 4px solid transparent;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            border-left-color: var(--emerald-500);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08);
        }
        
        .timeline-item:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 36px;
            top: 48px;
            height: calc(100% - 48px);
            width: 2px;
            background: var(--teal-600);
            opacity: 0.2;
        }
        
        .stat-card {
            background: linear-gradient(135deg, rgba(16,185,129,0.08) 0%, rgba(13,148,136,0.08) 100%);
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            background: linear-gradient(135deg, rgba(16,185,129,0.15) 0%, rgba(13,148,136,0.15) 100%);
            transform: translateY(-3px);
        }
        
        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 */
            height: 0;
        }
        
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        
        .step-icon {
            background: linear-gradient(135deg, rgba(16,185,129,0.1) 0%, rgba(13,148,136,0.1) 100%);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        
        .nav-shadow {
            box-shadow: 0 4px 30px -10px rgba(0, 0, 0, 0.1);
        }
        
        .testimonial-card {
            background: linear-gradient(135deg, rgba(255,255,255,0.98) 0%, rgba(249,250,251,0.98) 100%);
            backdrop-filter: blur(10px);
        }
        
        .tech-icon {
            filter: grayscale(100%);
            opacity: 0.7;
            transition: all 0.3s ease;
        }
        
        .tech-icon:hover {
            filter: grayscale(0%);
            opacity: 1;
        }
        
        .contact-form {
            background: linear-gradient(135deg, rgba(255,255,255,0.98) 0%, rgba(249,250,251,0.98) 100%);
            backdrop-filter: blur(10px);
        }
        
        .footer-gradient {
            background: linear-gradient(135deg, rgba(5,150,105,0.95) 0%, rgba(13,148,136,0.95) 100%);
        }
    </style>
</head>

<body class="font-sans antialiased text-gray-800 leading-relaxed bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white nav-shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex-shrink-0 flex items-center">
                    <img class="h-10 w-auto" src="{{ asset('img/logo.png') }}" alt="SolarPV Pro Logo">
                    <span class="ml-3 text-xl font-semibold text-gray-900">SolarPV <span class="text-emerald-500">Pro</span></span>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-center space-x-8">
                        <a href="#inicio" class="text-gray-700 hover:text-emerald-500 px-3 py-2 text-sm font-medium transition duration-300">Inicio</a>
                        <a href="#solucion" class="text-gray-700 hover:text-emerald-500 px-3 py-2 text-sm font-medium transition duration-300">Solución</a>
                        <a href="#funcionalidades" class="text-gray-700 hover:text-emerald-500 px-3 py-2 text-sm font-medium transition duration-300">Funcionalidades</a>
                        <a href="#tecnologia" class="text-gray-700 hover:text-emerald-500 px-3 py-2 text-sm font-medium transition duration-300">Tecnología</a>
                        <a href="#contacto" class="bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white px-5 py-2 rounded-md text-sm font-medium transition duration-300 shadow-md">Contacto</a>
                    </div>
                </div>
                <div class="-mr-2 flex md:hidden">
                    <!-- Mobile menu button -->
                    <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-emerald-500 hover:bg-gray-100 focus:outline-none transition duration-300" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <!-- Menu icon -->
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile menu -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="#inicio" class="text-gray-700 hover:text-emerald-500 block px-3 py-2 rounded-md text-base font-medium transition duration-300">Inicio</a>
                <a href="#solucion" class="text-gray-700 hover:text-emerald-500 block px-3 py-2 rounded-md text-base font-medium transition duration-300">Solución</a>
                <a href="#funcionalidades" class="text-gray-700 hover:text-emerald-500 block px-3 py-2 rounded-md text-base font-medium transition duration-300">Funcionalidades</a>
                <a href="#tecnologia" class="text-gray-700 hover:text-emerald-500 block px-3 py-2 rounded-md text-base font-medium transition duration-300">Tecnología</a>
                <a href="#contacto" class="bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white block px-3 py-2 rounded-md text-base font-medium transition duration-300">Contacto</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="inicio" class="hero-gradient text-white pt-24 pb-20 md:pt-32 md:pb-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div class="order-last md:order-first">
                    <div class="relative">
                        <div class="rounded-xl overflow-hidden shadow-2xl border-4 border-white border-opacity-20">
                            <img src="{{ asset('build/img/dashboard-solarpv.jpg') }}" alt="Dashboard SolarPV Pro" class="w-full h-auto">
                        </div>
                        <div class="absolute -inset-4 border-2 border-white border-opacity-10 rounded-xl pointer-events-none"></div>
                    </div>
                </div>
                <div>
                    <span class="inline-block px-3 py-1 text-xs font-semibold text-emerald-100 bg-white bg-opacity-10 rounded-full mb-4">PLATAFORMA PROFESIONAL</span>
                    <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-6">Diseño Fotovoltaico <br><span class="text-emerald-100">Preciso y Eficiente</span></h1>
                    <p class="text-lg md:text-xl text-emerald-100 mb-8">La solución definitiva para ingenieros y empresas especializadas en energía solar. Diseña, analiza y simula instalaciones fotovoltaicas con precisión profesional.</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#contacto" class="bg-white text-emerald-600 hover:bg-gray-50 px-6 py-3 rounded-lg font-medium text-center transition duration-300 shadow-md">Solicitar Demo</a>
                        <a href="#solucion" class="border-2 border-white border-opacity-30 text-white hover:bg-white hover:bg-opacity-10 px-6 py-3 rounded-lg font-medium text-center transition duration-300">Conocer Solución</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="stat-card p-6 rounded-xl text-center">
                    <div class="text-3xl md:text-4xl font-bold text-emerald-500 mb-2">+95%</div>
                    <div class="text-gray-600 font-medium">Precisión</div>
                </div>
                <div class="stat-card p-6 rounded-xl text-center">
                    <div class="text-3xl md:text-4xl font-bold text-emerald-500 mb-2">5</div>
                    <div class="text-gray-600 font-medium">Pasos Simples</div>
                </div>
                <div class="stat-card p-6 rounded-xl text-center">
                    <div class="text-3xl md:text-4xl font-bold text-emerald-500 mb-2">3</div>
                    <div class="text-gray-600 font-medium">Métodos de Análisis</div>
                </div>
                <div class="stat-card p-6 rounded-xl text-center">
                    <div class="text-3xl md:text-4xl font-bold text-emerald-500 mb-2">100%</div>
                    <div class="text-gray-600 font-medium">Profesional</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Solution Section -->
    <section id="solucion" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block px-3 py-1 text-xs font-semibold text-emerald-600 bg-emerald-100 rounded-full mb-4">SOLUCIÓN INTEGRAL</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Optimización Total del Proceso Fotovoltaico</h2>
                <p class="max-w-2xl mx-auto text-lg text-gray-600">Desde el análisis inicial hasta la presentación final al cliente, todo en una sola plataforma.</p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-12 items-center mb-20">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Flujo de Trabajo Estandarizado</h3>
                    <p class="text-gray-600 mb-6">SolarPV Pro establece un proceso claro y eficiente para el diseño de instalaciones solares, eliminando inconsistencias y reduciendo tiempos de entrega.</p>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg class="h-6 w-6 text-emerald-500 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-600">Proceso estructurado en 5 fases claramente definidas</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-6 w-6 text-emerald-500 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-600">Plantillas estandarizadas para informes profesionales</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-6 w-6 text-emerald-500 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-600">Integración perfecta con herramientas existentes</span>
                        </li>
                    </ul>
                </div>
                <div class="rounded-xl overflow-hidden shadow-xl border border-gray-200">
                    <img src="{{ asset('build/img/workflow-solar.jpg') }}" alt="Flujo de trabajo SolarPV Pro" class="w-full h-auto">
                </div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="order-last md:order-first">
                    <div class="rounded-xl overflow-hidden shadow-xl border border-gray-200">
                        <img src="{{ asset('build/img/data-analysis.jpg') }}" alt="Análisis de datos" class="w-full h-auto">
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Toma de Decisiones Basada en Datos</h3>
                    <p class="text-gray-600 mb-6">Nuestra plataforma transforma datos complejos en información accionable, permitiéndote tomar decisiones técnicas y comerciales con confianza.</p>
                    <p class="text-gray-600 mb-6">Con algoritmos avanzados y modelos de predicción precisos, SolarPV Pro elimina las conjeturas del diseño fotovoltaico.</p>
                    <a href="#funcionalidades" class="inline-flex items-center text-emerald-600 font-medium hover:text-emerald-700 transition duration-300">
                        Ver funcionalidades completas
                        <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="funcionalidades" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block px-3 py-1 text-xs font-semibold text-emerald-600 bg-emerald-100 rounded-full mb-4">FUNCIONALIDADES</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Herramientas Profesionales para Resultados Precisos</h2>
                <p class="max-w-2xl mx-auto text-lg text-gray-600">Diseñado por ingenieros para ingenieros, con todo lo que necesitas para proyectos fotovoltaicos de calidad.</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Gestión de Proyectos -->
                <div class="feature-card bg-white p-8 rounded-lg shadow-sm border border-gray-100">
                    <div class="w-14 h-14 bg-emerald-50 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Gestión de Proyectos</h3>
                    <p class="text-gray-600 mb-4">Organiza y gestiona todos tus proyectos solares desde un panel centralizado con funciones avanzadas de filtrado y búsqueda.</p>
                    <ul class="space-y-2 text-sm text-gray-500">
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-emerald-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>CRUD completo para proyectos</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-emerald-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Filtros y estadísticas avanzadas</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-emerald-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Panel lateral de detalles</span>
                        </li>
                    </ul>
                </div>
                
                <!-- Análisis de Consumo -->
                <div class="feature-card bg-white p-8 rounded-lg shadow-sm border border-gray-100">
                    <div class="w-14 h-14 bg-emerald-50 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Análisis de Consumo</h3>
                    <p class="text-gray-600 mb-4">Tres métodos flexibles para introducir datos de consumo eléctrico adaptados a diferentes escenarios profesionales.</p>
                    <ul class="space-y-2 text-sm text-gray-500">
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-emerald-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Introducción manual directa</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-emerald-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Importación desde CSV/Excel</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-emerald-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Conexión con comercializadora</span>
                        </li>
                    </ul>
                </div>
                
                <!-- Selección de Área -->
                <div class="feature-card bg-white p-8 rounded-lg shadow-sm border border-gray-100">
                    <div class="w-14 h-14 bg-emerald-50 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Selección de Área</h3>
                    <p class="text-gray-600 mb-4">Herramientas profesionales para análisis geográfico y selección precisa de ubicaciones.</p>
                    <ul class="space-y-2 text-sm text-gray-500">
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-emerald-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Integración con Google Maps</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-emerald-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Dibujo de áreas y obstáculos</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-emerald-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Cálculo automático de superficie</span>
                        </li>
                    </ul>
                </div>
                
                <!-- Simulación de Producción -->
                <div class="feature-card bg-white p-8 rounded-lg shadow-sm border border-gray-100">
                    <div class="w-14 h-14 bg-emerald-50 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Simulación de Producción</h3>
                    <p class="text-gray-600 mb-4">Modelado avanzado de producción energética con parámetros ajustables para máxima precisión.</p>
                    <ul class="space-y-2 text-sm text-gray-500">
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-emerald-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Cálculos avanzados de producción</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-emerald-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Gráficos mensuales y diarios</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-emerald-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Estimación de ahorros y CO₂</span>
                        </li>
                    </ul>
                </div>
                
                <!-- Informes Profesionales -->
                <div class="feature-card bg-white p-8 rounded-lg shadow-sm border border-gray-100">
                    <div class="w-14 h-14 bg-emerald-50 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Informes Profesionales</h3>
                    <p class="text-gray-600 mb-4">Generación automática de informes técnicos y comerciales listos para presentar al cliente.</p>
                    <ul class="space-y-2 text-sm text-gray-500">
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-emerald-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Plantillas personalizables</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-emerald-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Exportación en múltiples formatos</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-emerald-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Datos técnicos completos</span>
                        </li>
                    </ul>
                </div>
                
                <!-- Seguridad y Almacenamiento -->
                <div class="feature-card bg-white p-8 rounded-lg shadow-sm border border-gray-100">
                    <div class="w-14 h-14 bg-emerald-50 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Seguridad y Almacenamiento</h3>
                    <p class="text-gray-600 mb-4">Tus datos y proyectos están seguros con nuestro sistema de almacenamiento profesional.</p>
                    <ul class="space-y-2 text-sm text-gray-500">
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-emerald-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Almacenamiento local temporal</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-emerald-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Guardado seguro en la nube</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-emerald-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Cifrado de datos sensible</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Workflow Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block px-3 py-1 text-xs font-semibold text-emerald-600 bg-emerald-100 rounded-full mb-4">PROCESO</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Flujo de Trabajo Optimizado</h2>
                <p class="max-w-2xl mx-auto text-lg text-gray-600">Un proceso claro y eficiente para resultados consistentes en cada proyecto.</p>
            </div>
            
            <div class="max-w-4xl mx-auto">
                <div class="space-y-12">
                    <!-- Paso 1 -->
                    <div class="timeline-item relative pl-20">
                        <div class="absolute left-0 top-0 flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-bold shadow-lg">
                            <span class="text-xl">1</span>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Datos del Cliente y Propiedad</h3>
                            <p class="text-gray-600 mb-4">Recopilación estructurada de toda la información relevante sobre el cliente y la propiedad donde se instalará el sistema fotovoltaico.</p>
                            <div class="flex flex-wrap gap-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Formulario inteligente</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Estacionalidad</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Tipo de instalación</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Paso 2 -->
                    <div class="timeline-item relative pl-20">
                        <div class="absolute left-0 top-0 flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-bold shadow-lg">
                            <span class="text-xl">2</span>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Análisis de Consumo Eléctrico</h3>
                            <p class="text-gray-600 mb-4">Evaluación detallada de los patrones de consumo mediante múltiples métodos de entrada de datos para máxima precisión.</p>
                            <div class="flex flex-wrap gap-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Manual</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Importación</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Conexión API</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Gràficos interactivos</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Paso 3 -->
                    <div class="timeline-item relative pl-20">
                        <div class="absolute left-0 top-0 flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-bold shadow-lg">
                            <span class="text-xl">3</span>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Selección de Ubicación y Área</h3>
                            <p class="text-gray-600 mb-4">Identificación precisa del lugar óptimo para la instalación mediante herramientas geoespaciales avanzadas.</p>
                            <div class="flex flex-wrap gap-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Google Maps</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Dibujo de áreas</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Obstáculos</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Superficie útil</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Paso 4 -->
                    <div class="timeline-item relative pl-20">
                        <div class="absolute left-0 top-0 flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-bold shadow-lg">
                            <span class="text-xl">4</span>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Configuración del Sistema</h3>
                            <p class="text-gray-600 mb-4">Selección de componentes y parámetros técnicos para optimizar el rendimiento del sistema fotovoltaico.</p>
                            <div class="flex flex-wrap gap-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Paneles solares</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Inversores</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Baterías</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Orientación</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Paso 5 -->
                    <div class="timeline-item relative pl-20">
                        <div class="absolute left-0 top-0 flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-bold shadow-lg">
                            <span class="text-xl">5</span>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Simulación y Análisis de Resultados</h3>
                            <p class="text-gray-600 mb-4">Generación de proyecciones precisas de producción energética y análisis detallado de resultados.</p>
                            <div class="flex flex-wrap gap-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Producción estimada</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Ahorro económico</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Reducción CO₂</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Exportación PDF</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Technology Section -->
    <section id="tecnologia" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block px-3 py-1 text-xs font-semibold text-emerald-600 bg-emerald-100 rounded-full mb-4">TECNOLOGÍA</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Plataforma Construida con las Mejores Tecnologías</h2>
                <p class="max-w-2xl mx-auto text-lg text-gray-600">Una base tecnológica robusta para garantizar rendimiento, seguridad y escalabilidad.</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8">
                <div class="flex flex-col items-center">
                    <div class="w-20 h-20 bg-white rounded-xl shadow-sm p-4 flex items-center justify-center mb-3">
                        <img src="{{ asset('build/img/tech/tailwind.svg') }}" alt="Tailwind CSS" class="tech-icon max-h-12">
                    </div>
                    <span class="text-sm font-medium text-gray-600">Tailwind CSS</span>
                </div>
                
                <div class="flex flex-col items-center">
                    <div class="w-20 h-20 bg-white rounded-xl shadow-sm p-4 flex items-center justify-center mb-3">
                        <img src="{{ asset('build/img/tech/alpinejs.svg') }}" alt="Alpine.js" class="tech-icon max-h-12">
                    </div>
                    <span class="text-sm font-medium text-gray-600">Alpine.js</span>
                </div>
                
                <div class="flex flex-col items-center">
                    <div class="w-20 h-20 bg-white rounded-xl shadow-sm p-4 flex items-center justify-center mb-3">
                        <img src="{{ asset('build/img/tech/chartjs.svg') }}" alt="Chart.js" class="tech-icon max-h-12">
                    </div>
                    <span class="text-sm font-medium text-gray-600">Chart.js</span>
                </div>
                
                <div class="flex flex-col items-center">
                    <div class="w-20 h-20 bg-white rounded-xl shadow-sm p-4 flex items-center justify-center mb-3">
                        <img src="{{ asset('build/img/tech/laravel.svg') }}" alt="Laravel" class="tech-icon max-h-12">
                    </div>
                    <span class="text-sm font-medium text-gray-600">Laravel</span>
                </div>
                
                <div class="flex flex-col items-center">
                    <div class="w-20 h-20 bg-white rounded-xl shadow-sm p-4 flex items-center justify-center mb-3">
                        <img src="{{ asset('build/img/tech/google-maps.svg') }}" alt="Google Maps" class="tech-icon max-h-12">
                    </div>
                    <span class="text-sm font-medium text-gray-600">Google Maps</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block px-3 py-1 text-xs font-semibold text-emerald-600 bg-emerald-100 rounded-full mb-4">CLIENTES</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Lo que dicen nuestros clientes</h2>
                <p class="max-w-2xl mx-auto text-lg text-gray-600">Empresas líderes en energía solar confían en SolarPV Pro para sus proyectos.</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="testimonial-card p-8 rounded-xl shadow-sm border border-gray-200">
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0">
                            <img class="h-12 w-12 rounded-full" src="{{ asset('build/img/testimonial1.jpg') }}" alt="Testimonio 1">
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-bold text-gray-900">Ing. Carlos Méndez</h3>
                            <p class="text-gray-600">EcoEnergía Solutions</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic mb-4">"SolarPV Pro ha transformado completamente nuestro proceso de diseño. La precisión de las simulaciones nos permite presentar propuestas más competitivas y reducir los tiempos de entrega en un 40%."</p>
                    <div class="flex">
                        <svg class="h-5 w-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="h-5 w-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="h-5 w-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="h-5 w-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="h-5 w-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </div>
                </div>
                
                <div class="testimonial-card p-8 rounded-xl shadow-sm border border-gray-200">
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0">
                            <img class="h-12 w-12 rounded-full" src="{{ asset('build/img/testimonial2.jpg') }}" alt="Testimonio 2">
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-bold text-gray-900">Dra. Ana Torres</h3>
                            <p class="text-gray-600">SolFuturo Energías</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic mb-4">"La integración con Google Maps y la capacidad de analizar obstáculos en tiempo real ha mejorado nuestra precisión en los diseños y reducido los errores en un 30%."</p>
                    <div class="flex">
                        <svg class="h-5 w-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="h-5 w-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="h-5 w-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="h-5 w-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="h-5 w-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </div>
                </div>
                
                <div class="testimonial-card p-8 rounded-xl shadow-sm border border-gray-200">
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0">
                            <img class="h-12 w-12 rounded-full" src="{{ asset('build/img/testimonial3.jpg') }}" alt="Testimonio 3">
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-bold text-gray-900">Javier Ruiz</h3>
                            <p class="text-gray-600">RenovaTech</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic mb-4">"Los múltiples métodos para introducir datos de consumo nos permiten adaptarnos a cada cliente. La conexión directa con comercializadoras es un diferenciador clave para nuestra empresa."</p>
                    <div class="flex">
                        <svg class="h-5 w-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="h-5 w-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="h-5 w-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="h-5 w-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 hero-gradient text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">¿Listo para transformar tu proceso de diseño fotovoltaico?</h2>
            <p class="text-xl mb-8 max-w-3xl mx-auto">Descubre cómo SolarPV Pro puede optimizar tu flujo de trabajo y mejorar la precisión de tus proyectos.</p>
            <a href="#contacto" class="inline-flex items-center px-8 py-4 border border-transparent text-lg font-medium rounded-md shadow-sm text-emerald-600 bg-white hover:bg-gray-50 transition duration-300">
                Solicitar Demo Personalizada
                <svg class="ml-3 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contacto" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Contacto</h2>
                    <p class="text-gray-600 mb-8">Estamos aquí para responder cualquier pregunta sobre SolarPV Pro y mostrarte cómo puede beneficiar a tu negocio.</p>
                    
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-emerald-100 text-emerald-500">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Teléfono</h3>
                                <p class="text-gray-600">+34 123 456 789</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-emerald-100 text-emerald-500">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Email</h3>
                                <p class="text-gray-600">info@solarpvpro.com</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-emerald-100 text-emerald-500">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Dirección</h3>
                                <p class="text-gray-600">Calle Tecnología, 42<br>08025 Barcelona, España</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div>
                    <div class="contact-form p-8 rounded-xl shadow-sm border border-gray-200">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Solicita una Demo</h3>
                        <form action="#" method="POST" class="space-y-6">
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div>
                                    <label for="first-name" class="block text-sm font-medium text-gray-700">Nombre</label>
                                    <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500">
                                </div>
                                
                                <div>
                                    <label for="last-name" class="block text-sm font-medium text-gray-700">Apellidos</label>
                                    <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500">
                                </div>
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" autocomplete="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500">
                            </div>
                            
                            <div>
                                <label for="company" class="block text-sm font-medium text-gray-700">Empresa</label>
                                <input type="text" name="company" id="company" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500">
                            </div>
                            
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700">¿Qué te gustaría ver en la demo?</label>
                                <textarea id="message" name="message" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500"></textarea>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <input id="privacy-policy" name="privacy-policy" type="checkbox" class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded">
                                </div>
                                <div class="ml-3">
                                    <label for="privacy-policy" class="text-sm text-gray-700">Acepto la <a href="#" class="font-medium text-emerald-600 hover:text-emerald-500">Política de Privacidad</a></label>
                                </div>
                            </div>
                            
                            <div>
                                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition duration-300">
                                    Solicitar Demo
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-gradient text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <div>
                    <div class="flex items-center mb-4">
                        <img src="{{ asset('img/logo.png') }}" alt="SolarPV Pro Logo" class="h-10 w-auto">
                        <span class="ml-3 text-xl font-semibold">SolarPV <span class="text-emerald-100">Pro</span></span>
                    </div>
                    <p class="text-emerald-100 text-opacity-80">La solución profesional para diseño y simulación de instalaciones fotovoltaicas.</p>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Enlaces rápidos</h3>
                    <ul class="space-y-2">
                        <li><a href="#inicio" class="text-emerald-100 text-opacity-80 hover:text-white transition">Inicio</a></li>
                        <li><a href="#solucion" class="text-emerald-100 text-opacity-80 hover:text-white transition">Solución</a></li>
                        <li><a href="#funcionalidades" class="text-emerald-100 text-opacity-80 hover:text-white transition">Funcionalidades</a></li>
                        <li><a href="#tecnologia" class="text-emerald-100 text-opacity-80 hover:text-white transition">Tecnología</a></li>
                        <li><a href="#contacto" class="text-emerald-100 text-opacity-80 hover:text-white transition">Contacto</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Recursos</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-emerald-100 text-opacity-80 hover:text-white transition">Documentación</a></li>
                        <li><a href="#" class="text-emerald-100 text-opacity-80 hover:text-white transition">API</a></li>
                        <li><a href="#" class="text-emerald-100 text-opacity-80 hover:text-white transition">Preguntas Frecuentes</a></li>
                        <li><a href="#" class="text-emerald-100 text-opacity-80 hover:text-white transition">Blog Técnico</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Legal</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-emerald-100 text-opacity-80 hover:text-white transition">Términos y Condiciones</a></li>
                        <li><a href="#" class="text-emerald-100 text-opacity-80 hover:text-white transition">Política de Privacidad</a></li>
                        <li><a href="#" class="text-emerald-100 text-opacity-80 hover:text-white transition">Cookies</a></li>
                        <li><a href="#" class="text-emerald-100 text-opacity-80 hover:text-white transition">Aviso Legal</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="mt-12 pt-8 border-t border-emerald-400 border-opacity-20 flex flex-col md:flex-row justify-between items-center">
                <p class="text-emerald-100 text-opacity-80 text-sm">© 2023 SolarPV Pro. Todos los derechos reservados.</p>
                <div class="mt-4 md:mt-0 flex space-x-6">
                    <a href="#" class="text-emerald-100 text-opacity-80 hover:text-white transition">
                        <span class="sr-only">LinkedIn</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-emerald-100 text-opacity-80 hover:text-white transition">
                        <span class="sr-only">Twitter</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        document.querySelector('[aria-controls="mobile-menu"]').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
                
                // Close mobile menu if open
                const mobileMenu = document.getElementById('mobile-menu');
                if (!mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>