<?php

namespace App\Http\Controllers\tools;

use App\Http\Controllers\Controller;
use App\Models\PanelType;
use App\Models\SolarPanelsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UserImport;

class SolarPanelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $panelType = PanelType::all();            
        $panels = SolarPanelsModel::all()
        ->where('user_id', Auth::id());
        $nameAtributes = (new SolarPanelsModel)->getFillable();
        return view('tools.panels', compact('panels', 'panelType', 'nameAtributes'));  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'panel_model' => 'required|string|min:2|max:100',
            'manufacturer' => 'required|string|min:2|max:100',
            'panel_type' => 'required|string|min:2|max:50',
            'date_manufacturer' => 'required|date',
            'panel_warranty' => 'nullable|integer',
            'performance_warranty' => 'nullable|integer',
            'longitud_v2' => 'required|numeric|min:0',
            'anchura' => 'required|numeric|min:0',
            'espesor' => 'required|numeric|min:0',
            'peso' => 'required|numeric|min:0',
            'superficie' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
            'url_fabricante' => 'nullable|string',
            'imagen_panel' => 'nullable|string',
            'material_marco' => 'nullable|string',
            'color_panel' => 'nullable|string',
            'potencia_maxima' => 'required|numeric|min:0',
            'tension_maxima_potencia' => 'required|numeric|min:0',
            'corriente_punto_maxima_potencia' => 'required|numeric|min:0',
            'tension_circuito_abierto' => 'required|numeric|min:0',
            'corriente_cortocircuito' => 'required|numeric|min:0',
            'eficencia_panel' => 'required|numeric|min:0|max:100',
            'coeficiente_temp_pmax' => 'required|numeric|min:0|max:100',
            'coeficiente_temp_voc' => 'required|numeric|min:0|max:100',
            'coeficiente_temp_isc' => 'required|numeric|min:0|max:100',
        ]);

        SolarPanelsModel::create($request->all() + ['user_id' => Auth::id()]);

        return to_route('panels')->with('success', 'Panel registrado correctamente.');;    
    }

    /**
     * Display the specified resource.
     */
    public function show(SolarPanelsModel $solarPanelsModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SolarPanelsModel $newPanel) //toDo: aqui para la edicion: ep 53 min 6:14
    {
        $oldPanels = SolarPanelsModel::all();
        $panelType = PanelType::all();
        return view('tools.panelsEdit', compact('oldPanels', 'newPanel', 'panelType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SolarPanelsModel $solarPanelsModel)
    {
        $solarPanelsModel->update($request->validate());
        return to_route('panels'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SolarPanelsModel $solarPanelsModel)
    {
        //
    }

    public function import(Request $request) 
    {
        // 1. Get the local file path
        $filePath = app_path('Http/Controllers/tools/test.csv');
            
        // 2. Verify the file exists
        if (!file_exists($filePath)) {
            return back()->with('error', 'File not found!');
        }

        // 3. Create a UploadedFile instance manually
        $file = new \Illuminate\Http\UploadedFile(
            $filePath,
            'test.csv',
            'text/csv',
            null,
            true
        );        
        Excel::import(new UserImport, request()->file('test'),'csv');
        return back()->with('success', 'CSV imported!');
    }
}
