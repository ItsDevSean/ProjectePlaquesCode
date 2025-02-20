<?php

namespace App\Http\Controllers;
use App\Models\InformacionFisicaPanel;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Http\Request;

class InformacionFisicaPanelController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'longitud' => 'required|numeric|min:0',
            'anchura' => 'required|numeric|min:0',
            'espesor' => 'required|numeric|min:0',
            'peso' => 'required|numeric|min:0',
            'superficie' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
            'url_fabricante' => 'nullable|string',
            'imagen_panel' => 'nullable|string',
            'material_marco' => 'required|string',
            'color_panel' => 'nullable|string'
        ]);

        InformacionFisicaPanel::create($request->all());

        return response()->json(['message' =>'Datos guardados.']);

    }

}
