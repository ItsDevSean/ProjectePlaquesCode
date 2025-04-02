<?php
namespace App\Http\Controllers;

use App\Models\DadesClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DadesClientController extends Controller
{
    public function index()
{
    $clientes = DadesClient::with(['user', 'estado'])
        ->where('user_id', Auth::id()) 
        ->paginate(10);

    return view('proyectos', compact('clientes'));
}


    public function store(Request $request)
{
    // Validar los datos
    $request->validate([
        'nombre' => 'required|string',
        'email' => 'required|string',
        'telefono' => 'required|numeric|min:0',
        'direccion' => 'required|string',
        'ciudad' => 'required|string',
        'codigo_postal' => 'nullable|numeric|min:0',
        'nombre_proyecto' =>'required|string',
        'descripcion_proyecto' =>'nullable|string',
        'estacionalitat'=>'required|string',
        'tipo_instalacion' => 'required|string',
    ]);

    DadesClient::create($request->all() + ['user_id' => Auth::id(), 'estado_id' => 1]);
    
    return redirect()->route('proyectos');
}
public function details($id)
{
    // Busca el proyecto por su ID
    $proyecto = DadesClient::with(['user', 'estado'])->find($id);

    // Si no se encuentra el proyecto, devuelve un error
    if (!$proyecto) {
        return response()->json(['error' => 'Proyecto no encontrado'], 404);
    }

    // Devuelve los detalles del proyecto en formato JSON
    return response()->json([
        'dadesClient' => $proyecto,
    ]);
}
public function destroy($id)
{
    // Buscar el proyecto por su ID
    $proyecto = DadesClient::find($id);

    // Si no se encuentra el proyecto, devolver un mensaje de error
    if (!$proyecto) {
        return redirect()->route('proyectos')->with('error', 'Proyecto no encontrado');
    }

    // Eliminar el proyecto
    $proyecto->delete();

    // Redirigir de nuevo a la lista de proyectos con un mensaje de éxito
    return redirect()->route('proyectos')->with('success', 'Proyecto eliminado correctamente');
}

public function update(Request $request, $id)
{
    // Buscar el proyecto por su ID
    $proyecto = DadesClient::find($id);

    // Verificar si el proyecto existe
    if (!$proyecto) {
        return redirect()->route('proyectos')->with('error', 'Proyecto no encontrado');
    }

    // Actualizar los campos del proyecto
    $proyecto->update($request->all() + ['user_id' => Auth::id()]);
    // Redirigir al listado de proyectos con un mensaje de éxito
    return redirect()->route('dades_clients.edit', $id)->with('success', 'Proyecto actualizado correctamente');
}

public function edit($id)
{
    $proyecto = DadesClient::find($id);
    if (!$proyecto) {
        return redirect()->route('proyectos')->with('error', 'Proyecto no encontrado');
    }
    return view('dadesClient', compact('proyecto'));
}


public function updateEstado(Request $request, $id)
{
    $request->validate([
        'estado_id' => 'required|exists:estados,id', 
    ]);

    $proyecto = DadesClient::where('id', $id)->where('user_id', Auth::id())->first();

    if (!$proyecto) {
        return response()->json(['error' => 'Proyecto no encontrado'], 404);
    }

    $proyecto->estado_id = $request->estado_id;
    $proyecto->save();

    // Recalcular los contadores
    $total = DadesClient::where('user_id', Auth::id())->count();
    $activos = DadesClient::where('user_id', Auth::id())->where('estado_id', 1)->count();
    $enProgreso = DadesClient::where('user_id', Auth::id())->where('estado_id', 2)->count();
    $completados = DadesClient::where('user_id', Auth::id())->where('estado_id', 3)->count();

    return response()->json([
        'message' => 'Estado actualizado correctamente',
        'total' => $total,
        'activos' => $activos,
        'enProgreso' => $enProgreso,
        'completados' => $completados,
    ]);
}


public function show($id)
{
    $proyecto = DadesClient::find($id);
    if (!$proyecto) {
        return redirect()->route('proyectos')->with('error', 'Proyecto no encontrado');
    }
    return view('proyectos', compact('proyecto'));
}

}