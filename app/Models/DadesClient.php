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
        'nombre_proyecto', 'descripcion_proyecto', 'estacionalidad', 'tipo_instalacion',
        'user_id', 'estado_id', 
        // Añadir todos los nuevos campos aquí
        'consum_anual', 'factura_anual', 'tarifa_acces', 'coste_instalacion',
        'subvenciones', 'precio_excedentes', 'patro_consum', 'inclinacion',
        'orientacion', 'radiacion_anual', 'max_placas', 'placa_count',
        'panel_potencia', 'panel_modelo', 'superficie', 'nova_area',
        // Los campos JSON
        'monthly_radiation', 'produccion_mensual', 'edifici_data',
        'obstacles', 'polygon', 'radiation_coords'
    ];

    protected $casts = [
        'monthly_radiation' => 'array',
        'produccion_mensual' => 'array',
        'edifici_data' => 'array',
        'obstacles' => 'array',
        'polygon' => 'array',
        'radiation_coords' => 'array'
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