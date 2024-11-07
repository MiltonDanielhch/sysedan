<?php

namespace Database\Seeders;

use App\Models\Municipio;
use App\Models\Provincia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class MunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $municipios = [
            // Provincia: Cercado
            ['nombre_municipio' =>  'Trinidad', 'poblacion_total'=>124.357, 'nombre_alcalde'=>'Cristhian Miguel Cámara Arratia', 'provincia' => 'Cercado'],
            ['nombre_municipio' => 'San Javier', 'poblacion_total'=>7.654, 'nombre_alcalde'=>'Dany Añez Montalván', 'provincia' => 'Cercado'],

            // Provincia: Yacuma
            ['nombre_municipio' => 'Santa Ana del Yacuma', 'poblacion_total'=>18.102, 'nombre_alcalde'=>'Roció Roca Roca', 'provincia' => 'Yacuma'],
            ['nombre_municipio' => 'Exaltación', 'poblacion_total'=>7.890, 'nombre_alcalde'=>'Gonzalo Alfonso Hurtado Toro', 'provincia' => 'Yacuma'],

            // Provincia: Moxos
            ['nombre_municipio' => 'San Ignacio de Moxos', 'poblacion_total'=>21.578, 'nombre_alcalde'=>'Juan Carlos Abularach Suarez', 'provincia' => 'Moxos'],

            // Provincia: Ballivián
            ['nombre_municipio' => 'Santos Reyes', 'poblacion_total'=>11.274, 'nombre_alcalde'=>'Mercedes Molina Vásquez', 'provincia' => 'Ballivián'],
            ['nombre_municipio' => 'Santa Rosa de Yacuma', 'poblacion_total'=>10.910, 'nombre_alcalde'=>'Javier Nogales Jaime', 'provincia' => 'Ballivián'],
            ['nombre_municipio' => 'San Borja', 'poblacion_total'=>45.562, 'nombre_alcalde'=>'Walter Ronal Tovias Simón', 'provincia' => 'Ballivián'],
            ['nombre_municipio' => 'Rurrenabaque','poblacion_total'=>21.018, 'nombre_alcalde'=>'Elías Moreno Vargas', 'provincia' => 'Ballivián'],

            // Provincia: Marbán
            ['nombre_municipio' => 'Loreto', 'poblacion_total'=>4.263, 'nombre_alcalde'=>'Yascara Moreno Flores', 'provincia' => 'Marbán'],
            ['nombre_municipio' => 'San Andrés', 'poblacion_total'=>15.635, 'nombre_alcalde'=>'Eber Rudy Vásquez Mamani', 'provincia' => 'Marbán'],

            // // Provincia: Iténez
            ['nombre_municipio' => 'Magdalena', 'poblacion_total'=>12.769, 'nombre_alcalde'=>'Jorge Donny Chávez Suarez', 'provincia' => 'Iténez'],
            ['nombre_municipio' => 'Baures', 'poblacion_total'=>6.564, 'nombre_alcalde'=>'Roberto Eduardo Ayllón Castedo', 'provincia' => 'Iténez'],
            ['nombre_municipio' => 'Huacaraje', 'poblacion_total'=>4.628, 'nombre_alcalde'=>'Everty Orihuela Mercado', 'provincia' => 'Iténez'],

            // // Provincia: Vaca Díez
            ['nombre_municipio' => 'Riberalta', 'poblacion_total'=>107.141, 'nombre_alcalde'=>'Ciriaco Rodríguez Vásquez', 'provincia' => 'Vaca Díez'],
            ['nombre_municipio' => 'Guayaramerín', 'poblacion_total'=>40.759, 'nombre_alcalde'=>'Ángel Freddy Maimura Reina',  'provincia' => 'Vaca Díez'],

            // // Provincia: Mamoré
            ['nombre_municipio' => 'San Joaquín', 'poblacion_total'=>6.851, 'nombre_alcalde'=>'Carmen Eris Lima Lobo Dorado', 'provincia' => 'Mamoré'],
            ['nombre_municipio' => 'San Ramón', 'poblacion_total'=>5.441, 'nombre_alcalde'=>'German Sánchez Padilla', 'provincia' => 'Mamoré'],
            ['nombre_municipio' => 'Puerto Siles', 'poblacion_total'=>1.095, 'nombre_alcalde'=>'Darwin Perrogon Rodríguez', 'provincia' => 'Mamoré'],

        ];

        foreach ($municipios as $municipio) {
            try {
                 // Validación
                if (!is_numeric($municipio['poblacion_total'])) {
                    throw new \Exception('La población debe ser un número.');
                }


                $provincia = Provincia::where('nombre_provincia', $municipio['provincia'])->firstOrFail();

                Municipio::create([
                    'poblacion_total' => $municipio['poblacion_total'],
                    'nombre_alcalde' => $municipio['nombre_alcalde'],
                    'nombre_municipio' => $municipio['nombre_municipio'],
                    'provincia_id' => $provincia->id,
                ]);

                Log::info('Municipio creado exitosamente: ' . $municipio['nombre_municipio']);
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                Log::error('Provincia no encontrada para el municipio: ' . $municipio['nombre_municipio'], ['exception' => $e]);
            } catch (\Exception $e) {
                Log::error('Error al crear el municipio: ' . $municipio['nombre_municipio'], ['exception' => $e]);
            }
        }

    }
}
