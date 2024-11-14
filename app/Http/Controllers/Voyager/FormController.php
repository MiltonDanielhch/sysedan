<?php

namespace App\Http\Controllers\Voyager;

use App\Http\Controllers\Controller;
use App\Models\AreaForestal;
use App\Models\Comunidad;
use App\Models\DetalleAreaForestal;
use App\Models\DetalleEnfermedad;
use App\Models\DetalleFaunaSilvestre;
use App\Models\Educacion;
use App\Models\FaunaSilvestre;
use App\Models\Formulario;
use App\Models\GrupoEtario;
use App\Models\Incendio;
use App\Models\Infraestructura;
use App\Models\Institucion;
use App\Models\ModalidadEducacion;
use App\Models\Municipio;
use App\Models\PersonaAfectadaIncendio;
use App\Models\Provincia;
use App\Models\Salud;
use App\Models\SectorAgricola;
use App\Models\SectorPecuario;
use App\Models\ServicioBasico;
use App\Models\TipoCultivo;
use App\Models\TipoEspecie;
use App\Models\TipoInfraestructura;
use App\Models\TipoServicioBasico;
use App\Models\TipoServicioBasicos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    public function index(Request $request)
    {
        return view('vendor.voyager.formularios.browse');
    }

    public function list(Request $request)
    {
        $paginate = request('paginate') ?? 10;
        $search = request('search');
        // $data = Provincia::all();
        // $data = $data->paginate($paginate);
        if($request->ajax()){
            $provincias = DB::table('provincias')
            ->where('nombre_provincia', 'like', '%' . $search . '%')
            ->paginate($paginate);
            // dd($provincias);
            $html = view('voyager::formularios.list', compact('provincias'))->render();
            return response()->json([
                'code' => 200,
                'html' => $html,
                'msg' => 'success',
            ],200);
        }else{
            return response()->json([
                'code' => 404,
                'msg' => 'error',
                'message' => 'Error, no se puede acceder a la pagina'
            ], 404);
        }
    }

    public function create()
    {
        $provincias = Provincia::all();
        $municipios = Municipio::all();
        $grupoEtarios = GrupoEtario::all();
        $grupoEtarioSaluds = GrupoEtario::whereIn('nombre_grupo_etario', ['NNyA', 'Hombres', 'Mujeres', 'Tercera Edad'])->get();
        $detalleEnfermedades = DetalleEnfermedad::all();
        $modalidadEducacions = ModalidadEducacion::all();
        $institucions = Institucion::all();
        $tipoInfraestructuras = TipoInfraestructura::all();
        $tiposerviciobasicos = TipoServicioBasico::all();
        $tipoEspecies = TipoEspecie::all();
        $tipoCultivos = TipoCultivo::all();
        $detalleAreaForestals = DetalleAreaForestal::all();
        $detalleFaunaSilvestres = DetalleFaunaSilvestre::all();
        $tipoFaunaEspecies = TipoEspecie::whereIn('nombre_tipo_especie', ['Mamíferos', 'Reptiles'])->get();
        return view('vendor.voyager.formularios.edit-add', compact('provincias', 'municipios', 'grupoEtarios', 'detalleEnfermedades', 'grupoEtarioSaluds', 'modalidadEducacions', 'institucions', 'tiposerviciobasicos', 'tipoInfraestructuras', 'tipoEspecies','tipoCultivos', 'detalleAreaForestals', 'detalleFaunaSilvestres', 'tipoFaunaEspecies'));
    }

    public function buscar_municipio($id_provincia){
        try{
            $municipios = DB::table('municipios')->where('provincia_id', $id_provincia)->get();
            return view('vendor.voyager.formularios.cargar_municipios', compact('municipios'));

        }catch(\Exception $exception){
            return response()->json(['mensaje'=>'Error']);
        }
    }
    public function getAlcalde($municipioId)
    {
        $municipio = Municipio::find($municipioId);

        // Verifica que el municipio exista antes de intentar acceder a sus datos
        if ($municipio) {
            return response()->json(['nombre_alcalde' => $municipio->nombre_alcalde]);
        } else {
            return response()->json(['error' => 'Municipio no encontrado'], 404);
        }
    }

    public function getPoblacion($municipioId)
    {
        $municipio = Municipio::find($municipioId);

        // Verifica que el municipio exista antes de intentar acceder a sus datos
        if ($municipio) {
            return response()->json(['poblacion_total' => $municipio->poblacion_total]);
        } else {
            return response()->json(['error' => 'Municipio no encontrado'], 404);
        }
    }


    public function store(Request $request){
        // dd($request);

        // Validación de datos
        $validatedData = $request->validate([
            // formulario
            'fecha_llenado' => 'required|date',
            //comunidad
            'nombre_comunidad' => 'required|string',
            'tipo_comunidad' => 'required|string',
            'municipio_id' => 'required|integer|exists:municipios,id',
            //incendio
            'fecha_inicio' => 'required|date',
            'causas_probables' => 'nullable|string',
            'estado' => 'nullable|string',
            // comunidad_incendios
            'incendios_registrados' => 'required|integer',
            'incendios_activos' => 'required|integer',
            'necesidades' => 'nullable|string',
            'num_familias_afectadas' => 'required|integer',
            'num_familias_damnificadas' => 'required|integer',

             // persona_afectada_incendios
             'grupo_etario_id.*' => 'required|integer|exists:grupo_etarios,id',
             'cantidad_afectados_por_incendios.*' => 'required|integer',

             // saluds
             'detalle_enfermedad_id.*' => 'required|integer|exists:detalle_enfermedads,id',
             'cantidad_grupo_enfermos.*.*' => 'nullable|integer|min:0',

             // educacion
            'institucion_id.*' => 'required|integer',
             'num_estudiantes.*.*' => 'nullable|integer',

            // Infraestructura
            'tipo_infraestructura_id.*' => 'required|integer|exists:tipo_infraestructuras,id',
            'numeros_infraestructuras_afectadas.*' => 'nullable|integer',

             //servicios basicos
             'tipo_servicio_basico_id.*' => 'required|integer|exists:tipo_servicio_basicos,id',
             'informacion_tipo_dano.*' => 'nullable|string',
             'numero_comunidades_afectadas.*' => 'nullable|integer',

             // sector pecuario
             'tipo_especie_id.*' => 'required|integer|exists:tipo_especies,id',
             'numero_animales_afectados.*' => 'nullable|integer',
             'numero_animales_fallecidos.*' => 'nullable|integer',

             // sector agricola
             'tipo_cultivo_id.*' => 'required|integer',
             'hectareas_afectados.*' => 'nullable|numeric',
             'hectareas_perdidas.*' => 'nullable|numeric',

             // area forestal
             'detalle_area_forestal_id.*' => 'required|integer',
             'hectareas_perdidas_forestales.*' => 'required|numeric',

            //  fauna silvestre
            'detalle_fauna_silvestre_id.*' => 'required|integer',
            'numero_fauna_silvestre.*.*' => 'required|integer',
        ]);

        // dd($validatedData);

        return DB::transaction(function () use ($validatedData) {
            try {
                // Encontrar el municipio
                $municipio = Municipio::find($validatedData['municipio_id']);

                // Crear la comunidad
                $comunidad = Comunidad::create([
                    'nombre_comunidad' => $validatedData['nombre_comunidad'],
                    'tipo_comunidad' => $validatedData['tipo_comunidad'],
                    'municipio_id' => $validatedData['municipio_id'],
                ]);

                // Crear el incendio
                $incendio = Incendio::create([
                    'fecha_inicio' => $validatedData['fecha_inicio'],
                    'causas_probables' => $validatedData['causas_probables'],
                    'estado' => $validatedData['estado'],
                ]);

                // Crear el formulario
                $formulario = Formulario::create([
                    'fecha_llenado' => $validatedData['fecha_llenado'],
                    'comunidad_id' => $comunidad->id,
                    'incendio_id' => $incendio->id,
                ]);

                // crear la comunidad del incendio
                $comunidad->incendios()->attach($incendio, [
                    'incendios_registrados' => $validatedData['incendios_registrados'],
                    'incendios_activos' => $validatedData['incendios_activos'],
                    'necesidades' => $validatedData['necesidades'],
                    'num_familias_afectadas' => $validatedData['num_familias_afectadas'],
                    'num_familias_damnificadas' => $validatedData['num_familias_damnificadas'],
                    'comunidad_id' => $comunidad->id,
                    'incendio_id' => $incendio->id,
                ]);


                foreach ($validatedData['grupo_etario_id'] as $index => $grupoEtarioId) {
                    // Crear o actualizar un registro en la tabla persona_afectada_incendios
                    PersonaAfectadaIncendio::updateOrCreate(
                        [
                            'grupo_etario_id' => $grupoEtarioId,
                            'formulario_id' => $formulario->id,
                        ],
                        [
                            'cantidad_afectados_por_incendios' => $validatedData['cantidad_afectados_por_incendios'][$index]
                        ]
                    );
                }

                foreach ($validatedData['cantidad_grupo_enfermos'] as $grupoEtarioId => $enfermedades) {
                    foreach ($enfermedades as $detalleEnfermedadId => $cantidad) {
                        try {
                            Salud::create([
                                'grupo_etario_id' => $grupoEtarioId,
                                'detalle_enfermedad_id' => $detalleEnfermedadId,
                                'formulario_id' => $formulario->id,
                                'cantidad_grupo_enfermos' => $cantidad,
                            ]);
                        } catch (\Exception $e) {
                            Log::error('Error saving salud data: ' . $e->getMessage());
                            return redirect()->back()->with('error', 'An error occurred while saving the data.');
                        }
                    }
                }

                foreach ($validatedData['institucion_id'] as $institucionId) {
                    foreach ($validatedData['num_estudiantes'][$institucionId] as $modalidadId => $numEstudiantes) {
                        Educacion::create([
                            'institucion_id' => $institucionId,
                            'modalidad_educacion_id' => $modalidadId,
                            'numero_estudiantes' => $numEstudiantes,
                            'formulario_id' => $formulario->id,
                        ]);
                    }
                }

                // $request = request();

                foreach ($validatedData['tipo_infraestructura_id'] as $index => $tipoInfraestructuraId) {
                    $data = [
                        'tipo_infraestructura_id' => $tipoInfraestructuraId,
                        'numeros_infraestructuras_afectadas' => $validatedData['numeros_infraestructuras_afectadas'][$index],
                        'formulario_id' => $formulario->id,
                    ];
                    $validator = Validator::make($data, [
                        'numeros_infraestructuras_afectadas' => 'required|integer|min:0',
                    ]);
                    if ($validator->fails()) {
                        // Manejar el error
                        return back()->withErrors($validator);
                    } else {
                        Infraestructura::create($data);
                    }
                }

                foreach ($validatedData['tipo_servicio_basico_id'] as $index => $tipoServicioBasicoId) {
                    $data = [
                        'tipo_servicio_basico_id' => $tipoServicioBasicoId,
                        'informacion_tipo_dano' => $validatedData['informacion_tipo_dano'][$index],
                        'numero_comunidades_afectadas' => $validatedData['numero_comunidades_afectadas'][$index],
                        'formulario_id' => $formulario->id,
                    ];

                    ServicioBasico::create($data);
                    // dd($data);
                }

                foreach ($validatedData['tipo_especie_id'] as $index => $tipoEspecieId) {
                    $data = [
                        'tipo_especie_id' => $tipoEspecieId,
                        'numero_animales_afectados' => $validatedData['numero_animales_afectados'][$index],
                        'numero_animales_fallecidos' => $validatedData['numero_animales_fallecidos'][$index],
                        'formulario_id' => $formulario->id,
                    ];

                    if ($data['numero_animales_afectados'] < 0 || $data['numero_animales_fallecidos'] < 0) {
                        Log::error('Número de animales negativo para la especie ' . $tipoEspecieId);
                        continue;
                    }

                    SectorPecuario::create($data);
                }

                foreach ($validatedData['tipo_cultivo_id'] as $index => $tipoCultivoId) {
                    $data = [
                        'tipo_cultivo_id' => $tipoCultivoId,
                        'hectareas_afectados' => $validatedData['hectareas_afectados'][$index],
                        'hectareas_perdidas' => $validatedData['hectareas_perdidas'][$index],
                        'formulario_id' => $formulario->id,
                    ];

                    // Validación adicional
                    if ($data['hectareas_afectados'] < 0 || $data['hectareas_afectados'] < 0) {
                        Log::error('Número de hectáreas negativo para el cultivo ' . $tipoCultivoId);
                        continue; // Saltar a la siguiente iteración
                    }
                    SectorAgricola::create($data);
                }

                foreach ($validatedData['detalle_area_forestal_id'] as $index => $detalleAreaForestalId){
                    $data = [
                        'detalle_area_forestal_id' => $detalleAreaForestalId,
                        'hectareas_perdidas_forestales' => $validatedData['hectareas_perdidas_forestales'][$index],
                        'formulario_id' => $formulario->id,
                    ];

                    AreaForestal::create($data);
                }

                foreach ($validatedData['detalle_fauna_silvestre_id'] as $detalleId) {
                    foreach ($validatedData['numero_fauna_silvestre'][$detalleId] as $tipoEspecieId => $numero) {
                        if (isset($tipoEspecieId)) { // Check if tipo_especie_id is present
                            $data = [
                                'detalle_fauna_silvestre_id' => $detalleId,
                                'tipo_especie_id' => $tipoEspecieId,
                                'numero_fauna_silvestre' => $numero,
                                'formulario_id' => $formulario->id,
                            ];

                            FaunaSilvestre::create($data);
                            // $allData[] = $data;
                        } else {
                            // Handle missing tipo_especie_id, e.g., log an error, skip the record, or use a default value
                            Log::error("Missing tipo_especie_id for detalle_fauna_silvestre_id: $detalleId");
                        }
                    }
                }
                // dd($allData);

                // Redirigir después de guardar
                return redirect()->route('formularios.index')->with('success', 'Formulario guardado correctamente');

            } catch (\Exception $e) {
                Log::error('Error in transaction: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Ocurrió un error al guardar el formulario.');
            }

        }, 5);
    }
}
