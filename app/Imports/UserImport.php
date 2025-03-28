<?php

namespace App\Imports;

use App\Models\SolarPanelsModel;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

// Class that makes CSV imports
class UserImport implements ToModel, WithHeadingRow, WithCustomCsvSettings
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $fillable = (new SolarPanelsModel())->getFillable();
        $data = [];
        
        foreach ($fillable as $field) {
            // Convert CSV headers to match your fillable fields
            $csvField = str_replace('_', ' ', strtolower($field)); // Adjust based on your CSV headers
            $data[$field] = $row[$csvField] ?? null;
        }
        
        return new SolarPanelsModel($data);
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ',',
            'enclosure' => '"',
            'input_encoding' => 'UTF-8',
        ];
    }
}
