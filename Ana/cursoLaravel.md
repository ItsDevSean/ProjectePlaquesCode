# Laravel

## Sección 2: Introducción a Laravel

### 11. Primeros pasos

- **Route**: Es la forma en que Laravel maneja las rutas de la aplicación. Las rutas son definidas en el archivo `routes/web.php` y se utilizan para redirigir a las vistas correspondientes.

- **View()**: Es una función que se utiliza para renderizar vistas en Laravel. Se utiliza para mostrar contenido en la pantalla.

- **.env**: Es un archivo de configuración que se utiliza para almacenar variables de entorno. Se utiliza para configurar la aplicación.
  - APP_ENV: El entorno de la aplicación (desarrollo, producción, etc.). Local , Testing, Production.

  - APP_DEBUG: Si la aplicación está en modo depuración (true o false).

### 12. Rutas: Introducción

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

#### Views

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

### 13. Modelo vista controlador

- **MVC**: Es un patrón de diseño de software que separa la aplicación en tres componentes: Modelo, Vista y Controlador.

  - **Modelo**: Es el componente que se encarga de la lógica de negocio de la aplicación. Se encarga de interactuar con la base de datos.

  - **Vista**: Es el componente que se encarga de la presentación de la aplicación. Se encarga de mostrar la información a los usuarios.

  - **Controlador**: Es el componente que se encarga de recibir las solicitudes de los usuarios y enviarlas al modelo para que se encargue de ellas.

### 14. Configurar la base de datos MySQL

(Opcional, depende del proyecto)

### 15. Configurar la base de datos en MAC

(No es necesario)

### 16. Artisan la línea de comandos

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

### 17. Crear dos rutas con nombre y vistas asociadas

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

### 18. Redirecciones

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

### 19. Directivas de blade: if y for

```php
<!-- resources/views/ejemplo.blade.php -->
@if($usuario == 'admin')
    <p>Bienvenido, Administrador.</p>
@elseif($usuario == 'editor')
    <p>Bienvenido, Editor.</p>
@else
    <p>Bienvenido, Usuario.</p>
@endif


<!-- resources/views/numeros.blade.php -->
<ul>
    @for($i = 1; $i <= 5; $i++)
        <li>Número {{ $i }}</li>
    @endfor
</ul>

```

### 20. Layout o vista maestra

Es una plantilla base que se reutiliza en múltiples vistas del proyecto, permitiendo mantener una estructura común en todas las páginas.

**Blade**:define estos layouts. Permite el uso de secciones `(@section)` y rendimiento de contenido `(@yield)`, lo que facilita la personalización de cada vista secundaria.

---

_**Ejemplo de layout**_:

```php html
<!-- resources/views/layouts/app.blade.php -->

<body>
    <header>
        <h1>Mi Aplicación Laravel</h1>
        <nav>
            <a href="/">Inicio</a>
            <a href="/contacto">Contacto</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} - Todos los derechos reservados</p>
    </footer>
</body>
</html>

```

---

_**Crear una vista que herede el layout**_:

```php html
<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('title', 'Página de Inicio')

@section('content')
    <h2>Bienvenido a nuestra aplicación</h2>
    <p>Esta es la página principal de nuestro sitio.</p>
@endsection

```

---

_**Mostrar la vista en una ruta**_

```php
// routes/web.php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

```

Explicación:

- Laravel carga la vista home.blade.php, que extiende app.blade.php.

- La directiva @extends('layouts.app') indica que home.blade.php usa el layout definido en app.blade.php.

- En app.blade.php, la directiva @yield('content') se reemplaza con el contenido de @section('content') de home.blade.php.

- Laravel renderiza la vista final con la estructura completa y la muestra al usuario.

### 21. Controlador en laravel: Primeros pasos

#### Definición

Un controlador en Laravel es una clase que gestiona la lógica de las solicitudes HTTP. Se encarga de recibir peticiones, procesar datos y devolver respuestas a las vistas o APIs.

Los controladores permiten organizar mejor el código, evitando escribir toda la lógica dentro de las rutas (web.php).

Pueden:

- Procesar formularios
- Inyectar dependencias
- Devolver un JSON
- Heredar otras clases

#### Creación de un controlador

En el terminal, ejecuta el siguiente comando para crear un controlador:

```sh
php artisan make:controller ControladorNombre
```

Esto creará el archivo:
`app/Http/Controllers/ControladorNombre.php`

#### Ejemplo de controlador

```php
// app/Http/Controllers/ControladorNombre.php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ControladorNombre extends Controller
{
    public function index()
    {
        return view('home');
    }
}

```

#### Ruta para el controlador

```php
// routes/web.php
use App\Http\Controllers\ControladorNombre;
Route::get('/home', [ControladorNombre::class, 'index']);
```

#### Controlador con parametros

Archivo:`app/Http/Controllers/ControladorNombre.php`

```php
// app/Http/Controllers/ControladorNombre.php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\NombreModelo;
class ControladorNombre extends Controller
{
public function mostrarUsuario($id)
    {
        return "El ID del usuario es: " . $id;
    }
}

```

Archivo:`routes/web.php`

```php
Route::get('/usuario/{id}', [ControladorNombre::class, 'mostrarUsuario']);
```

### 22. Rutas tipo recurso

Las rutas de recurso en Laravel son una forma de definir automáticamente todas las rutas necesarias para un CRUD (Crear, Leer, Actualizar y Eliminar) de un recurso.

En lugar de definir manualmente cada ruta (GET, POST, PUT, DELETE), Laravel permite usar Route::resource() para generarlas todas de una vez.

#### Ejemplo

```php
// routes/web.php
Route::resource('producto', 'ControladorNombre');
```

Para ver las rutas generadas, puedes usar el comando `php artisan route:list` en la terminal.

 Esto generará automáticamente las siguientes rutas:

| Método HTTP | URL                     | Acción en el Controlador | Propósito                     |
|------------|-------------------------|-------------------------|-------------------------------|
| `GET`      | `/productos`             | `index`                 | Mostrar todos los productos  |
| `GET`      | `/productos/create`      | `create`                | Mostrar formulario para crear |
| `POST`     | `/productos`             | `store`                 | Guardar nuevo producto       |
| `GET`      | `/productos/{id}`        | `show`                  | Mostrar un solo producto     |
| `GET`      | `/productos/{id}/edit`   | `edit`                  | Mostrar formulario para editar |
| `PUT/PATCH`| `/productos/{id}`        | `update`                | Actualizar producto         |
| `DELETE`   | `/productos/{id}`        | `destroy`               | Eliminar producto           |

#### Limitar las rutas de un recurso

Solo algunas rutas:

```php

Route::resource('productos', ProductoController::class)->only(['index', 'show']);

```

Excluir algunas rutas:

```php

    Route::resource('productos', ProductoController::class)->except(['create', 'edit']);

```

### 23. Parámetros en las rutas

Los parámetros en las rutas se pueden definir de varias maneras.

#### Parámetros obligatorios

```php
// routes/web.php
Route::get('/producto/{id}', 'ControladorNombre@metodo');
```
