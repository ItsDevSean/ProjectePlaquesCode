<?php

namespace App\Http\Controllers;

use App\Models\Baterias;
use App\Models\Fabricante;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BateriasController extends Controller
{
    public function index()
    {
        
     
        $fabricantes = Fabricante::where('user_id', Auth::id())->get();
        $baterias = Baterias::where('user_id', Auth::id())->paginate(4);
 

        return view('baterias', compact('baterias','fabricantes'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'nombre_bateria' => 'required|string|min:2|max:100',
            'coste' => 'required|numeric|min:0',
            'garantia_fabricante' => 'nullable|integer|min:0',
            'descripcion' => 'required|string|min:5',
            'id_referencia' => 'nullable|string|max:50',
            'capacidad' => 'required|integer|min:0',
            'fabricante_id' => 'required|integer|exists:fabricantes,id',
            'garantia_material' => 'nullable|integer|min:0',
            'imagen_bateria' => 'nullable|url|max:2048',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        Baterias::create($data);

        return redirect()->route('baterias.index')->with('success', 'Batería creada correctamente.');
    }

    public function update(Request $request, $id)
    {
        $bateria = Baterias::find($id);
    
        if (!$bateria) {
            return redirect()->route('baterias.index')->with('error', 'Proyecto no encontrado');
        }
    
        
        $bateria->update($request->all() + ['user_id' => Auth::id()]);
        
        return redirect()->route('baterias.index')->with('success', 'Proyecto actualizado correctamente');
    }

    public function edit($id)
    {
        $bateria = Baterias::find($id);
        if (!$bateria) {
            return redirect()->route('baterias.index')->with('error', 'bateria no encontrado');
        }
    
        $fabricantes = Fabricante::where('user_id', Auth::id())->get(); 
        return view('baterias.edit', compact('bateria', 'fabricantes')); 
    }

    public function destroy($id)
{
    $bateria = Baterias::find($id);

    if (!$bateria) {
        return redirect()->route('baterias.index')->with('error', 'bateria no encontrado');
    }

    $bateria->delete();

    return redirect()->route('baterias.index')->with('success', 'bateria eliminado correctamente');
}
}
