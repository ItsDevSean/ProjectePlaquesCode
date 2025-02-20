<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dades del Client</title>
    <link rel="stylesheet" href="build/css/styles.css">
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Buscador de Direcció') }}
            </h2>
        </x-slot>
        <div class="container mt-4">
            <ul class="progressbar">
                <li data-url="dades" class=active>Dades Client</li>
                <li data-url="mapa">Seleccionar area</li>
                <li data-url="vista3.html">Pas 3</li>
            </ul>
            
        </div>
        <div class="client-form-container">
            <h2 class="client-form-title">Dades del Client</h2>
            <form action="" method="post">
                <label for="nombre" class="client-form-label">Nom Complet</label>
                <input type="text" class="client-form-input" id="nombre" name="nombre" placeholder="Exemple: Juan Pérez" required>

                <label for="email" class="client-form-label">Correu Electrònic</label>
                <input type="email" class="client-form-input" id="email" name="email" placeholder="Exemple: juan@gmail.com" required>

                <label for="telefono" class="client-form-label">Telèfon</label>
                <input type="tel" class="client-form-input" id="telefono" name="telefono" placeholder="Exemple: 600123456" required>

                <label for="direccion" class="client-form-label">Direcció</label>
                <input type="text" class="client-form-input" id="direccion" name="direccion" placeholder="Exemple: Carrer Major, 12" required>

                <label for="ciudad" class="client-form-label">Ciutat</label>
                <input type="text" class="client-form-input" id="ciudad" name="ciudad" placeholder="Exemple: Barcelona" required>

                <label for="codigo_postal" class="client-form-label">Codi Postal</label>
                <input type="text" class="client-form-input" id="codigo_postal" name="codigo_postal" placeholder="Exemple: 08001" required>

                <button type="submit" class="client-form-submit">Enviar</button>
            </form>
        </div>
        <script src="build/js/marcadors.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDu3ReEUVEQANj_h1EAtfe4-zyarcb3X04&libraries=places&callback=initMap"></script>
        <script src="https://solar.googleapis.com/v1/buildingInsights:findClosest?key=AIzaSyDu3ReEUVEQANj_h1EAtfe4-zyarcb3X04"></script>
    </x-app-layout>
</body>
</html>
