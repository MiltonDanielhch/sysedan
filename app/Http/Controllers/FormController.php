<?php

namespace App\Http\Controllers;

use App\Models\Comunidad;
use App\Models\ComunidadIncendio;
use App\Models\DetalleAreaForestal;
use App\Models\DetalleEnfermedad;
use App\Models\DetalleFaunaSilvestre;
use App\Models\Formulario;
use App\Models\GrupoEtario;
use App\Models\Incendio;
use App\Models\Institucion;
use App\Models\ModalidadEducacion;
use App\Models\Municipio;
use App\Models\Provincia;
use App\Models\TipoCultivo;
use App\Models\TipoEspecie;
use App\Models\TipoFaunaEspecie;
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

    public function create(Request $request){
        $provincias = Provincia::all();
        $municipios = Municipio::all();
        $grupoEtarios = GrupoEtario::all();
        $detalleEnfermedades = DetalleEnfermedad::all();
        $modalidadEducacions = ModalidadEducacion::all();
        $institucions = Institucion::all();
        $tipoInfraestructuras = TipoInfraestructura::all();
        $tiposerviciobasicos = TipoServicioBasico::all();
        $tipoEspecies = TipoEspecie::all();
        $tipoCultivos = TipoCultivo::all();
        $detalleAreaForestals = DetalleAreaForestal::all();
        $detalleFaunaSilvestres = DetalleFaunaSilvestre::all();
        $tipoFaunaEspecies = TipoFaunaEspecie::all();
        return view('vendor.voyager.formularios.edit-add', compact('provincias', 'municipios', 'grupoEtarios', 'detalleEnfermedades', 'modalidadEducacions', 'institucions', 'tipoInfraestructuras', 'tiposerviciobasicos', 'tipoEspecies', 'tipoCultivos', 'detalleAreaForestals', 'detalleFaunaSilvestres', 'tipoFaunaEspecies'));
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



    public function store(Request $request)
    {
        // $datos = request()->all();
        // return response()->json($datos);

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
        ]);

        return DB::transaction(function () use ($validatedData) {

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
            Formulario::create([
                'fecha_llenado' => $validatedData['fecha_llenado'],
                'comunidad_id' => $comunidad->id,
                'incendio_id' => $incendio->id,
            ]);


            $comunidad->incendios()->attach($incendio, [
                'incendios_registrados' => $validatedData['incendios_registrados'],
                'incendios_activos' => $validatedData['incendios_activos'],
                'necesidades' => $validatedData['necesidades'],
                'num_familias_afectadas' => $validatedData['num_familias_afectadas'],
                'num_familias_damnificadas' => $validatedData['num_familias_damnificadas'],
                'comunidad_id' => $comunidad->id,
                'incendio_id' => $incendio->id,
            ]);


            // Crear o actualizar el registro en comunidad_incendio
            // try {
            //     ComunidadIncendio::updateOrCreate(
            //         ['comunidad_id' => $comunidad->id, 'incendio_id' => $incendio->id],
            //         [
            //             'incendios_registrados' => $validatedData['incendios_registrados'],
            //             'incendios_activos' => $validatedData['incendios_activos'],
            //             'necesidades' => $validatedData['necesidades'],
            //             'num_familias_afectadas' => $validatedData['num_familias_afectadas'],
            //             'num_familias_damnificadas' => $validatedData['num_familias_damnificadas'],
            //         ]
            //     );
            // } catch (\Exception $e) {
            //     // Manejar la excepción
            //     Log::error('Error al actualizar o crear ComunidadIncendio: ' . $e->getMessage());
            //     // Puedes enviar una notificación o tomar otras acciones aquí
            // }

            // Redirigir después de guardar
            return redirect()->route('formularios.index')->with('success', 'Formulario guardado correctamente');
        }, 5); // Reintenta la transacción hasta 5 veces en caso de deadlock
    }


}

