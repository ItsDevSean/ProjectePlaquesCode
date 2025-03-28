<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Preus</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <link rel="stylesheet" href="build/css/styles.css">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Plans Disponibles') }}
            </h2>
        </x-slot>

        <section class="py-6 leading-7 text-gray-900 bg-gray-100 sm:py-12 md:py-16 lg:py-20">
            <div class="container px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 id="pricing" class="text-3xl font-semibold tracking-tight text-gray-900 sm:text-4xl md:text-5xl">
                        Escull el teu pla i comença avui!
                    </h2>
                    <p class="mt-4 text-lg text-gray-600 sm:text-xl">
                        Tria el pla que millor s'adapti a les teves necessitats.
                    </p>
                </div>

                <!-- Grid de Preus -->
                <div class="grid grid-cols-1 mt-12 sm:grid-cols-3 sm:gap-0">
                    <!-- Price 1 -->
                    <div class="relative z-10 flex flex-col p-8 bg-white border border-gray-200 rounded-lg shadow-sm sm:rounded-r-none h-full">
                        <h3 class="text-2xl font-semibold text-gray-900">Starter</h3>
                        <div class="flex items-baseline mt-4 text-gray-900">
                            <span class="text-5xl font-bold">$1</span>
                            <span class="ml-1 text-xl font-medium text-gray-500">/ month</span>
                        </div>
                        <ul class="mt-6 space-y-4 flex-1">
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="ml-3">1 Website</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="ml-3">SSL (HTTPS)</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="ml-3">SiteFast Domain</span>
                            </li>
                        </ul>
                        <a href="#" class="inline-flex items-center justify-center w-full px-6 py-3 mt-8 font-medium text-emerald-400 bg-transparent border border-emerald-400 rounded-md hover:bg-emerald-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2">
                            Millorar Plan
                        </a>
                    </div>

                    <!-- Price 2 (Destacado) -->
                    <div class="relative z-20 flex flex-col p-8 bg-white border-4 border-emerald-400 rounded-lg shadow-lg transform scale-105 h-full">
                        <h3 class="text-2xl font-semibold text-gray-900">Basic</h3>
                        <div class="flex items-baseline mt-4 text-gray-900">
                            <span class="text-6xl font-bold">$29</span>
                            <span class="ml-1 text-xl font-medium text-gray-500">/ month</span>
                        </div>
                        <ul class="mt-6 space-y-4 flex-1">
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="ml-3">15 Websites</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="ml-3">SSL (HTTPS)</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="ml-3">Custom Domain</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="ml-3">SiteFast Branding Removal</span>
                            </li>
                        </ul>
                        <a href="#" class="inline-flex items-center justify-center w-full px-6 py-3 mt-8 font-medium text-white bg-emerald-400 border border-transparent rounded-md hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2">
                            Millorar Plan
                        </a>
                    </div>

                    <!-- Price 3 -->
                    <div class="relative z-10 flex flex-col p-8 bg-white border border-gray-200 rounded-lg shadow-sm sm:rounded-l-none h-full">
                        <h3 class="text-2xl font-semibold text-gray-900">Plus</h3>
                        <div class="flex items-baseline mt-4 text-gray-900">
                            <span class="text-5xl font-bold">$49</span>
                            <span class="ml-1 text-xl font-medium text-gray-500">/ month</span>
                        </div>
                        <ul class="mt-6 space-y-4 flex-1">
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="ml-3">50 Websites</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="ml-3">SSL (HTTPS)</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="ml-3">Custom Domain</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="ml-3">SiteFast Branding Removal</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="ml-3">Google Analytics</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="ml-3">Email Integration</span>
                            </li>
                        </ul>
                        <a href="#" class="inline-flex items-center justify-center w-full px-6 py-3 mt-8 font-medium text-emerald-400 bg-transparent border border-emerald-400 rounded-md hover:bg-emerald-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2">
                            Millorar Plan
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </x-app-layout>
</body>
</html>