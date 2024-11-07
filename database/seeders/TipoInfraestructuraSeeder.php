<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoInfraestructuraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_infraestructuras')->insert([
            ['nombre_tipo_infraestructura' => 'Viviendas'],
            ['nombre_tipo_infraestructura' => 'Potreros'],
            ['nombre_tipo_infraestructura' => 'Ganadera'],
            ['nombre_tipo_infraestructura' => 'Unidad Educativas'],
            ['nombre_tipo_infraestructura' => 'Puentes'],
            ['nombre_tipo_infraestructura' => 'Pozos de Peces'],
            ['nombre_tipo_infraestructura' => 'Agrícola'],
        ]);
    }
}
