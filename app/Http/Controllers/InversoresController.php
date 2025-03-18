<?php

namespace App\Http\Controllers;

use App\Models\Inversores;
use App\Models\Fabricante;
use Illuminate\Http\Request;

class InversoresController extends Controller
{
    public function index()
    {    
        $inversores = Inversores::all();            
        $fabricantes = Fabricante::all(); 
    return view('inversores', compact('inversores', 'fabricantes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_inversor' => 'required|string|min:2|max:100',
            'eficiencia' => 'required|numeric|between:0,999.99',
            'tipo_instalacion' => 'required|string',
            'garantia_material' => 'nullable|integer|min:0',
            'potencia_nominal' => 'required|integer|min:1',
            'descripcion' => 'nullable|string|min:0',
            'fabricante_id' => 'required|integer|exists:fabricantes,id',
            'microinversor' => 'required|boolean',
            'garantia_fabricante' => 'required|integer|min:0',
            'imagen_inversor' => 'nullable|url|max:2048',
            'id_referencia' => 'nullable|string|max:50',
        ]);
        $data = $request->all();

        if ($request->has('imagen_inversor')) {
            $data['imagen_inversor'] = $request->input('imagen_inversor');
        }

        Inversores::create($data);

        return redirect()->route('inversores.index')->with('success', 'Inversor creado correctamente.');
    }
}