<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('build/css/header.css') }}">
<script src="//unpkg.com/alpinejs"></script>
  <nav x-data="{navigationMenuOpen: false,navigationMenu: '',navigationMenuCloseDelay: 200,navigationMenuCloseTimeout: null,navigationMenuLeave() {let that = this;this.navigationMenuCloseTimeout = setTimeout(() => {that.navigationMenuClose();}, this.navigationMenuCloseDelay);},navigationMenuReposition(navElement) {this.navigationMenuClearCloseTimeout();this.$refs.navigationDropdown.style.left = navElement.offsetLeft + 'px';this.$refs.navigationDropdown.style.marginLeft = (navElement.offsetWidth/2) + 'px';},navigationMenuClearCloseTimeout(){clearTimeout(this.navigationMenuCloseTimeout);},navigationMenuClose(){this.navigationMenuOpen = false;this.navigationMenu = '';}}"class="relative z-10 w-auto bg-[#34495E] border-b border-gray-200 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}">

                        <img id="logo" src="{{ asset('img/logo.png')}}" alt="foto" class="h-10">

                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('proyectos')" :active="request()->routeIs('proyectos')" class="itemsHeader">
                        {{ __('Inici') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('preus')" :active="request()->routeIs('preus')" class="itemsHeader">
                        {{ __('Plans') }}
                    </x-nav-link>
                </div>


                <!-- Tools Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6 relative"> <!-- Añade relative aquí -->
                <!-- Botón del menú -->
                <button 
                    :class="{ 'navigationMenu': 'learn-more', : navigationMenu!='learn-more' }" 
                    @mouseover="navigationMenuOpen=true; navigationMenuReposition($el); navigationMenu='learn-more'" 
                    @mouseleave="navigationMenuLeave()" 
                    class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors rounded-md focus:outline-none disabled:opacity-50 disabled:pointer-events-none group w-max text-white relative z-[1003]"> <!-- Añade z-[1003] aquí -->
                    <span>Herramientas</span>
                    <div class="ms-1">
                        <svg :class="{ '-rotate-180' : navigationMenuOpen==true && navigationMenu == 'learn-more' }" class="relative top-[1px] ml-1 h-3 w-3 ease-out duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <polyline points="6 9 12 15 18 9"></polyline>
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>

                <!-- Menú desplegable -->
                <div 
                    x-ref="navigationDropdown" 
                    x-show="navigationMenuOpen"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="opacity-0 scale-90"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-90"
                    @mouseover="navigationMenuClearCloseTimeout()" 
                    @mouseleave="navigationMenuLeave()"
                    class="absolute top-0 pt-3 duration-200 ease-out -translate-x-1/2 translate-y-11 z-[1003]" 
                    x-cloak
                    style="position: absolute; z-index: 1003;"> <!-- Asegúrate de que tenga position: absolute -->
                    <div class="flex justify-center w-auto h-auto overflow-visible bg-white border rounded-md shadow-sm border-neutral-200/70 z-[1003]">
                        <!-- Contenido del menú -->
                        <div x-show="navigationMenu == 'learn-more'" class="flex items-stretch justify-center w-full p-6 z-[1003]">
                            <div class="w-72">
                                <a href="{{ route('panels') }}" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100 z-[1003]">
                                    <span class="block mb-1 font-medium text-black">Paneles</span>
                                    <span class="block font-light leading-5 opacity-50">Crear/Editar paneles</span>
                                </a>
                                <a href="{{ route('baterias') }}" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100 z-[1003]">
                                    <span class="block mb-1 font-medium text-black">Baterias</span>
                                    <span class="block font-light leading-5 opacity-50">Crear/Editar baterias</span>
                                </a>
                                <a href="{{ route('inversores.index') }}" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-neutral-100 z-[1003]">
                                    <span class="block mb-1 font-medium text-black">Inversores</span>
                                    <span class="block leading-5 opacity-50">Crear/Editar inversores</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                   
                    <a href="{{ asset('dades') }}" class="hover:no-underline focus:outline-none focus:ring-0">

                        <button class="px-4 py-2 bg-[#49DBA3] text-white rounded-lg shadow-lg hover:bg-[#36B89A] transition-all duration-300">
                            <i class="fas fa-plus"></i> {{ __(' Nuevo Proyecto') }}
                        </button>
                    </a>
                </div>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-[#34495E] hover:bg-[#2C3E50] focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">

                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />

                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')"
                            class="text-gray-700 hover:bg-[#49DBA3] hover:text-black">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                class="text-gray-700 hover:bg-[#49DBA3] hover:text-black"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">

                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden transition-all duration-300 ease-in-out transform origin-top" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                class="text-gray-700 hover:bg-[#49DBA3] hover:text-white">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('proyectos')" :active="request()->routeIs('proyectos')">
                {{ __('Inici') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('preus')" :active="request()->routeIs('preus')">
                {{ __('Plans') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('open')" :active="request()->routeIs('open')">
                {{ __('OpenCV') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('dades')" :active="request()->routeIs('dadesClient')" class="hover:no-underline">
                <button class="px-4 py-2 bg-emerald-400 text-white rounded-lg border-spacing-6 shadow-lg hover:bg-[#193849] transition-all duration-300">
                    <i class="fas fa-plus"></i> {{ __(' Nuevo Proyecto') }}
                </button>
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')"
                    class="text-gray-700 hover:bg-[#49DBA3] hover:text-white">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        class="text-gray-700 hover:bg-[#49DBA3] hover:text-white"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>