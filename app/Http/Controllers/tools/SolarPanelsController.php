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
        Post::create(
            [
                'panel_model' => $request->all(['panel_model']),
                'manufacturer' =>$request->all(['manufacturer']) ,
                'panel_type' =>  $request->all(['panel_type']),
                #ToDo, implementar la resta d'atributs, min 1:51-
                'date_manufacturer' => , 
                'panel_warranty' => ,
                'performance_warranty' => ,
                'maximum_power' => ,
                'voltage_maximum_power_point' => ,
                'current_maximum_power_point' => , 
                'open_circuit_voltage' => ,
                'short_circuit_current' => ,
                'panel_efficiency' => 
            ]
        );
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
