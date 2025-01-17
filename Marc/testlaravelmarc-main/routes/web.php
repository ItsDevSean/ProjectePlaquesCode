<?php

use App\Http\Controllers\PrimerControlador;
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

Route::get('/hola', function () {
    return view('home');
});

Route::get('/Abdul', function () {
    $mensajito = "HOLA MUY BUENAS";
    $data = ['mensaje' => $mensajito,'respuesta'=> 'hola'];
    return view('Crud/index', $data);   
}) ->name('Crudy');

Route::get('/contact', function () {
    $data = ['nombre' => 'Alberto', 'apellido' =>'chicote'];
    return view('contact',$data);
})->name('contacto');

Route::get('/contact2', function () {
    return view('contact2');
})->name('contacto2');

Route::get('testeo', [PrimerControlador::class,'index'] );

Route::get('otro/{post}', [PrimerControlador::class,'otro'] );