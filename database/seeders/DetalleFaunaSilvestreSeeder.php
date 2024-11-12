<?php

namespace Database\Seeders;

use App\Models\DetalleFaunaSilvestre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetalleFaunaSilvestreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DetalleFaunaSilvestre::insert([
            ['nombre_detalle_fauna_silvestre' => 'Atención de fauna silvestre'],
            ['nombre_detalle_fauna_silvestre' => 'Derivación de fauna silvestre a centros de custodio'],
            ['nombre_detalle_fauna_silvestre' => 'Traslocación de fauna'],
            ['nombre_detalle_fauna_silvestre' => 'Deceso de animales silvestres'],
        ]);
    }
}
