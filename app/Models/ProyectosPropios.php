<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectosPropios extends Model
{
        use HasFactory;
    
        protected $table = "InformacionFisicaPanel";
    
        protected $fillable = [
            'asignado',
            'estado',
            'nombre_proyecto',
            'cliente',
            'tarifa',
            'potencia_pico',
            'pvp',
        ];
    }
    