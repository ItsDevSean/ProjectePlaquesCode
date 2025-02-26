<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function index()
    {
        $proyectos = Proyecto::paginate(10);
        return view('proyectos', compact('proyectos'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
            'descripcion' => 'nullable|string',
        ]);

        Proyecto::create($request->all());

        return redirect()->route('proyectos.index')->with('status', 'Proyecto creado con éxito');
    }

    public function show(Proyecto $proyecto)
    {
        return view('proyectos.show', compact('proyecto'));
    }

    public function edit(Proyecto $proyecto)
    {
        return view('proyectos.edit', compact('proyecto'));
    }

    public function update(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
            'descripcion' => 'nullable|string',
        ]);

        $proyecto->update($request->all());

        return redirect()->route('proyectos.index')->with('status', 'Proyecto actualizado con éxito');
    }

    public function destroy(Proyecto $proyecto)
    {
        $proyecto->delete();

        return redirect()->route('proyectos.index')->with('status', 'Proyecto eliminado con éxito');
    }
}

