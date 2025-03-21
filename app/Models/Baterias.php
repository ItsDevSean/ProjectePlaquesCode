<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Baterias extends Model
{
    protected $table = "baterias";

    protected $fillable = [
        'nombre_bateria',
        'coste',
        'garantia_fabricante',
        'descripcion',
        'id_referencia',
        'capacidad',
        'fabricante',
        'garantia_material',
        'imagen_bateria',
    ];
}
