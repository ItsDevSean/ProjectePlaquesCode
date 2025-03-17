<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inversores extends Model
{
    protected $table = "inversores";

    protected $fillable = [
        'nombre',
        'eficencia',
        'tipo_instalacion',
        'garantia_material',
        'potencia_nominal',
        'descripcion',
        'fabricante',
        'microinversor',
        'garantia_fabricante',
        'imagen_inversor',
        'id_referencia'
    ];
}
