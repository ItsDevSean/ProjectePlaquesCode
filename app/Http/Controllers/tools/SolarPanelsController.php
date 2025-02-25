<?php

namespace App\Http\Controllers\tools;

use App\Http\Controllers\Controller;
use App\Models\SolarPanelsModel;
use Illuminate\Http\Request;


class SolarPanelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        #to Do, aun no se muy bien que agarrar de aqui:
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        #toDo: deveria cojer los valores por defecto desde aqui
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                [
                    'panel_model' => 'required|string',
                    'manufacturer' => 'required|string' ,
                    'panel_type' =>  'required|string',
                    'date_manufacturer' => 'required|date', 
                    'panel_warranty' => 'required|numeric|min:0',
                    'performance_warranty' => 'required|numeric|min:0',
                    'maximum_power' => 'required|numeric|min:0',
                    'voltage_maximum_power_point' => 'required|numeric|min:0',
                    'current_maximum_power_point' => 'required|numeric|min:0', 
                    'open_circuit_voltage' => 'required|numeric|min:0',
                    'short_circuit_current' => 'required|numeric|min:0',
                    'panel_efficiency' => 'required|numeric|min:0'
                ] 
            ]
        );
        SolarPanelsController::create($request->all());

        return response()->json(['message' => 'Datos saved:)']);
                  
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
    public function edit(SolarPanelsModel $solarPanelsModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SolarPanelsModel $solarPanelsModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SolarPanelsModel $solarPanelsModel)
    {
        //
    }
}
