<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolarPanelsModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'panel_model', 'manufacturer', 'panel_type', 
        'date_manufacturer', 'panel_warranty', 'performance_warranty',
        'maximum_power', 'voltage_maximum_power_point', 'current_maximum_power_point',
        'open_circuit_voltage', 'short_circuit_current', 'panel_efficiency'
    ];
}
