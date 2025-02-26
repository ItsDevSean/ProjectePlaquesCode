<?php

namespace App\Http\Controllers\tools;

use App\Http\Controllers\Controller;
use App\Models\SolarPanelsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        return view('panels');
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
            'panel_warranty' => 'required|integer',
            'performance_warranty' => 'required|integer',
            'maximum_power' => 'required|integer',
            'voltage_maximum_power_point' => 'required|integer',
            'current_maximum_power_point' => 'required|integer',
            'open_circuit_voltage' => 'required|integer',
            'short_circuit_current' => 'required|integer',
            'panel_efficiency' => 'required|integer'
        ]);


        SolarPanelsModel::create($request->all());

        return to_route('panels');    
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
