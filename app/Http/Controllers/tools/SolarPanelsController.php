<?php

namespace App\Http\Controllers\tools;

use App\Http\Controllers\Controller;
use App\Imports\PanelImport;
use App\Models\Fabricante;
use App\Models\PanelType;
use App\Models\SolarPanelsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

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
        
        //dd($panels);
        $nameAtributes = (new SolarPanelsModel)->getFillable();
        $manufacturers = Fabricante::where('user_id', Auth::id())->get();
        return view('tools.panels', compact('panels', 'panelType', 'nameAtributes', 'manufacturers'));  
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
            'tension_maxima_potencia' => 'nullable|numeric|min:0',
            'corriente_punto_maxima_potencia' => 'nullable|numeric|min:0',
            'tension_circuito_abierto' => 'nullable|numeric|min:0',
            'corriente_cortocircuito' => 'nullable|numeric|min:0',
            'eficencia_panel' => 'required|numeric|min:0|max:100',
            'coeficiente_temp_pmax' => 'required|numeric|min:0|max:100',
            'coeficiente_temp_voc' => 'nullable|numeric|min:-100|max:100',
            'coeficiente_temp_isc' => 'nullable|numeric|min:-100|max:100',
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

    public function showForm()
    {
        return view('tools.panels');  
    }

    public function import(Request $request) 
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt'
        ]);
        $file = $request->file('csv_file');  
        if (!$file || !file_exists($file->getRealPath() )) {
            return back()->with('error', 'Invalid file!');
        }
        $data = array_map('str_getcsv', file($file->getRealPath()));
        if (empty($data) || count($data) <= 1) {  
            return back()->with('error', 'CSV file is empty or invalid!');
        }
        $headers = array_shift($data); 
        $expectedHeaders = (new SolarPanelsModel)->getFillable();
        if ($headers !== $expectedHeaders) {
            return back()->with('error', 'CSV headers are not valid!');
        }
        foreach ($data as $row) {
            $rowData = [];
            foreach ($expectedHeaders as $index => $header) {
                if ($header == 'user_id') {
                    $rowData[$header] = Auth::id();
                } else {
                    $rowData[$header] = $row[$index];
                }
            }
            $newRequest = new Request($rowData);
            try {
                $this->store($newRequest);
            } catch (\Exception $e) {
                return back()->with('error', "Error processing row " . ($index + 1) . ": " . $e->getMessage());
            }
        }
        return $this->index();
    }
}
