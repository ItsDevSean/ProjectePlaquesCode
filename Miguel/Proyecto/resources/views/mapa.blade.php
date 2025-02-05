<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mapa') }}
        </h2>
    </x-slot>

    <style>
        /* Estilamos el mapa */
        #map {
            height: 600px; 
            width: 100%;   
        }
        .map-control {
            background: white;
            border: 2px solid #fff;
            border-radius: 3px;
            box-shadow: 0 2px 6px rgba(0,0,0,.3);
            cursor: pointer;
            margin: 10px;
            padding: 10px;
            text-align: center;
        }
    </style>

    <div class="container">
        <h1>Mapa Interactivo</h1>
        <div id="map"></div> <!-- Renderizamos el mapa -->
    </div>

    <!-- Importamos la API de Google Maps -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXRR6-McZKLNKCEabMp2il2wrTTMakV84"></script>
    <script>
        // Esperamos que el DOM esté completamente cargado antes de ejecutar el script
        document.addEventListener('DOMContentLoaded', function () {
            // Inicializamos el mapa con una vista centrada en una latitud y longitud específicas
            var map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 40.19145865160104, lng: -1.6199891302842644 }, // Coordenadas específicas
                zoom: 13,
                mapTypeId: 'roadmap', // Vista estándar por defecto
                scaleControl: true, // Habilitamos control de escala
            });

            // Creamos botón para alternar entre vista satélite y vista estándar
            var controlDiv = document.createElement('div');
            var controlUI = document.createElement('div');
            controlUI.className = 'map-control';
            controlUI.title = 'Click para cambiar el tipo de mapa';
            controlUI.innerHTML = 'Cambiar Vista';
            controlDiv.appendChild(controlUI);

            // Añadimos el botón al mapa
            map.controls[google.maps.ControlPosition.TOP_RIGHT].push(controlDiv);

            // Añadimos un evento de clic al botón para alternar el tipo de mapa
            controlUI.addEventListener('click', function() {
                if (map.getMapTypeId() === 'roadmap') {
                    map.setMapTypeId('satellite');
                } else {
                    map.setMapTypeId('roadmap');
                }
            });
        });
    </script>
</x-app-layout>