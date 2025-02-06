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
            position: relative;
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
        .input-container {
            display: flex;
            align-items: center;
            margin: 10px;
        }
        .input-container label, .input-container input, .input-container button {
            margin-right: 10px;
        }
        .input-container input {
            height: 30px; 
        }
        .input-container button {
            background-color: #4CAF50; 
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
            transition-duration: 0.4s;
            height: 50px; 
        }
        .input-container button:hover {
            background-color: white;
            color: black;
            border: 2px solid #4CAF50;
        }
    </style>

    <div class="container">
        <h1>Mapa Interactivo</h1>
        <div id="map"></div> <!-- Renderizamos el mapa -->
    </div>

    <!-- Hacemos un pequeño formulari para ofrecer una busqueda en el mapa por lat y long: -->
    <div class="container">
        <div class="input-container">
            <label for="lat">Latitud:</label>
            <input type="text" id="lat-input" name="lat">
            <label for="lng">Longitud:</label>
            <input type="text" id="lng-input" name="lng">
            <button id="search">Buscar</button>
        </div>
    </div>

    <x-coordenadas-lector />

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
                scaleControlOptions: {
                    position: google.maps.ControlPosition.LEFT_BOTTOM // Posicionar el control de escala en la esquina inferior izquierda
                }
            });

            // Creamos un botón para alternar entre la vista de satélite y la vista estándar
            var controlDiv = document.createElement('div');
            var controlUI = document.createElement('div');
            controlUI.className = 'map-control';
            controlUI.title = 'Click para cambiar el tipo de mapa';
            controlUI.innerHTML = 'Cambiar Vista';
            controlDiv.appendChild(controlUI);

            // Añadimos el botón al mapa
            map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(controlDiv);

            // Añadimos un evento de clic al botón para alternar el tipo de mapa
            controlUI.addEventListener('click', function() {
                if (map.getMapTypeId() === 'roadmap') {
                    map.setMapTypeId('satellite');
                } else {
                    map.setMapTypeId('roadmap');
                }
            });

            // Añadimos funcionalidad de búsqueda
            document.getElementById('search').addEventListener('click', function() {
                var lat = parseFloat(document.getElementById('lat-input').value);
                var lng = parseFloat(document.getElementById('lng-input').value);
                if (!isNaN(lat) && !isNaN(lng)) {
                    map.setCenter({ lat: lat, lng: lng });
                } else {
                    alert('Por favor, introduce valores válidos para latitud y longitud.');
                }
            });

            // Actualizamos latitud y longitud conforme se mueve el ratón sobre el mapa
            map.addListener('mousemove', function(event) {
                document.getElementById('lat').innerText = event.latLng.lat().toFixed(6);
                document.getElementById('lng').innerText = event.latLng.lng().toFixed(6);
            });
        });
    </script>
</x-app-layout>