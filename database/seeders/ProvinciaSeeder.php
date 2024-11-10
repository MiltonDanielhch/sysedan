<?php

namespace Database\Seeders;

use App\Models\Provincia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provincias = [
            ['nombre_provincia' => 'Cercado'],
            ['nombre_provincia' => 'Yacuma'],
            ['nombre_provincia' => 'Moxos'],
            ['nombre_provincia' => 'Ballivián'],
            ['nombre_provincia' => 'Marbán'],
            ['nombre_provincia' => 'Iténez'],
            ['nombre_provincia' => 'Vaca Díez'],
            ['nombre_provincia' => 'Mamoré'],
        ];
        foreach ($provincias as $provincia) {
            Provincia::create($provincia);
        }

    }
}
