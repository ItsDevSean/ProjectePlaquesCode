<?php

namespace App\Http\Controllers;

use App\Models\Baterias;
use Illuminate\Http\Request;

class BateriasController extends Controller
{
    public function index()
    {
        $baterias = Baterias::all();            
        return view('baterias', compact('baterias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_bateria' => 'required|string|min:2|max:100',
            'coste' => 'required|numeric|min:0',
            'garantia_fabricante' => 'nullable|integer|min:0',
            'descripcion' => 'required|string|min:5',
            'id_referencia' => 'nullable|string|max:50',
            'capacidad' => 'required|integer|min:0',
            'fabricante' => 'required|integer|exists:fabricantes,id',
            'garantia_material' => 'nullable|integer|min:0',
            'imagen_bateria' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen_bateria')) {
            $data['imagen_bateria'] = $request->file('imagen_bateria')->store('baterias', 'public');
        }

        Baterias::create($data);

        return redirect()->route('baterias.index')->with('success', 'Batería creada correctamente.');
    }
}
