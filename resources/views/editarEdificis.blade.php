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
                            <table class="edificis-table">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Adreça</th>
                                        <th>Accions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Exemple d'edifici (aquestes dades haurien de venir de la base de dades) -->
                                    <tr>
                                        <td>Edifici A</td>
                                        <td>Carrer de l'Exemple, 123</td>
                                        <td>
                                            <button class="btn-edit" onclick="editarEdifici(1)">Editar</button>
                                            <button class="btn-delete" onclick="esborrarEdifici(1)">Esborrar</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Edifici B</td>
                                        <td>Carrer del Sol, 456</td>
                                        <td>
                                            <button class="btn-edit" onclick="editarEdifici(2)">Editar</button>
                                            <button class="btn-delete" onclick="esborrarEdifici(2)">Esborrar</button>
                                        </td>
                                    </tr>
                                    <!-- Afegir més edificis dinàmicament -->
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <script>
            function editarEdifici(id) {
                // Redirigeix a la pàgina d'edició amb l'ID de l'edifici
                window.location.href = `editarEdifici.php?id=${id}`;
            }

            function esborrarEdifici(id) {
                // Confirmar l'acció d'esborrat
                if (confirm("Estàs segur de voler esborrar aquest edifici?")) {
                    // Aquí es faria una crida per esborrar el registre de la base de dades
                    alert(`Edifici amb ID ${id} esborrat.`);
                }
            }
        </script>
    </x-app-layout>
</body>
</html>
