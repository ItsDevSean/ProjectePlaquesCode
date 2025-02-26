<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformacionElectricaPanel;

class InformacionElectricaPanelController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'potencia_maxima' => 'required|numeric|min:0',
            'tension_maxima_potencia' => 'required|numeric|min:0',
            'corriente_punto_maxima_potencia' => 'required|numeric|min:0',
            'tension_circuito_abierto' => 'required|numeric|min:0',
            'corriente_cortocircuito' => 'required|numeric|min:0',
            'eficencia_panel' => 'required|numeric|min:0|max:100',
            'coeficiente_temp_pmax' => 'required|numeric|min:0|max:100',
            'coeficiente_temp_voc' => 'required|numeric|min:0|max:100',
            'coeficiente_temp_isc' => 'required|numeric|min:0|max:100',
            
        ]);

        InformacionElectricaPanel::create($request->all());

        return response()->json(['message' =>'Datos guardados.']);

    }
}
