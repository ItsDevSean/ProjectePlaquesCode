<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\infoEco;
class infoEcoController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'financiacion_disponible' => 'required|in:si,no',
            'condiciones_financiacion' => 'required|string',
            'subvenciones' => 'required|string',
            'proveedor' => 'required|string',
            'telefono_proveedor' => 'required|string|regex:/^[0-9]+$/',
            'email_proveedor' => 'required|email',
        ]);
    
    
        $data = $request->all();
        $data['financiacion_disponible'] = $request->financiacion_disponible === 'si' ? 1 : 0;
    
        infoEco::create($data);
    
        return response()->json(['message' => 'Datos guardados.']);
    }
    
    
}
