<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>PAGINA DE REGISTRO</h1>
    @if (session('status'))
        {{'status'}}
    @endif
    @include('error')

    <form action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data">
        @method('PATCH')
        @csrf <!-- Token CSRF necesario -->
        
        <label for="title">TITULO</label>
        <input type="text" name="title" id="title" value="{{old("title",$user->title)}}">

        <label for="slug">SLUG</label>
        <input type="text" name="slug" id="slug" value="{{old("slug",$user->slug)}}">

        <label for="content">CONTENIDO</label>
        <textarea name="content" id="content">{{old("content",$user->content)}}</textarea>

        <label for="category_id">CATEGORY</label>
        <select name="category_id" id="category_id">
        @foreach ($categories as $title => $id )
        <option {{ $user->category && $user->category->id == $id ? 'selected' : '' }} value="{{ $id }}">{{ $title }}</option>


        @endforeach
        </select>

        <label for="description">DESCRIPTION</label>
        <textarea name="description" id="description">{{old("description",$user->description)}}</textarea>

        <label for="Status">STATUS</label>
        <select name="status" id="status">
            <option {{$user->status== 'no' ? 'selected' : ''}} value="no">No</option>
            <option {{$user->status== 'yes' ? 'selected' : ''}} value="yes">Yes</option>
        </select>
        
        
            <label for="">Image</label>
            <input class="form-control" type="file" name = "image">
        
        <button type="submit">Enviar</button>
    </form>

</body>
</html>
