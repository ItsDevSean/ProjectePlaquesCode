<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class DadesClient extends Model
{
    use HasFactory;

    protected $table = "DadesClient";

    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'direccion',
        'ciudad',
        'codigo_postal',
    ];

    
}
