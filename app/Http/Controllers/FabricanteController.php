<?php

namespace App\Http\Controllers;

use App\Models\Fabricante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FabricanteController extends Controller
{
    public function index()
    {
   
        $fabricantes = Fabricante::where('user_id', Auth::id())->get();
        return view('inversores', compact('fabricantes'));
    }

    public function getFabricate($id) {
        $fabricante = Fabricante::where('user_id', Auth::id())
        ->where("id", $id)
        ->get();
        return view('panels.detail', compact('fabricante'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:fabricantes,nombre',
        ]);

      
        $data = $request->all();
        $data['user_id'] = Auth::id();

        $fabricante = Fabricante::create($data);

        return response()->json([
            'success' => true,
            'fabricante' => $fabricante
        ]);
    }
}
