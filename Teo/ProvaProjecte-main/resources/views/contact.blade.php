@extends('master')

@section('contect')

<h1>Contact 1</h1>
    <p>{{$name}}</p>

    @if($name != 'Paco')
    Tu nombre no es Paco

    @else
        Tu nombre es Paco
    @endif

    <ul>
    @foreach ([1,2,3,4,5] as $item)
        <li>{{$item}}</li>
        <!--El <li>, serveix per fer salt de linea i 
            que surtin amb un punt devant-->
    @endforeach
    </ul>
@endsection