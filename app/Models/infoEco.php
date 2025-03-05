<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class infoEco extends Model
{
    protected $table = "info_ecos";

    protected $fillable = [
        'financiacion_disponible',
        'condiciones_financiacion',
        'subvenciones',
        'proveedor',
        'telefono_proveedor',
        'email_proveedor',
    ];
}
