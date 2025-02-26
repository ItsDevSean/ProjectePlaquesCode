<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caracteristicas fisicas panel</title>
    <link rel="stylesheet" type="text/css" href="build/css/fisico.css">
    <style></style>
</head>
<body>
    

    <form action="{{ route('guardar.informacionFisica') }}" method="post">

    @csrf
        {{-- Campo numérico en milímetros (mm) --}}
        <p>Longitud</p>
        <input type="text" name="longitud"/>

        {{-- Campo numérico en milímetros (mm) --}}
        <p>Anchura</p>
        <input type="text" name="anchura"/>

        {{-- Campo numérico en milímetros (mm) --}}
        <p>Espesor</p>
        <input type="text" name="espesor"/>

        {{-- Campo numérico en kilogramos (kg) --}}
        <p>Peso</p>
        <input type="text" name="peso"/>

        {{-- Campo numérico en metros cuadrados (m²) (puede calcularse automáticamente si se desea) --}}
        <p>Superficie</p>
        <input type="text" name="superficie"/>

        {{-- Área de texto para una descripción detallada del panel, que se podría utilizar para implementar el presupuesto por ejemplo, podría ser interesante un campo para el presupuesto y otro para observaciones de los usuarios. --}}
        <p>Descripcion</p>
        <input type="text" name="descripcion"/>

        {{--  Campo de texto para el enlace a la ficha técnica del fabricante. --}}
        <p>Url del Fabricante</p>
        <input type="text" name="url_fabricante"/>

        {{-- Campo para subir una imagen del panel. --}}
        <p>Imagen del Panel</p>
        <input type="text" name="imagen_panel"/>

        {{--  Menú desplegable con opciones como Aluminio, Acero, etc. --}}
        <p>Material del Marco </p>
        <input type="text" name="material_marco"/>
        
        {{-- Campo de texto (opcional) --}}
        <p>Opcional : color del panel</p>
        <input type="text" name="color_panel"/>

        <button type="submit">Guardar</button>


    </form>

    
</body>
</html>