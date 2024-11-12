<?php

namespace Database\Seeders;

use App\Models\Institucion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstitucionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Institucion::create([
            'nombre_institucion' => 'Unidades Educativas'
        ]);
        Institucion::create([
            'nombre_institucion' => 'Universidades'
        ]);
        Institucion::create([
            'nombre_institucion' => 'Institutos de Formación Técnica y Superior'
        ]);
    }
}
