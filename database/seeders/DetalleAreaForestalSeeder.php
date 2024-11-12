<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetalleAreaForestalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('detalle_area_forestals')->insert([
            ['nombre_detalle_area_forestal' => 'Forrajes o pastizales'],
            ['nombre_detalle_area_forestal' => 'Áreas protegidas'],
            ['nombre_detalle_area_forestal' => 'Pampas'],
            ['nombre_detalle_area_forestal' => 'Bosques'],
            ['nombre_detalle_area_forestal' => 'Serranías'],
            ['nombre_detalle_area_forestal' => 'Forestal maderable'],
            ['nombre_detalle_area_forestal' => 'Bosque con castaña'],
        ]);
    }
}
