<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
});

Route::get('/myamoreterno', function () {

    $age = 20;
    $data = ['name' => 'Seán', 'age' => $age];

    return view('crud.index', $data);
})->name('folder');


