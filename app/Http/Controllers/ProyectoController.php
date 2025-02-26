<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importa Auth

class ProyectoController extends Controller
{
    public function index()
    {
        // Aquí estamos cargando la relación 'user' para cada proyecto
        $proyectos = Proyecto::with('user')->paginate(10);
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

        // Aquí se asigna el usuario logueado al proyecto
        Proyecto::create([
            'nombre' => $request->nombre,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
            'descripcion' => $request->descripcion,
            'user_id' => Auth::id(),  // Asigna el ID del usuario logueado
        ]);

        return redirect()->route('proyectos.index')->with('status', 'Proyecto creado con éxito');
    }

    public function show(Proyecto $proyecto)
    {
        // Accede al nombre del usuario asociado al proyecto
        $userName = $proyecto->user->name;
        return view('proyectos.show', compact('proyecto', 'userName'));
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

