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
        'garantia_material',
        'imagen_bateria',
        'fabricante_id',
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
