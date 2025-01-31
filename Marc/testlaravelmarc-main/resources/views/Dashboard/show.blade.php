<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>MOSTRAR DATOS DE LA TABLA</h1>
    
    @include('error')
    <h1>{{$user ->title}}</h1>
    <div>{{$user->description}}</div>
    <div>{{$user->content}}</div>
    <span>{{$user->status}}</span>
    <span>{{$user->category}}</span>
    <img src="{{ asset('uploads/posts/' . $user->image) }}" style="width:250px">
</body>
</html>
