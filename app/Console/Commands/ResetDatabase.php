<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ResetDatabase extends Command
{
    protected $signature = 'reset:database';
    protected $description = 'Elimina todos los datos de las tablas de la base de datos';

    public function handle()
    {
        // Desactivar las restricciones de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Obtener todas las tablas de la base de datos
        $tables = DB::select('SHOW TABLES');

        // Truncar todas las tablas
        foreach ($tables as $table) {
            // Acceder al nombre de la tabla correctamente
            $tableName = $table->Tables_in_ . env('DB_DATABASE');

            // Truncar la tabla
            DB::table($tableName)->truncate();
        }

        // Reactivar las restricciones de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->info('Datos eliminados de todas las tablas.');
    }
}
