<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Registro de usuario</h1>
    
    <p>{{ $mensaje }}</p>
    <p>{{ $respuesta }}</p>
    <form method="post" action="C:\laragon\www\testLaravelMarc\app\Http\Controllers\PrimerControlador.php"></form>
    Pon tu usuario : <input type="text" name="usuario" required><br>
    Tu contraseña : <input type="text" name="contraseña"required><br>
    Nombre: <input type="text" name="nombre" required><br>
    Apellido : <input type="text" name="apellido" required><br>
    Correo : <input type="text" name="correo" required><br>
    Telefono : <input type="text" name="telefono" required><br>
    <input type ="submit" value="Register">


</body>
</html>