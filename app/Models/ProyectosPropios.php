<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectosPropios extends Model
{
        use HasFactory;
    
        protected $table = "proyectospropios";
    
        protected $fillable = [
            'Nombre',
            'Latitud',
            'Longitud',
            'Descripcion',
        ];
    }
    