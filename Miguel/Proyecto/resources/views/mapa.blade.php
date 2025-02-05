<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mapa') }}
        </h2>
    </x-slot>

    <style>
        /* Estilos para mapa */
        #map {
            height: 600px; 
            width: 100%;   
        }
    </style>

    <div class="container">
        <h1>Mapa Interactivo</h1>
        <div id="map"></div> <!-- Renderizamos el mapa -->
    </div>

    <!-- Importamos una API (creada por nosotros) de Google Maps -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXRR6-McZKLNKCEabMp2il2wrTTMakV84"></script>
    <script>
        // esperamos que DOM esté completamente cargado antes de ejecutar el script
        document.addEventListener('DOMContentLoaded', function () {
            // Una vez el dom cargado, inicializamos el mapa con una vista centrada en lat y lon que queramos:
            var map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 40.19145865160104, lng: -1.6199891302842644 },  // Marcamos donde queremos que aparezca al recargar la página
                zoom: 13 //E indicamos un zoom
            });
        });
    </script>
</x-app-layout>