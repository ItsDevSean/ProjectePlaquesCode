<form action="{{ route('paneles.resultado')}}" method="POST" id="panelForm">
                    
    @csrf

    @method('POST')

    <h2 class="text-xl font-bold text-gray-700 mb-4 text-center underline underline-offset-8 decoration-green-200">
        Informacion basica del panel
    </h2>

    <div>
        <label>Nombre del Modelo <span class="text-red-500">*</span></label>
        <input type="text" name="panel_model" class="border p-2 rounded w-full" required />
    </div>
    <div>
        <label>Fabricante <span class="text-red-500">*</span></label>
        <input type="text" name="manufacturer"class="border p-2 rounded w-full" required />
    </div>

   
    <label>Tipo de Panel <span class="text-red-500">*</span></label>
    <select name="panel_type"class="border p-2 rounded w-full">
        @foreach ($panelType as $pt)
            <option value="{{ $pt->panel_type }}">{{ $pt->panel_type }}</option>
        @endforeach
        
    </select> 

    <div>
        <label for="date">Fecha de Fabricación <span class="text-red-500">*</span></label>
        <input type="date" name="date_manufacturer" class="border p-2 rounded w-full" required />
    </div>
    <div>
        <label>Garantía del producto (años)</label>
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
        <label>Longitud (mm) <span class="text-red-500">*</span></label>
        <input type="number" id="longitud" name="longitud" class="border p-2 rounded w-full" required />
    </div>


    <div>
        <label>Anchura (mm) <span class="text-red-500">*</span></label>
        <input type="number" id="anchura" name="anchura" class="border p-2 rounded w-full" required />
    </div>

    <div>
        <label>Espesor (mm) <span class="text-red-500">*</span></label>
        <input type="number" name="espesor" class="border p-2 rounded w-full" required />
    </div>

    <div>
        <label>Peso (kg) <span class="text-red-500">*</span></label>
        <input type="number" name="peso" class="border p-2 rounded w-full" required />
    </div>

    <div style="display: none;">
        <label>Superficie (m²) <span class="text-red-500">*</span></label>
        <input type="number" id="superficie" name="superficie" class="border p-2 rounded w-full">
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

    <h2 class="text-xl font-bold text-gray-700 mb-4 text-center underline underline-offset-8 decoration-green-200">Datos del Panel Solar</h2>

    <div>
        <label for="potencia_maxima">Potencia Máxima (Pmax)<span class="text-red-500">*</span></label>
        <input id="potencia_maxima" name="potencia_maxima" type="number" class="border p-2 rounded w-full" required />
    </div>

    <div>
        <label for="tension_maxima_potencia">Tensión en Punto de Máxima Potencia (Vmp)<span class="text-red-500">*</span></label>
        <input id="tension_maxima_potencia" name="tension_maxima_potencia" type="number" class="border p-2 rounded w-full" required />
    </div>

    <div>
        <label for="corriente_punto_maxima_potencia">Corriente en Punto de Máxima Potencia (Imp)<span class="text-red-500">*</span></label>
        <input id="corriente_punto_maxima_potencia" name="corriente_punto_maxima_potencia" type="number" class="border p-2 rounded w-full" required />
    </div>    

    <div>
        <label for="tension_circuito_abierto">Tensión de Circuito Abierto (Voc)<span class="text-red-500">*</span></label>
        <input id="tension_circuito_abierto" name="tension_circuito_abierto" type="number" class="border p-2 rounded w-full" required />
    </div>

    <div>
        <label for="corriente_cortocircuito">Corriente de Cortocircuito (Isc)<span class="text-red-500">*</span></label>
        <input id="corriente_cortocircuito" name="corriente_cortocircuito" type="number" class="border p-2 rounded w-full" required />
    </div>

    <div>
        <label for="eficencia_panel">Eficiencia del Panel (%)<span class="text-red-500">*</span></label>
        <input id="eficencia_panel" name="eficencia_panel" type="number" class="border p-2 rounded w-full" required />
    </div>

    <div>
        <label for="coeficiente_temp_pmax">Coeficiente de Temperatura de Pmax (%/°C)<span class="text-red-500">*</span></label>
        <input id="coeficiente_temp_pmax" name="coeficiente_temp_pmax" type="number" class="border p-2 rounded w-full" required />
    </div>

    <div>
        <label for="coeficiente_temp_voc">Coeficiente de Temperatura de Voc (%/°C)<span class="text-red-500">*</span></label>
        <input id="coeficiente_temp_voc" name="coeficiente_temp_voc" type="number" class="border p-2 rounded w-full" required />
    </div>

    <div>
        <label for="coeficiente_temp_isc">Coeficiente de Temperatura de Isc (%/°C)<span class="text-red-500">*</span></label>
        <input id="coeficiente_temp_isc" name="coeficiente_temp_isc" type="number" class="border p-2 rounded w-full" required />
    </div>

    <div class="flex justify-end mt-4 space-x-4">
        <button onclick="toggleModal()" class="text-gray-500 hover:bg-gray-500 hover:text-white py-2 px-4 rounded-lg">Cancelar</button>
        <button id="submitButton" onclick="formSubmit()" type="submit" class="bg-[#49DBA3] hover:bg-[#193849] text-white py-2 px-4 rounded-lg">Confirmar</button>
    </div>
</form>