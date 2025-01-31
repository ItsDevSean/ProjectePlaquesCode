<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrimerControlador extends Controller
{
    /**
     * Summary of index
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * 
     * La función index es una muy simple.
     * Se encarga de que al ser llamada devuelve una ruta con los valores que la ruta necesita mostrar.
     * 
     */
    function index(){
        $data =['nombre' => 'Alberto', 'apellido' => 'chicote'];
        return view("contact",compact("data"));
    }


    /**
     * Summary of otro
     * @param mixed $post
     * @return void
     * 
     * Esta funcion hace que cuando se llegue a la ruta [/otro] lo que se le pase a continuacion se muestre.
     * Ejemplo:
     * testlaramarc.test/otro/macarrones
     * A la función otro le llegara el texto macarrones y lo imprimira por pantalla.
     * Tambien se le puede poner valores por defecto: $post = hola
     * 
     */
    function otro($post){
        echo $post;
    }
}
