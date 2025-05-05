<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('build/css/header.css') }}">
<script src="//unpkg.com/alpinejs"></script>

<nav x-data="{navigationMenuOpen: false, navigationMenu: '', navigationMenuCloseDelay: 200, navigationMenuCloseTimeout: null}" 
     class="sticky top-0 z-50 w-full bg-[#34495E] shadow-md border-b border-gray-700 z-[9999]">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo and Left Menu -->
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}" class="flex items-center">
                        <img id="logo" src="{{ asset('img/logo.png')}}" alt="Logo" class="h-12 w-auto">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-1 ml-10">
                    <x-nav-link :href="route('proyectos')" :active="request()->routeIs('proyectos')" 
                        class="px-3 py-2 rounded-md text-sm font-medium text-white hover:!text-emerald-300 transition-colors duration-200">
                 {{ __('Inicio') }}
             </x-nav-link>
             
             <x-nav-link :href="route('preus')" :active="request()->routeIs('preus')" 
                        class="px-3 py-2 rounded-md text-sm font-medium text-white hover:!text-emerald-300 transition-colors duration-200">
                 {{ __('Planes') }}
             </x-nav-link>

                    <!-- Tools Dropdown -->
                    <div class="relative" 
                         @mouseenter="navigationMenuOpen = true; navigationMenu = 'learn-more'" 
                         @mouseleave="navigationMenuOpen = false; navigationMenu = ''">
                        <button class="flex items-center px-3 pt-0 pb-1 rounded-md text-sm font-medium text-white hover:text-emerald-300 hover:bg-[#2C3E50] transition-colors duration-200 ">
                            <span>Herramientas</span>
                            <svg class="ml-1 h-4 w-4 transition-transform duration-200" 
                                 :class="{ 'rotate-180': navigationMenuOpen }" 
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="navigationMenuOpen" 
                             x-transition:enter="transition ease-out duration-200" 
                             x-transition:enter-start="opacity-0 translate-y-1" 
                             x-transition:enter-end="opacity-100 translate-y-0" 
                             x-transition:leave="transition ease-in duration-150" 
                             x-transition:leave-start="opacity-100 translate-y-0" 
                             x-transition:leave-end="opacity-0 translate-y-1" 
                             class="absolute left-0 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
                             @mouseenter="navigationMenuOpen = true"
                             @mouseleave="navigationMenuOpen = false">
                             <div class="py-1">
                                <a href="{{ route('panels') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-teal-50 hover:to-emerald-50 hover:text-teal-600 transition-all duration-200 flex items-center">
                                    <i class="fas fa-solar-panel mr-3 text-teal-500"></i>
                                    <div>
                                        <div class="font-medium">Paneles</div>
                                        <div class="text-xs text-gray-500">Crear/Editar paneles</div>
                                    </div>
                                </a>
                                <a href="{{ route('baterias.index') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-teal-50 hover:to-emerald-50 hover:text-teal-600 transition-all duration-200 flex items-center">
                                    <i class="fas fa-battery-three-quarters mr-3 text-teal-500"></i>
                                    <div>
                                        <div class="font-medium">Baterías</div>
                                        <div class="text-xs text-gray-500">Crear/Editar baterías</div>
                                    </div>
                                </a>
                                <a href="{{ route('inversores.index') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-teal-50 hover:to-emerald-50 hover:text-teal-600 transition-all duration-200 flex items-center">
                                    <i class="fas fa-bolt mr-3 text-teal-500"></i>
                                    <div>
                                        <div class="font-medium">Inversores</div>
                                        <div class="text-xs text-gray-500">Crear/Editar inversores</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Menu -->
            <div class="flex items-center">
                <!-- New Project Button -->
                <div class="hidden md:block mr-4">
                    <button id="loadProjectBtn" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-emerald-500 to-teal-600 border border-transparent rounded-md font-medium text-white shadow-sm hover:from-emerald-600 hover:to-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all duration-200">
                        <i class="fas fa-sun mr-3 text-lg"></i> {{ __('Nuevo Proyecto') }}
                    </button>
                </div>

                <!-- User Dropdown -->
                <div class="relative ml-3">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center max-w-xs rounded-full text-sm  transition-all duration-200">
                                <span class="sr-only">Open user menu</span>
                                <div class="text-white font-medium mr-2">{{ Auth::user()->name }}</div>
                                @if(Auth::user()->profile_photo_path)
                                    <img id="imgid" src="{{ asset(Auth::user()->profile_photo_path) }}" 
                                        alt="{{ Auth::user()->name }}" 
                                        class="h-8 w-8 rounded-full object-cover border-2 border-emerald-400">
                                @else
                                    <div class="h-8 w-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                                        <i class="fas fa-user"></i>
                                    </div>
                                @endif
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" class="text-gray-700 hover:bg-emerald-50 hover:text-emerald-600">
                                <i class="fas fa-user-circle mr-2"></i> {{ __('Perfil') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" 
                                                class="text-gray-700 hover:bg-emerald-50 hover:text-emerald-600"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Cerrar sesión') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center ml-2">
                    <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-300 hover:text-white hover:bg-[#2C3E50] focus:outline-none focus:ring-2 focus:ring-inset focus:ring-emerald-500">
                        <span class="sr-only">Open main menu</span>
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-100" 
         x-transition:enter-start="transform opacity-0 scale-95" 
         x-transition:enter-end="transform opacity-100 scale-100" 
         x-transition:leave="transition ease-in duration-75" 
         x-transition:leave-start="transform opacity-100 scale-100" 
         x-transition:leave-end="transform opacity-0 scale-95" 
         class="md:hidden bg-[#34495E] shadow-lg rounded-b-lg">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <x-responsive-nav-link :href="route('proyectos')" :active="request()->routeIs('proyectos')" 
                                 class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-emerald-300 hover:bg-[#2C3E50]">
                {{ __('Inicio') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('preus')" :active="request()->routeIs('preus')" 
                                 class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-emerald-300 hover:bg-[#2C3E50]">
                {{ __('Planes') }}
            </x-responsive-nav-link>
            
            <!-- Mobile Tools Dropdown -->
            <div x-data="{ toolsOpen: false }" class="relative">
                <button @click="toolsOpen = !toolsOpen" 
                        class="flex items-center justify-between w-full px-3 py-2 rounded-md text-base font-medium text-white hover:text-emerald-300 hover:bg-[#2C3E50]">
                    <span>Herramientas</span>
                    <svg class="ml-1 h-5 w-5 transition-transform duration-200" 
                         :class="{ 'rotate-180': toolsOpen }" 
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                
                <div x-show="toolsOpen" 
                     x-transition:enter="transition ease-out duration-100" 
                     x-transition:enter-start="transform opacity-0 scale-95" 
                     x-transition:enter-end="transform opacity-100 scale-100" 
                     x-transition:leave="transition ease-in duration-75" 
                     x-transition:leave-start="transform opacity-100 scale-100" 
                     x-transition:leave-end="transform opacity-0 scale-95" 
                     class="pl-4 space-y-1">
                    <a href="{{ route('panels') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-200 hover:text-emerald-300 hover:bg-[#2C3E50]">
                        Paneles
                    </a>
                    <a href="{{ route('baterias.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-200 hover:text-emerald-300 hover:bg-[#2C3E50]">
                        Baterías
                    </a>
                    <a href="{{ route('inversores.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-200 hover:text-emerald-300 hover:bg-[#2C3E50]">
                        Inversores
                    </a>
                </div>
            </div>
            
            <x-responsive-nav-link :href="route('dades')" :active="request()->routeIs('dadesClient')" 
                                 class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700">
                <i class="fas fa-plus mr-2"></i> {{ __('Nuevo Proyecto') }}
            </x-responsive-nav-link>
        </div>
        
        <!-- Mobile User Menu -->
        <div class="pt-4 pb-3 border-t border-gray-700">
            <div class="flex items-center px-5">
                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                    <i class="fas fa-user"></i>
                </div>
                <div class="ml-3">
                    <div class="text-base font-medium text-white">{{ Auth::user()->name }}</div>
                    <div class="text-sm font-medium text-gray-300">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <div class="mt-3 px-2 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" 
                                     class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-emerald-300 hover:bg-[#2C3E50]">
                    <i class="fas fa-user-circle mr-2"></i> {{ __('Perfil') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" 
                                         class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-emerald-300 hover:bg-[#2C3E50]"
                                         onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Cerrar sesión') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<script src="build/js/dades.js"></script>
<script>
    const loadProjectBtn = document.getElementById('loadProjectBtn');
    loadProjectBtn.addEventListener('click', function() {
        localStorage.setItem('shouldCheckForProject', 'true');
        window.location.href = "{{ asset('dades') }}";
    });
</script>
