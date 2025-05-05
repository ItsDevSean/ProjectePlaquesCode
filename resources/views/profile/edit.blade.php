<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                {{ __('Configuración de Perfil') }}
            </h2>
            
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto space-y-8">
            <!-- Sección de Información del Perfil -->
            @include('profile.partials.update-profile-information-form')

            <!-- Sección de Foto de Perfil -->
            @include('profile.partials.update-profile-photo-form')

            <!-- Sección de Seguridad -->
            @include('profile.partials.update-password-form')

            <!-- Sección de Eliminación de Cuenta -->
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>