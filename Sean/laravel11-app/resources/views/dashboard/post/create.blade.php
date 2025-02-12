@extends('dashboard.master')

@section('contect')
    <form action="{{ route('post.store') }}" method="POST" >

        @csrf

        <label for="">Title</label>
        <input type="text" name="title">

        <label for="">Slug</label>
        <input type="text" name="title">

        <label for="">Content</label>
        <textarea name="content"></textarea>

        <label for="">Categories</label>
        <select name="categories_id">
            @foreach ($categories as $title => $id)
                <option value="{{ $id }}">{{$title}}</option>
            @endforeach
        </select>

        <label for="">Posted</label>
        <select name="posted">
            <option value="Not">Not</option>
            <option value="yes">Yes</option>
        </select>

        <label for="">Description</label>
        <textarea name="description"></textarea>
        <button type="submit">Send</button>
    </form>

    
@endsection