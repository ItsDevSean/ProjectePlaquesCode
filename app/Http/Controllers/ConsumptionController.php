<?php

namespace App\Http\Controllers;

use App\Models\ConsumptionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsumptionController extends Controller
{
    public function index() {
        $electicConsumption = ["hello"];
        return view('consum', compact('electicConsumption'));
    }

    public function validation(Request $request) 
    {
        $request->validate([
            'Year' => 'required|numeric|min:1900',
            'Month' => 'required|string',
            'Electric Consumption (kWh)' => 'required|numeric|min:1',
            'Bill Amount ($)' => 'required|numeric|min:1',
        ]);
    }

    public function import(Request $request) 
    {
        $electicConsumption = [];
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt'
        ]);
        $file = $request->file('csv_file');
         
        if (!$file || !file_exists($file->getRealPath() )) {
            return back()->with('error', 'Invalid file!');
        }
        $data = array_map('str_getcsv', file($file->getRealPath()));
        if (empty($data) || count($data) <= 1) {  
            return back()->with('error', 'CSV file is empty or invalid!');
        }
        $headers = array_shift($data); 
        $expectedHeaders = (new ConsumptionModel())->getFillable();
        //dd($expectedHeaders);
        if ($headers !== $expectedHeaders) {
            return back()->with('error', 'CSV headers are not valid!');
        }
        foreach ($data as $row) {
            $rowData = [];
            foreach ($expectedHeaders as $index => $header) {
                $rowData[$header] = $row[$index];
            }
            $newRequest = new Request($rowData);
            try {
                $this->validation($newRequest);
                $rowData['user_id'] = Auth::id();
                $electicConsumption[] = $rowData;
            } catch (\Exception $e) {
                return back()->with('error', "Error processing row " . ($index + 1) . ": " . $e->getMessage());
            }
        }
        return view('pujarFitxer', compact('electicConsumption')); //toDo: evitar que refesque
    }
}
