<?php

namespace App\View\Components;

use Illuminate\View\Component;

// Definimos la clase CoordenadasLector que extiende de Component
class CoordenadasLector extends Component
{
    // Creamos un método render que nos devuelve la vista del componente
    public function render()
    {
        // Devolvemos vista 'components.coordenadas-lector'
        return view('components.coordenadas-lector');
        //Seguidamente nos dirigimos a components/coordenadas-lector.blade.php
    }
}