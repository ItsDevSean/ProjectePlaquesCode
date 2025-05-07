<?php

use App\Http\Controllers\BateriasController;
use App\Http\Controllers\ConsumptionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InformacionElectricaPanelController;
use App\Http\Controllers\infoEcoController;
use App\Http\Controllers\DadesClientController;
use App\Http\Controllers\infoEcoResultadoController;
use App\Http\Controllers\InversoresController;
use App\Http\Controllers\FabricanteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tools\SolarPanelsController;
use App\Models\ConsumptionModel;

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


// Ruta para mostrar el formulario de producción (GET)
Route::get('/produccio', [DadesClientController::class, 'produccio'])->name('produccio');


Route::get('/consum', [ConsumptionController::class, 'index'])->name('consum');

Route::post('/consum', [ConsumptionController::class, 'import'])->name('consumption');


Route::get('/vue', function(){
    return view('vue');
});

Route::get('/herramientas/paneles', [SolarPanelsController::class, 'index'])->name('panels');

Route::get('/herramientas/paneles/editar', [SolarPanelsController::class, 'edit'])->name('panelsEdit');

Route::get('/herramientas/paneles/importar', [SolarPanelsController::class, 'import'])->name('panelsImport');

Route::post('/herramientas/paneles/resultado', [SolarPanelsController::class, 'store'])->name('paneles.resultado');

Route::get('/herramientas/cositas', [SolarPanelsController::class, 'showForm'])->name('showImportForm');

Route::post('/herramientas/cositas', [SolarPanelsController::class, 'import'])->name('veureImport');

Route::post('/herramientas/paneles/fabricantes/{id}', [SolarPanelsController::class, 'getFabricate'])->name('veureFabricante');

Route::resource('baterias',BateriasController::class);

Route::resource('inversores', InversoresController::class);

Route::get('/dades', function(){
    return view('dadesClient');
})->name('dades');

Route::get('/preus', function(){
    return view('preus');
})->name('preus');


Route::get('/electrico', function(){
    return view('caracElecPlac');
});

Route::get('/infoeco2', function(){
    return view('otraInfoEco');
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

Route::prefix('proyecto/{id}/editar')->group(function () {
    Route::get('dadesclient', [DadesClientController::class, 'editDadesClient'])->name('proyecto.edit.dadesclient');
    Route::get('consum', [DadesClientController::class, 'editConsum'])->name('proyecto.edit.consum'); // ✅ CAMBIADO
    Route::get('mapa', [DadesClientController::class, 'editMapa'])->name('proyecto.edit.mapa'); // ✅ CAMBIADO
    Route::get('produccio', [DadesClientController::class, 'editProduccio'])->name('proyecto.edit.produccio');
    
    Route::put('dadesclient', [DadesClientController::class, 'updateDadesClient'])->name('proyecto.update.dadesclient');
    Route::put('consum', [DadesClientController::class, 'updateConsum'])->name('proyecto.update.consum');
    Route::put('mapa', [DadesClientController::class, 'updateMapa'])->name('proyecto.update.mapa');
    Route::put('produccio', [DadesClientController::class, 'updateProduccio'])->name('proyecto.update.produccio');
});

Route::post('/guardar-dades', action: [DadesClientController::class, 'store'])->name('guardar.dades');

Route::resource('dades_clients', DadesClientController::class);


Route::post('/fabricantes', [FabricanteController::class, 'store'])->name('fabricantes.store');

// En tu archivo de rutas
Route::get('/proyectos', [DadesClientController::class, 'index'])->name('proyectos');

Route::post('/guardar-eco', [infoEcoController::class, 'store'])->name('guardar.eco');

Route::post('/guardar-eco-resultado', [infoEcoResultadoController::class, 'store'])->name('guardar.eco.resultado');

Route::get('/dades_clients/{id}/details', [DadesClientController::class, 'showDetails'])->name('dades_clients.details');

Route::post('/proyectos/estado/{id}', [DadesClientController::class, 'updateEstado'])->name('proyectos.updateEstado');



Route::get('/infoProject', function(){
    return view('infoProject');
});

Route::get('/panelPlantilla', [App\Http\Controllers\PanelPlantilla::class, 'download'])->name('file.download');


