<?php

namespace App\Http\Controllers\tools;

use App\Http\Controllers\Controller;
use App\Models\PanelType;
use App\Models\SolarPanelsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

        return view('tools.panels', compact('panels', 'panelType'));    }

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
            'longitud' => 'required|numeric|min:1|max:5',
            'anchura' => 'required|numeric|min:1|max:5',
            'espesor' => 'required|numeric|min:0',
            'peso' => 'required|numeric|min:0',
            'superficie' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
            'url_fabricante' => 'nullable|string',
            'imagen_panel' => 'nullable|string',
            'material_marco' => 'nullable|string',
            'color_panel' => 'nullable|string'
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
}
