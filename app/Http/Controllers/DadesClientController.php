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
    try {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'email' => 'required|email',
            'telefono' => 'required|numeric|min:0',
            'direccion' => 'required|string',
            'ciudad' => 'required|string',
            'codigo_postal' => 'nullable|numeric|min:0',
            'nombre_proyecto' => 'required|string',
            'descripcion_proyecto' => 'nullable|string',
            'estacionalidad' => 'nullable|string',
            'tipo_instalacion' => 'nullable|string',
            'consum_anual' => 'nullable|numeric',
            'factura_anual' => 'nullable|numeric',
            'tarifa_acces' => 'nullable|string',
            'coste_instalacion' => 'nullable|numeric',
            'subvenciones' => 'nullable|numeric',
            'precio_excedentes' => 'nullable|numeric',
            'patro_consum' => 'nullable|numeric',
            'inclinacion' => 'nullable|numeric',
            'orientacion' => 'nullable|string',
            'radiacion_anual' => 'nullable|numeric',
            'max_placas' => 'nullable|numeric',
            'placa_count' => 'nullable|numeric',
            'panel_potencia' => 'nullable|numeric',
            'panel_modelo' => 'nullable|string',
            'superficie' => 'nullable|numeric',
            'nova_area' => 'nullable|numeric',
            'monthly_radiation' => 'nullable|array',
            'produccion_mensual' => 'nullable|array',
            'edifici_data' => 'nullable|array',
            'obstacles' => 'nullable|array',
            'polygon' => 'nullable|array',
            'radiation_coords' => 'nullable|array',
        ]);
        
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['estado_id'] = 1;

        $proyecto = DadesClient::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Proyecto creado correctamente',
            'data' => $proyecto
        ]);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error de validación',
            'errors' => $e->errors()
        ], 422);
        
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error del servidor: ' . $e->getMessage()
        ], 500);
    }
}


    public function details($id)
    {
        $proyecto = DadesClient::with(['user', 'estado'])->find($id);

        if (!$proyecto) {
            return response()->json(['error' => 'Proyecto no encontrado'], 404);
        }

        return response()->json(['dadesClient' => $proyecto]);
    }

    public function destroy($id)
    {
        $proyecto = DadesClient::find($id);

        if (!$proyecto) {
            return redirect()->route('proyectos')->with('error', 'Proyecto no encontrado');
        }

        $proyecto->delete();

        return redirect()->route('proyectos')->with('success', 'Proyecto eliminado correctamente');
    }

    public function update(Request $request, $id)
    {
        $proyecto = DadesClient::find($id);

        if (!$proyecto) {
            return redirect()->route('proyectos')->with('error', 'Proyecto no encontrado');
        }

        $data = $request->all();
        $data['user_id'] = Auth::id();

        $proyecto->update($data);

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

        $proyecto = DadesClient::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$proyecto) {
            return response()->json(['error' => 'Proyecto no encontrado'], 404);
        }

        $proyecto->estado_id = $request->estado_id;
        $proyecto->save();

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

    public function produccio()
{
    return view('produccio'); // Asegúrate de que esta vista existe
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
