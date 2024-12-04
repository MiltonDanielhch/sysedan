<?php

namespace App\Http\Controllers\Voyager;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateFormularioRequest;
use App\Http\Requests\UpdateFormularioRequest;
use App\Models\AreaForestal;
use App\Models\Asistencia;
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
use App\Models\Reforestacion;
use App\Models\Salud;
use App\Models\SectorAgricola;
use App\Models\SectorPecuario;
use App\Models\ServicioBasico;
use App\Models\TipoCultivo;
use App\Models\TipoEspecie;
use App\Models\TipoInfraestructura;
use App\Models\TipoServicioBasico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FormController extends Controller
{
    public function index(Request $request)
    {
        return view('vendor.voyager.formularios.browse');
    }

    public function list()
    {
        $paginate = request('paginate') ?? 10;
        $search = request('search');

        // Comienza la consulta
        $data = Formulario::with(['comunidad.municipio.provincia', 'incendio', 'asistencias'])
            ->where(function ($query) use ($search) {
                // Añadimos todas las condiciones de búsqueda aquí dentro de una función anónima
                $query->where('id', 'like', '%' . $search . '%')
                    ->orWhereHas('comunidad', function ($query) use ($search) {
                        $query->where('nombre_comunidad', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('comunidad.municipio', function ($query) use ($search) {
                        $query->where('nombre_municipio', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('comunidad.municipio.provincia', function ($query) use ($search) {
                        $query->where('nombre_provincia', 'like', '%' . $search . '%');
                    });
            })
            ->orderBy('id', 'desc')
            ->paginate($paginate);

        return view('voyager::formularios.list', compact('data'));
    }

    public function create()
    {
        $provincias = Provincia::all();
        $municipios = Municipio::all();
        $grupoEtarios = cache()->remember('grupo_etarios', 60, function() {
            return GrupoEtario::all();
        });
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

        return view('vendor.voyager.formularios.edit-add',
            [
                'provincias' => $provincias,
                'municipios' => $municipios,
                'grupoEtarios' => $grupoEtarios,
                'detalleEnfermedades' => $detalleEnfermedades,
                'grupoEtarioSaluds' => $grupoEtarioSaluds,
                'modalidadEducacions' => $modalidadEducacions,
                'institucions' => $institucions,
                'tiposerviciobasicos' => $tiposerviciobasicos,
                'tipoInfraestructuras' => $tipoInfraestructuras,
                'tipoEspecies' => $tipoEspecies,
                'tipoCultivos' => $tipoCultivos,
                'detalleAreaForestals' => $detalleAreaForestals,
                'detalleFaunaSilvestres' => $detalleFaunaSilvestres,
                'tipoFaunaEspecies' => $tipoFaunaEspecies,
            ]);
    }

    public function buscar_municipio($id_provincia){
        try{
            $municipios = DB::table('municipios')->where('provincia_id', $id_provincia)->get();
            return view('vendor.voyager.formularios.cargar_municipios', compact('municipios'));

        }catch(\Exception $exception){
            return response()->json(['mensaje'=>'Error']);
        }
    }

    public function buscar_comunidad($id_municipio)
    {
        // try {
            // Fetch communities where municipio_id matches the provided ID
            $comunidades = DB::table('comunidads')->where('municipio_id', $id_municipio)->get();

            // Return the data to the view (could be JSON if you prefer)
            return view('vendor.voyager.formularios.cargar_comunidades', compact('comunidades'));
        // } catch (\Exception $exception) {
        //     // Return a JSON response in case of error
        //     return response()->json(['mensaje' => 'Error']);
        // }
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

    public function getMunicipiosForEdit($provinciaId)
    {
        $municipios = Municipio::where('provincia_id', $provinciaId)->get();
        return response()->json($municipios);
    }

    public function getAlcaldeForEdit($municipioId)
    {
        $municipio = Municipio::find($municipioId);
        return response()->json([
            'nombre_alcalde' => $municipio ? $municipio->nombre_alcalde : null
        ]);
    }

    public function getPoblacionForEdit($municipioId)
    {
        $municipio = Municipio::find($municipioId);
        return response()->json([
            'poblacion_total' => $municipio ? $municipio->poblacion_total : null
        ]);
    }

    public function actualizarTotalAfectados(Request $request)
    {
        // Validar que la data venga correctamente
        $validated = $request->validate([
            'cantidad_afectados_por_incendios' => 'array',
            'cantidad_afectados_por_incendios.*' => 'nullable|numeric',
        ]);

        // Obtener los valores de cantidad_afectados_por_incendios
        $cantidadAfectados = $validated['cantidad_afectados_por_incendios'];

        // Calcular el total de afectados
        $totalAfectados = array_sum($cantidadAfectados);

        // Devolver la respuesta como JSON con el total calculado
        return response()->json([
            'totalAfectados' => $totalAfectados
        ]);
    }



    public function store(CreateFormularioRequest $request){
        // dd($request);

        // Validación de datos
        $validatedData = $request->validated();
        // dd($validatedData);

        // return DB::transaction(function () use ($validatedData) {
        // try {
            // Encontrar el municipio
            $municipio = Municipio::find($validatedData['municipio_id']);

            // Crear la comunidad
            $comunidad = Comunidad::find($validatedData['comunidad_id']);
            // $comunidad = Comunidad::create([
            //     'nombre_comunidad' => $validatedData['nombre_comunidad'],
            //     'tipo_comunidad' => $validatedData['tipo_comunidad'],
            //     'municipio_id' => $validatedData['municipio_id'],
            // ]);

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


            $asistencias = Asistencia::create([
                'actividades' => $validatedData['actividades'],
                'cantidad_beneficiarios' => $validatedData['cantidad_beneficiarios'],
                'fecha_asistencia' =>  $validatedData['fecha_asistencia'],
                'formulario_id' => $formulario->id,
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

            $infraestructuras = [];
            foreach ($validatedData['tipo_infraestructura_id'] as $index => $tipoInfraestructuraId) {
                $infraestructuras[] = [
                    'tipo_infraestructura_id' => $tipoInfraestructuraId,
                    'numeros_infraestructuras_afectadas' => $validatedData['numeros_infraestructuras_afectadas'][$index],
                    'formulario_id' => $formulario->id,
                ];
            }
            Infraestructura::insert($infraestructuras);


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
                        Log::error("Missing tipo_especie_id for detalle_fauna_silvestre_id: $detalleId");
                    }
                }
            }
            // dd($allData);

            // Procesar los datos validados y almacenarlos
            foreach ($validatedData['especie_plantin'] as $index => $plantin) {
                // Obtener la cantidad de plantines, si no existe, asignar 0
                $cantidad = $validatedData['cantidad_plantines'][$index] ?? 0;
                // Crear un nuevo registro de reforestación en la base de datos
                Reforestacion::create([
                    'especie_plantin' => $plantin, // Especie del plantín
                    'cantidad_plantines' => $cantidad, // Cantidad de plantines
                    'formulario_id' => $formulario->id,
                ]);
            }
            // dd($plantin);
        // Redirigir después de guardar
        return redirect()->route('formularios.index')->with('success', 'Formulario guardado correctamente');

        //     } catch (\Exception $e) {
        //         Log::error('Error in transaction: ' . $e->getMessage());
        //         return redirect()->back()->with('error', 'Ocurrió un error al guardar el formulario.');
        //     }

        // }, 3);
    }

    public function show($id){
        try {

            $form = Formulario::findOrFail($id);

            $personasAfectadas = PersonaAfectadaIncendio::where('formulario_id', $id)->get();

            $asistencias = Asistencia::where('formulario_id', $id)->get();

            $educacions = Educacion::with('modalidadEducacion', 'institucion')->where('formulario_id', $id)->get();
            $modalidadEducacions = ModalidadEducacion::all();

            $pecuarios = SectorPecuario::where('formulario_id', $id)->get();


            $saluds = Salud::with('detalleEnfermedad', 'grupoEtario')->where('formulario_id', $id)->get();
            $detalleEnfermedades = DetalleEnfermedad::all();

            $infraestructuras = Infraestructura::with('tipoInfraestructura')->where('formulario_id', $id)->get();

            $servicioBasicos = ServicioBasico::with('tipoServicioBasico')->where('formulario_id', $id)->get();

            $sectorPecuarios = SectorPecuario::with('tipoEspecie')->where('formulario_id', $id)->get();

            $sectorAgricolas = SectorAgricola::with('tipoCultivo')->where('formulario_id', $id)->get();

            $areaForestals = AreaForestal::with('detalleAreaForestal')->where('formulario_id', $id)->get();

            $faunaSilvestres = FaunaSilvestre::with('detalleFaunaSilvestre', 'tipoEspecie')->where('formulario_id', $id)->get();

            $reforestacions = Reforestacion::where('formulario_id', $id)->get();

        } catch (\Exception $e) {
            Log::error('Error al cargar formulario: ' . $e->getMessage());
            return redirect()->route('formularios.index')->with('error', 'Hubo un problema al cargar el formulario.');
        }

        return view('vendor.voyager.formularios.show', compact('form', 'personasAfectadas', 'educacions', 'modalidadEducacions', 'pecuarios', 'saluds', 'detalleEnfermedades', 'infraestructuras', 'servicioBasicos', 'sectorPecuarios', 'sectorAgricolas', 'areaForestals', 'faunaSilvestres', 'asistencias', 'reforestacions'));
    }



    public function edit($id)
    {
        $formulario = Formulario::findOrFail($id);
        $provinciaId = $formulario->comunidad->municipio->provincia->id ?? null;
        // dd($formularios);
        $provincias = Provincia::all();

        $municipioId = $formulario->comunidad->municipio->id ?? null;
        $municipios = Municipio::all();

        $grupoEtarios = GrupoEtario::all();

        $asistencias = Asistencia::where('formulario_id', $id)->get();


        $personasAfectadas = PersonaAfectadaIncendio::with('grupoEtario')->where('formulario_id', $id)->get();

        $educacions = Educacion::with('modalidadEducacion', 'institucion')->where('formulario_id', $id)->get();
        $modalidadEducacions = ModalidadEducacion::all();

        $saluds = Salud::with('detalleEnfermedad', 'grupoEtario')->where('formulario_id', $id)->get();
        $detalleEnfermedades = DetalleEnfermedad::all();

        $infraestructuras = Infraestructura::with('tipoInfraestructura')->where('formulario_id', $id)->get();

        $servicioBasicos = ServicioBasico::with('tipoServicioBasico')->where('formulario_id', $id)->get();

        $sectorPecuarios = SectorPecuario::with('tipoEspecie')->where('formulario_id', $id)->get();

        $sectorAgricolas = SectorAgricola::with('tipoCultivo')->where('formulario_id', $id)->get();

        $areaForestals = AreaForestal::with('detalleAreaForestal')->where('formulario_id', $id)->get();

        $faunaSilvestres = FaunaSilvestre::with('detalleFaunaSilvestre', 'tipoEspecie')->where('formulario_id', $id)->get();

        $reforestacions = Reforestacion::where('formulario_id', $id)->get();

        return view('vendor.voyager.formularios.edit', compact('formulario', 'provinciaId', 'provincias', 'municipioId', 'municipios', 'grupoEtarios', 'personasAfectadas', 'educacions', 'modalidadEducacions', 'saluds', 'detalleEnfermedades', 'infraestructuras', 'servicioBasicos', 'sectorPecuarios', 'sectorAgricolas', 'areaForestals', 'faunaSilvestres', 'asistencias', 'reforestacions'));
    }

    public function update(UpdateFormularioRequest $request, $id)
    {
        $validatedData = $request->validated();
        // dd($validatedData);
        DB::beginTransaction();

        // dd($validatedData);
        try {
            // Encontrar el formulario a actualizar
            $formulario = Formulario::findOrFail($id);

            // Actualizar los datos del formulario
            $comunidad = $formulario->comunidad;
            $comunidad->update([
                'nombre_comunidad' => $validatedData['nombre_comunidad'],
                'tipo_comunidad' => $validatedData['tipo_comunidad'],
                'municipio_id' => $validatedData['municipio_id'],
            ]);

            $incendio = $formulario->incendio;
            $incendio->update([
                'fecha_inicio' => $validatedData['fecha_inicio'],
                'causas_probables' => $validatedData['causas_probables'],
                'estado' => $validatedData['estado'],
            ]);

            $formulario->update([
                'fecha_llenado' => $validatedData['fecha_llenado'],
                'comunidad_id' => $comunidad->id,
                'incendio_id' => $incendio->id,
            ]);

              // Loop through the validated data and update the corresponding Asistencia records
            foreach ($validatedData['actividades'] as $asistenciaId => $actividad) {
                $asistencia = Asistencia::findOrFail($asistenciaId);

                // Update the fields if they are present
                if (isset($validatedData['actividades'][$asistenciaId])) {
                    $asistencia->actividades = $validatedData['actividades'][$asistenciaId];
                }

                if (isset($validatedData['cantidad_beneficiarios'][$asistenciaId])) {
                    $asistencia->cantidad_beneficiarios = $validatedData['cantidad_beneficiarios'][$asistenciaId];
                }

                if (isset($validatedData['fecha_asistencia'][$asistenciaId])) {
                    $asistencia->fecha_asistencia = $validatedData['fecha_asistencia'][$asistenciaId];
                }

                // Save the updated Asistencia
                $asistencia->save();
            }


            $formulario->comunidad->incendios()->updateExistingPivot($incendio->id, [
                'incendios_registrados' => $validatedData['incendios_registrados'],
                'incendios_activos' => $validatedData['incendios_activos'],
                'necesidades' => $validatedData['necesidades'],
                'num_familias_afectadas' => $validatedData['num_familias_afectadas'],
                'num_familias_damnificadas' => $validatedData['num_familias_damnificadas'],
                'comunidad_id' => $comunidad->id,
                'incendio_id' => $incendio->id,
            ]);

          // Obtener los datos del formulario
            $gruposEtarios = $request->input('cantidad_afectados_por_incendios');
          // Iterar sobre los grupos etarios y actualizar los registros correspondientes
            foreach ($gruposEtarios as $grupoEtarioId => $cantidadAfectados) {
                // Buscar el registro por formulario y grupo etario
                PersonaAfectadaIncendio::updateOrCreate(
                    [
                        'formulario_id' => $formulario->id,
                        'grupo_etario_id' => $grupoEtarioId,
                    ],
                    [
                        'cantidad_afectados_por_incendios' => $cantidadAfectados,
                    ]
                );
            }

            $educacions = Educacion::with('institucion', 'modalidadEducacion')
             ->where('formulario_id', $formulario->id)
            ->get();
            foreach ($educacions as $educacion) {
                $educacion->update([
                    'numero_estudiantes' => $validatedData['num_estudiantes'][$educacion->institucion_id][$educacion->modalidadEducacion->id] ?? 0,
                ]);
            }

            $saluds = Salud::where('formulario_id', $id)->get();

            foreach ($saluds as $salud) {
                // Obtener el grupo_etario_id directamente del registro actual de Salud
                $grupoEtarioId = $salud->grupo_etario_id;
                $detalleEnfermedadId = $salud->detalle_enfermedad_id;

                // Verificar que el grupo_etario_id esté dentro de los valores válidos
                if (in_array($grupoEtarioId, [1, 2, 3, 4])) {
                    // Verificar que existe el valor de cantidad_grupo_enfermos para este grupo y enfermedad
                    if (isset($validatedData['cantidad_grupo_enfermos'][$detalleEnfermedadId][$grupoEtarioId])) {
                        // Actualizar el valor de cantidad_grupo_enfermos
                        $salud->cantidad_grupo_enfermos = $validatedData['cantidad_grupo_enfermos'][$detalleEnfermedadId][$grupoEtarioId];
                        $salud->save();
                    }
                } else {
                    // Si el grupo_etario_id es inválido, registrar un error
                    Log::error("Grupo Etario no válido: {$grupoEtarioId}");
                }
            }


            $infraestructuras = Infraestructura::with('tipoInfraestructura')->where('formulario_id', $formulario->id)->get();

            foreach ($infraestructuras  as $infraestructura){
                $infraestructura->update([
                    'numeros_infraestructuras_afectadas' => $validatedData['numeros_infraestructuras_afectadas'][$infraestructura->tipo_infraestructura_id] ?? 0,
                ]);
            }



            $servicioBasicos = ServicioBasico::with('tipoServicioBasico')->where('formulario_id', $id)->get();

            foreach ($servicioBasicos as $servicioBasico){
                $servicioBasico->update([
                    'numero_comunidades_afectadas' => $validatedData['numero_comunidades_afectadas'][$servicioBasico->tipo_servicio_basico_id] ?? 0,
                ]);
            }
            // dd($servicioBasicos);

            $sectorPecuarios = SectorPecuario::with('tipoEspecie')->where('formulario_id', $id)->get();

            foreach ($sectorPecuarios as $sectorPecuario){
                $sectorPecuario->update([
                    'numero_animales_afectados' => $validatedData['numero_animales_afectados'][$sectorPecuario->tipo_especie_id] ?? 0,
                    'numero_animales_fallecidos' => $validatedData['numero_animales_fallecidos'][$sectorPecuario->tipo_especie_id] ?? 0,
                ]);
            }

            $sectorAgricolas = SectorAgricola::with('tipoCultivo')->where('formulario_id', $id)->get();

            foreach ($sectorAgricolas as $sectorAgricola) {
                $sectorAgricola->updateSectorAgricola($validatedData, $sectorAgricola);
            }

            $areasForestales = AreaForestal::with('detalleAreaForestal')->where('formulario_id', $id)->get();

            foreach($areasForestales as $areaForestal){
                $areaForestal->update([
                    'hectareas_perdidas_forestales' => $validatedData['hectareas_perdidas_forestales'][$areaForestal->detalle_area_forestal_id] ?? 0,
                ]);
            }


            $faunaSilvestres = FaunaSilvestre::with('detalleFaunaSilvestre','tipoEspecie')->where('formulario_id', $formulario->id)->get();

            foreach ( $faunaSilvestres as $faunaSilvestre){
                $faunaSilvestre->update([
                    'numero_fauna_silvestre' => $validatedData['numero_fauna_silvestre'][$faunaSilvestre->detalle_fauna_silvestre_id][$faunaSilvestre->tipo_especie_id] ?? 0,
                ]);
            }

               // Procesar la actualización de las cantidades de plantines
                foreach ($validatedData['cantidad_plantines'] as $index => $cantidad) {
                    // Obtener el ID correspondiente para este índice
                    $plantinId = $validatedData['id_plantins'][$index];

                    // Buscar el plantín usando el ID
                    $plantin = Reforestacion::find($plantinId);

                    if ($plantin) {
                        // Actualiza la cantidad de plantines
                        $plantin->cantidad_plantines = $cantidad;
                        $plantin->save(); // Guarda los cambios
                    }
                }


            DB::commit();

            return redirect()->route('formularios.index')->with('success', 'Formulario actualizado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            // Manejar el error, por ejemplo, mostrar un mensaje al usuario
            return redirect()->back()->withErrors(['error' => 'Ocurrió un error al actualizar el formulario.']);
        }
    }

    public function destroy(Formulario $formulario)
    {
        try {
            // Llamamos a safeDelete() para eliminar el formulario y sus relaciones de forma segura
            $formulario->safeDelete();

            return redirect()->route('formularios.index')->with('success', 'Formulario eliminado correctamente');

        } catch (\Exception $e) {
            // En caso de error, devolver al usuario con el error
            return redirect()->back()->withErrors(['error' => 'Ocurrió un error al eliminar el formulario.']);
        }
    }
}
