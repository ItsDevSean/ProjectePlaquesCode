<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-gray-100 to-gray-200 dark:bg-gradient-to-br dark:from-gray-900 dark:to-gray-800">
    <div class="min-h-screen flex items-center justify-center py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
            <div class="px-10 py-12">
                <div class="flex justify-center mb-8">
                    <a href="/" class="inline-block">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-20 h-20 md:w-20 md:h-20">
                    </a>
                </div>
                <h2 class="mt-6 text-center text-3xl font-semibold text-gray-900 dark:text-white">
                    {{ __('Restablecer Contraseña') }}
                </h2>
                <p class="mt-3 text-center text-gray-600 dark:text-gray-400 text-sm">
                    {{ __('¿Has olvidado tu contraseña? No te preocupes, introduce tu correo electrónico y te enviaremos un enlace para crear una nueva.') }}
                </p>

                <x-auth-session-status class="mt-6 mb-4" :status="session('status')" />

                <form class="mt-8 space-y-6" method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="space-y-1">
                        <x-input-label for="email" :value="__('Correo Electrónico')" class="block text-sm font-medium text-gray-700 dark:text-gray-300" />
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            <x-text-input id="email" name="email" type="email" autocomplete="email" required class="appearance-none block w-full pl-10 px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 rounded-md focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 transition duration-150 ease-in-out sm:text-sm sm:leading-5" placeholder="{{ __('tu.correo@ejemplo.com') }}" value="{{ old('email') }}" autofocus />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600 dark:text-red-400" />
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 dark:bg-emerald-500 dark:hover:bg-emerald-600 dark:focus:ring-emerald-400 transition duration-150 ease-in-out">
                            <svg class="-ml-1 mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                            {{ __('Enviar enlace de restablecimiento') }}
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center text-sm">
                    <p class="text-gray-500 dark:text-gray-400">
                        {{ __('¿Has recordado tu contraseña?') }}
                        <a href="{{ route('login') }}" class="font-medium text-emerald-600 hover:text-emerald-500 dark:text-emerald-500 dark:hover:text-emerald-400 focus:outline-none focus:underline transition ease-in-out duration-150">
                            {{ __('Iniciar sesión') }}
                        </a>
                    </p>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-900 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <p class="text-xs text-gray-500 dark:text-gray-400 text-center sm:text-left">
                    {{ __('Protegido por reCAPTCHA y sujeto a la Política de privacidad y los Términos de servicio de Google.') }}
                </p>
            </div>
        </div>
    </div>
</body>
</html>