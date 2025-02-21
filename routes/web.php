<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/web', function(){
    return view('webxr');
});

require __DIR__.'/auth.php';

Route::get('/mapa', function () {
    return view('map');
})->name('map');

Route::get('/open', function () {
    return view('opencv');
})->name('open');


Route::get('/web', function () {
    return view('webXREjemplo');
})->name('web');

Route::get('/edificis', function () {
    return view('editarEdificis');
})->name('edificis');

Route::get('/vue', function(){
    return view('vue');
});

Route::get('/herramientas/paneles', function(){
    return view('tools.panels');
})->name('panels');