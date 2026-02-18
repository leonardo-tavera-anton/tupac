<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Tramite;
use App\Models\Requisito;
use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TupaSeeder extends Seeder
{
    public function run(): void
    {
        $file = storage_path('app/tupa_data.csv');
        
        if (!file_exists($file)) {
            $this->command->error("Archivo no encontrado en: $file");
            return;
        }

        // Obtener el primer usuario o crear uno genérico
        $user = Usuario::first() ?: Usuario::create([
            'name' => 'Admin Sistema',
            'email' => 'admin@tupac.com',
            'password' => bcrypt('password'),
        ]);

        $handle = fopen($file, "r");
        $firstline = true;

        DB::beginTransaction();
        try {
            while (($data = fgetcsv($handle, 2000, ";")) !== FALSE) {
                // Si la línea está vacía o no tiene suficientes columnas, saltar
                if (!$data || count($data) < 2) continue;

                // Saltar cabecera
                if ($firstline) { $firstline = false; continue; }

                // data[0]=AREA, data[1]=TRAMITE, data[3]=ESPECIFICO, data[4]=IMPORTE
                $areaNombre    = trim($data[0] ?? 'SIN AREA');
                $tramiteNombre = trim($data[1] ?? 'SIN TRAMITE');
                $especifico    = trim($data[3] ?? 'General');
                $monto         = floatval($data[4] ?? 0);

                if (empty($areaNombre) || empty($tramiteNombre)) continue;

                // 1. Crear/Buscar Área
                $area = Area::firstOrCreate(['nombre' => $areaNombre]);

                // 2. Crear/Buscar Trámite
                $tramite = Tramite::firstOrCreate(
                    ['nombre_tramite' => $tramiteNombre, 'id_area' => $area->id],
                    ['usuario_id' => $user->id, 'monto' => 0.00]
                );

                // 3. Crear Requisito (Específico)
                Requisito::create([
                    'tramite_id' => $tramite->id_tramite,
                    'descripcion' => $especifico . " - S/. " . number_format($monto, 2),
                    'es_obligatorio' => true
                ]);
            }
            DB::commit();
            $this->command->info('✅ TUPA importado con éxito.');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error("❌ Error: " . $e->getMessage());
        }
        fclose($handle);
    }
}