<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoEspecieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_especies')->insert([
            ['nombre_tipo_especie' => 'Bovinos'],
            ['nombre_tipo_especie' => 'Equinos'],
            ['nombre_tipo_especie' => 'Porcinos'],
            ['nombre_tipo_especie' => 'Aves'],
            ['nombre_tipo_especie' => 'Piscícolas'],
        ]);
    }
}
