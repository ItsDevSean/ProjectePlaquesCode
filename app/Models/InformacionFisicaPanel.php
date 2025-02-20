<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformacionFisicaPanel extends Model
{
    use HasFactory;

    protected $table = "InformacionFisicaPanel";

    protected $fillable = [
        'longitud',
        'anchura',
        'espesor',
        'peso',
        'superficie',
        'descripcion',
        'url_fabricante',
        'imagen_panel',
        'material_marco',
        'color_panel'
    ];
}
