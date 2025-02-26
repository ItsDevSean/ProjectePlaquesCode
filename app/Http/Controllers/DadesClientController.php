<?php

namespace App\Http\Controllers;
use App\Models\DadesClient;
use Illuminate\Http\Request;

class DadesClientController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'nombre' => 'required|string',
            'email' => 'required|string',
            'telefono' => 'required|numeric|min:0',
            'direccion' => 'required|string',
            'ciudad' => 'required|string',
            'codigo_postal' => 'nullable|numeric|min:0',
        ]);

        dadesclient::create($request->all());

        return response()->json(['message' =>'Datos guardados.']);

    }
}
