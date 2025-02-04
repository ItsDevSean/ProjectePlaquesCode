<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
class IndexController extends Controller
{
    function index(){
        $post = Post::paginate(5);
        return view("index.index",compact("post"));
    }
}
