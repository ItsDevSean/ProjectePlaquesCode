<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estados = ['pendiente', 'en_progreso', 'completado'];

        foreach ($estados as $estado) {
            DB::table('estados')->updateOrInsert(
                ['nombre' => $estado], // Condición para verificar si ya existe
                ['nombre' => $estado]  // Datos a insertar si no existe
            );
        }
    }
}
