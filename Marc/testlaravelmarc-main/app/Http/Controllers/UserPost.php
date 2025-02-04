<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatchRequest;
use App\Http\Requests\StoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;

class UserPost extends Controller
{
    public function index()
    {
        $user = Post::paginate(3);
        $category = Category::find(1);
        return view("Dashboard.index", compact("user", "category"));
    }

    public function create()
    {
        $categories = Category::pluck('title', 'id');
        return view("Dashboard.create", compact("categories"))->with('status', 'CREADO');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/posts'), $fileName);
            $data['image'] = $fileName;
        }

       
        Post::create($data);

        return to_route('user.index')->with('status', 'CREADO');
    }

    public function show(Post $user)
    {
        return view('Dashboard.show', ['user' => $user]);
    }

    public function edit(Post $user)
    {
        $categories = Category::pluck('id', 'title');
        return view('Dashboard.edit', compact('categories', 'user'))->with('status', 'ACTUALIZADO');
    }

    public function update(PatchRequest $request, Post $user)
    {
        $data = $request->validated();


        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/posts'), $fileName);
            $data['image'] = $fileName;
        }

     
        $user->update($data);

        return to_route('user.index')->with('status', 'ACTUALIZADO');;
    }

    public function destroy(Post $user)
    {
        if ($user->image) {
            $imagePath = public_path('uploads/posts/' . $user->image);
            if (file_exists($imagePath)) {
                unlink($imagePath); 
            }
        }

        $user->delete();

        return to_route('user.index')->with('status', 'DESTRUIDO');;
    }
}

