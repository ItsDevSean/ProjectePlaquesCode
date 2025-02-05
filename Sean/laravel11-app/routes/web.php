<?php

use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\FirstController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/test', function () {
//     return view('test');
// });

// Route::get('/myamoreterno', function () {

//     $age = 20;
//     $data = ['name' => 'Seán', 'age' => $age];

//     return view('crud.index', $data);
// })->name('folder');

// Route::get('/screen1', function () {

//     $num_hobies = 2;
//     $data = ['name' => 'Seán', 'age' => $num_hobies];

//     return view('screen1', $data);
// })->name('screen1');


// Route::get('/screen2', function () {
//     return redirect()->route('screen1'); // Redirects to screen1
// })->name('screen2');

//Route::get('screen1', [FirstController::class, 'index']);
//Route::get('other/{post}/{other}', [FirstController::class, 'other']);
//Route::resource('post', FirstController::class);

Route::resource('post', PostController::class);