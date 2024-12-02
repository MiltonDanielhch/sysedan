<?php

namespace Database\Seeders;

use App\Models\Comunidad;
use App\Models\Municipio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComunidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comunidades = [
            // municipio Trinidad
            ['nombre_comunidad' =>  'Copacabana', 'tipo_comunidad'=>null, 'municipio' => 'Trinidad'],
            ['nombre_comunidad' =>  'Los Puentes', 'tipo_comunidad'=>null, 'municipio' => 'Trinidad'],
            ['nombre_comunidad' =>  'Puerto Almacén', 'tipo_comunidad'=>null, 'municipio' => 'Trinidad'],
            ['nombre_comunidad' =>  'Ibiato', 'tipo_comunidad'=>null, 'municipio' => 'Trinidad'],
            ['nombre_comunidad' =>  'Loma Suárez', 'tipo_comunidad'=>null, 'municipio' => 'Trinidad'],

            // San Javier
            ['nombre_comunidad' =>  '27 de Mayo', 'tipo_comunidad'=>null, 'municipio' => 'San Javier'],
            ['nombre_comunidad' =>  'San Javier', 'tipo_comunidad'=>null, 'municipio' => 'San Javier'],


            // Santa Ana del Yacuma
            ['nombre_comunidad' =>  'El Piraí', 'tipo_comunidad'=>null, 'municipio' => 'Santa Ana del Yacuma'],
            ['nombre_comunidad' =>  'El Retoño', 'tipo_comunidad'=>null, 'municipio' => 'Santa Ana del Yacuma'],
            ['nombre_comunidad' =>  'Los Tres Mandarinos', 'tipo_comunidad'=>null, 'municipio' => 'Santa Ana del Yacuma'],
            ['nombre_comunidad' =>  'Santa María del Apere', 'tipo_comunidad'=>null, 'municipio' => 'Santa Ana del Yacuma'],
            ['nombre_comunidad' =>  'Nueva Esperanza', 'tipo_comunidad'=>null, 'municipio' => 'Santa Ana del Yacuma'],
            ['nombre_comunidad' =>  'Chaco Brasil', 'tipo_comunidad'=>null, 'municipio' => 'Santa Ana del Yacuma'],
            ['nombre_comunidad' =>  'El Cedral', 'tipo_comunidad'=>null, 'municipio' => 'Santa Ana del Yacuma'],
            ['nombre_comunidad' =>  'Aguas Negras', 'tipo_comunidad'=>null, 'municipio' => 'Santa Ana del Yacuma'],
            ['nombre_comunidad' =>  'San Joaquín del Maniqui', 'tipo_comunidad'=>null, 'municipio' => 'Santa Ana del Yacuma'],
            ['nombre_comunidad' =>  'El Perú Río Apere', 'tipo_comunidad'=>null, 'municipio' => 'Santa Ana del Yacuma'],
            ['nombre_comunidad' =>  'Cero Ocho', 'tipo_comunidad'=>null, 'municipio' => 'Santa Ana del Yacuma'],
            ['nombre_comunidad' =>  'Turindi', 'tipo_comunidad'=>null, 'municipio' => 'Santa Ana del Yacuma'],
            ['nombre_comunidad' =>  'Soberanía', 'tipo_comunidad'=>null, 'municipio' => 'Santa Ana del Yacuma'],
            ['nombre_comunidad' =>  'El Lipimo', 'tipo_comunidad'=>null, 'municipio' => 'Santa Ana del Yacuma'],
            ['nombre_comunidad' =>  '18 de Noviembre', 'tipo_comunidad'=>null, 'municipio' => 'Santa Ana del Yacuma'],
            ['nombre_comunidad' =>  'La Finca', 'tipo_comunidad'=>null, 'municipio' => 'Santa Ana del Yacuma'],
            ['nombre_comunidad' =>  'Cotoca de Moseruna', 'tipo_comunidad'=>null, 'municipio' => 'Santa Ana del Yacuma'],
            ['nombre_comunidad' =>  'Maniquicito I', 'tipo_comunidad'=>null, 'municipio' => 'Santa Ana del Yacuma'],
            ['nombre_comunidad' =>  'Mapajo La Rampa', 'tipo_comunidad'=>null, 'municipio' => 'Santa Ana del Yacuma'],
            ['nombre_comunidad' =>  'Buen Día', 'tipo_comunidad'=>null, 'municipio' => 'Santa Ana del Yacuma'],
            ['nombre_comunidad' =>  'Totaizal', 'tipo_comunidad'=>null, 'municipio' => 'Santa Ana del Yacuma'],
            ['nombre_comunidad' =>  'San Miguel del Apere', 'tipo_comunidad'=>null, 'municipio' => 'Santa Ana del Yacuma'],
            ['nombre_comunidad' =>  'San Pedro del Apere', 'tipo_comunidad'=>null, 'municipio' => 'Santa Ana del Yacuma'],
            ['nombre_comunidad' =>  'Carmen del Iruyañez', 'tipo_comunidad'=>null, 'municipio' => 'Santa Ana del Yacuma'],
            ['nombre_comunidad' =>  'Miraflores', 'tipo_comunidad'=>null, 'municipio' => 'Santa Ana del Yacuma'],
            ['nombre_comunidad' =>  'Carnavales', 'tipo_comunidad'=>null, 'municipio' => 'Santa Ana del Yacuma'],
            ['nombre_comunidad' =>  'Carmen del Matto', 'tipo_comunidad'=>null, 'municipio' => 'Santa Ana del Yacuma'],
            ['nombre_comunidad' =>  'San Juan del Remanzo', 'tipo_comunidad'=>null, 'municipio' => 'Santa Ana del Yacuma'],
            ['nombre_comunidad' =>  'Montes de Oro', 'tipo_comunidad'=>null, 'municipio' => 'Santa Ana del Yacuma'],
            ['nombre_comunidad' =>  'Villa Fátima', 'tipo_comunidad'=>null, 'municipio' => 'Santa Ana del Yacuma'],

            // Exaltación
            ['nombre_comunidad' =>  'Las Abras', 'tipo_comunidad'=>null, 'municipio' => 'Exaltación'],

            // San Ignacio de Moxos
            ['nombre_comunidad' =>  'San Lorenzo', 'tipo_comunidad'=>null, 'municipio' => 'San Ignacio de Moxos'],
            ['nombre_comunidad' =>  'Litoral', 'tipo_comunidad'=>null, 'municipio' => 'San Ignacio de Moxos'],
            ['nombre_comunidad' =>  'Ichasawasare', 'tipo_comunidad'=>null, 'municipio' => 'San Ignacio de Moxos'],
            ['nombre_comunidad' =>  'Flores Coloradas', 'tipo_comunidad'=>null, 'municipio' => 'San Ignacio de Moxos'],
            ['nombre_comunidad' =>  'Chanequeré', 'tipo_comunidad'=>null, 'municipio' => 'San Ignacio de Moxos'],
            ['nombre_comunidad' =>  'San Pablo', 'tipo_comunidad'=>null, 'municipio' => 'San Ignacio de Moxos'],
            ['nombre_comunidad' =>  'Bella Brisa', 'tipo_comunidad'=>null, 'municipio' => 'San Ignacio de Moxos'],
            ['nombre_comunidad' =>  'San Ignacito', 'tipo_comunidad'=>null, 'municipio' => 'San Ignacio de Moxos'],
            ['nombre_comunidad' =>  'Las Mercedes del Apere', 'tipo_comunidad'=>null, 'municipio' => 'San Ignacio de Moxos'],
            ['nombre_comunidad' =>  'Tipnis', 'tipo_comunidad'=>null, 'municipio' => 'San Ignacio de Moxos'],

            // Santos Reyes
            ['nombre_comunidad' =>  'Carmen Alto del Genesguaya', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'Recreo', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'San Felipe', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'Misión Cavina', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'Carmen Alto del Beni', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'Baquetty', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'Campo Bolívar', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'Centrito', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'San Jose del Biata', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'Natividad', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'Monterrey', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'San Miguel', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'San Marcos', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'Candelaria', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'Santa Catalina', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'El Cozar', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'Villa Copacabana', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'San José', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'Guaguauno', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'Río Viejo', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'Puerto Salinas', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'San Juan', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'Rotije', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'San Pedro', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'Salsipuedes', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'Monte Carlos', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'Baychuje', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'Gualaguagua', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'Zoraida', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'Nuevo Reyes', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'Las Penitas', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'Peña Guarayo', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],
            ['nombre_comunidad' =>  'Nueva Alianza', 'tipo_comunidad'=>null, 'municipio' => 'Santos Reyes'],

            // Santa Rosa de Yacuma
            ['nombre_comunidad' =>  'San Cristóbal', 'tipo_comunidad'=>null, 'municipio' => 'Santa Rosa de Yacuma'],
            ['nombre_comunidad' =>  'Villa Fátima', 'tipo_comunidad'=>null, 'municipio' => 'Santa Rosa de Yacuma'],
            ['nombre_comunidad' =>  'Aguaysal', 'tipo_comunidad'=>null, 'municipio' => 'Santa Rosa de Yacuma'],
            ['nombre_comunidad' =>  'Triunfo', 'tipo_comunidad'=>null, 'municipio' => 'Santa Rosa de Yacuma'],
            ['nombre_comunidad' =>  'Puerto Yata', 'tipo_comunidad'=>null, 'municipio' => 'Santa Rosa de Yacuma'],
            ['nombre_comunidad' =>  'Tacuaral', 'tipo_comunidad'=>null, 'municipio' => 'Santa Rosa de Yacuma'],
            ['nombre_comunidad' =>  'Candado', 'tipo_comunidad'=>null, 'municipio' => 'Santa Rosa de Yacuma'],
            ['nombre_comunidad' =>  'Cerrito', 'tipo_comunidad'=>null, 'municipio' => 'Santa Rosa de Yacuma'],
            ['nombre_comunidad' =>  'Palmaflor', 'tipo_comunidad'=>null, 'municipio' => 'Santa Rosa de Yacuma'],
            ['nombre_comunidad' =>  'Australia', 'tipo_comunidad'=>null, 'municipio' => 'Santa Rosa de Yacuma'],
            ['nombre_comunidad' =>  'Cabador', 'tipo_comunidad'=>null, 'municipio' => 'Santa Rosa de Yacuma'],
            ['nombre_comunidad' =>  'Mojón', 'tipo_comunidad'=>null, 'municipio' => 'Santa Rosa de Yacuma'],

            // San Borja
            ['nombre_comunidad' =>  'Galilea', 'tipo_comunidad'=>null, 'municipio' => 'San Borja'],
            ['nombre_comunidad' =>  'El Triunfo', 'tipo_comunidad'=>null, 'municipio' => 'San Borja'],
            ['nombre_comunidad' =>  'Ivasichi', 'tipo_comunidad'=>null, 'municipio' => 'San Borja'],
            ['nombre_comunidad' =>  'Villa Gonzáles', 'tipo_comunidad'=>null, 'municipio' => 'San Borja'],
            ['nombre_comunidad' =>  'Tierra Santa', 'tipo_comunidad'=>null, 'municipio' => 'San Borja'],
            ['nombre_comunidad' =>  'Carmen del Yacuma', 'tipo_comunidad'=>null, 'municipio' => 'San Borja'],
            ['nombre_comunidad' =>  'Las Maravillas', 'tipo_comunidad'=>null, 'municipio' => 'San Borja'],
            ['nombre_comunidad' =>  'Oriende del Yacuma', 'tipo_comunidad'=>null, 'municipio' => 'San Borja'],
            ['nombre_comunidad' =>  'Puerto Triunfo', 'tipo_comunidad'=>null, 'municipio' => 'San Borja'],
            ['nombre_comunidad' =>  'Agua Zarca', 'tipo_comunidad'=>null, 'municipio' => 'San Borja'],
            ['nombre_comunidad' =>  'Canaán', 'tipo_comunidad'=>null, 'municipio' => 'San Borja'],
            ['nombre_comunidad' =>  'Edén', 'tipo_comunidad'=>null, 'municipio' => 'San Borja'],
            ['nombre_comunidad' =>  'Las Palmeras', 'tipo_comunidad'=>null, 'municipio' => 'San Borja'],
            ['nombre_comunidad' =>  'Santa Elena del Caripo', 'tipo_comunidad'=>null, 'municipio' => 'San Borja'],
            ['nombre_comunidad' =>  'Mercedes', 'tipo_comunidad'=>null, 'municipio' => 'San Borja'],
            ['nombre_comunidad' =>  'Tres Amigos', 'tipo_comunidad'=>null, 'municipio' => 'San Borja'],
            ['nombre_comunidad' =>  'Yacuma A', 'tipo_comunidad'=>null, 'municipio' => 'San Borja'],
            ['nombre_comunidad' =>  'Cachuela', 'tipo_comunidad'=>null, 'municipio' => 'San Borja'],
            ['nombre_comunidad' =>  'Villa Borjana', 'tipo_comunidad'=>null, 'municipio' => 'San Borja'],
            ['nombre_comunidad' =>  'Soledad', 'tipo_comunidad'=>null, 'municipio' => 'San Borja'],
            ['nombre_comunidad' =>  'El Progreso', 'tipo_comunidad'=>null, 'municipio' => 'San Borja'],
            ['nombre_comunidad' =>  'Belén', 'tipo_comunidad'=>null, 'municipio' => 'San Borja'],
            ['nombre_comunidad' =>  'San Lorenzo', 'tipo_comunidad'=>null, 'municipio' => 'San Borja'],

            // Rurrenabaque
            ['nombre_comunidad' =>  'Rio Hondo', 'tipo_comunidad'=>null, 'municipio' => 'Rurrenabaque'],
            ['nombre_comunidad' =>  'Alto Colorado', 'tipo_comunidad'=>null, 'municipio' => 'Rurrenabaque'],
            ['nombre_comunidad' =>  'Puerto Yumani', 'tipo_comunidad'=>null, 'municipio' => 'Rurrenabaque'],
            ['nombre_comunidad' =>  'Asunción Quiquibey', 'tipo_comunidad'=>null, 'municipio' => 'Rurrenabaque'],
            ['nombre_comunidad' =>  'Carmen Florida', 'tipo_comunidad'=>null, 'municipio' => 'Rurrenabaque'],
            ['nombre_comunidad' =>  'La Asunta', 'tipo_comunidad'=>null, 'municipio' => 'Rurrenabaque'],
            ['nombre_comunidad' =>  'Bibosis', 'tipo_comunidad'=>null, 'municipio' => 'Rurrenabaque'],
            ['nombre_comunidad' =>  'San Bernardo', 'tipo_comunidad'=>null, 'municipio' => 'Rurrenabaque'],
            ['nombre_comunidad' =>  'Wara Wara', 'tipo_comunidad'=>null, 'municipio' => 'Rurrenabaque'],
            ['nombre_comunidad' =>  'El Bala', 'tipo_comunidad'=>null, 'municipio' => 'Rurrenabaque'],
            ['nombre_comunidad' =>  'Santa Rosita', 'tipo_comunidad'=>null, 'municipio' => 'Rurrenabaque'],
            ['nombre_comunidad' =>  'Cuatro Ojitos', 'tipo_comunidad'=>null, 'municipio' => 'Rurrenabaque'],


            // Loreto
            ['nombre_comunidad' =>  'Villa Alba', 'tipo_comunidad'=>null, 'municipio' => 'Loreto'],
            ['nombre_comunidad' =>  'Miraflores', 'tipo_comunidad'=>null, 'municipio' => 'Loreto'],
            ['nombre_comunidad' =>  'Naranjito', 'tipo_comunidad'=>null, 'municipio' => 'Loreto'],
            ['nombre_comunidad' =>  'Buen Jesús', 'tipo_comunidad'=>null, 'municipio' => 'Loreto'],
            ['nombre_comunidad' =>  'Bella Selva', 'tipo_comunidad'=>null, 'municipio' => 'Loreto'],


            // san andres
            ['nombre_comunidad' =>  'San Andrés', 'tipo_comunidad'=>null, 'municipio' => 'San Andrés'],
            ['nombre_comunidad' =>  'Perotó', 'tipo_comunidad'=>null, 'municipio' => 'San Andrés'],
            ['nombre_comunidad' =>  'Somopae', 'tipo_comunidad'=>null, 'municipio' => 'San Andrés'],
            ['nombre_comunidad' =>  '1ro de Mayo', 'tipo_comunidad'=>null, 'municipio' => 'San Andrés'],
            ['nombre_comunidad' =>  'Villa San Andrés', 'tipo_comunidad'=>null, 'municipio' => 'San Andrés'],
            ['nombre_comunidad' =>  'Villa San Pedro', 'tipo_comunidad'=>null, 'municipio' => 'San Andrés'],
            ['nombre_comunidad' =>  'Puente San Pablo', 'tipo_comunidad'=>null, 'municipio' => 'San Andrés'],
            ['nombre_comunidad' =>  'Buen Jesús', 'tipo_comunidad'=>null, 'municipio' => 'San Andrés'],
            ['nombre_comunidad' =>  'San Martín de Porres', 'tipo_comunidad'=>null, 'municipio' => 'San Andrés'],
            ['nombre_comunidad' =>  'Santa Rosa', 'tipo_comunidad'=>null, 'municipio' => 'San Andrés'],
            ['nombre_comunidad' =>  '4 de Julio', 'tipo_comunidad'=>null, 'municipio' => 'San Andrés'],
            ['nombre_comunidad' =>  'Nueva Betania', 'tipo_comunidad'=>null, 'municipio' => 'San Andrés'],
            ['nombre_comunidad' =>  'Loma del Amor', 'tipo_comunidad'=>null, 'municipio' => 'San Andrés'],
            ['nombre_comunidad' =>  'La Galaxia', 'tipo_comunidad'=>null, 'municipio' => 'San Andrés'],
            ['nombre_comunidad' =>  'Rem. del Paraiso', 'tipo_comunidad'=>null, 'municipio' => 'San Andrés'],
            ['nombre_comunidad' =>  'Pedro Marbán', 'tipo_comunidad'=>null, 'municipio' => 'San Andrés'],
            ['nombre_comunidad' =>  'Zamaria', 'tipo_comunidad'=>null, 'municipio' => 'San Andrés'],
            ['nombre_comunidad' =>  'Caimanes', 'tipo_comunidad'=>null, 'municipio' => 'San Andrés'],
            ['nombre_comunidad' =>  'Laguna Azul', 'tipo_comunidad'=>null, 'municipio' => 'San Andrés'],
            ['nombre_comunidad' =>  '13 de Agosto', 'tipo_comunidad'=>null, 'municipio' => 'San Andrés'],
            ['nombre_comunidad' =>  'Villa Cruz', 'tipo_comunidad'=>null, 'municipio' => 'San Andrés'],
            ['nombre_comunidad' =>  'Pozo Honda', 'tipo_comunidad'=>null, 'municipio' => 'San Andrés'],
            ['nombre_comunidad' =>  'Nueva Alianza', 'tipo_comunidad'=>null, 'municipio' => 'San Andrés'],
            ['nombre_comunidad' =>  'Carmen del Dorado', 'tipo_comunidad'=>null, 'municipio' => 'San Andrés'],
            ['nombre_comunidad' =>  'El Triunfo', 'tipo_comunidad'=>null, 'municipio' => 'San Andrés'],
            ['nombre_comunidad' =>  'Villa Alba', 'tipo_comunidad'=>null, 'municipio' => 'San Andrés'],


            // Magdalena
            ['nombre_comunidad' =>  'Bella Vista', 'tipo_comunidad'=>null, 'municipio' => 'Magdalena'],
            ['nombre_comunidad' =>  'California', 'tipo_comunidad'=>null, 'municipio' => 'Magdalena'],
            ['nombre_comunidad' =>  'Buena Vista', 'tipo_comunidad'=>null, 'municipio' => 'Magdalena'],
            ['nombre_comunidad' =>  'Nueva Brema', 'tipo_comunidad'=>null, 'municipio' => 'Magdalena'],
            ['nombre_comunidad' =>  'El Escondido', 'tipo_comunidad'=>null, 'municipio' => 'Magdalena'],
            ['nombre_comunidad' =>  'La Soga', 'tipo_comunidad'=>null, 'municipio' => 'Magdalena'],
            ['nombre_comunidad' =>  'San Borja', 'tipo_comunidad'=>null, 'municipio' => 'Magdalena'],
            ['nombre_comunidad' =>  'La Cayoba', 'tipo_comunidad'=>null, 'municipio' => 'Magdalena'],
            ['nombre_comunidad' =>  'Nueva Calama', 'tipo_comunidad'=>null, 'municipio' => 'Magdalena'],
            ['nombre_comunidad' =>  'Cafetal', 'tipo_comunidad'=>null, 'municipio' => 'Magdalena'],
            ['nombre_comunidad' =>  'La Cafacha', 'tipo_comunidad'=>null, 'municipio' => 'Magdalena'],

            // Baures
            ['nombre_comunidad' =>  'Veremos', 'tipo_comunidad'=>null, 'municipio' => 'Baures'],
            ['nombre_comunidad' =>  'El Cairo II', 'tipo_comunidad'=>null, 'municipio' => 'Baures'],
            ['nombre_comunidad' =>  'Baures', 'tipo_comunidad'=>null, 'municipio' => 'Baures'],

            // Huacaraje
            ['nombre_comunidad' =>  'Huacaraje', 'tipo_comunidad'=>null, 'municipio' => 'Huacaraje'],
            ['nombre_comunidad' =>  'La Embrolla', 'tipo_comunidad'=>null, 'municipio' => 'Huacaraje'],
            ['nombre_comunidad' =>  'Pariagua', 'tipo_comunidad'=>null, 'municipio' => 'Huacaraje'],
            ['nombre_comunidad' =>  'Isla Grande', 'tipo_comunidad'=>null, 'municipio' => 'Huacaraje'],
            ['nombre_comunidad' =>  'El Carmen', 'tipo_comunidad'=>null, 'municipio' => 'Huacaraje'],
            ['nombre_comunidad' =>  'Besuria', 'tipo_comunidad'=>null, 'municipio' => 'Huacaraje'],
            ['nombre_comunidad' =>  'Buena Hora', 'tipo_comunidad'=>null, 'municipio' => 'Huacaraje'],
            ['nombre_comunidad' =>  'San Pedro', 'tipo_comunidad'=>null, 'municipio' => 'Huacaraje'],
            ['nombre_comunidad' =>  'La Esperanza', 'tipo_comunidad'=>null, 'municipio' => 'Huacaraje'],

            // San Ramón
            ['nombre_comunidad' =>  'La Laguna', 'tipo_comunidad'=>null, 'municipio' => 'San Ramón'],
            ['nombre_comunidad' =>  'Guarrasca', 'tipo_comunidad'=>null, 'municipio' => 'San Ramón'],
            ['nombre_comunidad' =>  'La Peña', 'tipo_comunidad'=>null, 'municipio' => 'San Ramón'],
            ['nombre_comunidad' =>  'Siringalito', 'tipo_comunidad'=>null, 'municipio' => 'San Ramón'],
            ['nombre_comunidad' =>  'Huacayane', 'tipo_comunidad'=>null, 'municipio' => 'San Ramón'],
            ['nombre_comunidad' =>  'Nicalapo', 'tipo_comunidad'=>null, 'municipio' => 'San Ramón'],

            // Riberalta
            ['nombre_comunidad' =>  'Medio Monte', 'tipo_comunidad'=>null, 'municipio' => 'Riberalta'],
            ['nombre_comunidad' =>  'Berlín', 'tipo_comunidad'=>null, 'municipio' => 'Riberalta'],
            ['nombre_comunidad' =>  'Bella Flor', 'tipo_comunidad'=>null, 'municipio' => 'Riberalta'],
            ['nombre_comunidad' =>  'Nazareth', 'tipo_comunidad'=>null, 'municipio' => 'Riberalta'],
            ['nombre_comunidad' =>  'Warnes', 'tipo_comunidad'=>null, 'municipio' => 'Riberalta'],
            ['nombre_comunidad' =>  'San Francisco', 'tipo_comunidad'=>null, 'municipio' => 'Riberalta'],
            ['nombre_comunidad' =>  'El Hondo', 'tipo_comunidad'=>null, 'municipio' => 'Riberalta'],
            ['nombre_comunidad' =>  'Tumichucua', 'tipo_comunidad'=>null, 'municipio' => 'Riberalta'],
            ['nombre_comunidad' =>  'San José Bajo', 'tipo_comunidad'=>null, 'municipio' => 'Riberalta'],
            ['nombre_comunidad' =>  'Cayuces', 'tipo_comunidad'=>null, 'municipio' => 'Riberalta'],
            ['nombre_comunidad' =>  'Nueva Unión', 'tipo_comunidad'=>null, 'municipio' => 'Riberalta'],
            ['nombre_comunidad' =>  'Recreo', 'tipo_comunidad'=>null, 'municipio' => 'Riberalta'],
            ['nombre_comunidad' =>  'Carmen Alto', 'tipo_comunidad'=>null, 'municipio' => 'Riberalta'],
            ['nombre_comunidad' =>  'Alta Gracia', 'tipo_comunidad'=>null, 'municipio' => 'Riberalta'],
            ['nombre_comunidad' =>  'Nueva Generación Productiva', 'tipo_comunidad'=>null, 'municipio' => 'Riberalta'],
            ['nombre_comunidad' =>  '12 de Octubre', 'tipo_comunidad'=>null, 'municipio' => 'Riberalta'],
            ['nombre_comunidad' =>  'Alto Ivón', 'tipo_comunidad'=>null, 'municipio' => 'Riberalta'],

            // Guayaramerín
            ['nombre_comunidad' =>  'La Unión', 'tipo_comunidad'=>null, 'municipio' => 'Guayaramerín'],
            ['nombre_comunidad' =>  'San Agustín', 'tipo_comunidad'=>null, 'municipio' => 'Guayaramerín'],
            ['nombre_comunidad' =>  '1ro de Mayo', 'tipo_comunidad'=>null, 'municipio' => 'Guayaramerín'],
            ['nombre_comunidad' =>  '8 de Febrero', 'tipo_comunidad'=>null, 'municipio' => 'Guayaramerín'],
            ['nombre_comunidad' =>  'San Lorenzo', 'tipo_comunidad'=>null, 'municipio' => 'Guayaramerín'],
            ['nombre_comunidad' =>  'San Miguel', 'tipo_comunidad'=>null, 'municipio' => 'Guayaramerín'],
            ['nombre_comunidad' =>  'San Roque', 'tipo_comunidad'=>null, 'municipio' => 'Guayaramerín'],
            ['nombre_comunidad' =>  'Barranco Colorado', 'tipo_comunidad'=>null, 'municipio' => 'Guayaramerín'],
            ['nombre_comunidad' =>  'Palmazola', 'tipo_comunidad'=>null, 'municipio' => 'Guayaramerín'],
            ['nombre_comunidad' =>  'Ranchío Grande', 'tipo_comunidad'=>null, 'municipio' => 'Guayaramerín'],
            ['nombre_comunidad' =>  'Cachuela del Mamoré', 'tipo_comunidad'=>null, 'municipio' => 'Guayaramerín'],

            // San Joaquin
            ['nombre_comunidad' =>  'San Mateo', 'tipo_comunidad'=>null, 'municipio' => 'San Joaquín'],
            ['nombre_comunidad' =>  'Monte Azul', 'tipo_comunidad'=>null, 'municipio' => 'San Joaquín'],
            ['nombre_comunidad' =>  'El Huaso', 'tipo_comunidad'=>null, 'municipio' => 'San Joaquín'],
            ['nombre_comunidad' =>  'Las Pavas', 'tipo_comunidad'=>null, 'municipio' => 'San Joaquín'],
            ['nombre_comunidad' =>  'Las Moscas', 'tipo_comunidad'=>null, 'municipio' => 'San Joaquín'],
            ['nombre_comunidad' =>  'Chaco Lejos', 'tipo_comunidad'=>null, 'municipio' => 'San Joaquín'],
            ['nombre_comunidad' =>  'Campo Alegre', 'tipo_comunidad'=>null, 'municipio' => 'San Joaquín'],
            ['nombre_comunidad' =>  'Surucucu', 'tipo_comunidad'=>null, 'municipio' => 'San Joaquín'],
            ['nombre_comunidad' =>  'Puerto Ustarez', 'tipo_comunidad'=>null, 'municipio' => 'San Joaquín'],

            // Puerto Siles
            ['nombre_comunidad' =>  'Lago Bolívar', 'tipo_comunidad'=>null, 'municipio' => 'Puerto Siles'],
            ['nombre_comunidad' =>  'Alejandría', 'tipo_comunidad'=>null, 'municipio' => 'Puerto Siles'],
            ['nombre_comunidad' =>  'Altura el Carmen', 'tipo_comunidad'=>null, 'municipio' => 'Puerto Siles'],
            ['nombre_comunidad' =>  'Santa Rosa del Vigo', 'tipo_comunidad'=>null, 'municipio' => 'Puerto Siles'],
            ['nombre_comunidad' =>  'Puerto Siles', 'tipo_comunidad'=>null, 'municipio' => 'Puerto Siles'],
        ];

        foreach ($comunidades as $comunidad) {
            $municipio = Municipio::where('nombre_municipio', $comunidad['municipio'])->firstOrFail();

            Comunidad::create([
                'nombre_comunidad' => $comunidad['nombre_comunidad'],
                'tipo_comunidad' => $comunidad['tipo_comunidad'],
                'municipio_id' => $municipio->id,
            ]);
        }

        // $comunidadData = [];
        // foreach ($comunidades as $comunidad) {
        //     $municipio = Municipio::where('nombre_municipio', $comunidad['municipio'])->firstOrFail();

        //     $comunidadData[] = [
        //         'nombre_comunidad' => $comunidad['nombre_comunidad'],
        //         'tipo_comunidad' => $comunidad['tipo_comunidad'],
        //         'municipio_id' => $municipio->id,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ];
        // }

        // // Insert all communities at once
        // DB::table('comunidades')->insert($comunidadData);
    }
}
