<div>
    @isset($header)

    <h1>{{$header}}</h1>

    @endisset
    
    @foreach ( $post as $p )
        <div class="card card-white mt-2">
        <h3>{{ $p -> title }}</h3>
        <a href="#">NAVEGAR</a>
        <p>{{$p-> description}}</p>
        </div>
        
    @endforeach

    @isset($extra)

    <h1>{{$extra}}</h1>

    @endisset

    @isset($footer)

    <h1>{{$footer}}</h1>

    @endisset

    {{$post->links()}}

    
</div> 