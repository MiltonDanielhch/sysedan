<?php

namespace App\Http\Controllers;

use App\Models\Formulario;
use App\Models\Municipio;
use App\Models\Provincia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IncendioPorMunicipioController extends Controller
{
    public function index()
    {
        // Obtenemos las provincias con sus municipios
        $poblacionPorMunicipio = Provincia::with('municipios')->get()
            ->map(function ($provincia) {

                return [
                    $provincia->nombre_provincia => $provincia->municipios->map(function ($municipio) {
                        return [
                            $municipio->nombre_municipio,    // Nombre del municipio
                            $municipio->poblacion_total
                        ];
                    })
                ];
            });
            // dd($poblacionPorMunicipio);

            // $datosPorMunicipio = Provincia::with('municipio')->get()
            // ->map(function($provincia){
            //     return [
            //         $provincia->nombre_provincia => $provincia->municipios->map(function ($municipio){
            //             return [
            //                 $municipio->nombre_municipio,
            //                 $municipio->personaAfectadaIncendio[0]->cantidad_afectados_por_incendios
            //             ];
            //         })
            //     ];
            // });

            // $datosPorMunicipio = Municipio::join('provincias', 'provincias.id', '=', 'municipios.provincia_id')
            // ->join('comunidads', 'municipios.id', '=', 'comunidads.municipio_id')
            // ->join('formularios', 'comunidads.id', '=', 'formularios.comunidad_id')

            // // Subconsulta para los afectados por incendios
            // ->leftJoin(DB::raw('(SELECT formulario_id, SUM(cantidad_afectados_por_incendios) as total_afectados
            //                     FROM persona_afectada_incendios
            //                     GROUP BY formulario_id) as persona_afectada'), 'formularios.id', '=', 'persona_afectada.formulario_id')

            // // Subconsulta para los estudiantes
            // ->leftJoin(DB::raw('(SELECT formulario_id, SUM(numero_estudiantes) as total_estudiantes
            //                     FROM educacions
            //                     GROUP BY formulario_id) as educacion'), 'formularios.id', '=', 'educacion.formulario_id')

            // // Subconsulta para infraestructuras
            // ->leftJoin(DB::raw('(SELECT formulario_id, SUM(numeros_infraestructuras_afectadas) as total_infraestructuras
            //                     FROM infraestructuras
            //                     GROUP BY formulario_id) as infraestructura'), 'formularios.id', '=', 'infraestructura.formulario_id')

            // // Subconsulta para saluds
            // ->leftJoin(DB::raw('(SELECT formulario_id, SUM(cantidad_grupo_enfermos) as total_salud
            //                     FROM saluds
            //                     GROUP BY formulario_id) as salud'), 'formularios.id', '=', 'salud.formulario_id')

            // ->leftJoin(DB::raw('(SELECT formulario_id, SUM(numero_comunidades_afectadas) as total_servicio_basicos
            //                     FROM servicio_basicos
            //                     GROUP BY formulario_id) as servicio_basico'), 'formularios.id', '=', 'servicio_basico.formulario_id'
            //                     )
            // ->leftJoin(DB::raw('(SELECT formulario_id, SUM(numero_animales_afectados) as total_animales, SUM(numero_animales_fallecidos) as total_fallecidos
            //                     FROM sector_pecuarios
            //                     GROUP BY formulario_id) as sector_pecuario'), 'formularios.id', '=', 'sector_pecuario.formulario_id')

            // ->leftJoin(DB::raw('(SELECT formulario_id, SUM(hectareas_afectados) as hectareas_afectados, SUM(hectareas_perdidas) as hectareas_perdidas
            //                     FROM sector_agricolas
            //                     GROUP BY formulario_id) as sector_agricola'), 'formularios.id', '=', 'sector_agricola.formulario_id')

            // ->leftJoin(DB::raw('(SELECT formulario_id, SUM(hectareas_perdidas_forestales) as total_hectareas_perdidas_forestales
            //                     FROM area_forestals
            //                     GROUP BY formulario_id) as area_forestal'), 'formularios.id', '=', 'area_forestal.formulario_id')

            // ->leftJoin(DB::raw('(SELECT formulario_id, SUM(numero_fauna_silvestre) AS total_fauna_silvestre
            //                     FROM fauna_silvestres
            //                     GROUP BY formulario_id) as fauna_silvestre'), 'formularios.id', '=', 'fauna_silvestre.formulario_id')

            // ->leftJoin(DB::raw('(SELECT formulario_id, SUM(cantidad_plantines) AS total_cantidad_plantines
            //                     FROM reforestacions
            //                     GROUP BY formulario_id) as reforestacion'), 'formularios.id', '=', 'reforestacion.formulario_id')

            // // Seleccionamos las columnas que queremos y las sumas
            // ->select(
            //     'municipios.nombre_municipio',  // Seleccionar el nombre del municipio
            //     DB::raw('SUM(persona_afectada.total_afectados) as total_afectados'),
            //     DB::raw('SUM(educacion.total_estudiantes) as total_educacion'),
            //     DB::raw('SUM(infraestructura.total_infraestructuras) as total_infraestructuras'),
            //     DB::raw('SUM(salud.total_salud) as total_salud'),
            //     DB::raw('SUM(servicio_basico.total_servicio_basicos) as total_servicio_basicos'),
            //     DB::raw('SUM(sector_pecuario.total_animales) as total_animales'),
            //     DB::raw('SUM(sector_pecuario.total_fallecidos) as total_fallecidos'),
            //     DB::raw('SUM(sector_agricola.hectareas_afectados) as hectareas_afectados'),
            //     DB::raw('SUM(sector_agricola.hectareas_perdidas) as hectareas_perdidas'),
            //     DB::raw('SUM(area_forestal.total_hectareas_perdidas_forestales) as total_hectareas_perdidas_forestales'),
            //     DB::raw('SUM(fauna_silvestre.total_fauna_silvestre) as total_fauna_silvestre'),
            //     DB::raw('SUM(reforestacion.total_cantidad_plantines) as total_cantidad_plantines')
            // )
            // ->groupBy('municipios.id', 'municipios.nombre_municipio')  // Agrupar por municipio
            // ->get();


            // Realizamos la consulta en Formulario, y usamos joins para las relaciones de otros modelos
            $datosPorMunicipio = Formulario::join('comunidads', 'formularios.comunidad_id', '=', 'comunidads.id')
                ->join('municipios', 'comunidads.municipio_id', '=', 'municipios.id')
                ->join('provincias', 'municipios.provincia_id', '=', 'provincias.id')

                // Subconsultas para los diferentes modelos relacionados
                ->leftJoin(DB::raw('(SELECT formulario_id, SUM(cantidad_afectados_por_incendios) as total_afectados
                                     FROM persona_afectada_incendios
                                     GROUP BY formulario_id) as persona_afectada'), 'formularios.id', '=', 'persona_afectada.formulario_id')

                ->leftJoin(DB::raw('(SELECT formulario_id, SUM(numero_estudiantes) as total_estudiantes
                                     FROM educacions
                                     GROUP BY formulario_id) as educacion'), 'formularios.id', '=', 'educacion.formulario_id')

                ->leftJoin(DB::raw('(SELECT formulario_id, SUM(numeros_infraestructuras_afectadas) as total_infraestructuras
                                     FROM infraestructuras
                                     GROUP BY formulario_id) as infraestructura'), 'formularios.id', '=', 'infraestructura.formulario_id')

                ->leftJoin(DB::raw('(SELECT formulario_id, SUM(cantidad_grupo_enfermos) as total_salud
                                     FROM saluds
                                     GROUP BY formulario_id) as salud'), 'formularios.id', '=', 'salud.formulario_id')

                ->leftJoin(DB::raw('(SELECT formulario_id, SUM(numero_comunidades_afectadas) as total_servicio_basicos
                                     FROM servicio_basicos
                                     GROUP BY formulario_id) as servicio_basico'), 'formularios.id', '=', 'servicio_basico.formulario_id')

                ->leftJoin(DB::raw('(SELECT formulario_id, SUM(numero_animales_afectados) as total_animales, SUM(numero_animales_fallecidos) as total_fallecidos
                                     FROM sector_pecuarios
                                     GROUP BY formulario_id) as sector_pecuario'), 'formularios.id', '=', 'sector_pecuario.formulario_id')

                ->leftJoin(DB::raw('(SELECT formulario_id, SUM(hectareas_afectados) as hectareas_afectados, SUM(hectareas_perdidas) as hectareas_perdidas
                                     FROM sector_agricolas
                                     GROUP BY formulario_id) as sector_agricola'), 'formularios.id', '=', 'sector_agricola.formulario_id')

                ->leftJoin(DB::raw('(SELECT formulario_id, SUM(hectareas_perdidas_forestales) as total_hectareas_perdidas_forestales
                                     FROM area_forestals
                                     GROUP BY formulario_id) as area_forestal'), 'formularios.id', '=', 'area_forestal.formulario_id')

                ->leftJoin(DB::raw('(SELECT formulario_id, SUM(numero_fauna_silvestre) AS total_fauna_silvestre
                                     FROM fauna_silvestres
                                     GROUP BY formulario_id) as fauna_silvestre'), 'formularios.id', '=', 'fauna_silvestre.formulario_id')

                ->leftJoin(DB::raw('(SELECT formulario_id, SUM(cantidad_plantines) AS total_cantidad_plantines
                                     FROM reforestacions
                                     GROUP BY formulario_id) as reforestacion'), 'formularios.id', '=', 'reforestacion.formulario_id')

                // Seleccionamos las columnas que queremos y las sumas
                ->select(
                    'municipios.nombre_municipio',
                    DB::raw('SUM(persona_afectada.total_afectados) as total_afectados'),
                    DB::raw('SUM(educacion.total_estudiantes) as total_educacion'),
                    DB::raw('SUM(infraestructura.total_infraestructuras) as total_infraestructuras'),
                    DB::raw('SUM(salud.total_salud) as total_salud'),
                    DB::raw('SUM(servicio_basico.total_servicio_basicos) as total_servicio_basicos'),
                    DB::raw('SUM(sector_pecuario.total_animales) as total_animales'),
                    DB::raw('SUM(sector_pecuario.total_fallecidos) as total_fallecidos'),
                    DB::raw('SUM(sector_agricola.hectareas_afectados) as hectareas_afectados'),
                    DB::raw('SUM(sector_agricola.hectareas_perdidas) as hectareas_perdidas'),
                    DB::raw('SUM(area_forestal.total_hectareas_perdidas_forestales) as total_hectareas_perdidas_forestales'),
                    DB::raw('SUM(fauna_silvestre.total_fauna_silvestre) as total_fauna_silvestre'),
                    DB::raw('SUM(reforestacion.total_cantidad_plantines) as total_cantidad_plantines')
                )
                ->groupBy('municipios.id', 'municipios.nombre_municipio')
                ->get();

            // Procesamos los resultados
            $municipios = $datosPorMunicipio->map(function ($municipio) {
                return [
                    'nombre_municipio' => $municipio->nombre_municipio,
                    'total_afectados' => $municipio->total_afectados,
                    'total_educacion' => $municipio->total_educacion,
                    'total_infraestructuras' => $municipio->total_infraestructuras,
                    'total_salud' => $municipio->total_salud,
                    'total_servicio_basicos' => $municipio->total_servicio_basicos,
                    'total_animales' => $municipio->total_animales,
                    'total_fallecidos' => $municipio->total_fallecidos,
                    'hectareas_afectados' => $municipio->hectareas_afectados,
                    'hectareas_perdidas' => $municipio->hectareas_perdidas,
                    'total_hectareas_perdidas_forestales' => $municipio->total_hectareas_perdidas_forestales,
                    'total_fauna_silvestre' => $municipio->total_fauna_silvestre,
                    'total_cantidad_plantines' => $municipio->total_cantidad_plantines
                ];
            });

            // $datosPorMunicipioTrinidad = Formulario::join('comunidads', 'formularios.comunidad_id', '=', 'comunidads.id')
            // ->join('municipios', 'comunidads.municipio_id', '=', 'municipios.id')
            // ->join('provincias', 'municipios.provincia_id', '=', 'provincias.id')
            // // Unir con la tabla persona_afectada_incendios y grupo_etarios
            // ->leftJoin('persona_afectada_incendios', 'formularios.id', '=', 'persona_afectada_incendios.formulario_id')
            // ->leftJoin('grupo_etarios', 'persona_afectada_incendios.grupo_etario_id', '=', 'grupo_etarios.id')
            // ->select(
            //     'municipios.nombre_municipio',
            //     'grupo_etarios.nombre_grupo_etario',
            //     DB::raw('SUM(persona_afectada_incendios.cantidad_afectados_por_incendios) as total_afectados')
            // )
            // ->groupBy('municipios.id', 'municipios.nombre_municipio', 'grupo_etarios.id', 'grupo_etarios.nombre_grupo_etario')
            // ->get();

            $datosPorMunicipioTrinidad = Formulario::join('comunidads', 'formularios.comunidad_id', '=', 'comunidads.id')
            ->join('municipios', 'comunidads.municipio_id', '=', 'municipios.id')
            ->join('provincias', 'municipios.provincia_id', '=', 'provincias.id')
            // Unir con la tabla persona_afectada_incendios y grupo_etarios
            ->leftJoin('persona_afectada_incendios', 'formularios.id', '=', 'persona_afectada_incendios.formulario_id')
            ->leftJoin('grupo_etarios', 'persona_afectada_incendios.grupo_etario_id', '=', 'grupo_etarios.id')
            ->select(
                'municipios.nombre_municipio',
                DB::raw('SUM(CASE WHEN grupo_etarios.nombre_grupo_etario = "NNyA" THEN persona_afectada_incendios.cantidad_afectados_por_incendios ELSE 0 END) as nnya_afectados'),
                DB::raw('SUM(CASE WHEN grupo_etarios.nombre_grupo_etario = "Hombres" THEN persona_afectada_incendios.cantidad_afectados_por_incendios ELSE 0 END) as hombres_afectados'),
                DB::raw('SUM(CASE WHEN grupo_etarios.nombre_grupo_etario = "Mujeres" THEN persona_afectada_incendios.cantidad_afectados_por_incendios ELSE 0 END) as mujeres_afectados'),
                DB::raw('SUM(CASE WHEN grupo_etarios.nombre_grupo_etario = "Tercera Edad" THEN persona_afectada_incendios.cantidad_afectados_por_incendios ELSE 0 END) as tercera_edad_afectados'),
                DB::raw('SUM(CASE WHEN grupo_etarios.nombre_grupo_etario = "Persona con discapacidad" THEN persona_afectada_incendios.cantidad_afectados_por_incendios ELSE 0 END) as discapacidad_afectados'),
                DB::raw('SUM(persona_afectada_incendios.cantidad_afectados_por_incendios) as total_afectados')
            )
            ->groupBy('municipios.id', 'municipios.nombre_municipio')
            ->get();



            // dd($datosPorMunicipioTrinidad);
        // Devolvemos la vista con la variable 'poblacionPorMunicipio'
        return view('frontend.incendioMunicipio',
        compact(
        'poblacionPorMunicipio',
        'datosPorMunicipio',
        'datosPorMunicipioTrinidad'
    ));
    }

    // public function personaAfectada(){
    //     $personaAfectada = Provincia::with('municipio')->get()
    //     ->map(function($provincia){
    //         return [
    //             $provincia->nombre_provincia => $provincia->municipios->map(function ($municipio){
    //                 return [
    //                     $municipio->nombre_municipio,
    //                     $municipio->personaAfectadaIncendio[0]->cantidad_afectados_por_incendios
    //                 ];
    //             })
    //         ];
    //     });

    //     dd($personaAfectada);
    //     return view('frontend.incendioMunicipio', compact('personaAfectada'));
    // }

}
