<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caracteristicas electricas panel</title>
    <link rel="stylesheet" type="text/css" href="build/css/fisico.css">
    <style></style>
</head>
<body>
    

    <form action="{{ route('guardar.informacionElectrica') }}" method="post">
    @csrf
        {{--  Campo numérico en vatios (W). --}}
        <p>Potencia Máxima (Pmax)</p>
        <input type="text" name="potencia_maxima"/>

        {{-- Campo numérico en voltios (V). --}}
        <p>Tension en Punto de Máxima Potencia (Vmp)</p>
        <input type="text" name="tension_maxima_potencia"/>

        {{--  Campo numérico en amperios (A). --}}
        <p>Corriente en Punto de Máxima  (Imp)</p>
        <input type="text" name="corriente_punto_maxima_potencia"/>

        {{-- Campo numérico en voltios (V). --}}
        <p>Tensión de Circuito Abierto (Voc)</p>
        <input type="text" name="tension_circuito_abierto"/>

        {{-- Campo numérico en amperios (A). --}}
        <p>Corriente de Cortocircuito (Isc)</p>
        <input type="text" name="corriente_cortocircuito"/>

        {{-- Campo numérico en porcentaje (%) --}}
        <p>Eficencia del Panel</p>
        <input type="text" name="eficencia_panel"/>

        {{-- Campo numérico en %/°C --}}
        <p>Coeficiente de Temperatura de Pmax</p>
        <input type="text" name="coeficiente_temp_pmax"/>

        {{-- Campo numérico en %/°C --}}
        <p>Coeficiente de Temperatura de Voc</p>
        <input type="text" name="coeficiente_temp_voc"/>

        {{-- Campo numérico en %/°C --}}
        <p>Coeficiente de Temperatura de</p>
        <input type="text" name="coeficiente_temp_isc"/>

        <button type="submit" name="Guardar"> Guardar </button>
      


    </form>

    
</body>
</html>