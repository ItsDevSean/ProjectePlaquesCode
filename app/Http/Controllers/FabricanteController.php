<?php

namespace App\Http\Controllers;

use App\Models\Fabricante;
use Illuminate\Http\Request;

class FabricanteController extends Controller
{
    public function index()
    {
        $fabricantes = Fabricante::all();
        return view('inversores', compact('inversores', 'fabricantes'));
    }

    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:100|unique:fabricantes,nombre',
    ]);

    $fabricante = Fabricante::create($request->all());

    return response()->json([
        'success' => true,
        'fabricante' => $fabricante
    ]);
}
}
