<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class infoEcoResultadoPanel extends Model
{
    protected $table = "info_eco_resultados";

    

    protected $fillable = [
        'precio_modulo',
        'descuento',
        'precio_descuento',
        'impuesto_aplicable',
        'precio_final',
        'moneda',
        'coste_envio',
        'coste_instalacion',
        'periodo_amortizacion',
        'rentabilidad_esperada'
    ];
}

