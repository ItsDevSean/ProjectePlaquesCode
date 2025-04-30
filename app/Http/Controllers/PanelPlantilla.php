<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;


class PanelPlantilla extends Controller
{
    public function download()
    {
        $content = "panel_model,fabricante_id,panel_type,date_manufacturer,panel_warranty,performance_warranty,longitud_v2,anchura,espesor,peso,superficie,descripcion,url_fabricante,imagen_panel,material_marco,color_panel,potencia_maxima,tension_maxima_potencia,corriente_punto_maxima_potencia,tension_circuito_abierto,corriente_cortocircuito,eficencia_panel,coeficiente_temp_pmax,coeficiente_temp_voc,coeficiente_temp_isc";
        $fileName = "PanelesPlantilla.csv";

        return response($content)
            ->header('Content-Type', 'text/plain')
            ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }
}
