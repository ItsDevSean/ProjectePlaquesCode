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
            'eficiencia' => 'required|string|min:2|max:100',
            'tipo_instalacion' => 'required|string',
            'garantia_material' => 'nullable|integer|min:0',
            'potencia_nominal' => 'required|integer|min:1',
            'descripcion' => 'required|string|min:5',
            'fabricante_id' => 'required|integer|exists:fabricantes,id',
            'microinversor' => 'required|boolean',
            'garantia_fabricante' => 'required|integer|min:0',
            'imagen_inversor' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_referencia' => 'nullable|string|max:50',
        ]);

        $data = $request->all();

        // Manejo de imagen si se sube
        if ($request->hasFile('imagen_inversor') && $request->file('imagen_inversor')->isValid()) {
            $file = $request->file('imagen_inversor');
            if ($file->getSize() > 0) {
                $data['imagen_inversor'] = $file->store('inversores', 'public');
            } else {
                $data['imagen_inversor'] = null; 
            }
        }

        Inversores::create($data);

        return redirect()->route('inversores.index')->with('success', 'Inversor creado correctamente.');
    }
}