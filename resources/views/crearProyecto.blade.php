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
    

    <form action="{{ route('guardar.proyecto') }}" method="POST">
    @csrf 
        <div>
            <label for="Nombre">Nombre del Proyecto</label>
            <input type="text" id="Nombre" name="Nombre" required>
        </div>

        <div>
            <label for="Latitud">Latitud</label>
            <input type="number" id="Latitud" name="Latitud" required>
        </div>

        <div>
            <label for="Longitud">Longitud</label>
            <input type="number" id="Longitud" name="Longitud" required>
        </div>

        <div>
            <label for="Descripcion">Descripción</label>
            <textarea id="Descripcion" name="Descripcion"></textarea>
        </div>

        <button type="submit">Guardar Proyecto</button>
    </form>

    
</body>
</html>