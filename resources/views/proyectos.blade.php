<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="build/css/styles.css">

</head>
<body>
    <x-app-layout>    
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        @if (session('status'))
                            <div class="p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        <h2>Projectes creats</h2>
    
                        <table class="tabla min-w-full divide-y">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Usuario</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nombre Proyecto</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($proyectos as $proyecto)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $proyecto->user?->name ?? 'Usuario no disponible' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $proyecto->nombre }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('proyectos.edit', $proyecto->id) }}" class="text-green-600 hover:text-green-900 mr-3">Editar</a>
                                            <form action="{{ route('proyectos.destroy', $proyecto->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <div class="mt-6">
                            {{ $proyectos->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
    
</body>
</html>