# Sección 2: Introducción a Laravel

## 11. Primeros pasos

- **Route**: Es la forma en que Laravel maneja las rutas de la aplicación. Las rutas son definidas en el archivo `routes/web.php` y se utilizan para redirigir a las vistas correspondientes.

- **View()**: Es una función que se utiliza para renderizar vistas en Laravel. Se utiliza para mostrar contenido en la pantalla.

- **.env**: Es un archivo de configuración que se utiliza para almacenar variables de entorno. Se utiliza para configurar la aplicación.
  - APP_ENV: El entorno de la aplicación (desarrollo, producción, etc.). Local , Testing, Production.

  - APP_DEBUG: Si la aplicación está en modo depuración (true o false).

## 12. Rutas: Introducción

```php
// Ejemplo de ruta
Route::get('/ruta', function () {
    return 'Hola mundo';
});

```

- **get()**: Es un método que se utiliza para definir una ruta GET.
- **/ruta**: Es la ruta que se define.
- **function()**: Es una función que se ejecuta cuando se accede a la ruta.
- **return 'Hola mundo';**: Es el contenido que se muestra en la pantalla cuando se accede a la ruta.
- **Route::**: Es el objeto que se utiliza para definir las rutas.
- **web.php**: Es el archivo donde se definen las rutas.

### Views

- **view()**: Es una función que se utiliza para renderizar vistas en Laravel.

---

Ejemplo para acceder a una carpeta dentro de la carpeta views:

```php

Route::get('/test', function () {
    return view('views/crud');
    });
```

---

Ejemplo para pasar datos a una vista:

```php
Route::get('/test', function () {
    $nombre = 'Juan';
    $edad = 25;
    return view('views/crud', compact('nombre', 'edad'));
    });
```

```html
<!-- views/crud.blade.php -->
    <h1>Nombre: {{ $nombre }}</h1>
    <h1>Edad: {{ $edad }}</h1>
```

---

Ejemplo pasar el nombre de la ruta:

```php
Route::get('/test', function () {
    $nombre = 'Juan';
    $edad = 25;
    return view('views/crud', compact('nombre', 'edad'));
    })->name('test');
```

```html
// En la vista
<a href="{{ route('test') }}">Ir a la ruta</a>
```

## 13. Modelo vista controlador

- **MVC**: Es un patrón de diseño de software que separa la aplicación en tres componentes: Modelo, Vista y Controlador.

  - **Modelo**: Es el componente que se encarga de la lógica de negocio de la aplicación. Se encarga de interactuar con la base de datos.

  - **Vista**: Es el componente que se encarga de la presentación de la aplicación. Se encarga de mostrar la información a los usuarios.

  - **Controlador**: Es el componente que se encarga de recibir las solicitudes de los usuarios y enviarlas al modelo para que se encargue de ellas.

## 14. Configurar la base de datos MySQL

(Opcional, depende del proyecto)

## 15. Configurar la base de datos en MAC

(No es necesario)

## 16. Artisan la línea de comandos

- **Artisan**: Es una herramienta de línea de comandos que viene incluida en Laravel. Se utiliza para realizar tareas como crear modelos, controladores, rutas, etc.

Los comandos más utilizados:

- `php artisan make:model Modelo` (Crear un modelo)
- `php artisan make:controller Controlador` (Crear un controlador)
- `php artisan make:migration CrearTabla` (Crear una migración)
- `php artisan migrate` (Ejecutar las migraciones)
- `php artisan db:seed` (Ejecutar las semillas de la base de datos)
- `php artisan route:list` (Listar las rutas de la aplicación)
- `php artisan serve` (Iniciar el servidor de desarrollo de Laravel)
- `php artisan key:generate` (Generar una clave de aplicación)

## Sección 3: Rutas, controladores y vistas

---

## 17. Crear dos rutas con nombre y vistas asociadas

```php
// En el archivo routes/web.php
Route::get('/contact', function () {
    $nombre = 'Juan';
    return view('contact', compact('nombre'));
})->name('contact');

Route::get('/contact2', function () {
    return view('contact2', compact('nombre', 'edad'));
})->name('contact2');
```

- En la carpeta views , crear dos archivos: `contact.blade.php` y `contact2.blade.php`

## 18. Redirecciones

- **Redirecciones**: Es una forma de enviar a un usuario a una ruta diferente de la que solicitó.

```php
// En el archivo routes/web.php

Route::get('/contact', function () {
    // return redirect('contact2', 301); // Redirección permanente
    return redirect()->route('contact2'); // Redirección con nombre de ruta
})->name('contact');

Route::get('/contact2', function () {
    return view('contact2', compact('nombre', 'edad'));
})->name('contact2');

```

## 19. Directivas de blade: if y for

```php
// En el archivo contact.blade.php
@if ($name != 'Ana')
    <p class="red">No eres Ana</p>
@else
    <p>Hola Ana</p>
@endif

<ul>
@foreach ([1, 2, 3, 4] as $item)
<li>{{ $item }}</li>
@endforeach
</ul>
```
