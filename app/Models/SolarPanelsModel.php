<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolarPanelsModel extends Model
{
    use HasFactory;

    protected $table = "solar_panels_tabel";
    
    protected $fillable = [
        'panel_model', 'manufacturer', 'panel_type', 
        'date_manufacturer', 'panel_warranty', 'performance_warranty'
    ];
}
