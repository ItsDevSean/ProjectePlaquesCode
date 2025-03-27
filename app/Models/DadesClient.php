<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DadesClient extends Model
{
    use HasFactory;

    protected $table = "dades_clients";

    protected $fillable = [
        'nombre', 'email', 'telefono', 'direccion', 'ciudad', 'codigo_postal',
        'nombre_proyecto', 'descripcion_proyecto', 'estacionalitat', 'tipo_instalacion',
        'user_id', 'estado_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }
}