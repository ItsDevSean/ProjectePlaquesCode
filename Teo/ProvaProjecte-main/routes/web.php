<?php

use App\Http\Controllers\PrimerControlador;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
});

Route::get('/crud', function () {
    $age = 19;
    $data = ['name' => 'Teo', 'age' => $age];
    return view('crud/index', $data);
})->name('crud');// S'assigna un nom a aquesta ruta, el que permet cridar-la
                // més fàcilment en altres parts de l'aplicació utilitzant
                // l'ajudant {{ route('crud') }} per generar l'URL.


Route::get('/contact', function () {
    $data = ['name' => 'Teo'];
    return view('contact', $data);
})->name('contact');

Route::get('/contact2', function () {
    return redirect('/contact', 302);
    //Serveix per direccionar pagines, important ficar el 302
})->name('contact2');

Route::get('test2',[PrimerControlador::class,'index']);
Route::get('otro/{post?}/{otro?}',[PrimerControlador::class,'otro']);