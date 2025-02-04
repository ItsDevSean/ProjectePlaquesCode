<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactiva las restricciones de claves foráneas
    
        Post::truncate(); 
    
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Reactiva las restricciones de claves foráneas
    
        
        for ($i = 0; $i < 20; $i++) {
            $c = Category::inRandomOrder()->first()->first();
            $title = Str::random(20);
            Post::create([
                'title' =>$title,
                'slug'=> Str::slug($title),
                'content' => Str::random(20),
                'description' => Str::random(20),
                'status' => 'yes',
                'category_id'=> $c ->id,
            ]);
        }
    }
}
