<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Plans - SiteFast</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>
<body class="bg-gray-50">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Plans Disponibles') }}
            </h2>
        </x-slot>

        <section class="py-12 md:py-20 lg:py-24 bg-gradient-to-b from-gray-50 to-white">
            <div class="container px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <span class="inline-block px-3 py-1 text-sm font-semibold text-emerald-600 bg-emerald-100 rounded-full mb-4 animate__animated animate__fadeIn">
                        Plans Flexibles
                    </span>
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl md:text-6xl animate__animated animate__fadeInUp">
                        <span class="block">Escull el teu pla ideal</span>
                        <span class="block text-emerald-600">per créixer en línia</span>
                    </h1>
                    <p class="mt-6 max-w-2xl mx-auto text-xl text-gray-600 animate__animated animate__fadeInUp animate__delay-1s">
                        Desbloqueja tot el potencial del teu negoci amb solucions adaptades a cada necessitat.
                    </p>
                </div>

                <!-- Toggle Anual/Mensual -->
                <div class="flex justify-center mb-16 animate__animated animate__fadeIn animate__delay-1s">
                    <div class="inline-flex bg-gray-100 rounded-lg p-1">
                        <button class="px-6 py-2 rounded-md font-medium text-gray-700">Mensual</button>
                        <button class="px-6 py-2 rounded-md font-medium bg-white shadow-sm text-emerald-600">Anual (20% dte.)</button>
                    </div>
                </div>

                <!-- Grid de Preus -->
                <div class="grid grid-cols-1 gap-8 lg:grid-cols-3 lg:gap-6">
                    <!-- Plan Starter -->
                    <div class="relative flex flex-col p-8 bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 h-full border border-gray-100 animate__animated animate__fadeInLeft">
                        <div class="absolute top-0 left-0 right-0 h-2 bg-gray-200 rounded-t-xl"></div>
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">Starter</h3>
                            <p class="text-gray-600 mb-6">Perfecte per petits projectes personals</p>
                            
                            <div class="mb-8">
                                <span class="text-5xl font-bold text-gray-900">€1</span>
                                <span class="text-lg font-medium text-gray-500">/mes</span>
                                <p class="text-sm text-gray-500 mt-1">Facturat anualment (€12/any)</p>
                            </div>
                            
                            <ul class="space-y-4 mb-8">
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-3">1 Lloc web</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-3">Certificat SSL inclòs</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-3">Subdomini SiteFast</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-gray-300 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-3 text-gray-400">Dominis personalitzats</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-gray-300 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-3 text-gray-400">Eliminar marca SiteFast</span>
                                </li>
                            </ul>
                        </div>
                        
                        <a href="#" class="w-full inline-flex justify-center items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors duration-200">
                            Començar ara
                        </a>
                    </div>

                    <!-- Plan Basic (Destacat) -->
                    <div class="relative z-10 flex flex-col p-8 bg-white rounded-xl shadow-2xl transform scale-105 border-2 border-emerald-500 animate__animated animate__fadeInUp">
                        <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-emerald-400 to-emerald-600 rounded-t-xl"></div>
                        <div class="absolute top-0 right-0 mr-6 -mt-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-emerald-100 text-emerald-800">
                                Més popular
                            </span>
                        </div>
                        
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">Basic</h3>
                            <p class="text-gray-600 mb-6">Ideal per autònoms i petites empreses</p>
                            
                            <div class="mb-8">
                                <span class="text-5xl font-bold text-gray-900">€29</span>
                                <span class="text-lg font-medium text-gray-500">/mes</span>
                                <p class="text-sm text-gray-500 mt-1">Facturat anualment (€348/any)</p>
                            </div>
                            
                            <ul class="space-y-4 mb-8">
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-3">15 Llocs web</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-3">Certificat SSL inclòs</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-3">1 Domini personalitzat</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-3">Eliminar marca SiteFast</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-gray-300 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-3 text-gray-400">Google Analytics</span>
                                </li>
                            </ul>
                        </div>
                        
                        <a href="#" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all duration-200 transform hover:scale-105">
                            Triar aquest pla
                            <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>

                    <!-- Plan Plus -->
                    <div class="relative flex flex-col p-8 bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 h-full border border-gray-100 animate__animated animate__fadeInRight">
                        <div class="absolute top-0 left-0 right-0 h-2 bg-gray-800 rounded-t-xl"></div>
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">Plus</h3>
                            <p class="text-gray-600 mb-6">Per negocis en creixement i agències</p>
                            
                            <div class="mb-8">
                                <span class="text-5xl font-bold text-gray-900">€49</span>
                                <span class="text-lg font-medium text-gray-500">/mes</span>
                                <p class="text-sm text-gray-500 mt-1">Facturat anualment (€588/any)</p>
                            </div>
                            
                            <ul class="space-y-4 mb-8">
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-3">50 Llocs web</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-3">Certificat SSL inclòs</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-3">Dominis personalitzats il·limitats</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-3">Eliminar marca SiteFast</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-3">Integració amb Google Analytics</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-3">Integració amb correu electrònic</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-3">Suport prioritari</span>
                                </li>
                            </ul>
                        </div>
                        
                        <a href="#" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 transition-colors duration-200">
                            Contractar ara
                        </a>
                    </div>
                </div>

                <!-- Comparativa de plans -->
                <div class="mt-24 bg-white rounded-xl shadow-lg overflow-hidden animate__animated animate__fadeIn animate__delay-1s">
                    <div class="px-6 py-5 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Comparativa completa de plans</h3>
                    </div>
                    <div class="divide-y divide-gray-200">
                        <!-- Fila de característica -->
                        <div class="grid grid-cols-4 gap-6 px-6 py-4 hover:bg-gray-50">
                            <div class="col-span-1 font-medium text-gray-900">Llocs web</div>
                            <div class="text-center">1</div>
                            <div class="text-center font-semibold text-emerald-600">15</div>
                            <div class="text-center">50</div>
                        </div>
                        <!-- Fila de característica -->
                        <div class="grid grid-cols-4 gap-6 px-6 py-4 hover:bg-gray-50">
                            <div class="col-span-1 font-medium text-gray-900">Emmagatzematge</div>
                            <div class="text-center">5GB</div>
                            <div class="text-center font-semibold text-emerald-600">50GB</div>
                            <div class="text-center">200GB</div>
                        </div>
                        <!-- Fila de característica -->
                        <div class="grid grid-cols-4 gap-6 px-6 py-4 hover:bg-gray-50">
                            <div class="col-span-1 font-medium text-gray-900">Dominis personalitzats</div>
                            <div class="text-center text-gray-400">-</div>
                            <div class="text-center font-semibold text-emerald-600">1</div>
                            <div class="text-center">Il·limitats</div>
                        </div>
                        <!-- Fila de característica -->
                        <div class="grid grid-cols-4 gap-6 px-6 py-4 hover:bg-gray-50">
                            <div class="col-span-1 font-medium text-gray-900">Suport</div>
                            <div class="text-center">Bàsic</div>
                            <div class="text-center font-semibold text-emerald-600">Estàndard</div>
                            <div class="text-center">Prioritari 24/7</div>
                        </div>
                    </div>
                </div>

                <!-- Garantia de satisfacció -->
                <div class="mt-16 text-center animate__animated animate__fadeIn animate__delay-1s">
                    <div class="inline-flex items-center px-6 py-3 bg-emerald-50 rounded-full">
                        <svg class="w-6 h-6 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="font-medium text-emerald-700">Garantia de satisfacció de 30 dies - Reemborsament sense preguntes</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Preguntes freqüents -->
        <section class="py-12 bg-gray-50">
            <div class="container px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Preguntes freqüents</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Pregunta 1 -->
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Puc canviar de pla més tard?</h3>
                        <p class="text-gray-600">Sí, pots actualitzar o degradar el teu pla en qualsevol moment des del teu tauler de control. Els canvis s'aplicaran immediatament i es farà un ajust proporcional en la teva propera factura.</p>
                    </div>
                    
                    <!-- Pregunta 2 -->
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Hi ha costos ocults?</h3>
                        <p class="text-gray-600">No, tots els nostres plans inclouen tot el que es mostra. L'únic cost addicional seria si necessites dominis addicionals, que es poden adquirir per separat.</p>
                    </div>
                    
                    <!-- Pregunta 3 -->
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Com funciona el descompte anual?</h3>
                        <p class="text-gray-600">En triar facturació anual, obtens 2 mesos gratuïts respecte al preu mensual. Això representa un 20% de descompte en el cost total.</p>
                    </div>
                    
                    <!-- Pregunta 4 -->
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Ofereu suport tècnic?</h3>
                        <p class="text-gray-600">Sí, tots els plans inclouen suport tècnic. Els plans Basic i Plus reben suport prioritari, amb temps de resposta més ràpids i assistència 24/7 en el cas del pla Plus.</p>
                    </div>
                </div>
            </div>
        </section>
    </x-app-layout>
</body>
</html>