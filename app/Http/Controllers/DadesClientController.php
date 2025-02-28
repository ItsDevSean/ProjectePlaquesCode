<?php
namespace App\Http\Controllers;

use App\Models\DadesClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DadesClientController extends Controller
{
    public function index()
    {
        $clientes = DadesClient::with(['user', 'estado'])->paginate(10);
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
        'tarifa'=>'required|string',
        'tipo_instalacion' => 'required|string',
    ]);

    DadesClient::create($request->all() + ['user_id' => Auth::id(), 'estado_id' => 1]);

    return response()->json(['message' =>'Datos guardados.']);
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


}