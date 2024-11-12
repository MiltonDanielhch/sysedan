<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoCultivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_cultivos')->insert([
            ['nombre_tipo_cultivo' => 'Maíz'],
            ['nombre_tipo_cultivo' => 'Soya'],
            ['nombre_tipo_cultivo' => 'Arroz'],
            ['nombre_tipo_cultivo' => 'Frijol'],
            ['nombre_tipo_cultivo' => 'Sorgo'],
            ['nombre_tipo_cultivo' => 'Plátano'],
            ['nombre_tipo_cultivo' => 'Yuca'],
            ['nombre_tipo_cultivo' => 'Cacao'],
            ['nombre_tipo_cultivo' => 'Caña de azúcar'],
            ['nombre_tipo_cultivo' => 'Papaya'],
            ['nombre_tipo_cultivo' => 'Piña'],
            ['nombre_tipo_cultivo' => 'Sandía'],
            ['nombre_tipo_cultivo' => 'Cítricos'],
            ['nombre_tipo_cultivo' => 'Hortalizas'],
        ]);
    }
}
