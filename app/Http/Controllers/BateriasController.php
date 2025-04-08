<?php

namespace App\Http\Controllers;

use App\Models\Baterias;
use App\Models\Fabricante;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            'descripcion' => 'nullable|string|min:0',
            'id_referencia' => 'nullable|string|max:50',
            'capacidad' => 'required|integer|min:0',
            'fabricante_id' => 'required|integer|exists:fabricantes,id',
            'garantia_material' => 'nullable|integer|min:0',
            #'imagen_bateria' => 'nullable|url|max:2048',
            'imagen_bateria' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        #dd($request->file('imagen_bateria'));

        if ($request->hasFile('imagen_bateria')) {
            $image = $request->file('imagen_bateria');
            $extension = $image->getClientOriginalExtension();
            $safeName = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME));
            $imageName = time() . '_' . $safeName . '.' . $extension;
        
            // Usar move() para mover la imagen al directorio correcto
            $image->move(public_path('storage/baterias'), $imageName);
        
            // Guardar la ruta en la base de datos
            $data['imagen_bateria'] = 'storage/baterias/' . $imageName;
        }

        Baterias::create($data);

        return redirect()->route('baterias.index')->with('success', 'Batería creada correctamente.');
    }

    public function update(Request $request, $id)
{
    $bateria = Baterias::find($id);

    if (!$bateria) {
        return redirect()->route('baterias.index')->with('error', 'Proyecto no encontrado');
    }

    $data = $request->all();

    if ($request->hasFile('imagen_bateria')) {
        // Eliminar la imagen anterior si existe
        if ($bateria->imagen_bateria) {
            $oldImagePath = public_path('storage/baterias/' . basename($bateria->imagen_bateria));
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);  // Eliminar el archivo
            }
        }

        $image = $request->file('imagen_bateria');
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('storage/baterias'), $imageName); // Mover la nueva imagen

        $data['imagen_bateria'] = 'storage/baterias/' . $imageName;
    } else {
        // Mantener la imagen existente si no se sube una nueva
        $data['imagen_bateria'] = $bateria->imagen_bateria;
    }

    // Actualizar la batería con los nuevos datos
    $bateria->update($data + ['user_id' => Auth::id()]);

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
