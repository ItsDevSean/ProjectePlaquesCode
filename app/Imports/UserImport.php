<?php

namespace App\Imports;

use App\Models\SolarPanelsModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToModel, WithHeadingRow, WithCustomCsvSettings
{
    public function model(array $row)
    {
        // Map CSV headers to the model's fillable attributes
        $fillable = (new SolarPanelsModel())->getFillable();
        $data = [];

        foreach ($fillable as $field) {
            if ($field == 'user_id') {
                $data[$field] = Auth::id();
            } else {
                $data[$field] = isset($row[$field]) ? $row[$field] : null;
            }
        }

        Log::info('Imported data:', $data);
        
        return new SolarPanelsModel($data);
    }

    public function getCsvSettings(): array
    {
        // Custom CSV settings: define delimiter, enclosure, and encoding
        return [
            'delimiter' => ',',
            'enclosure' => '"',
            'input_encoding' => 'UTF-8',
        ];
    }
}