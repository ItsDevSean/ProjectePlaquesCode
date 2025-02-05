<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PutRequestApi;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    
    public function index()
    {
        return response()->json([
           Post::paginate(5)
        ]);
    }

    public function store(PutRequestApi $request)
    {
        return response()->json(Post::create($request->validated()));
    }


    public function show(Post $post)
    {
        return response()->json($post);
    }


    
    public function update(PutRequestApi $request, Post $post)
    {
        $post->update($request->validated());
        return response()->json($post);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json('ok');
    }
}
