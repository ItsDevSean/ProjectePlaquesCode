<?php

namespace App\Http\Controllers;

use App\Models\Inversores;
use App\Models\Fabricante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class InversoresController extends Controller
{
    public function index()
    {
        $inversores = Inversores::where('user_id', Auth::id())
                    ->with('fabricante') 
                    ->paginate(3);
        
        $fabricantes = Fabricante::where('user_id', Auth::id())->get();

        return view('inversores', compact('inversores', 'fabricantes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_inversor' => 'required|string|min:2|max:100',
            'eficiencia' => 'required|numeric|between:0,999.99',
            'tipo_instalacion' => 'required|string',
            'garantia_material' => 'nullable|integer|min:0',
            'potencia_nominal' => 'required|integer|min:1',
            'descripcion' => 'nullable|string|min:0',
            'fabricante_id' => 'required|integer|exists:fabricantes,id',
            'microinversor' => 'required|boolean',
            'garantia_fabricante' => 'required|integer|min:0',
            'imagen_inversor' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

            'id_referencia' => 'nullable|string|max:50',
        ]);

        
        $data = $request->all();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('imagen_inversor')) {
            $image = $request->file('imagen_inversor');
            $extension = $image->getClientOriginalExtension();
            $safeName = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME));
            $imageName = time() . '_' . $safeName . '.' . $extension;
        
            // Usar move() para mover la imagen al directorio correcto
            $image->move(public_path('storage/inversores'), $imageName);
        
            // Guardar la ruta en la base de datos
            $data['imagen_inversor'] = 'storage/inversores/' . $imageName;
        }

        Inversores::create($data);

        return redirect()->route('inversores.index')->with('success', 'Inversor creado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $inversor = Inversores::find($id);

        if (!$inversor) {
            return redirect()->route('inversores.index')->with('error', 'Inversor no encontrado');
        }

        $data = $request->all();

        if ($request->hasFile('imagen_inversor')) {
            // Eliminar la imagen anterior si existe
            if ($inversor->imagen_inversor) {
                $oldImagePath = public_path('storage/inversores/' . basename($inversor->imagen_inversor));
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);  // Eliminar el archivo anterior
                }
            }

            $image = $request->file('imagen_inversor');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            // Mover la nueva imagen al directorio adecuado
            $image->move(public_path('storage/inversores'), $imageName);
            
            // Actualizar la ruta de la imagen
            $data['imagen_inversor'] = 'storage/inversores/' . $imageName;
        } else {
            // Mantener la imagen existente si no se sube una nueva
            $data['imagen_inversor'] = $inversor->imagen_inversor;
        }

        // Actualizar los datos del inversor
        $inversor->update($data + ['user_id' => Auth::id()]);

        return redirect()->route('inversores.index')->with('success', 'Inversor actualizado correctamente');
    }

    public function edit($id)
    {
        $inversor = Inversores::find($id);
        if (!$inversor) {
            return redirect()->route('inversores.index')->with('error', 'Inversor no encontrado');
        }
    
        $fabricantes = Fabricante::where('user_id', Auth::id())->get(); 
        return view('inversores.edit', compact('inversor', 'fabricantes')); 
    }

    public function destroy($id)
{
    $inversor = Inversores::find($id);

    if (!$inversor) {
        return redirect()->route('inversores.index')->with('error', 'inversor no encontrado');
    }

    $inversor->delete();

    return redirect()->route('inversores.index')->with('success', 'inversor eliminado correctamente');
}
}
