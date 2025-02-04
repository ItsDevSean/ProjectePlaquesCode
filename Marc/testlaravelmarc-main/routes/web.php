<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PrimerControlador;
use App\Http\Controllers\UserPost;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserAccesDashboardMiddleware;
use Illuminate\Auth\Events\Verified;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


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

Route::group(['middleware' => ['auth','verified',UserAccesDashboardMiddleware::class]], function () {
Route::resources([
    'user' => App\Http\Controllers\UserPost::class
]);
});


Route::group( ['prefix'=>'index'],function () {
    Route::get('', [IndexController::class,'index'] )->name('index');
});


Route::group( ['prefix'=>'show'],function () {
    Route::get('', [IndexController::class,'index'] )->name('index');
});

Route::get('/vue', function(){
    return view('vue');
});
