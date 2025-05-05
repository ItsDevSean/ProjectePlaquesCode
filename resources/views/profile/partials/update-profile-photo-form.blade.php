<section>
    <header class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
            {{ __('Foto de Perfil') }}
        </h2>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Actualiza la foto de tu perfil para personalizar tu cuenta.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update-photo') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="flex flex-col sm:flex-row items-center gap-6">
            <div class="shrink-0">
                @if (Auth::user()->profile_photo_path)
                    <img src="{{ asset(Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->name }}" class="w-24 h-24 rounded-full object-cover border-2 border-emerald-500">
                @else
                    <div class="w-24 h-24 rounded-full bg-gray-200 dark:bg-gray-700 border-2 border-emerald-500 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                @endif
            </div>

            <div class="flex-1 w-full">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Nueva foto de perfil') }}</label>
                <label for="profile_photo" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 border-emerald-300 dark:border-emerald-500/50 transition-colors duration-300">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-emerald-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="text-xs text-gray-500 dark:text-gray-400 text-center">
                            <span class="font-semibold text-emerald-600 dark:text-emerald-400">Haz clic para subir</span> o arrastra una imagen<br>
                            PNG, JPG o JPEG (MAX. 2MB)
                        </p>
                    </div>
                    <input id="profile_photo" name="profile_photo" type="file" class="hidden" accept="image/*">
                </label>
                <div class="mt-3 flex justify-center">
                    <img id="profile_photo_preview" class="hidden w-32 h-32 object-cover rounded-lg border-2 border-emerald-300 dark:border-emerald-500/50">
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <x-primary-button class="bg-emerald-600 hover:bg-emerald-700 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                {{ __('Guardar foto') }}
            </x-primary-button>

            @if (session('status') === 'profile-photo-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm text-emerald-600 dark:text-emerald-400"
                >{{ __('Foto de perfil actualizada correctamente.') }}</p>
            @endif
        </div>
    </form>

    @push('scripts')
    <script>
        // Preview image before upload
        document.getElementById('profile_photo').addEventListener('change', function(e) {
            const preview = document.getElementById('profile_photo_preview');
            const file = e.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                
                reader.readAsDataURL(file);
            }
        });
    </script>
    @endpush
</section>