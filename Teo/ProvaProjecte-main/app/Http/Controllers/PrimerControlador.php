<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrimerControlador extends Controller
{
    function index() {
        $data2 = ['name' => 'Juan'];
        return view('contact', $data2);
    }
    function otro($post = 40, $otro = 30) {
        echo $post;
        echo $otro;
    }
}
