<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InformacionFisicaPanelController;
use App\Http\Controllers\InformacionElectricaPanelController;
use App\Http\Controllers\infoEcoController;
use App\Http\Controllers\DadesClientController;
use App\Http\Controllers\ProyectoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tools\SolarPanelsController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

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




Route::get('/edificis', function () {
    return view('editarEdificis');
})->name('edificis');

Route::get('/formulari', function () {
    return view('formulariProva');
})->name('formulari');


Route::get('/vue', function(){
    return view('vue');
});

Route::get('/herramientas/paneles', function(){
    return view('tools.panels');
})->name('panels');

Route::post('/herramientas/paneles/resultado', [SolarPanelsController::class, 'store'])->name('paneles.resultado');

Route::get('/dades', function(){
    return view('dadesClient');
})->name('dades');

Route::get('/preus', function(){
    return view('preus');
})->name('preus');

Route::get('/fisico', function(){
    return view('caracFisiPlac');
});

Route::get('/electrico', function(){
    return view('caracElecPlac');
});

Route::get('/infobasica', function(){
    return view('infoBasicPanel');
});

Route::get('/infoeco2', function(){
    return view('otraInfoEco');
});

Route::get('/infoadd', function(){
    return view('infoAdd');
});

Route::get('/condicionesop', function(){
    return view('condeOper');
});

Route::get('/certificaciones', function(){
    return view('certOp');
});

Route::get('/infoEco', function(){
    return view('infoEco');
});


Route::post('/guardar-informacionFisica', [InformacionFisicaPanelController::class, 'store'])->name('guardar.informacionFisica');

Route::post('/guardar-informacionElectrica', [InformacionElectricaPanelController::class, 'store'])->name('guardar.informacionElectrica');

Route::post('/guardar-dades', [DadesClientController::class, 'store'])->name('guardar.dades');

Route::resource('dades_clients', DadesClientController::class);

// En tu archivo de rutas
Route::get('/proyectos', [DadesClientController::class, 'index'])->name('proyectos');

Route::post('/guardar-eco', [infoEcoController::class, 'store'])->name('guardar.eco');


Route::get('/dades_clients/{id}/details', [DadesClientController::class, 'details'])->name('dades_clients.details');



