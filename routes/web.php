<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InformacionFisicaPanelController;
use App\Http\Controllers\InformacionElectricaPanelController;
use App\Http\Controllers\DadesClientController;
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
    return view('mapaPrueva');
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

Route::get('/formulari', function () {
    return view('formulariProva');
})->name('formulari');


Route::get('/vue', function(){
    return view('vue');
});

Route::get('/dades', function(){
    return view('dadesClient');
})->name('dades');

Route::get('/fisico', function(){
    return view('caracFisiPlac');
});

Route::get('/electrico', function(){
    return view('caracElecPlac');
});

Route::post('/guardar-informacionFisica', [InformacionFisicaPanelController::class, 'store'])->name('guardar.informacionFisica');

Route::post('/guardar-informacionElectrica', [InformacionElectricaPanelController::class, 'store'])->name('guardar.informacionElectrica');

Route::post('/guardar-dades', [DadesClientController::class, 'store'])->name('guardar.dades');
