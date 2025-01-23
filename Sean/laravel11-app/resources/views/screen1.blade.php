@extends('master')

@section('contect')
<h3>{{ $name }}</h3>

@if($name != "Seán")
    Your name is not Seán
@else 
    You are the best :>
@endif

<ul>
@foreach ([1,2,3,4,5] as $item)
    <li>{{ $item }}</li>
@endforeach
<ul>
    
@endsection