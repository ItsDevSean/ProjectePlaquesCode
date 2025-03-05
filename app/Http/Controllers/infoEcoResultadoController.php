<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\infoEcoResultadoPanel;

class infoEcoResultadoController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'precio_modulo' => 'required|numeric|min:0',
            'descuento' => 'required|numeric|min:0|max:100',
            'precio_descuento' => 'required|numeric|min:0',
            'impuesto_aplicable' => 'nullable|integer|in:0,5,10,16,21',
            'precio_final' => 'required|numeric|min:0',
            'moneda' => 'required|string|in:USD,EUR,MXN,COP,ARS',
            'coste_envio' => 'required|numeric|min:0',
            'coste_instalacion' => 'required|numeric|min:0',
            'periodo_amortizacion' => 'required|numeric|min:0',
            'rentabilidad_esperada' => 'required|numeric|min:0|max:100',

            
        ]);

        infoEcoResultadoPanel::create($request->all());

        return response()->json(['message' =>'Datos guardados.']);

    }
}
