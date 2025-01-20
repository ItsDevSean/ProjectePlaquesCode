<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>PAGINA DE CONTACTO</h1>
    <p>{{$nombre}}</p>
    <p>{{$apellido}}</p>

    @php
    echo'hola'
    @endphp
</br>
</br>
    @if ($nombre != "alberto")
        Chaval no eres Alberto
    @endif
    
</body>
</html>