<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoServicioBasicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_servicio_basicos')->insert([
            ['nombre_servicio_basico' => 'Luz eléctrica'],
            ['nombre_servicio_basico' => 'Agua potable'],
            ['nombre_servicio_basico' => 'Alcantarillado'],
            ['nombre_servicio_basico' => 'Telecomunicaciones'],
            ['nombre_servicio_basico' => 'Caminos'],
        ]);
    }
}
