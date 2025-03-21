<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inversores extends Model
{
    protected $table = "inversores";

    protected $fillable = [
        'nombre_inversor',
        'eficiencia',
        'tipo_instalacion',
        'garantia_material',
        'potencia_nominal',
        'descripcion',
        'fabricante_id',
        'microinversor',
        'garantia_fabricante',
        'imagen_inversor',
        'id_referencia',
        'user_id', 
    ];

    public function fabricante()
    {
        return $this->belongsTo(Fabricante::class, 'fabricante_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}