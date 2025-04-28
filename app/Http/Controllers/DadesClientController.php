<?php

namespace App\Http\Controllers;

use App\Models\DadesClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ConsumptionModel;

class DadesClientController extends Controller
{
    public function index()
    {
        $clientes = DadesClient::with(['user', 'estado'])
            ->where('user_id', Auth::id())
            ->paginate(5);

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
            'prodAnual' => 'nullable|String',
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
public function showDetails($id)
{
    try {
        $project = DadesClient::with(['user', 'estado']) // Ajusta las relaciones según tu modelo
            ->findOrFail($id);
            
        return response()->json([
            'id' => $project->id,
            'nombre_proyecto' => $project->nombre_proyecto,
            'descripcion_proyecto' => $project->descripcion_proyecto,
            'estado' => $project->estado->nombre, // Ajusta según tu relación
            'created_at' => $project->created_at->format('d/m/Y H:i'),
            'updated_at' => $project->updated_at->format('d/m/Y H:i'),
            'client_name' => $project->nombre,
            'client_address' => $project->direccion,
            'client_city' => $project->ciudad,
            'client_contact' => $project->telefono,
            'user_name' => $project->user->name, // Ajusta según tu relación
            'user_email' => $project->user->email,
            // Añade más campos según necesites
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'No se pudo cargar el proyecto',
            'message' => $e->getMessage()
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
public function import(Request $request)
{
    $electicConsumption = [];

    $request->validate([
        'csv_file' => 'required|file|mimes:csv,txt',
        'proyecto_id' => 'required|exists:dades_clients,id'
    ]);

    $file = $request->file('csv_file');

    if (!$file || !file_exists($file->getRealPath())) {
        return back()->with('error', 'Archivo no válido.');
    }

    $data = array_map('str_getcsv', file($file->getRealPath()));
    if (empty($data) || count($data) <= 1) {
        return back()->with('error', 'El archivo CSV está vacío o mal formado.');
    }

    $headers = array_shift($data);
    $expectedHeaders = (new ConsumptionModel())->getFillable();

    if ($headers !== $expectedHeaders) {
        return back()->with('error', 'Los encabezados del CSV no son válidos.');
    }

    foreach ($data as $rowIndex => $row) {
        $rowData = [];
        foreach ($expectedHeaders as $index => $header) {
            $rowData[$header] = $row[$index];
        }

        $newRequest = new Request($rowData);
        try {
            $this->validateConsumptionRow($newRequest);
            $rowData['user_id'] = Auth::id();
            $rowData['dades_client_id'] = $request->input('proyecto_id');

            $electicConsumption[] = ConsumptionModel::create($rowData);
        } catch (\Exception $e) {
            return back()->with('error', "Error en la fila " . ($rowIndex + 1) . ": " . $e->getMessage());
        }
    }

    return redirect()->route('proyecto.edit.consum', $request->input('proyecto_id'))
        ->with('success', 'Consumos importados correctamente.');
}

public function validateConsumptionRow(Request $request)
{
    $request->validate([
        'anio' => 'required|integer',
        'mes' => 'required|string|max:10',
        'consumo_kwh' => 'required|numeric',
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

    public function editDadesClient($id) {
        $proyecto = DadesClient::findOrFail($id);
        return view('dadesClient', compact('proyecto'));
    }
    
    public function editProduccio($id) {
        $proyecto = DadesClient::findOrFail($id);
        return view('produccio', compact('proyecto'));
    }
    
    public function editConsum($id)
{
    $proyecto = DadesClient::find($id);
    if (!$proyecto) {
        return redirect()->route('proyectos')->with('error', 'Proyecto no encontrado');
    }

    // Obtenemos los consumos asociados al proyecto
    $electicConsumption = ConsumptionModel::where('dades_client_id', $id)->get();

    return view('consum', compact('proyecto', 'electicConsumption'));
}
    
    public function updateConsum(Request $request, $id) {
        $proyecto = DadesClient::findOrFail($id);
        $proyecto->update($request->all());
        return redirect()->route('proyecto.edit.produccio', $id);
    }

    public function editMapa($id) {
        $proyecto = DadesClient::findOrFail($id);
        return view('mapaPrueva', compact('proyecto'));
    }

    public function updateMapa(Request $request, $id) {
        $proyecto = DadesClient::findOrFail($id);
        $proyecto->update($request->all());
        return redirect()->route('proyectos'); 
    }

}
