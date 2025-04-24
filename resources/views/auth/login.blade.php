<x-guest-layout>
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900 p-4 sm:p-6 lg:p-8">
        <div class="w-full max-w-5xl bg-white dark:bg-gray-800 rounded-xl shadow-2xl overflow-hidden flex flex-col md:flex-row">

            <div class="w-full md:w-2/5 bg-gradient-to-br from-emerald-500 to-emerald-700 p-8 md:p-10 flex flex-col text-white">
                <div class="mb-10 flex justify-center">
                    <div class="p-4 bg-white bg-opacity-85 rounded-full shadow-lg">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-16 h-16 md:w-20 md:h-20">
                    </div>
                </div>
                {{-- Aumentamos margen inferior del texto principal --}}
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-bold mb-3">Control Solar Integral</h2>
                    <p class="text-emerald-100 text-lg">Gestión avanzada de instalaciones fotovoltaicas</p>
                </div>
                <div class="mt-auto space-y-4"> {{-- Añadimos space-y para los items inferiores --}}
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-white bg-opacity-25 flex items-center justify-center mr-3 shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <p class="text-sm text-emerald-50">Monitorización en tiempo real</p>
                    </div>
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-white bg-opacity-25 flex items-center justify-center mr-3 shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <p class="text-sm text-emerald-50">Datos 100% seguros y encriptados</p>
                    </div>
                </div>
            </div>

            {{-- Aumentamos significativamente el padding y ajustamos espacios --}}
            <div class="w-full md:w-3/5 p-8 sm:p-10 lg:p-12 flex flex-col justify-center">
                {{-- Aumentamos margen inferior del título --}}
                <h3 class="text-3xl font-semibold text-gray-800 dark:text-white mb-8 text-center">Acceso al Sistema</h3>

                {{-- Aumentamos el espacio entre elementos del formulario --}}
                <form class="space-y-6" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        {{-- Separamos un poco más el label del input --}}
                        <div class="flex items-center justify-between mb-2">
                            <x-input-label for="email" :value="__('Correo Electrónico')" class="text-base font-medium text-gray-700 dark:text-gray-300" />
                            {{-- Mostramos errores debajo del input para un look más limpio --}}
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            <x-text-input
                                id="email"
                                {{-- Aumentamos padding vertical y horizontal, y tamaño de fuente --}}
                                class="block w-full pl-11 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-base text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 dark:focus:ring-emerald-400 dark:focus:border-emerald-400 shadow-sm"
                                type="email"
                                name="email"
                                :value="old('email')"
                                required
                                autofocus
                                placeholder="tu.correo@ejemplo.com" {{-- Placeholder ayuda --}}
                            />
                        </div>
                         {{-- Error debajo del input --}}
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600 dark:text-red-400" />
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <x-input-label for="password" :value="__('Contraseña')" class="text-base font-medium text-gray-700 dark:text-gray-300" />
                             {{-- Mantenemos el link de forgot password aquí o lo movemos abajo --}}
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm text-emerald-600 hover:text-emerald-500 dark:text-emerald-400 dark:hover:text-emerald-300 font-medium">
                                    {{ __('¿Olvidaste la contraseña?') }}
                                </a>
                            @endif
                        </div>
                        <div class="relative">
                             <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                  <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <x-text-input
                                id="password"
                                {{-- Aumentamos padding vertical y horizontal, y tamaño de fuente --}}
                                class="block w-full pl-11 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-base text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 dark:focus:ring-emerald-400 dark:focus:border-emerald-400 shadow-sm"
                                type="password"
                                name="password"
                                required
                                placeholder="••••••••" {{-- Placeholder ayuda --}}
                            />
                        </div>
                        {{-- Error debajo del input --}}
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600 dark:text-red-400" />
                    </div>

                    {{-- Simplificamos esta sección, el forgot pass está arriba --}}
                    <div class="flex items-center text-sm">
                        <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 dark:border-gray-600 rounded dark:bg-gray-700 dark:focus:ring-offset-gray-800">
                        <label for="remember_me" class="ml-2 text-gray-700 dark:text-gray-300 font-medium">
                            {{ __('Recordar acceso en este equipo') }}
                        </label>
                    </div>


                    {{-- Aumentamos el padding superior y el tamaño/padding del botón --}}
                    <div class="pt-4">
                        <button class="w-full justify-center py-3 px-5 text-base font-semibold text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors duration-200 rounded-lg shadow-md">
                            {{ __('Acceder al Panel') }}
                        </button>
                    </div>
                </form>

                {{-- Aumentamos el margen superior --}}
                <div class="mt-8 text-center text-base">
                    <p class="text-gray-600 dark:text-gray-400">
                        ¿Aún no tienes cuenta?
                        <a href="{{ route('register') }}" class="font-semibold text-emerald-600 hover:text-emerald-500 dark:text-emerald-400 dark:hover:text-emerald-300 ml-1">
                            {{ __('Regístrate aquí') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>