<?php

namespace App\Http\Controllers;
use App\Models\Baterias;
use Illuminate\Http\Request;

class BateriasController extends Controller
{
    public function index()
    {
        $baterias = Baterias::all();            

        return view('baterias', compact('baterias', 'baterias'));    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_bateria' => 'required|string|min:2|max:100',
            'coste' => 'required|string|min:2|max:100',
            'garantia_fabricante' => 'required|string|min:2|max:50',
            'descripcion' => 'required|date',
            'id_referencia' => 'required|integer',
            'capacidad' => 'required|integer',
            'fabricante' => 'required|numeric|min:0',
            'garantia_material' => 'required|numeric|min:0',
            'imagen_bateria' => 'required|numeric|min:0',

        ]);

        Baterias::create($request->all());

        return to_route('baterias');    
    }
}
