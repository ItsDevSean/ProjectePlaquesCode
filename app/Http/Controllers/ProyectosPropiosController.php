<?php

namespace App\Http\Controllers;
use App\Models\ProyectosPropios;
use Illuminate\Http\Request;

class ProyectosPropiosController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'asignado' => 'required|numeric|min:0',
            'estado' => 'required|boolean',
            'nombre_proyecto' => 'required|string',
            'cliente' => 'required|string',
            'tarifa' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'potencia_pico' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'pvp' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
        ]);

        ProyectosPropios::create($request->all());

        return response()->json(['message' =>'Datos guardados.']);

    }

}
