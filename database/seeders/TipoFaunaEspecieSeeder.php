<?php

namespace Database\Seeders;

use App\Models\TipoFaunaEspecie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoFaunaEspecieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoFaunaEspecie::insert([
            ['nombre_fauna_especie' => 'Mamíferos', 'descripcion' => 'Animales de sangre caliente que alimentan a sus crías con leche.'],
            ['nombre_fauna_especie' => 'Aves', 'descripcion' => 'Animales vertebrados de sangre caliente, ovíparos, con el cuerpo recubierto de plumas.'],
            ['nombre_fauna_especie' => 'Reptiles', 'descripcion' => 'Animales vertebrados de sangre fría, ovíparos o ovovivíparos, con la piel recubierta de escamas.'],
        ]);
    }
}
