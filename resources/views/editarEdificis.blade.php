<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Llistat d'Edificis</title>
    <link rel="stylesheet" href="build/css/styles.css">
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Llistat d\'Edificis') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <!-- Llistat d'Edificis -->
                        <div class="edificis-container">
                            <h3 class="form-title">Edificis Registrats</h3>
                            <table class="edificis-table" id="edificis-table">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Adreça</th>
                                        <th>Accions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Aquí s'afegiran les files dinàmicament -->
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>
</html>