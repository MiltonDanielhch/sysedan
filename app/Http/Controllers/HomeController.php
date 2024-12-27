<?php

namespace App\Http\Controllers;

use App\Models\Formulario;
use App\Models\Provincia;
use App\Models\Comunidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    
        // $afectadosPorProvincia = Provincia::join('municipios', 'provincias.id', '=', 'municipios.provincia_id')
        //     ->join('comunidads', 'municipios.id', '=', 'comunidads.municipio_id')
        //     ->join('formularios', 'comunidads.id', '=', 'formularios.comunidad_id')
        //     ->join('persona_afectada_incendios', 'formularios.id', '=', 'persona_afectada_incendios.formulario_id')
        //     ->select('provincias.nombre_provincia', DB::raw('SUM(persona_afectada_incendios.cantidad_afectados_por_incendios) as total_afectados'))
        //     ->groupBy('provincias.id', 'provincias.nombre_provincia')
        //     ->get();

        // $educacionsPorProvincia = Provincia::join('municipios', 'provincias.id', '=', 'municipios.provincia_id')
        //     ->join('comunidads', 'municipios.id', '=', 'comunidads.municipio_id')
        //     ->join('formularios', 'comunidads.id', '=', 'formularios.comunidad_id')
        //     ->join('educacions', 'formularios.id', '=', 'educacions.formulario_id')
        //     ->select('provincias.nombre_provincia', DB::raw('SUM(educacions.numero_estudiantes) as total_educacion'))
        //     ->groupBy('provincias.id', 'provincias.nombre_provincia')
        //     ->get();

        // $infraestructurasPorProvincias = Provincia::join('municipios', 'provincias.id', '=', 'municipios.provincia_id')
        //     ->join('comunidads', 'municipios.id', '=', 'comunidads.municipio_id')
        //     ->join('formularios', 'comunidads.id', '=', 'formularios.comunidad_id')
        //     ->join('infraestructuras', 'formularios.id', '=', 'infraestructuras.formulario_id')
        //     ->select('provincias.nombre_provincia', DB::raw('SUM(infraestructuras.numeros_infraestructuras_afectadas) as total_infraestructuras'))
        //     ->groupBy('provincias.id', 'provincias.nombre_provincia')
        //     ->get();


    public function index(){
        $poblacionPorProvincia = Provincia::with('municipios')
        ->get()
        ->map(function ($provincia) {
            return (object) [
                'nombre_provincia' => $provincia->nombre_provincia,
                'poblacion_total' => $provincia->municipios->sum('poblacion_total'),
            ];
        });

        $datosPorProvincia = Provincia::join('municipios', 'provincias.id', '=', 'municipios.provincia_id')
        ->join('comunidads', 'municipios.id', '=', 'comunidads.municipio_id')
        ->join('formularios', 'comunidads.id', '=', 'formularios.comunidad_id')

        // Subconsulta para los afectados por incendios
        ->leftJoin(DB::raw('(SELECT formulario_id, SUM(cantidad_afectados_por_incendios) as total_afectados
                             FROM persona_afectada_incendios
                             GROUP BY formulario_id) as persona_afectada'), 'formularios.id', '=', 'persona_afectada.formulario_id')

        // Subconsulta para los estudiantes
        ->leftJoin(DB::raw('(SELECT formulario_id, SUM(numero_estudiantes) as total_estudiantes
                             FROM educacions
                             GROUP BY formulario_id) as educacion'), 'formularios.id', '=', 'educacion.formulario_id')

        // Subconsulta para infraestructuras
        ->leftJoin(DB::raw('(SELECT formulario_id, SUM(numeros_infraestructuras_afectadas) as total_infraestructuras
                             FROM infraestructuras
                             GROUP BY formulario_id) as infraestructura'), 'formularios.id', '=', 'infraestructura.formulario_id')

        // Subconsulta para saluds
        ->leftJoin(DB::raw('(SELECT formulario_id, SUM(cantidad_grupo_enfermos) as total_salud
                            FROM saluds
                            GROUP BY formulario_id) as salud'), 'formularios.id', '=', 'salud.formulario_id')

        ->leftJoin(DB::raw('(SELECT formulario_id, SUM(numero_comunidades_afectadas) as total_servicio_basicos
                            FROM servicio_basicos
                            GROUP BY formulario_id) as servicio_basico'), 'formularios.id', '=', 'servicio_basico.formulario_id'
                            )
        ->leftJoin(DB::raw('(SELECT formulario_id, SUM(numero_animales_afectados) as total_animales, SUM(numero_animales_fallecidos) as total_fallecidos FROM sector_pecuarios
        GROUP BY formulario_id) as sector_pecuario'), 'formularios.id', '=', 'sector_pecuario.formulario_id')

        ->leftJoin(DB::raw('(SELECT formulario_id, SUM(hectareas_afectados) as hectareas_afectados, SUM(hectareas_perdidas) as hectareas_perdidas FROM sector_agricolas
        GROUP BY formulario_id) as sector_agricola'), 'formularios.id', '=', 'sector_agricola.formulario_id')

        ->leftJoin(DB::raw('(SELECT formulario_id, SUM(hectareas_perdidas_forestales) as total_hectareas_perdidas_forestales FROM area_forestals GROUP BY formulario_id) as area_forestal'), 'formularios.id', '=', 'area_forestal.formulario_id')

        ->leftJoin(DB::raw('(SELECT formulario_id, SUM(numero_fauna_silvestre) AS total_fauna_silvestre FROM fauna_silvestres
        GROUP BY formulario_id) as fauna_silvestre'), 'formularios.id', '=', 'fauna_silvestre.formulario_id')

        ->leftJoin(DB::raw('(SELECT formulario_id, SUM(cantidad_plantines) AS total_cantidad_plantines
                        FROM reforestacions
                        GROUP BY formulario_id) as reforestacion'), 'formularios.id', '=', 'reforestacion.formulario_id')  // Corrected here

        // Seleccionamos las columnas que queremos y las sumas
        ->select(
            'provincias.nombre_provincia',
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
        ->groupBy('provincias.id', 'provincias.nombre_provincia')
        ->get();

        $paginate = request('paginate') ?? 10;
        $search = request('search');

        $provincias = Provincia::all();
        $formulario = Formulario::with('comunidad.municipio.provincia', 'incendio', 'asistencias')->where(function ($query) use ($search){
            $query->where('id', 'like', '%' . $search . '%')
            ->orWhereHas('comunidad', function ($query) use ($search) {
                $query->where('nombre_comunidad', 'like', '%' . $search . '%');
            })
            ->orWhereHas('comunidad.municipio', function ($query) use ($search) {
                $query->where('nombre_municipio', 'like', '%' . $search . '%');
            })
            ->orWhereHas('comunidad.municipio.provincia', function ($query) use ($search) {
                $query->where('nombre_provincia', 'like', '%' . $search . '%');
            })
            ->orWhereHas('incendio', function ($query) use ($search) {
                $query->where('fecha_inicio', 'like', '%' . $search . '%')
                ->orWhere('causas_probables', 'like', '%' . $search . '%')
                ->orWhere('estado', 'like', '%' . $search . '%');
            })
            ->orWhereHas('asistencias', function ($query) use ($search) {
                $query->where('actividades', 'like', '%' . $search. '%');
            });
        })
        ->orderBy('id', 'desc')
        ->paginate($paginate);

        // Obtener la suma total de incendios registrados desde la tabla pivote
        $totalIncendios = Comunidad::with('incendios')->get()->pluck('incendios')->flatten()->sum('pivot.incendios_registrados');
        $totalIncendiosActivos = Comunidad::with('incendios')->get()->pluck('incendios')->flatten()->sum('pivot.incendios_activos');
        $totalNumFamiliasAfectadas = Comunidad::with('incendios')->get()->pluck('incendios')->flatten()->sum('pivot.num_familias_afectadas');
        $totalNumFamiliasDamnificadas = Comunidad::with('incendios')->get()->pluck('incendios')->flatten()->sum('pivot.num_familias_damnificadas');


        $dataPointsAfectados = [];
        $dataPointsEstudiantes = [];
        $dataPointsInfraestructuras = [];
        $dataPointsSalud = [];
        $dataPointsServicioBasico = [];

        foreach ($datosPorProvincia as $dato) {
            $dataPointsAfectados[] = ['label' => $dato->nombre_provincia, 'y' => $dato->total_afectados];
            $dataPointsEstudiantes[] = ['label' => $dato->nombre_provincia, 'y' => $dato->total_educacion];
            $dataPointsInfraestructuras[] = ['label' => $dato->nombre_provincia, 'y' => $dato->total_infraestructuras];
            $dataPointsSalud[] = ['label' => $dato->nombre_provincia, 'y' => $dato->total_salud];
            $dataPointsServicioBasico[] = ['label' => $dato->nombre_provincia, 'y' => $dato->total_servicio_basicos];
        }

        // En el backend
        $dataPointsAnimales = [];
        $dataPointsFallecidos = [];
        $dataPointsHectareasAfectados = [];
        $dataPointsHectareasPerdidas = [];
        $dataPointsHectareasPerdidasForestales = [];
        $dataPointsFaunaSilvestre = [];
        $dataPointsCantidadPlantines = [];

        foreach ($datosPorProvincia as $dato) {
            $dataPointsAnimales[] = [
                'label' => $dato->nombre_provincia,
                'y' => $dato->total_animales ?? 0
            ];
            $dataPointsFallecidos[] = [
                'label' => $dato->nombre_provincia,
                'y' => $dato->total_fallecidos ?? 0
            ];
            $dataPointsHectareasAfectados[] = [
                'label' => $dato->nombre_provincia,
                'y' => $dato->hectareas_afectados ?? 0
            ];
            $dataPointsHectareasPerdidas[] = [
                'label' => $dato->nombre_provincia,
                'y' => $dato->hectareas_perdidas ?? 0
            ];
            $dataPointsHectareasPerdidasForestales[] = [
                'label' => $dato->nombre_provincia,
                'y' => $dato->total_hectareas_perdidas_forestales ?? 0
            ];
            $dataPointsFaunaSilvestre[] = [
                'label' => $dato->nombre_provincia,
                'y' => $dato->total_fauna_silvestre ?? 0
            ];
            $dataPointsCantidadPlantines[] = [
                'label' => $dato->nombre_provincia,
                'y' => $dato->total_cantidad_plantines ?? 0
            ];
        }


        return view('welcome', compact('provincias', 'totalIncendios', 'totalIncendiosActivos', 'totalNumFamiliasAfectadas', 'totalNumFamiliasDamnificadas', 'poblacionPorProvincia', 'datosPorProvincia', 'dataPointsAfectados', 'dataPointsEstudiantes', 'dataPointsInfraestructuras', 'dataPointsSalud', 'dataPointsServicioBasico', 'dataPointsAnimales', 'dataPointsFallecidos', 'dataPointsHectareasAfectados', 'dataPointsHectareasPerdidas', 'dataPointsHectareasPerdidasForestales', 'dataPointsFaunaSilvestre', 'dataPointsCantidadPlantines'));


        // return view('welcome', compact('provincias', 'totalIncendios', 'totalIncendiosActivos', 'totalNumFamiliasAfectadas', 'totalNumFamiliasDamnificadas', 'poblacionPorProvincia', 'afectadosPorProvincia', 'infraestructurasPorProvincias', 'educacionsPorProvincia', 'datosPorProvincia'));
    }
}
