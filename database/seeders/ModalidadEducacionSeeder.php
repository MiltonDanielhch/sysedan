<?php

namespace Database\Seeders;

use App\Models\ModalidadEducacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModalidadEducacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModalidadEducacion::create([
            'nombre_modalidad_educacion' => 'Modalidad Presencial'
        ]);
        ModalidadEducacion::create([
            'nombre_modalidad_educacion' => 'Modalidad a Distancia'
        ]);
    }
}
