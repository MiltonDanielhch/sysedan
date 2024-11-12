<?php

namespace Database\Seeders;

use App\Models\DetalleEnfermedad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetalleEnfermedadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $enfermedades = [
            'Conjuntivitis' => 'Inflamación de la conjuntiva del ojo.',
            'Respiratorias Agudas' => 'Infección del sistema respiratorio superior.',
            'Neumonías' => 'Infección de los pulmones.',
            'Otro' => 'Otras enfermedades no especificadas.',
            'Fallecimientos' => 'Número de muertes relacionadas con las enfermedades mencionadas.',

        ];

        foreach ($enfermedades as $nombre => $descripcion) {
            DetalleEnfermedad::create([
                'nombre_detalle_enfermedad' => $nombre,
                'descripcion' => $descripcion,
            ]);
        }
    }
}
