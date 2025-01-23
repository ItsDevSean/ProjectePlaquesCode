<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>The screen nomber one</h1>

    <h3><?php echo $age ?></h3> 

    <h3>{{ $name }}</h3>

    @if($name != "Seán")
        Your name is not Seán
    @else 
        You are the best :>
    @endif

    <ul>
    @foreach ([1,2,3,4,5] as $item)
        <li>{{ $item }}</li>
    @empty
        
    @endforelse
    
</body>
</html>