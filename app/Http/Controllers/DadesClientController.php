<?php

namespace App\Http\Controllers;
use App\Models\DadesClient;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use App\Events\DadesClientCreated;
class DadesClientController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'nombre' => 'required|string',
            'email' => 'required|string',
            'telefono' => 'required|numeric|min:0',
            'direccion' => 'required|string',
            'ciudad' => 'required|string',
            'codigo_postal' => 'nullable|numeric|min:0',
            'proyecto_id' => 'required|exists:proyectos,id',
        ]);

        dadesclient::create($request->all());

        $dadesClient = DadesClient::create($request->all());


        return response()->json(['message' =>'Datos guardados.']);
       

    }

     

    public function showForm($proyecto_id)
    {
        // Obtener el proyecto por su ID
        $proyecto = Proyecto::find($proyecto_id);

        // Si el proyecto no existe, redirigir o mostrar un error
        if (!$proyecto) {
            return redirect()->route('proyectos.index')->with('error', 'Proyecto no encontrado.');
        }

        // Pasar el proyecto a la vista
        return view('dades', compact('proyecto'));
    }
}
