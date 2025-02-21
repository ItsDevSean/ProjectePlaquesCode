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

        <section class="py-6 leading-7 text-gray-900 bg-gray sm:py-12 md:py-16">
            <div class="box-border px-4 mx-auto border-solid bg-white sm:px-6 md:px-6 lg:px-0 max-w-[90%] rounded-[10px]">
                <div class="scale-90">   
                    <div class="flex flex-col items-center leading-7 text-center text-gray-900 border-0 border-gray-200">
                        <h2 id="pricing"
                            class="box-border m-0 text-3xl font-semibold leading-tight tracking-tight text-black border-solid sm:text-4xl md:text-5xl">
                            Escull el teu pla i comença avui!
                        </h2>
                        <p class="box-border mt-2 text-xl text-gray-900 border-solid sm:text-2xl">
                        </p>
                    </div>
            
                    
                    <div id="pricing"
                        class="grid grid-cols-1 gap-4 mt-4 leading-7 text-gray-900 border-0 border-gray-200 sm:mt-6 sm:gap-6 md:mt-8 md:gap-0 lg:grid-cols-3">
                        <!-- Price 1 -->
                        <div class="relative z-10 flex flex-col items-center max-w-md p-4 mx-auto my-0 border border-solid rounded-lg lg:-mr-3 sm:my-0 sm:p-6 md:my-8 md:p-8">
                            <h3 class="m-0 text-2xl font-semibold leading-tight tracking-tight text-black border-0 border-gray-200 sm:text-3xl md:text-4xl">
                                Starter
                            </h3>
                            <div class="flex items-end mt-6 leading-7 text-gray-900 border-0 border-gray-200">
                                <p class="box-border m-0 text-6xl font-semibold leading-none border-solid">
                                    $1
                                </p>
                                <p class="box-border m-0 border-solid" style="border-image: initial;">
                                    / month
                                </p>
                            </div>
                            <ul class="flex-1 p-0 mt-4 ml-5 leading-7 text-gray-900 border-0 border-gray-200">
                                <li class="inline-flex items-center block w-full mb-2 ml-5 font-semibold text-left border-solid">
                                    <svg class="w-5 h-5 mr-2 font-semibold leading-7 text-emerald-400 sm:h-5 sm:w-5 md:h-6 md:w-6"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                        </path>
                                    </svg>
                                    1 Website
                                </li>
            
                                <li class="inline-flex items-center block w-full mb-2 ml-5 font-semibold text-left border-solid">
                                    <svg class="w-5 h-5 mr-2 font-semibold leading-7 text-emerald-400 sm:h-5 sm:w-5 md:h-6 md:w-6"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                        </path>
                                    </svg>
                                    SSL (HTTPS)
                                </li>
            
                                <li class="inline-flex items-center block w-full mb-2 ml-5 font-semibold text-left border-solid">
                                    <svg class="w-5 h-5 mr-2 font-semibold leading-7 text-emerald-400 sm:h-5 sm:w-5 md:h-6 md:w-6"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                        </path>
                                    </svg>
                                    SiteFast Domain
                                </li>
            
                            </ul>
                            <a href="#"
                                class="inline-flex justify-center w-full px-4 py-3 mt-8 font-sans text-sm leading-none text-center text-emerald-400 no-underline bg-transparent border border-emerald-400 rounded-md cursor-pointer hover:bg-emerald-400 hover:border-emerald-400 hover:text-white focus-within:bg-emerald-400 focus-within:border-emerald-400 focus-within:text-white sm:text-base md:text-lg">
                                Millorar Plan
                            </a>
                        </div>
                        <!-- Price 2 -->
                        <div
                            class="relative z-20 flex flex-col items-center max-w-md p-4 mx-auto my-0 bg-white border-4 border-emerald-400 border-solid rounded-lg sm:p-6 md:px-8 md:py-16">
                            <h3
                                class="m-0 text-2xl font-semibold leading-tight tracking-tight text-black border-0 border-gray-200 sm:text-3xl md:text-4xl">
                                Basic
                            </h3>
                            <div class="flex items-end mt-6 leading-7 text-gray-900 border-0 border-gray-200">
                                <p class="box-border m-0 text-6xl font-semibold leading-none border-solid">
                                    $29
                                </p>
                                <p class="box-border m-0 border-solid" style="border-image: initial;">
                                    / month
                                </p>
                            </div>
                            <ul class="flex-1 p-0 mt-4 ml-5 leading-7 text-gray-900 border-0 border-gray-200">
                                <li class="inline-flex items-center block w-full mb-2 ml-5 font-semibold text-left border-solid">
                                    <svg class="w-5 h-5 mr-2 font-semibold leading-7 text-emerald-400 sm:h-5 sm:w-5 md:h-6 md:w-6"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                        </path>
                                    </svg>
                                    15 Websites
                                </li>
            
                                <li class="inline-flex items-center block w-full mb-2 ml-5 font-semibold text-left border-solid">
                                    <svg class="w-5 h-5 mr-2 font-semibold leading-7 text-emerald-400 sm:h-5 sm:w-5 md:h-6 md:w-6"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                        </path>
                                    </svg>
                                    SSL (HTTPS)
                                </li>
            
                                <li class="inline-flex items-center block w-full mb-2 ml-5 font-semibold text-left border-solid">
                                    <svg class="w-5 h-5 mr-2 font-semibold leading-7 text-emerald-400 sm:h-5 sm:w-5 md:h-6 md:w-6"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                        </path>
                                    </svg>
                                    Custom Domain
                                </li>
            
                                <li class="inline-flex items-center block w-full mb-2 ml-5 font-semibold text-left border-solid">
                                    <svg class="w-5 h-5 mr-2 font-semibold leading-7 text-emerald-400 sm:h-5 sm:w-5 md:h-6 md:w-6"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                        </path>
                                    </svg>
                                    SiteFast Branding Removal
                                </li>
                            </ul>
            
                            <a href="#"
                                class="inline-flex justify-center w-full px-4 py-3 mt-8 font-sans text-sm leading-none text-center text-white no-underline bg-emerald-400 border rounded-md cursor-pointer hover:bg-emerald-400 hover:border-emerald-400 hover:text-white focus-within:bg-emerald-400 focus-within:border-emerald-400 focus-within:text-white sm:text-base md:text-lg">
                                Millorar Plan
                            </a>
                        </div>
                        <!-- Price 3 -->
                        <div
                            class="relative z-10 flex flex-col items-center max-w-md p-4 mx-auto my-0 border border-solid rounded-lg lg:-ml-3 sm:my-0 sm:p-6 md:my-8 md:p-8">
                            <h3
                                class="m-0 text-2xl font-semibold leading-tight tracking-tight text-black border-0 border-gray-200 sm:text-3xl md:text-4xl">
                                Plus
                            </h3>
                            <div class="flex items-end mt-6 leading-7 text-gray-900 border-0 border-gray-200">
                                <p class="box-border m-0 text-6xl font-semibold leading-none border-solid">
                                    $49
                                </p>
                                <p class="box-border m-0 border-solid" style="border-image: initial;">
                                    / month
                                </p>
                            </div>
            
                            <ul class="flex-1 p-0 mt-4 leading-7 text-gray-900 border-0 border-gray-200">
                                <li class="inline-flex items-center block w-full mb-2 ml-5 font-semibold text-left border-solid">
                                    <svg class="w-5 h-5 mr-2 font-semibold leading-7 text-emerald-400 sm:h-5 sm:w-5 md:h-6 md:w-6"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                        </path>
                                    </svg>
                                    50 Websites
                                </li>
            
                                <li class="inline-flex items-center block w-full mb-2 ml-5 font-semibold text-left border-solid">
                                    <svg class="w-5 h-5 mr-2 font-semibold leading-7 text-emerald-400 sm:h-5 sm:w-5 md:h-6 md:w-6"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                        </path>
                                    </svg>
                                    SSL (HTTPS)
                                </li>
            
                                <li class="inline-flex items-center block w-full mb-2 ml-5 font-semibold text-left border-solid">
                                    <svg class="w-5 h-5 mr-2 font-semibold leading-7 text-emerald-400 sm:h-5 sm:w-5 md:h-6 md:w-6"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                        </path>
                                    </svg>
                                    Custom Domain
                                </li>
            
            
                                <li class="inline-flex items-center block w-full mb-2 ml-5 font-semibold text-left border-solid">
                                    <svg class="w-5 h-5 mr-2 font-semibold leading-7 text-emerald-400 sm:h-5 sm:w-5 md:h-6 md:w-6"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                        </path>
                                    </svg>
                                    SiteFast Branding Removal
                                </li>
            
            
                                <li class="inline-flex items-center block w-full mb-2 ml-5 font-semibold text-left border-solid">
                                    <svg class="w-5 h-5 mr-2 font-semibold leading-7 text-emerald-400 sm:h-5 sm:w-5 md:h-6 md:w-6"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                        </path>
                                    </svg>
                                    Google Analytics
                                </li>
            
                                <li class="inline-flex items-center block w-full mb-2 ml-5 font-semibold text-left border-solid">
                                    <svg class="w-5 h-5 mr-2 font-semibold leading-7 text-emerald-400 sm:h-5 sm:w-5 md:h-6 md:w-6"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                        </path>
                                    </svg>
                                    Email Integration
                                </li>
            
                            </ul>
                            <a href="#"
                                class="inline-flex justify-center w-full px-4 py-3 mt-8 font-sans text-sm leading-none text-center text-emerald-400 no-underline bg-transparent border border-emerald-400 rounded-md cursor-pointer hover:bg-emerald-400 hover:border-emerald-400 hover:text-white focus-within:bg-emerald-400 focus-within:border-emerald-400 focus-within:text-white sm:text-base md:text-lg">
                                Millorar Plan
                            </a>
            
                        </div>
                    </div>
                </div>    
            </div>
        </section>
    </x-app-layout>
</body>
</html>