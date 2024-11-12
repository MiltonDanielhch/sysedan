<?php

namespace Database\Seeders;




use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GrupoEtario as ModelsGrupoEtario;
class GrupoEtarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsGrupoEtario::create([
            'nombre_grupo_etario' => 'NNyA',
            'descripcion' => 'Personas menores de 18 años',
        ]);

        ModelsGrupoEtario::create([
            'nombre_grupo_etario' => 'Hombres',
            'descripcion' => 'Personas entre 18 y 65 años',
        ]);
        ModelsGrupoEtario::create([
            'nombre_grupo_etario' => 'Mujeres',
            'descripcion' => 'Personas entre 18 y 65 años',
        ]);
        ModelsGrupoEtario::create([
            'nombre_grupo_etario' => 'Tercera Edad',
            'descripcion' => 'Personas mayores de 65 años',
        ]);
        ModelsGrupoEtario::create([
            'nombre_grupo_etario' => 'Persona con discapacidad',
            'descripcion' => 'Personas con discapacidad',
        ]);
    }
}
