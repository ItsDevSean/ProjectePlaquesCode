<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main class="p-8">
            <h1 class="text-3xl font-bold mb-6">Listado de Items</h1>

            @if (session('status'))
            <div class="p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg">
                {{ session('status') }}
            </div>
            @endif

            <a href="{{ route('user.create') }}" class="button button-primary mb-4 inline-block">Crear Formulario</a>

            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Category</th>
                        <th colspan="3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $u)
                    <tr>
                        <td>{{ $u->id }}</td>
                        <td>{{ $u->title }}</td>
                        <td>{{ $u->status }}</td>
                        <td>{{ $u->category_id }}</td>
                        <td>
                            <a href="{{ route('user.edit', $u->id) }}" class="button button-secondary">Editar</a>
                        </td>
                        <td>
                            <a href="{{ route('user.show', $u->id) }}" class="button button-primary">Mostrar</a>
                        </td>
                        <td>
                            <form action="{{ route('user.destroy', $u->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button button-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-6">
                {{ $user->links() }}
            </div>
        </main>
    </div>
</body>
</html>
