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
            <main>
            <h1>PAGINA DE REGISTRO</h1>
    @if (session('status'))
    <div class="card card-white">{{session('status')}}</div>
    @endif
    @include('error')
 
    <form action="{{ route('user.store') }}" method="POST">
        @csrf <!-- Token CSRF necesario -->
        
        <label for="title">TITULO</label>
        <input  class="form-control" type="text" name="title" id="title">

        <label for="slug">SLUG</label>
        <input  class="form-control" type="text" name="slug" id="slug">

        <label for="content">CONTENIDO</label>
        <textarea class="form-control" name="content" id="content"></textarea>

        <label for="category_id">CATEGORY</label>
        <select class="form-control" name="category_id" id="category_id">
            @foreach ($categories as $title => $id)
                <option value="{{ $title }}">{{ $id }}</option>
            @endforeach
        </select>

        <label for="description">DESCRIPTION</label>
        <textarea class="form-control" name="description" id="description"></textarea>

        <label for="Status">STATUS</label>
        <select class="form-control" name="status" id="status">
            <option value="no">No</option>
            <option value="yes">Yes</option>
        </select>

        <button type="submit" class="button button-primary">Enviar</button>
    </form>
        
            </main>
        </div>
    </body>
</html>
