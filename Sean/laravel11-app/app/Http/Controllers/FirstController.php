<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FirstController extends Controller
{
    function index() {
        $post = ['post1, post2'];
        //return view('screen1', ['post'=>$post]); //this is more longe
        return view('screen1', compact('post')); //this is a easyst whay.
    } 

    function other($post, $other) {
        echo $post + $other;
    }
}
