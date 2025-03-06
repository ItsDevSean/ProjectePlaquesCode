<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProyectoController extends Controller
{
    public function index()
{
    // Obtener solo los proyectos del usuario autenticado y paginar
    $proyectos = Proyecto::with('user', 'dadesClient')
                         ->where('user_id', Auth::id()) // Filtra solo los del usuario autenticado
                         ->paginate(10);

    return view('proyectos', compact('proyectos'));
}


    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
      
    
        // Validación de los campos
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

       
        Proyecto::create([
            'nombre' => $request->nombre,
            'user_id' => Auth::id(),
            'estado_id' => 1, 
        ]);

        return redirect()->route('proyectos.index')->with('status', 'Proyecto creado con éxito');
    }



    public function show(Proyecto $proyecto)
    {
        
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

    public function details($id)
{
    $proyecto = Proyecto::with(['user', 'dadesClient'])->find($id);

    if (!$proyecto) {
        return response()->json(['error' => 'Proyecto no encontrado'], 404);
    }

    // Verifica si 'dadesClient' existe antes de devolver los datos
    $dadesClient = $proyecto->dadesClient ? $proyecto->dadesClient : null;

    return response()->json([
        'proyecto' => $proyecto,
        'dadesClient' => $dadesClient
    ]);
}

public function showForm($proyecto_id)
{
    $proyecto = Proyecto::find($proyecto_id);

    if (!$proyecto) {
        return redirect()->back()->with('error', 'Proyecto no encontrado');
    }

    return view('dadesClient', compact('proyecto'));
}

}

