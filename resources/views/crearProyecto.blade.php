<form action="{{ route('guardar.proyecto') }}" method="POST">
    @csrf 
    <div>
        <label for="nombre">Nombre del Proyecto</label>
        <input type="text" id="nombre" name="nombre" required>
    </div>

    <div>
        <label for="latitud">Latitud</label>
        <input type="number" id="latitud" name="latitud" required>
    </div>

    <div>
        <label for="longitud">Longitud</label>
        <input type="number" id="longitud" name="longitud" required>
    </div>

    <div>
        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion"></textarea>
    </div>

    <button type="submit">Guardar Proyecto</button>
</form>
