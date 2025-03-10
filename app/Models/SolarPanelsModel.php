<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolarPanelsModel extends Model
{
    use HasFactory;

    protected $table = "solar_panels_tabel";
    
    protected $fillable = [
        'user_id', 'panel_model', 'manufacturer', 'panel_type', 
        'date_manufacturer', 'panel_warranty', 'performance_warranty', 
        'longitud', 'anchura', 'espesor', 'peso', 'superficie', 'descripcion',
        'url_fabricante', 'imagen_panel', 'material_marco', 'color_panel'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
}
