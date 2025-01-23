<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FirstController extends Controller
{
    function index() {
        $num_hobies = 2;
        $data = ['name' => 'Saxo', 'age' => $num_hobies];

        return view('screen1', $data);
    }
}
