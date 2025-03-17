<?php

namespace App\Http\Controllers;
use App\Models\Inversores;
use Illuminate\Http\Request;

class InversoresController extends Controller
{
    public function index()
    {
        $inversores = Inversores::all();            

        return view('inversores', compact('inversores', 'inversores'));    }

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
            'nombre_inversor' => 'required|string|min:2|max:100',
            'eficencia' => 'required|string|min:2|max:100',
            'tipo_instalacion' => 'required|string',
            'garantia_material' => 'nullable|date',
            'potencia_nominal' => 'required|integer',
            'descripcion' => 'required|integer',
            'fabricante' => 'required|numeric|min:0',
            'microinversor' => 'required|numeric|min:0',
            'garantia_fabricante' => 'required|numeric|min:0',
            'imagen_inversor' => 'required|numeric|min:0',
            'id_referencia' => 'required|numeric|min:0',
        ]);

        Inversores::create($request->all());

        return to_route('inversores');    
    }
}
