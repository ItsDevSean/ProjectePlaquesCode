<form action="{{ route('paneles.resultado')}}" method="POST">
                    
    @csrf

    @method('POST')

    <h2 class="text-xl font-bold text-gray-700 mb-4 text-center underline underline-offset-8 decoration-green-200">
        Informacion basica del panel
    </h2>

    <div>
        <label>Nombre del Modelo <span class="text-red-500">*</span></label>
        <input type="text" name="panel_model" class="border p-2 rounded w-full">
    </div>
    <div>
        <label>Fabricante*</label>
        <input type="text" name="manufacturer"class="border p-2 rounded w-full">
    </div>

   
    <label>Tipo de Panel*</label>
    <select name="panel_type"class="border p-2 rounded w-full">
        @foreach ($panelType as $pt)
            <option value="{{ $pt->panel_type }}">{{ $pt->panel_type }}</option>
        @endforeach
        
    </select> 

    <div>
        <label for="date">Fecha de Fabricación:</label>
        <input type="date" name="date_manufacturer" class="border p-2 rounded w-full">
    </div>
    <div>
        <label>Garantía del producto (años) <span class="text-red-500">*</span></label>
        <input type="number" name="panel_warranty" class="border p-2 rounded w-full">
    </div>
    <div>
        <label>Garantía de rendimiento (años):</label>
        <input type="number" name="performance_warranty" class="border p-2 rounded w-full">
    </div>

    <h2 class="text-xl font-bold text-gray-700 mb-4 text-center underline underline-offset-8 decoration-green-200">
        Datos Físicos del Panel
    </h2>

    <div>
        <label>Longitud (mm):</label>
        <input type="number" name="longitud" class="border p-2 rounded w-full">
    </div>


    <div>
        <label>Anchura (mm)</label>
        <input type="number" name="anchura" class="border p-2 rounded w-full">
    </div>

    <div>
        <label>Espesor (mm)</label>
        <input type="number" name="espesor" class="border p-2 rounded w-full">
    </div>

    <div>
        <label>Peso (kg)</label>
        <input type="number" name="peso" class="border p-2 rounded w-full">
    </div>

    <div>
        <label>Superficie (m²)</label>
        <input type="number" name="superficie" class="border p-2 rounded w-full">
    </div>


    <div>
        <label>Descripción</label>
        <input type="text" name="descripcion" class="border p-2 rounded w-full">
    </div>

    <div>
        <label>URL del Fabricante</label>
        <input type="text" name="url_fabricante" class="border p-2 rounded w-full">
    </div>

    <div>
        <label>Imagen del Panel</label>
        <input type="text" name="imagen_panel" class="border p-2 rounded w-full">
    </div>

    <div>
        <label>Material del Marco</label>
        <input type="text" name="material_marco" class="border p-2 rounded w-full">
    </div>


    <div>
        <label>Color del Panel (Opcional)</label>
        <input type="text" name="color_panel" class="border p-2 rounded w-full">
    </div>

    <div class="flex justify-end mt-4 space-x-4">
        <button onclick="toggleModal()" class="text-gray-500 hover:bg-gray-500 hover:text-white py-2 px-4 rounded-lg">Cancelar</button>
        <button class="bg-[#49DBA3] hover:bg-[#193849] text-white py-2 px-4 rounded-lg" type="submit">Confirmar</button>
    </div>
    
</form>