<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactiva las restricciones de claves foráneas
    
        Category::truncate(); 
    
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Reactiva las restricciones de claves foráneas
    
        for ($i = 0; $i < 20; $i++) {
            Category::create([
                'title' => "Category $i",
            ]);
        }
    }
    
}

