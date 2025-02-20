<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformacionElectricaPanel extends Model
{
    protected $table = "InformacionElectricaPanel";

    protected $fillable = [
        'potencia_maxima',
        'tension_maxima_potencia',
        'corriente_punto_maxima_potencia',
        'tension_circuito_abierto',
        'corriente_cortocircuito',
        'eficencia_panel',
        'coeficiente_temp_pmax',
        'coeficiente_temp_voc',
        'coeficiente_temp_isc',
    ];
}
