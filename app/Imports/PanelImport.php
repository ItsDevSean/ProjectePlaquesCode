<?php

namespace App\Imports;

use App\Models\SolarPanelsModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PanelImport implements ToModel, WithHeadingRow, WithCustomCsvSettings
{
    // Function that maps the CSV field to DB fields.
    public function model(array $row)
    {
        $fillable = (new SolarPanelsModel())->getFillable();
        $data = [];
        foreach ($fillable as $field) {
            if ($field == 'user_id') {
                $data[$field] = Auth::id();
            } else {
                $data[$field] = isset($row[$field]) ? $row[$field] : null;
            }
        }        
        return new SolarPanelsModel($data);
    }
    // Function that specify the specified rules of the CSV
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ',',
            'enclosure' => '"',
            'input_encoding' => 'UTF-8',
        ];
    }
}