<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tramite;
use App\Models\Area;
use Illuminate\Support\Facades\DB;

class TramiteTupaSeeder extends Seeder {
    public function run(): void {
        $filePath = database_path('data/tasas2.csv');
        
        if (!file_exists($filePath)) {
            $this->command->error("No se encontró tasas2.csv en database/data/");
            return;
        }

        $file = fopen($filePath, 'r');
        fgetcsv($file, 0, ";"); // Saltamos la cabecera

        while (($row = fgetcsv($file, 0, ";")) !== FALSE) {
            if (empty($row[0])) continue;

            // CONVERSIÓN DE CODIFICACIÓN (Añade estas líneas)
            // Esto convierte de Windows-1252 (formato Excel común) a UTF-8
            $unidadNombre  = mb_convert_encoding(trim($row[0]), 'UTF-8', 'ISO-8859-1');
            $genericoText  = mb_convert_encoding(trim($row[1]), 'UTF-8', 'ISO-8859-1');
            $especifica    = mb_convert_encoding(trim($row[3]), 'UTF-8', 'ISO-8859-1');

            // 1. Unidad Orgánica
            $area = Area::firstOrCreate(['nombre' => $unidadNombre]);

            // 2. Limpieza de nombre y código
            $codigoTupa = null;
            $nombreTramite = $genericoText;
            if (preg_match('/^(\d+)\.\s*(.*)/', $genericoText, $matches)) {
                $codigoTupa = $matches[1];
                $nombreTramite = $matches[2];
            }

            // 3. Crear Trámite
            $tramite = Tramite::firstOrCreate(
                ['nombre_tramite' => $nombreTramite, 'id_area' => $area->id],
                ['codigo_tupa' => $codigoTupa, 'es_generico' => false]
            );

            // 4. Crear Requisito
            DB::table('requisitos')->insert([
                'tramite_id'  => $tramite->id_tramite,
                'descripcion' => $especifica, // Ahora ya está en UTF-8
                'orden'       => (int)$row[2],
                'importe'     => (float)str_replace(',', '.', $row[4]),
                'factor'      => (float)str_replace(',', '.', $row[5]),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
        fclose($file);
    }
}